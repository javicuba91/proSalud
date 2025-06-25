<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodos = MetodoPago::all();
        return view('admin.metodos_pagos.index', compact('metodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.metodos_pagos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        MetodoPago::create($request->all());

        return redirect()->route('metodos-pagos.index')
            ->with('success', 'Método de Pago creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MetodoPago $metodo)
    {
        return view('admin.metodos_pagos.show', compact('metodo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetodoPago $metodo)
    {
        return view('admin.metodos_pagos.edit', compact('metodo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MetodoPago $metodo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $metodo->update($request->all());

        return redirect()->route('metodos-pagos.index')
            ->with('success', 'Método de Pago actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetodoPago $metodo)
    {
        $metodo->delete();
        return redirect()->route('metodos-pagos.index')->with('eliminado', 'ok');
    }
}
