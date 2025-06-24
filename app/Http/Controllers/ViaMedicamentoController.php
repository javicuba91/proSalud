<?php

namespace App\Http\Controllers;

use App\Models\ViaAdministracionMedicamento;
use Illuminate\Http\Request;

class ViaMedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vias = ViaAdministracionMedicamento::all();
        return view('admin.vias.index', compact('vias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        ViaAdministracionMedicamento::create($request->all());

        return redirect()->route('vias.index')
            ->with('success', 'Vía de administración creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ViaAdministracionMedicamento $via)
    {
        $via->delete();
        return redirect()->route('vias.index')->with('eliminado', 'ok');
    }
}
