<?php
namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Producto;
use App\Models\Almacen;
use App\Models\InventarioAlmacenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 25);
        $stocks = Stock::with(['producto', 'almacen'])
            ->when($search, function ($query, $search) {
                return $query->where('tipo', 'like', '%' . $search . '%')
                    ->orWhere('cantidad', 'like', '%' . $search . '%')
                    ->orWhereHas('producto', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%")
                          ->orWhere('codigo', 'like', "%{$search}%")
                          ->orWhere('codigo_de_barras', 'like', "%{$search}%");
                    })
                    ->orWhereHas('almacen', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%")
                          ->orWhere('ubicacion', 'like', "%{$search}%");
                    });
            })
            ->paginate($perPage);
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $productos = Producto::all();
        $almacenes = Almacen::all();
        return view('stocks.create', compact('productos', 'almacenes'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'producto_id' => 'required|exists:productos,id',
                'tipo' => 'required|in:entrada,salida',
                'cantidad' => 'required|integer|min:1',
                'almacen_id' => 'required|exists:almacens,id',
            ]);

            $producto = Producto::findOrFail($request->producto_id);
            $almacen = Almacen::findOrFail($request->almacen_id);

            // Verificar el stock suficiente en el almacén específico
            $inventario = InventarioAlmacenes::firstOrNew([
                'producto_id' => $producto->id,
                'almacen_id' => $almacen->id
            ]);

            if ($request->tipo === 'salida') {
                if ($inventario->cantidad < $request->cantidad) {
                    DB::rollBack();
                    return back()->withErrors(['error' => 'Stock insuficiente en este almacén para realizar esta salida.']);
                }
                $inventario->cantidad -= $request->cantidad;
            } else {
                $inventario->cantidad += $request->cantidad;
            }

            // Guardar el inventario actualizado del almacén
            $inventario->save();

            // Crear el movimiento de stock
            Stock::create([
                'producto_id' => $request->producto_id,
                'tipo' => $request->tipo,
                'cantidad' => $request->cantidad,
                'almacen_id' => $request->almacen_id,
            ]);

            // Actualizar la cantidad total de producto
            $producto->cantidad += $request->tipo === 'entrada' ? $request->cantidad : -$request->cantidad;
            $producto->save();

            DB::commit();
            return redirect()->route('stocks.index')->with('success', 'Movimiento de stock registrado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'producto_id' => 'required|exists:productos,id',
                'tipo' => 'required|in:entrada,salida',
                'cantidad' => 'required|integer|min:1',
                'almacen_id' => 'required|exists:almacens,id',
            ]);

            $stock = Stock::findOrFail($id);
            $producto = Producto::findOrFail($request->producto_id);
            $almacen = Almacen::findOrFail($request->almacen_id);

            // Revertir el cambio anterior en cantidad del inventario específico
            $inventario = InventarioAlmacenes::where('producto_id', $producto->id)
                ->where('almacen_id', $almacen->id)
                ->firstOrFail();

            if ($stock->tipo === 'entrada') {
                $inventario->cantidad -= $stock->cantidad;
            } else {
                $inventario->cantidad += $stock->cantidad;
            }

            // Validar el stock en el almacén seleccionado
            if ($request->tipo === 'salida' && $inventario->cantidad < $request->cantidad) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Stock insuficiente en este almacén para realizar esta salida.']);
            }

            // Aplicar el nuevo cambio en el inventario
            if ($request->tipo === 'entrada') {
                $inventario->cantidad += $request->cantidad;
            } else {
                $inventario->cantidad -= $request->cantidad;
            }
            $inventario->save();

            // Actualizar el movimiento de stock
            $stock->update([
                'producto_id' => $request->producto_id,
                'tipo' => $request->tipo,
                'cantidad' => $request->cantidad,
                'almacen_id' => $request->almacen_id,
            ]);

            // Ajustar la cantidad del producto
            $producto->cantidad += $request->tipo === 'entrada' ? $request->cantidad : -$request->cantidad;
            $producto->save();

            DB::commit();
            return redirect()->route('stocks.index')->with('success', 'Movimiento de stock actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $stock = Stock::findOrFail($id);
            $producto = Producto::findOrFail($stock->producto_id);
            $almacen = Almacen::findOrFail($stock->almacen_id);

            // Ajustar la cantidad del producto en el inventario del almacén
            $inventario = InventarioAlmacenes::where('producto_id', $producto->id)
                ->where('almacen_id', $almacen->id)
                ->firstOrFail();

            if ($stock->tipo === 'entrada') {
                $inventario->cantidad -= $stock->cantidad;
            } else {
                $inventario->cantidad += $stock->cantidad;
            }
            $inventario->save();

            // Ajustar la cantidad total del producto
            $producto->cantidad -= $stock->tipo === 'entrada' ? $stock->cantidad : -$stock->cantidad;
            $producto->save();

            $stock->delete();

            DB::commit();
            return redirect()->route('stocks.index')->with('success', 'Movimiento de stock eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al eliminar el movimiento de stock.']);
        }
    }
}
