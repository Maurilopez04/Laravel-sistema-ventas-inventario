<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 5);
    
        $productos = Producto::with(['categoria', 'marca'])
            ->when($search, function ($query, $search) {
                return $query->where('nombre', 'like', "%{$search}%")
                    ->orWhere('codigo', 'like', "%{$search}%")
                    ->orWhere('codigo_de_barras', 'like', "%{$search}%")
                    ->orWhereHas('categoria', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    })
                    ->orWhereHas('marca', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    });
            })
            ->paginate($perPage)
            ->appends(['search' => $search, 'perPage' => $perPage]);
    
        return view('productos.index', compact('productos', 'search', 'perPage'));
    }
    
    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('productos.create', compact('categorias', 'marcas'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
        $validatedData = $request->validate([
            'codigo' => 'required|unique:productos,codigo|max:255',
            'codigo_de_barras' => 'nullable|unique:productos,codigo_de_barras|max:255',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
            'costo' => 'required|numeric',
            'precioMayorista' => 'required|numeric',
            'precioMinorista' => 'required|numeric',
            'precioConInstalacion' => 'nullable|numeric',
            'categoria_id' => 'nullable|exists:categorias,id',
            'marca_id' => 'nullable|exists:marcas,id',
        ]);
    

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            $validatedData['imagen'] = $request->file('imagen')->store('productos', 'public');
        }
        $producto = new Producto();
        $producto->fill($validatedData);
        $producto->save();
        DB::commit();
        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear el producto');
            }
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'marca'])->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('productos.edit', compact('producto', 'categorias', 'marcas'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $producto = Producto::findOrFail($id);
            $validatedData = $request->validate([
                'codigo' => 'required|max:255|unique:productos,codigo,' . $producto->id,
                'codigo_de_barras' => 'nullable|max:255|unique:productos,codigo_de_barras,' . $producto->id,
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'imagen' => 'nullable|image|max:2048',
                'costo' => 'nullable|numeric',
                'precioMayorista' => 'nullable|numeric',
                'precioMinorista' => 'nullable|numeric',
                'precioConInstalacion' => 'nullable|numeric',
                'categoria_id' => 'nullable|exists:categorias,id',
                'marca_id' => 'nullable|exists:marcas,id',
            ]);
    
            // Manejo de imagen
            if ($request->hasFile('imagen')) {
                // Eliminar la imagen anterior si existe
                if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                    Storage::disk('public')->delete($producto->imagen);
                }
                $validatedData['imagen'] = $request->file('imagen')->store('productos', 'public');
            }
    
            $producto->fill($validatedData);
            $producto->save();
            DB::commit();
            return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar producto: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error al actualizar el producto.']);
        }
    }
    
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
            }
            DB::commit();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar producto: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error al eliminar el producto.']);
            }
    }
}
