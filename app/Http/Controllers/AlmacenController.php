<?php
namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenController extends Controller
{
    /**
     * Muestra una lista de todos los almacenes.
     */
    public function index()
    {
        $almacenes = Almacen::all();
        return view('almacenes.index', compact('almacenes'));
    }

    /**
     * Muestra el formulario para crear un nuevo almacén.
     */
    public function create()
    {
        return view('almacenes.create');
    }

    /**
     * Guarda un nuevo almacén en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            Almacen::create($request->all());
            DB::commit();
            return redirect()->route('almacenes.index')->with('success', 'Almacén creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al crear el almacén: ' . $e->getMessage()]);
        }
    }

    /**
     * Muestra los detalles de un almacén específico, incluyendo el stock de productos.
     */
    public function show(Almacen $almacene)
    {
        DB::beginTransaction();
        try {
            $stocks = Stock::with('producto')
                ->where('almacen_id', $almacene->id)
                ->get();

            DB::commit();
            return view('almacenes.show', compact('almacene', 'stocks'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al cargar los detalles del almacén: ' . $e->getMessage()]);
        }
    }

    /**
     * Muestra el formulario para editar un almacén específico.
     */
    public function edit(Almacen $almacene)
    {
        return view('almacenes.edit', compact('almacene'));
    }

    /**
     * Actualiza un almacén específico en la base de datos.
     */
    public function update(Request $request, Almacen $almacene)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $almacene->update($request->all());
            DB::commit();
            return redirect()->route('almacenes.index')->with('success', 'Almacén actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar el almacén: ' . $e->getMessage()]);
        }
    }

    /**
     * Elimina un almacén específico de la base de datos.
     */
    public function destroy(Almacen $almacene)
    {
        DB::beginTransaction();
        try {
            $almacene->delete();
            DB::commit();
            return redirect()->route('almacenes.index')->with('success', 'Almacén eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al eliminar el almacén: ' . $e->getMessage()]);
        }
    }
}
