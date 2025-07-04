<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use App\Http\Requests\StorePropietarioRequest;
use App\Http\Requests\UpdatePropietarioRequest;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropietarioRequest $request)
    {
        $data = $request->validated();
        $propietario = Propietario::create($data);
        // ... lógica adicional si es necesario ...
        return redirect()->route('propietarios.index')->with('success', 'Propietario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Propietario $propietario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Propietario $propietario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropietarioRequest $request, Propietario $propietario)
    {
        $data = $request->validated();
        $propietario->update($data);
        // ... lógica adicional si es necesario ...
        return redirect()->route('propietarios.index')->with('success', 'Propietario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Propietario $propietario)
    {
        //
    }
}
