<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use App\Models\Paciente;
use App\Models\Profesional;
use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Valoracion::with(['paciente', 'profesional']);

        // Aplicar filtros
        if ($request->filled('paciente_id')) {
            $query->where('paciente_id', $request->paciente_id);
        }

        if ($request->filled('profesional_id')) {
            $query->where('profesional_id', $request->profesional_id);
        }

        if ($request->filled('modalidad')) {
            $query->where('modalidad', $request->modalidad);
        }

        if ($request->filled('puntuacion')) {
            $query->where('puntuacion', $request->puntuacion);
        }

        $valoraciones = $query->orderBy('fecha', 'desc')->get();

        // Obtener datos para los filtros
        $pacientes = Paciente::orderBy('nombre_completo', 'ASC')->get();
        $profesionales = Profesional::orderBy('nombre_completo', 'ASC')->get();

        return view('admin.valoraciones.index', compact('valoraciones', 'pacientes', 'profesionales'));
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
    public function show(Valoracion $valoracion)
    {
        return view('admin.valoraciones.show', compact('valoracion'));
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
    public function destroy(Valoracion $valoracion)
    {
        $valoracion->delete();
        return redirect()->route('valoraciones.index')->with('eliminado', 'ok');
    }
}
