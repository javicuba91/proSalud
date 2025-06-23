<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\MedicamentoReceta;
use Illuminate\Http\Request;

class MedicamentosRecetaController extends Controller
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
    public function destroy($id)
    {
        MedicamentoReceta::destroy($id);
        return back()->with('success', 'Medicamento eliminado correctamente.');
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receta_id' => 'required|exists:recetas,id',
            'presentacion_medicamentos_id' => 'required|exists:presentacion_medicamentos,id',
            'medicamento_id' => 'required|exists:medicamentos,id',
            'dosis' => 'required|string|max:255',
            'via_administracion_medicamentos_id' => 'required|exists:via_administracion_medicamentos,id',
            'intervalo_medicamentos_id' => 'required|exists:intervalo_medicamentos,id',
            'duracion' => 'required|string|max:255',
        ]);

        MedicamentoReceta::create([
            'receta_id' => $validated['receta_id'],
            'medicamento_id' => $validated['medicamento_id'],
            'presentacion_medicamentos_id' => $validated['presentacion_medicamentos_id'],
            'dosis' => $validated['dosis'],
            'via_administracion_medicamentos_id' => $validated['via_administracion_medicamentos_id'],
            'intervalo_medicamentos_id' => $validated['intervalo_medicamentos_id'],
            'duracion' => $validated['duracion'],
        ]);

        return back()->with('success', 'Medicamento añadido correctamente.');
    }
}
