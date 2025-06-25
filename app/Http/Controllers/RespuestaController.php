<?php

namespace App\Http\Controllers;

use App\Models\RespuestaExperto;
use App\Models\PreguntaExperto;
use App\Models\Profesional;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $respuestas = RespuestaExperto::all();
        return view('admin.respuestas.index', compact('respuestas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $preguntas = PreguntaExperto::with(['especialidad', 'subespecialidad'])->get();
        // Ya no cargamos todos los profesionales, se cargarán via AJAX según la pregunta seleccionada
        $profesionales = collect(); // Colección vacía

        return view('admin.respuestas.create', compact('preguntas', 'profesionales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'preguntas_expertos_id' => 'required|exists:preguntas_expertos,id',
            'profesional_id' => 'required|exists:profesionales,id',
            'respuesta' => 'required|string',
        ]);

        RespuestaExperto::create($request->all());


        return redirect()->route('respuestas.index')
            ->with('success', 'Respuesta creada correctamente.');
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
    public function edit(RespuestaExperto $respuesta)
    {
        $preguntas = PreguntaExperto::with(['especialidad', 'subespecialidad'])->get();
        $profesionales = collect(); // Se cargarán vía AJAX

        return view('admin.respuestas.edit', compact('respuesta', 'preguntas', 'profesionales'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RespuestaExperto $respuesta)
    {
        $request->validate([
            'preguntas_expertos_id' => 'required|exists:preguntas_expertos,id',
            'profesional_id' => 'required|exists:profesionales,id',
            'respuesta' => 'required|string',
        ]);

        $respuesta->update($request->all());

        return redirect()->route('respuestas.index')
            ->with('success', 'Respuesta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RespuestaExperto $respuesta)
    {
        $respuesta->delete();
        return redirect()->route('respuestas.index')->with('eliminado', 'ok');
    }

    /**
     * Get professionals filtered by question's speciality
     */
    public function ProfesionalesPregunta(Request $request)
    {
        $preguntaId = $request->get('pregunta_id');

        if (!$preguntaId) {
            return response()->json([]);
        }

        // Obtener la pregunta con sus especialidades
        $pregunta = PreguntaExperto::find($preguntaId);

        if (!$pregunta) {
            return response()->json([]);
        }

        // Obtener profesionales que tienen la especialidad principal o sub-especialidad de la pregunta
        $profesionales = Profesional::with('user')
            ->whereHas('especializaciones', function($query) use ($pregunta) {
                // Filtrar por especialidad principal
                $query->where('especialidad_id', $pregunta->especialidad_id);
            })->get();

        // Formatear la respuesta para el select
        $profesionalesFormatted = $profesionales->map(function($profesional) {
            return [
                'id' => $profesional->id,
                'nombre_completo' => $profesional->nombre_completo?? 'Profesional #' . $profesional->id
            ];
        });

        return response()->json($profesionalesFormatted);
    }
}
