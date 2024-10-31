<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $search = $request->input('search');
    $perPage = $request->input('perPage', 5); // Valor por defecto: 10

    $clientes = Cliente::when($search, function ($query, $search) {
        return $query->where('nombre', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('ci_ruc', 'like', "%{$search}%");
    })->paginate($perPage)->appends(['search' => $search, 'perPage' => $perPage]);

    return view('clientes.index', compact('clientes', 'search', 'perPage'));
}

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        $request->validate([
            'nombre' => 'required',
            'email' => 'nullable|email',
            'telefono' => 'nullable',
            'direccion' => 'nullable', 
            'ci_ruc' => 'required', 
            'fecha_cumple' => 'nullable'
            ]);
        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente creado con exito');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error al crear el cliente');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate([
                'nombre' => 'required',
                'email' => 'nullable|email',
                'telefono' => 'nullable',
                'direccion' => 'nullable',
                'ci_ruc' => 'required',
                'fecha_cumple' => 'nullable'
                ]);
                $cliente = Cliente::find($id);
                $cliente->update($request->all());
                return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con exito');
                }catch(\Exception $e){
                    return redirect()->back()->with('error', 'Error al actualizar el cliente');
                }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $cliente = Cliente::find($id);
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado con exito');
            }catch(\Exception $e){
                return redirect()->back()->with('error', 'Error al eliminar el cliente');
                }
    }
}
