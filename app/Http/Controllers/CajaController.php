<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Muestra la lista de todas las cajas.
     */
    public function index()
    {
        $cajas = Caja::all();
        return view('cajas.index', compact('cajas'));
    }

    /**
     * Muestra el formulario para crear una nueva caja.
     */
    public function create()
    {
        return view('cajas.create');
    }

    /**
     * Almacena una nueva caja en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'saldo_inicial' => 'required|numeric|min:0',
        ]);

        // Se asigna el saldo inicial como saldo actual
        $validatedData['saldo_actual'] = $validatedData['saldo_inicial'];

        Caja::create($validatedData);

        return redirect()->route('cajas.index')->with('success', 'Caja creada exitosamente.');
    }

    /**
     * Muestra los detalles de una caja específica.
     */
    public function show($id)
    {
        $caja = Caja::findOrFail($id);
        return view('cajas.show', compact('caja'));
    }

    /**
     * Muestra el formulario para editar una caja existente.
     */
    public function edit($id)
    {
        $caja = Caja::findOrFail($id);
        return view('cajas.edit', compact('caja'));
    }

    /**
     * Actualiza una caja existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
            'saldo_inicial' => 'required|numeric|min:0',
        ]);

        $caja = Caja::findOrFail($id);

        // Actualizar solo los datos editables
        $caja->update([
            'nombre' => $validatedData['nombre'],
            'descripcion' => $validatedData['descripcion'],
            'saldo_inicial' => $validatedData['saldo_inicial'],
        ]);

        return redirect()->route('cajas.index')->with('success', 'Caja actualizada exitosamente.');
    }

    /**
     * Elimina una caja de la base de datos.
     */
    public function destroy($id)
    {
        $caja = Caja::findOrFail($id);
        $caja->delete();

        return redirect()->route('cajas.index')->with('success', 'Caja eliminada exitosamente.');
    }
}

