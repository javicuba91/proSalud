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
    public function index(Request $request)
    {
        $query = \App\Models\RespuestaExperto::query();

        // Filtrar por categoría de la pregunta
        if ($request->filled('categoria_id')) {
            $query->whereHas('pregunta', function($q) use ($request) {
                $q->where('categoria_id', $request->categoria_id);
            });
        }

        // Filtrar por especialidad de la pregunta
        if ($request->filled('especialidad_id')) {
            $query->whereHas('pregunta', function($q) use ($request) {
                $q->where('especialidad_id', $request->especialidad_id);
            });
        }

        // Filtrar por subespecialidad de la pregunta
        if ($request->filled('sub_especialidad_id')) {
            $query->whereHas('pregunta', function($q) use ($request) {
                $q->where('sub_especialidad_id', $request->sub_especialidad_id);
            });
        }

        // Filtrar por profesional que respondió
        if ($request->filled('profesional_id')) {
            $query->where('profesional_id', $request->profesional_id);
        }

        $respuestas = $query->with(['pregunta.categoria', 'pregunta.especialidad', 'pregunta.subespecialidad', 'profesional.user'])->get();

        // Obtener datos para filtros
        $categorias = \App\Models\CategoriaProfesional::all();
        $especialidades = \App\Models\Especialidad::whereNull('padre_id')->get();
        $profesionales = \App\Models\Profesional::orderBy('nombre_completo')->get();

        return view('admin.respuestas.index', compact('respuestas', 'categorias', 'especialidades', 'profesionales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $preguntas = PreguntaExperto::with(['categoria', 'especialidad', 'subespecialidad'])->get();
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
        $preguntas = PreguntaExperto::with(['categoria', 'especialidad', 'subespecialidad'])->get();
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
     * Get professionals filtered by question's category, specialty and subspecialty
     */
    public function ProfesionalesPregunta(Request $request)
    {
        $preguntaId = $request->get('pregunta_id');

        if (!$preguntaId) {
            return response()->json([]);
        }

        // Obtener la pregunta con sus categorías y especialidades
        $pregunta = PreguntaExperto::with(['categoria', 'especialidad', 'subespecialidad'])->find($preguntaId);

        if (!$pregunta) {
            return response()->json([]);
        }

        // Obtener profesionales que coincidan con la categoría, especialidad o subespecialidad de la pregunta
        $profesionales = Profesional::with('user')
            ->where(function($query) use ($pregunta) {
                // Filtrar por categoría si la pregunta tiene categoría
                if ($pregunta->categoria_id) {
                    $query->orWhere('categoria_id', $pregunta->categoria_id);
                }

                // Filtrar por especialidad principal si la pregunta tiene especialidad
                if ($pregunta->especialidad_id) {
                    $query->orWhereHas('especializaciones', function($subQuery) use ($pregunta) {
                        $subQuery->where('especialidad_id', $pregunta->especialidad_id);
                    });
                }

                // Filtrar por subespecialidad si la pregunta tiene subespecialidad
                if ($pregunta->sub_especialidad_id) {
                    $query->orWhereHas('especializaciones', function($subQuery) use ($pregunta) {
                        $subQuery->where('sub_especialidad_id', $pregunta->sub_especialidad_id);
                    });
                }
            })
            ->get();

        // Formatear la respuesta para el select
        $profesionalesFormatted = $profesionales->map(function($profesional) {
            return [
                'id' => $profesional->id,
                'nombre_completo' => $profesional->nombre_completo ?? 'Profesional #' . $profesional->id
            ];
        });

        return response()->json($profesionalesFormatted);
    }
}
