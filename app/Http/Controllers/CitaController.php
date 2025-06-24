<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Profesional;
use App\Models\ConsultorioProfesional;

use App\Models\Cita;
use App\Models\EspecializacionesProfesional;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Cita::all();
        return view('admin.citas.index', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $pacientes = Paciente::all();
        $profesionales = Profesional::all();

        return view('admin.citas.create', compact('pacientes', 'profesionales'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $request->validate([
                'paciente_id' => 'required|exists:pacientes,id',
                'profesional_id' => 'required|exists:profesionales,id',
                'fecha_hora' => 'required|date_format:Y-m-d\TH:i',
                'modalidad' => 'required|in:presencial,videoconsulta',
                'motivo' => 'required|string|max:255',
                'consultorio_id' => 'nullable|exists:consultorios,id',
                'url_meet' => 'nullable|url|max:255',
                'estado' => 'required|in:pendiente,aceptada,cancelada,completada,noacude',
                'especializacion_id' => 'required|exists:especializaciones,id',
            ]);

            // Para depuración
            Log::info('Datos de la cita:', $request->all());

            $citaData = $request->all();
            // Establecer valores por defecto
            $citaData['recordatorio_enviado'] = false;
            $citaData['informe_creado'] = false;
            // Generar código QR antes de crear la cita
            $citaData['codigo_qr'] = strtoupper(Str::random(8));

            $cita = Cita::create($citaData);

            if (!$cita) {
                Log::error('Error al crear la cita');
                return back()->with('error', 'Error al crear la cita')->withInput();
            }

            return redirect()->route('citas.index')
                ->with('success', 'Cita creada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error en store: ' . $e->getMessage());
            return back()
                ->withErrors(['error' => 'Error al crear la cita: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        return view('admin.citas.show', compact('cita'));
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
    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('eliminado', 'ok');
    }

    public function especializacionesProfesional($profesional_id)
    {
        try {
            $especializaciones = EspecializacionesProfesional::with(['especialidad', 'subespecialidad'])
                ->where('profesional_id', $profesional_id)
                ->get();

            if ($especializaciones->isEmpty()) {
                return response()->json([]);
            }

            return response()->json($especializaciones->map(function ($e) {
                $nombre = $e->especialidad ? $e->especialidad->nombre : 'Sin especialidad';
                if ($e->subespecialidad) {
                    $nombre .= ' / ' . $e->subespecialidad->nombre;
                }
                return [
                    'id' => $e->id,
                    'nombre' => $nombre
                ];
            }));
        } catch (\Exception $e) {
            Log::error('Error al obtener especializaciones: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener especializaciones'], 500);
        }
    }

    public function modalidadesProfesional($profesional_id)
    {
        try {
            $profesional = Profesional::findOrFail($profesional_id);
            
            $modalidades = [];
            
            if ($profesional->presencial) {
                $modalidades[] = [
                    'value' => 'presencial',
                    'text' => 'Presencial'
                ];
            }
            
            if ($profesional->videoconsulta) {
                $modalidades[] = [
                    'value' => 'videoconsulta',
                    'text' => 'Videoconsulta'
                ];
            }
            
            return response()->json($modalidades);
        } catch (\Exception $e) {
            Log::error('Error al obtener modalidades: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener modalidades'], 500);
        }
    }

    public function consultoriosProfesional($profesional_id)
    {
        try {
            $consultorios = ConsultorioProfesional::where('profesional_id', $profesional_id)->get();
            
            return response()->json($consultorios->map(function ($consultorio) {
                return [
                    'id' => $consultorio->id,
                    'direccion' => $consultorio->direccion,
                    'clinica' => $consultorio->clinica
                ];
            }));
        } catch (\Exception $e) {
            Log::error('Error al obtener consultorios: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener consultorios'], 500);
        }
    }
}
