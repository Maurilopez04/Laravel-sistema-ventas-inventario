<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $marca = new Marca();
        $marca->nombre = $request->input('nombre');
        $marca->descripcion = $request->input('descripcion');
        $marca->save();
        return redirect()->route('marcas.index')->with('success', 'Marca creada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $marca = Marca::find($id);
        $productos= Producto::where('marca_id', $id)->get();
        return view('marcas.show', compact('marca', 'productos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $marca = Marca::find($id);
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $marca = Marca::find($id);
        $marca->nombre = $request->input('nombre');
        $marca->descripcion = $request->input('descripcion');
        $marca->save();
        return redirect()->route('marcas.index')->with('success', 'Marca actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $marca = Marca::find($id);
        $marca->delete();
        return redirect()->route('marcas.index')->with('success', 'Marca eliminada con exito');
    }
}
