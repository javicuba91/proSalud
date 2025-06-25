<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recetas = Receta::all();
        return view('admin.recetas.index', compact('recetas'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Receta $receta)
    {
        return view('admin.recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receta = Receta::findOrFail($id);
        $pacientes = \App\Models\Paciente::all();
        $presentaciones = \App\Models\PresentacionMedicamento::all();
        $vias = \App\Models\ViaAdministracionMedicamento::all();
        $intervalos = \App\Models\IntervaloMedicamento::all();
        return view('admin.recetas.edit', compact('receta', 'pacientes', 'presentaciones', 'vias', 'intervalos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'informe_consulta_id' => 'required|exists:informes_consultas,id',
            'qr' => 'nullable|string|max:255',
            'fecha_emision' => 'required|date',
            'diagnostico' => 'nullable|string',
            'comentarios' => 'nullable|string',
            'ruta_firma' => 'nullable|string|max:255',
        ]);

        $receta = Receta::findOrFail($id);
        $receta->informe_consulta_id = $request->informe_consulta_id;
        $receta->fecha_emision = $request->fecha_emision;
        $receta->diagnostico = $request->diagnostico;
        $receta->comentarios = $request->comentarios;
        $receta->ruta_firma = $request->ruta_firma;
        $receta->save();

        // Actualizar paciente (a través de la cita del informe de consulta)
        if ($request->filled('paciente_id') && $receta->informeConsulta && $receta->informeConsulta->cita) {
            $cita = $receta->informeConsulta->cita;
            $cita->paciente_id = $request->paciente_id;
            $cita->save();
        }

        // Actualizar medicamentos recetados
        if ($request->has('medicamentos')) {
            foreach ($request->medicamentos as $i => $medData) {
                $med = $receta->medicamentosRecetados[$i] ?? null;
                if ($med) {
                    $med->dosis = $medData['dosis'] ?? $med->dosis;
                    $med->presentacion_medicamentos_id = $medData['presentacion_id'] ?? $med->presentacion_medicamentos_id;
                    $med->via_administracion_medicamentos_id = $medData['via_id'] ?? $med->via_administracion_medicamentos_id;
                    $med->intervalo_medicamentos_id = $medData['intervalo_id'] ?? $med->intervalo_medicamentos_id;
                    $med->duracion = $medData['duracion'] ?? $med->duracion;
                    $med->save();
                }
            }
        }

        return redirect()->route('recetas.index')
            ->with('success', 'Receta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receta $receta)
    {
        $receta->delete();
        return redirect()->route('recetas.index')->with('eliminado', 'ok');
    }
}
