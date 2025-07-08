<?php

namespace App\Http\Controllers;

use App\Models\Antecedente;
use App\Models\CategoriaProfesional;
use App\Models\Cita;
use App\Models\Ciudad;
use App\Models\ContactosEmergencia;
use App\Models\Emergencia;
use App\Models\Especialidad;
use App\Models\ImagenesPrueba;
use App\Models\InformeConsulta;
use App\Models\IntervaloMedicamento;
use App\Models\Medicamento;
use App\Models\Notificacion;
use App\Models\Paciente;
use App\Models\PresentacionMedicamento;
use App\Models\Prueba;
use App\Models\Receta;
use App\Models\SegurosMedicos;
use App\Models\User;
use App\Models\Valoracion;
use App\Models\ViaAdministracionMedicamento;
use App\Models\PresupuestoPrueba;
use App\Models\Profesional;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pacientes.index');
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

    public function update(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = Str::slug($paciente->id . '-' . time()) . '.' . $file->getClientOriginalExtension();
            $path = 'imagenes/pacientes/' . $paciente->id;
            $file->move(public_path($path), $filename);

            // Guardar la ruta relativa en la base de datos
            $paciente->foto = $path . '/' . $filename;
        }

        $paciente->nombre_completo = $request->nombre_completo;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero = $request->genero;
        $paciente->estado_civil = $request->estado_civil;
        $paciente->nacionalidad = $request->nacionalidad;
        $paciente->celular = $request->celular;
        $paciente->direccion = $request->direccion;
        $paciente->cedula = $request->cedula;
        $paciente->ciudad_id = $request->ciudad_id;
        $paciente->grupo_sanguineo = $request->grupo . "" . $request->rh;
        $paciente->save();

        $usuario = User::find($paciente->user_id);
        $usuario->name =  $request->nombre_completo;
        $usuario->save();

        // Validación opcional, ajusta según tus necesidades
        $request->validate([
            'antecedentes.*.alergias' => 'nullable|string|max:255',
            'antecedentes.*.condiciones_medicas' => 'nullable|string|max:255',
            'antecedentes.*.medicamentos' => 'nullable|string|max:255',



            'contactos_emergencia.*.nombre' => 'nullable|string|max:255',
            'contactos_emergencia.*.relacion' => 'nullable|string|max:255',
            'contactos_emergencia.*.telefono' => 'nullable|string|max:50',
        ]);

        // Insertar nuevos antecedentes (sin borrar los existentes)
        if ($request->has('antecedentes')) {
            foreach ($request->input('antecedentes') as $antecedenteData) {
                $paciente->antecedentes()->create($antecedenteData);
            }
        }

        if ($request->has('contactos_emergencia')) {
            foreach ($request->input('contactos_emergencia') as $contactoData) {
                $paciente->contactos_emergencia()->create($contactoData);
            }
        }

        if ($request->has('seguros_medicos')) {
            $paciente->segurosMedicos()->sync($request->input('seguros_medicos'));
        } else {
            $paciente->segurosMedicos()->detach();
        }

        if ($request->has('password')) {
            if ($request->password == $request->repetir_password) {
                $usuario = User::find($paciente->user_id);
                $usuario->password = bcrypt($request->password);
                $usuario->save();
            }
        }


        return redirect()->back()->with('success', 'Datos actualizados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function pedirCita()
    {
        return view('pacientes.pedirCita');
    }

    public function misCitas()
    {
        $paciente = Paciente::where('user_id', '=', Auth()->user()->id)->firstOrFail();
        $citas = $paciente->citas;
        return view('pacientes.misCitas', compact('citas'));
    }

    public function detalleCita($id)
    {
        $cita = Cita::find($id);

        $receta = null;
        if ($cita->informeConsulta != null) {
            $informe = $cita->informeConsulta;
            $receta = Receta::where('informe_consulta_id', '=', $informe->id)->first();
        }
        return view('pacientes.detalleCita', compact('cita', 'receta'));
    }

    public function misCitasPendiente()
    {
        return view('pacientes.misCitasPendiente');
    }

    public function misCitasAceptadas()
    {
        return view('pacientes.misCitasAceptadas');
    }

    public function misCitasCanceladas()
    {
        return view('pacientes.misCitasCanceladas');
    }
    public function cancelar($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = 'cancelada'; // o elimínala si prefieres
        $cita->save();
        return redirect()->back()->with('success', 'Cita cancelada correctamente.');
    }

    public function buscarProfesionales()
    {

        $categorias_profesionales = CategoriaProfesional::where('orden', '>', 1)->orderBy('orden', 'ASC')->get();
        return view('pacientes.formProfesionales', compact('categorias_profesionales'));
    }

    public function buscarProfesionalesCitas()
    {
        $seguros = SegurosMedicos::all();
        $especialidades = Especialidad::orderBy('nombre', 'ASC')->get();
        return view('pacientes.buscarProfesionales', compact('seguros', 'especialidades'));
    }

    public function buscarEmergencias()
    {
        $emergencias = Emergencia::all();
        return view('pacientes.buscarEmergencias', compact('emergencias'));
    }

    public function buscarProveedores()
    {
        return view('pacientes.formProveedores');
    }

    public function buscarProveedoresPresupuestos()
    {
        return view('pacientes.buscarProveedores');
    }

    public function emergencias()
    {
        return view('pacientes.emergencias');
    }

    public function misRecetas()
    {
        $paciente = Paciente::where('user_id', '=', Auth()->user()->id)->firstOrFail();

        $recetas = DB::table('recetas as r')
            ->join('informes_consultas as ic', 'ic.id', '=', 'r.informe_consulta_id')
            ->join('citas as c', 'c.id', '=', 'ic.cita_id')
            ->join('profesionales as p', 'p.id', '=', 'c.profesional_id')
            ->join('pacientes as pac', 'pac.id', '=', 'c.paciente_id')
            ->join('especializaciones as ep', 'ep.id', '=', 'c.especializacion_id')
            ->join('especialidades as e', 'e.id', '=', 'ep.especialidad_id')
            ->where('pac.id', $paciente->id)
            ->select('ic.*', 'c.*', 'p.nombre_completo as medicoReceta', 'pac.*', 'r.*', 'e.nombre as nombre_especialidad')
            ->get();

        return view('pacientes.misRecetas', compact('paciente', 'recetas'));
    }

    public function misRecetasDetalle($id)
    {
        $paciente = Paciente::where('user_id', '=', Auth()->user()->id)->firstOrFail();

        $informe = InformeConsulta::find($id);
        $presentaciones = PresentacionMedicamento::all();
        $vias = ViaAdministracionMedicamento::all();
        $intervalos = IntervaloMedicamento::all();
        $medicamentos = Medicamento::orderBy('nombre', 'ASC')->get();

        $cita = Cita::where('id', '=', $informe->cita_id)->first();

        $recetas_informe = Receta::where('informe_consulta_id', '=', $informe->id)->count();

        $receta = Receta::where('informe_consulta_id', '=', $informe->id)->first();

        return view('pacientes.misRecetasDetalle', compact('paciente', 'receta', 'medicamentos', 'informe', 'cita', 'presentaciones', 'vias', 'intervalos'));
    }

    public function presupuestos()
    {
        $paciente = Paciente::where('user_id', '=', Auth()->user()->id)->firstOrFail();

        // Obtener todas las citas del paciente
        $citas = Cita::where('paciente_id', $paciente->id)->with([
            'informeConsulta.pedidoLaboratorio.pruebas.presupuestos.proveedor',
            'informeConsulta.pedidoImagen.pruebas.presupuestos.proveedor'
        ])->get();

        // Recolectar todas las pruebas con presupuesto
        $pruebasConPresupuesto = collect();

        foreach ($citas as $cita) {
            $informe = $cita->informeConsulta;
            if (!$informe) continue;

            // Pruebas de laboratorio
            if ($informe->pedidoLaboratorio) {
                foreach ($informe->pedidoLaboratorio->pruebas as $prueba) {
                    if ($prueba->presupuestos->count() > 0) {
                        $pruebasConPresupuesto->push($prueba);
                    }
                }
            }

            // Pruebas de imagen
            if ($informe->pedidoImagen) {
                foreach ($informe->pedidoImagen->pruebas as $prueba) {
                    if ($prueba->presupuestos->count() > 0) {
                        $pruebasConPresupuesto->push($prueba);
                    }
                }
            }
        }

        return view('pacientes.presupuestos', [
            'pruebas' => $pruebasConPresupuesto
        ]);
    }

    public function misPruebas()
    {
        $paciente = Paciente::where('user_id', Auth::id())->firstOrFail();

        $pruebas = collect();

        foreach ($paciente->citas as $cita) {
            $informe = $cita->informeConsulta;
            if (!$informe) continue;

            // Pruebas de laboratorio
            if ($informe->pedidoLaboratorio) {
                foreach ($informe->pedidoLaboratorio->pruebas as $prueba) {
                    $pruebas->push($prueba);
                }
            }

            // Pruebas de imagen
            if ($informe->pedidoImagen) {
                foreach ($informe->pedidoImagen->pruebas as $prueba) {
                    $pruebas->push($prueba);
                }
            }
        }

        return view('pacientes.misPruebas', compact('pruebas'));
    }

    public function miHistorialMedico()
    {
        $seguros = SegurosMedicos::all();
        $paciente = Paciente::where('user_id', '=', Auth()->user()->id)->firstOrFail();

        $informes = InformeConsulta::whereHas('cita', function ($query) use ($paciente) {
            $query->where('paciente_id', $paciente->id);
        })
        ->with([
            'cita',
            'pedidoLaboratorio.pruebas',
            'pedidoImagen.pruebas'
        ])
        ->get();

        $pruebas = collect();

        foreach ($paciente->citas as $cita) {
            $informe = $cita->informeConsulta;
            if (!$informe) continue;

            // Pruebas de laboratorio
            if ($informe->pedidoLaboratorio) {
                foreach ($informe->pedidoLaboratorio->pruebas as $prueba) {
                    $pruebas->push($prueba);
                }
            }

            // Pruebas de imagen
            if ($informe->pedidoImagen) {
                foreach ($informe->pedidoImagen->pruebas as $prueba) {
                    $pruebas->push($prueba);
                }
            }
        }

        $recetas = DB::table('recetas as r')
            ->join('informes_consultas as ic', 'ic.id', '=', 'r.informe_consulta_id')
            ->join('citas as c', 'c.id', '=', 'ic.cita_id')
            ->join('profesionales as p', 'p.id', '=', 'c.profesional_id')
            ->join('pacientes as pac', 'pac.id', '=', 'c.paciente_id')
            ->where('pac.id', $paciente->id)
            ->select('r.id', 'r.fecha_emision', 'p.nombre_completo', 'pac.cedula', 'c.motivo', 'ic.id as idInforme', 'c.id as idCita')
            ->get();

        return view('pacientes.miHistorialMedico', compact('seguros', 'recetas', 'paciente', 'informes', 'pruebas'));
    }

    public function valoraciones()
    {
        $paciente = Paciente::where('user_id', '=', Auth()->user()->id)->firstOrFail();
        $valoraciones = Valoracion::where('paciente_id', $paciente->id)->get();
        return view('pacientes.valoraciones', compact('valoraciones'));
    }

    public function valoracionesProfesionales($id)
    {
        return view('pacientes.valoracionesProfesionales');
    }

    public function valoracionesProveedores($id)
    {
        return view('pacientes.valoracionesProveedores');
    }

    public function datos()
    {
        $paciente = Paciente::where('user_id', Auth::user()->id)->first();
        $seguros = SegurosMedicos::all();
        $ciudades = Ciudad::orderBy('nombre', 'asc')->get(); // Obtener todas las ciudades
        return view('pacientes.datos', compact('seguros', 'paciente', 'ciudades'));
    }

    public function notificaciones()
    {
        return view('pacientes.notificaciones');
    }

    public function contactoAdministrador()
    {
        return view('pacientes.contactoAdministrador');
    }

    public function getSubespecialidades($id)
    {
        $subespecialidades = Especialidad::where('padre_id', $id)->get();

        return response()->json($subespecialidades);
    }

    public function guardarValoracion(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'profesional_id' => 'required|exists:profesionales,id',
            'fecha' => 'required|date',
            'modalidad' => 'required|in:presencial,videollamada',
            'puntuacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string',
        ]);

        Valoracion::create($request->only([
            'paciente_id',
            'profesional_id',
            'fecha',
            'modalidad',
            'puntuacion',
            'comentario'
        ]));

        if($request->puntuacion<3){        // Crear notificación
            $paciente = Paciente::findOrFail($request->paciente_id);
            $profesional = Profesional::findOrFail($request->profesional_id);

            $notificacion = new Notificacion();
            $notificacion->mensaje = "Valoración de {$paciente->nombre_completo} para {$profesional->nombre_completo}";
            $notificacion->titulo = "{$request->puntuacion} estrellas - {$profesional->nombre_completo}";
            $notificacion->tipo = 'valoracion_profesional';
            $notificacion->icono = 'fa fa-star';
            $notificacion->url = "/admin/valoraciones?paciente_id=&profesional_id=&modalidad=&puntuacion={$request->puntuacion}";
            $notificacion->leida = 0;
            $notificacion->usuario_id = $paciente->user_id;
            $notificacion->usuario_id_destino = NULL;
            $notificacion->save();
           }

        return redirect()->back()->with('success', 'Gracias por tu valoración.');
    }

    public function eliminarAntecdente(Antecedente $antecedente)
    {
        $antecedente->delete();

        return response()->json(['message' => 'Antecedente eliminado correctamente']);
    }

    public function eliminarContacto(ContactosEmergencia $contacto)
    {
        $contacto->delete();

        return response()->json(['message' => 'Contacto de Emergencia eliminado correctamente']);
    }

    public function eliminarCuenta(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
        }

        $user = auth()->user();
        $user->activo = false;
        $user->save();

        auth()->logout();

        return response()->json(['message' => 'Tu cuenta ha sido eliminada correctamente.']);
    }
    public function exportarCitaPdf($id)
    {
        $cita = Cita::findOrFail($id);
        $receta = null;
        if ($cita->informeConsulta != null) {
            $informe = $cita->informeConsulta;
            $receta = \App\Models\Receta::where('informe_consulta_id', '=', $informe->id)->first();
        }
        $paciente = $cita->paciente;
        $profesional = $cita->profesional;
        $pdf = \PDF::loadView('pacientes.pdf.cita', compact('cita', 'receta', 'paciente', 'profesional'));
        return $pdf->download('cita_' . $cita->id . '.pdf');
    }

    /**
     * Aceptar un presupuesto de prueba
     */
    public function aceptarPresupuesto($id)
    {
        $presupuesto = PresupuestoPrueba::findOrFail($id);
        $presupuesto->estado = 'aprobado';
        $presupuesto->save();
        return redirect()->back()->with('success', 'Presupuesto aprobado correctamente.');
    }

    public function denegarPresupuesto($id)
    {
        $presupuesto = PresupuestoPrueba::findOrFail($id);
        $presupuesto->estado = 'denegado';
        $presupuesto->save();
        return redirect()->back()->with('success', 'Presupuesto denegado correctamente.');
    }

    public function exportarHistorialMedicoPdf($id)
    {
        $paciente = Paciente::findOrFail($id);

        // Verificar que el usuario solo pueda acceder a su propio historial
        if ($paciente->user_id !== Auth::id()) {
            abort(403, 'No tienes permisos para acceder a este historial médico.');
        }

        $seguros = SegurosMedicos::all();

        $informes = InformeConsulta::whereHas('cita', function ($query) use ($paciente) {
            $query->where('paciente_id', $paciente->id);
        })
        ->with([
            'cita',
            'pedidoLaboratorio.pruebas',
            'pedidoImagen.pruebas'
        ])
        ->get();

        $pruebas = collect();

        foreach ($paciente->citas as $cita) {
            $informe = $cita->informeConsulta;
            if (!$informe) continue;

            // Pruebas de laboratorio
            if ($informe->pedidoLaboratorio) {
                foreach ($informe->pedidoLaboratorio->pruebas as $prueba) {
                    $pruebas->push($prueba);
                }
            }

            // Pruebas de imagen
            if ($informe->pedidoImagen) {
                foreach ($informe->pedidoImagen->pruebas as $prueba) {
                    $pruebas->push($prueba);
                }
            }
        }

        $recetas = DB::table('recetas as r')
            ->join('informes_consultas as ic', 'ic.id', '=', 'r.informe_consulta_id')
            ->join('citas as c', 'c.id', '=', 'ic.cita_id')
            ->join('profesionales as p', 'p.id', '=', 'c.profesional_id')
            ->join('pacientes as pac', 'pac.id', '=', 'c.paciente_id')
            ->where('pac.id', $paciente->id)
            ->select('r.id', 'r.fecha_emision', 'p.nombre_completo', 'pac.cedula', 'c.motivo', 'ic.id as idInforme', 'c.id as idCita')
            ->get();

        $pdf = \PDF::loadView('pacientes.pdf.historialMedico', compact('seguros', 'recetas', 'paciente', 'informes', 'pruebas'));

        return $pdf->download('historial_medico_' . $paciente->nombre_completo . '_' . date('Y-m-d') . '.pdf');
    }
}
