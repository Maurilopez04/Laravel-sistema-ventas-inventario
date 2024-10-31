<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 5);
        $proveedores = Proveedor::where('nombre', 'like', '%' . $search . '%')
        ->orWhere('ruc', 'like', '%' . $search . '%')
        ->orWhere('telefono', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%')
        ->paginate($perPage);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        try{
            $validateData= $request->validate([
                'nombre' => 'required|max:255',
                'ruc' => 'required|max:255',
                'telefono' => 'nullable|max:20',
                'email' => 'nullable|max:255|email',
                'direccion' => 'nullable|max:255',
                ]);
            $proveedor = new Proveedor();
            $proveedor->fill($validateData);
            $proveedor->save();
            return redirect()->route('proveedores.index')->with('success', 'Proveedor creado con éxito');
            }catch(\Exception $e){
                return redirect()->back()->with('error', 'Error al crear el proveedor');
            }
    }

    public function show(string $id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(string $id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, string $id)
    {
        try{
            $proveedor = Proveedor::find($id);
            $validateData= $request->validate([
                'nombre' => 'required|max:255',
                'ruc' => 'required|max:255',
                'telefono' => 'nullable|max:20',
                'email' => 'nullable|max:255|email',
                'direccion' => 'nullable|max:255',
                ]);
            $proveedor->fill($validateData);
            $proveedor->save();
            return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado con éxito');
            }catch(\Exception $e){
                return redirect()->back()->with('error', 'Error al actualizar el proveedor');
            }
    }

    public function destroy(string $id)
    {
        try{
            $proveedor = Proveedor::find($id);
            $proveedor->delete();
            return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado con éxito');
            }catch(\Exception $e){
                return redirect()->back()->with('error', 'Error al eliminar el proveedor');
                }
    }
}
