<?php

namespace App\Http\Controllers;

use App\Models\InformeConsulta;
use App\Models\Receta;
use App\Models\Paciente;
use App\Models\Profesional;
use Illuminate\Http\Request;

class InformeConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = InformeConsulta::with(['cita.paciente', 'cita.profesional']);

        // Aplicar filtros
        if ($request->filled('paciente_id')) {
            $query->whereHas('cita', function ($q) use ($request) {
                $q->where('paciente_id', $request->paciente_id);
            });
        }

        if ($request->filled('profesional_id')) {
            $query->whereHas('cita', function ($q) use ($request) {
                $q->where('profesional_id', $request->profesional_id);
            });
        }

        if ($request->filled('modalidad')) {
            $query->whereHas('cita', function ($q) use ($request) {
                $q->where('modalidad', $request->modalidad);
            });
        }

        $informes = $query->orderBy('created_at', 'desc')->get();

        // Obtener datos para los filtros
        $pacientes = Paciente::orderBy('nombre_completo', 'ASC')->get();
        $profesionales = Profesional::orderBy('nombre_completo', 'ASC')->get();

        return view('admin.informes.index', compact('informes', 'pacientes', 'profesionales'));
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
    public function show(InformeConsulta $informe)
    {
        $receta = Receta::where('informe_consulta_id','=',$informe->id)->firstOrFail();
        $pacientes = Paciente::orderBy('nombre_completo', 'ASC')->get();

        return view('admin.informes.show', compact('informe','receta','pacientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $informe = InformeConsulta::findOrFail($id);
        $pacientes = Paciente::orderBy('nombre_completo', 'ASC')->get();
        return view('admin.informes.edit', compact('informe', 'pacientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'motivo_consulta' => 'required|string',
            'antecedentes_familiares' => 'nullable|string',
            'enfermedad_actual' => 'nullable|string',
            'exploracion_fisica' => 'nullable|string',
            'pruebas_complementarias' => 'nullable|string',
            'juicio_clinico' => 'nullable|string',
            'dibujo_dental' => 'nullable|string',
            'plan_terapeutico' => 'nullable|string',
            'paciente_id' => 'nullable|exists:pacientes,id',
        ]);

        $informe = InformeConsulta::findOrFail($id);

        // Actualizar los campos del informe
        $informe->update([
            'motivo_consulta' => $request->motivo_consulta,
            'antecedentes_familiares' => $request->antecedentes_familiares,
            'enfermedad_actual' => $request->enfermedad_actual,
            'exploracion_fisica' => $request->exploracion_fisica,
            'pruebas_complementarias' => $request->pruebas_complementarias,
            'juicio_clinico' => $request->juicio_clinico,
            'dibujo_dental' => $request->dibujo_dental,
            'plan_terapeutico' => $request->plan_terapeutico,
        ]);

        // Si se proporciona un nuevo paciente, actualizar la cita asociada
        if ($request->filled('paciente_id') && $informe->cita) {
            $pacienteAnterior = $informe->cita->paciente->nombre_completo;
            $informe->cita->update(['paciente_id' => $request->paciente_id]);

            // Verificar integridad después del cambio
            $verificacion = $this->verificarIntegridadRelaciones($informe);

            if (isset($verificacion['error'])) {
                return redirect()->route('informes.index')
                    ->with('error', 'Error en la actualización: ' . $verificacion['error']);
            }

            $nuevoPaciente = $informe->fresh()->cita->paciente->nombre_completo;
            $mensaje = "Informe actualizado correctamente. Paciente cambiado de '{$pacienteAnterior}' a '{$nuevoPaciente}'. " . $verificacion['mensaje'];

            return redirect()->route('informes.index')
                ->with('success', $mensaje);
        }

        return redirect()->route('informes.index')
            ->with('success', 'Informe de consulta actualizado correctamente.');
    }

    /**
     * Cambiar el paciente asociado al informe específicamente desde la vista show
     */
    public function changePaciente(Request $request, string $id)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
        ]);

        $informe = InformeConsulta::findOrFail($id);

        if ($informe->cita) {
            $informe->cita->update(['paciente_id' => $request->paciente_id]);

            return redirect()->route('informes.show', $informe->id)
                ->with('success', 'Paciente asociado al informe actualizado correctamente.');
        }

        return redirect()->route('informes.show', $informe->id)
            ->with('error', 'No se pudo actualizar el paciente. La cita asociada no existe.');
    }

    /**
     * Verificar la integridad de las relaciones después de cambiar paciente
     */
    private function verificarIntegridadRelaciones(InformeConsulta $informe)
    {
        // Verificar que el informe tiene cita
        if (!$informe->cita) {
            return ['error' => 'El informe no tiene una cita asociada'];
        }

        // Verificar que la cita tiene paciente
        if (!$informe->cita->paciente) {
            return ['error' => 'La cita no tiene un paciente asociado'];
        }

        // Verificar recetas asociadas
        $recetas = Receta::where('informe_consulta_id', $informe->id)->get();

        return [
            'success' => true,
            'mensaje' => 'Verificación completada. ' .
                        ($recetas->count() > 0 ?
                            "Se mantienen {$recetas->count()} receta(s) asociada(s) al informe." :
                            "No hay recetas asociadas al informe.")
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformeConsulta $informe)
    {
        $informe->delete();
        return redirect()->route('informes.index')->with('eliminado', 'ok');
    }
}
