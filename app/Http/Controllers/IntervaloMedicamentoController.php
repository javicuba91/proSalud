<?php

namespace App\Http\Controllers;

use App\Models\IntervaloMedicamento;
use Illuminate\Http\Request;

class IntervaloMedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $intervalos = IntervaloMedicamento::all();
        return view('admin.intervalos.index', compact('intervalos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.intervalos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        IntervaloMedicamento::create($request->all());

        return redirect()->route('intervalos.index')
            ->with('success', 'Intervalo creado correctamente.');
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
        $intervalo = IntervaloMedicamento::find($id);
        return view('admin.intervalos.edit', compact('intervalo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $intervalo = IntervaloMedicamento::find($id);
        $intervalo->update($request->all());

        return redirect()->route('intervalos.index')
            ->with('success', 'Intervalo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IntervaloMedicamento $intervalo)
    {
        $intervalo->delete();
        return redirect()->route('intervalos.index')->with('eliminado', 'ok');
    }
}
