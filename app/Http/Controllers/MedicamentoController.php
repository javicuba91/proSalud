<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicamentos = Medicamento::all();
        return view('admin.medicamentos.index', compact('medicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.medicamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Medicamento::create($request->all());

        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento creado correctamente.');
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
        $medicamento = Medicamento::find($id);
        return view('admin.medicamentos.edit', compact('medicamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $medicamento = Medicamento::find($id);
        $medicamento->update($request->all());

        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();
        return redirect()->route('medicamentos.index')->with('eliminado', 'ok');
    }
}
