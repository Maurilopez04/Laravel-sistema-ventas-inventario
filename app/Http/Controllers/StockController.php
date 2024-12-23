<?php
namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Producto;
use App\Models\Almacen;
use App\Models\InventarioAlmacenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            ->orderBy('created_at', 'desc') // Ordenar por fecha más reciente
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
            // Validar datos de entrada
            $request->validate([
                'producto_id' => 'required|exists:productos,id',
                'tipo' => 'required|in:entrada,salida',
                'cantidad' => 'required|integer|min:1',
                'almacen_id' => 'required|exists:almacens,id',
            ]);

            // Encontrar el inventario existente
            $inventario = InventarioAlmacenes::findCompositeKey($request->almacen_id, $request->producto_id);

            if ($inventario) {
                // Si el inventario existe, actualizar la cantidad
                if ($request->tipo === 'salida') {
                    if ($inventario->cantidad < $request->cantidad) {
                        return back()->with('errorr', 'Stock insuficiente en este almacén para realizar esta salida.');
                    }
                    $nuevo_cantidad = $inventario->cantidad - $request->cantidad;
                } else {
                    $nuevo_cantidad = $inventario->cantidad + $request->cantidad;
                }

                // Usar Query Builder para actualizar
                DB::table('inventario_almacenes')
                    ->where('almacen_id', $request->almacen_id)
                    ->where('producto_id', $request->producto_id)
                    ->update(['cantidad' => $nuevo_cantidad]);
            } else {
                // Si el inventario no existe y el tipo es 'entrada', crear un nuevo registro
                if ($request->tipo === 'salida') {
                    return back()->with('errorr', 'No hay stock en este almacén para realizar una salida.');
                }
                DB::table('inventario_almacenes')->insert([
                    'almacen_id' => $request->almacen_id,
                    'producto_id' => $request->producto_id,
                    'cantidad' => $request->cantidad,
                ]);
            }

            // Registrar el movimiento en la tabla Stock
            Stock::create([
                'producto_id' => $request->producto_id,
                'tipo' => $request->tipo,
                'cantidad' => $request->cantidad,
                'almacen_id' => $request->almacen_id,
            ]);

            // Actualizar la cantidad total del producto
            $producto = Producto::findOrFail($request->producto_id);
            $producto->cantidad += ($request->tipo === 'entrada') ? $request->cantidad : -$request->cantidad;
            $producto->save();

            DB::commit();
            return redirect()->route('stocks.index')->with('success', 'Movimiento de stock registrado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error al registrar el movimiento de stock: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            DB::rollBack();
            return back()->with('errorr', 'Ocurrió un error al procesar su solicitud.');
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
                return back()->with('errorr', 'Stock insuficiente en este almacén para realizar esta salida.');
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
            Log::error('Error al registrar el movimiento de stock: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            DB::rollBack();
            return back()->with('errorr', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $stock = Stock::findOrFail($id);
            $producto = Producto::findOrFail($stock->producto_id);
            $almacen = Almacen::findOrFail($stock->almacen_id);
    
            // Ajustar la cantidad del producto en el inventario del almacén usando Query Builder
            $inventario = DB::table('inventario_almacenes')
                ->where('producto_id', $producto->id)
                ->where('almacen_id', $almacen->id)
                ->first();
    
            if ($inventario) {
                // Ajustar la cantidad según el tipo de movimiento
                if ($stock->tipo === 'entrada') {
                    $nuevoCantidad = $inventario->cantidad - $stock->cantidad;
                } else {
                    $nuevoCantidad = $inventario->cantidad + $stock->cantidad;
                }
    
                // Asegúrate de que la cantidad no sea negativa
                if ($nuevoCantidad < 0) {
                    DB::rollBack();
                    return back()->with('errorr', 'No se puede ajustar la cantidad del inventario a un número negativo.');
                }
    
                // Actualiza la cantidad en la tabla inventario_almacenes
                DB::table('inventario_almacenes')
                    ->where('producto_id', $producto->id)
                    ->where('almacen_id', $almacen->id)
                    ->update(['cantidad' => $nuevoCantidad]);
            } else {
                // Manejar el caso donde no se encontró el inventario, si es necesario
                return back()->with('errorr', 'Inventario no encontrado para el producto y almacén especificados.');
            }
    
            // Ajustar la cantidad total del producto
            $producto->cantidad -= $stock->tipo === 'entrada' ? $stock->cantidad : -$stock->cantidad;
            $producto->save();
    
            $stock->delete();
    
            DB::commit();
            return redirect()->route('stocks.index')->with('success', 'Movimiento de stock eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('errorr', 'Error al eliminar el movimiento de stock.');
        }
    }
}
