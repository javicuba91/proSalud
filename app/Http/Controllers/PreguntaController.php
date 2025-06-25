<?php

namespace App\Http\Controllers;

use App\Models\PreguntaExperto;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PreguntaExperto::query();

        if ($request->filled('especialidad_id')) {
            $query->where('especialidad_id', $request->especialidad_id);
        }
        if ($request->filled('subespecialidad_id')) {
            $query->where('sub_especialidad_id', $request->subespecialidad_id);
        }

        $preguntas = $query->get();
        $especialidades = Especialidad::whereNull('padre_id')->get();
        if ($request->filled('especialidad_id')) {
            $subespecialidades = Especialidad::where('padre_id', $request->especialidad_id)->get();
        } else {
            $subespecialidades = Especialidad::whereNotNull('padre_id')->get();
        }

        return view('admin.preguntas.index', compact('preguntas', 'especialidades', 'subespecialidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $especialidades = Especialidad::whereNull('padre_id')->get(); //
        return view('admin.preguntas.create', compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                'especialidad_id' => 'required|exists:especialidades,id',
                'sub_especialidad_id' => 'nullable|exists:especialidades,id',
                'pregunta' => 'required|string',
            ]);
            PreguntaExperto::create($request->all());

            return redirect()->route('preguntas.index')
                ->with('success', 'Pregunta creada correctamente.');
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
    public function edit(PreguntaExperto $pregunta)
    {
        $especialidades = Especialidad::whereNull('padre_id')->get();
        return view('admin.preguntas.edit', compact('pregunta', 'especialidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PreguntaExperto $pregunta)
    {
        $request->validate([
            'especialidad_id' => 'required|exists:especialidades,id',
            'sub_especialidad_id' => 'nullable|exists:especialidades,id',
            'pregunta' => 'required|string',
        ]);

        $pregunta->update($request->all());

        return redirect()->route('preguntas.index')
            ->with('success', 'Pregunta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreguntaExperto $pregunta)
    {
        $pregunta->delete();
        return redirect()->route('preguntas.index')->with('eliminado', 'ok');
    }

    /**
     * Obtener sub-especialidades por especialidad
     */
    public function subespecialidadesPorEspecialidad($especialidad_id)
    {
        try {
            $subespecialidades = Especialidad::where('padre_id', $especialidad_id)->get();

            return response()->json($subespecialidades->map(function ($subespecialidad) {
                return [
                    'id' => $subespecialidad->id,
                    'nombre' => $subespecialidad->nombre
                ];
            }));
        } catch (\Exception $e) {
            Log::error('Error al obtener sub-especialidades: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener sub-especialidades'], 500);
        }
    }
}
