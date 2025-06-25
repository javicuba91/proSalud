<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Ciudad;
use App\Models\ConsultorioImagen;
use App\Models\ConsultorioProfesional;
use App\Models\ContactoAdminProfesional;
use App\Models\DetalleHorario;
use App\Models\DocumentoProfesional;
use App\Models\Especialidad;
use App\Models\EspecializacionesProfesional;
use App\Models\ExperienciaLaboral;
use App\Models\FormacionAdicional;
use App\Models\HorarioProfesional;
use App\Models\InformeConsulta;
use App\Models\IntervaloMedicamento;
use App\Models\Medicamento;
use App\Models\MetodoPago;
use App\Models\Paciente;
use App\Models\Plan;
use App\Models\PresentacionMedicamento;
use App\Models\Profesional;
use App\Models\Provincia;
use App\Models\Receta;
use App\Models\Region;
use App\Models\SegurosMedicos;
use App\Models\SuscripcionPlan;
use App\Models\TituloUniversitario;
use App\Models\User;
use App\Models\Valoracion;
use App\Models\ViaAdministracionMedicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfesionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profesionales.index');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function misEstadisticas()
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();

        $num_pacientes = $profesional->citas()
            ->with('paciente')
            ->get()
            ->pluck('paciente')
            ->unique('id')
            ->count();

        $num_videoconsultas = $profesional->citas()->where('modalidad', '=', 'videoconsulta')->count();

        $num_comentarios = Valoracion::where('profesional_id', '=', $profesional->id)->count();
        $media = 0;
        if ($num_comentarios > 0) {
            $media = round(Valoracion::where('profesional_id', '=', $profesional->id)->sum('puntuacion') / $num_comentarios, 2);
        }


        $num_citas_canceladas = $profesional->citas->where('estado', '=', 'cancelada')->count();
        return view('profesionales.misEstadisticas', compact('num_citas_canceladas', 'num_pacientes', 'num_videoconsultas', 'num_comentarios', 'media'));
    }

    public function misCitasPresenciales()
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        return view('profesionales.misCitasPresenciales', compact('profesional'));
    }

    public function misCitasPresencialesPendientes()
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();

        $citas = Cita::where('profesional_id', $profesional->id)
            ->where('modalidad', 'presencial')
            ->where('estado', '=', 'pendiente')
            ->get();

        return view('profesionales.misCitasPresencialesPendientes', compact('profesional', 'citas'));
    }

    public function citasPresencialesJson(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();

        // Obtener las citas presenciales con filtro
        $query = Cita::where('profesional_id', $profesional->id)
            ->where('modalidad', 'presencial');

        if ($request->has('filtro')) {
            if ($request->filtro === 'pasadas') {
                $query->where('fecha_hora', '<', now());
            } elseif ($request->filtro === 'pendientes') {
                $query->where('fecha_hora', '>=', now());
            }
        }

        $citas = $query->get();

        // Formatear las citas para FullCalendar
        $eventos = $citas->map(function ($cita) {
            return [
                'id' => $cita->id,
                'title' => $cita->paciente->nombre_completo ?? 'Paciente',
                'start' => $cita->fecha_hora,
                'extendedProps' => [
                    'motivo' => $cita->motivo,
                    'consultorio' => optional($cita->consultorio)->direccion,
                    'hora' => \Carbon\Carbon::parse($cita->fecha_hora)->format('H:i'),
                ]
            ];
        });


        // 🔁 Retornar eventos y días bloqueados por separado
        return response()->json([
            'events' => $eventos
        ]);
    }


    public function listadoCitasPresenciales(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();

        $query = Cita::where('profesional_id', $profesional->id)
            ->where('modalidad', 'presencial');

        switch ($request->filtro) {
            case 'pasadas':
                $query->where('fecha_hora', '<', now())
                    ->where('estado', '!=', 'cancelada');
                break;
            case 'pendientes':
                $query->where('fecha_hora', '>=', now())
                    ->where('estado', '!=', 'cancelada');
                break;
            case 'cancelada':
                $query->where('estado', 'cancelada');
                break;
            case 'todas':
            default:
                // No filtros adicionales
                break;
        }

        $citas = $query->get();

        return view('profesionales.listadoCitasPresenciales', compact('citas'));
    }


    public function citasVideoLlamadasJson(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();

        $query = Cita::where('profesional_id', $profesional->id)
            ->where('modalidad', 'videoconsulta');

        // Filtro según estado
        if ($request->has('filtro')) {
            if ($request->filtro === 'pasadas') {
                $query->where('fecha_hora', '<', now());
            } elseif ($request->filtro === 'pendientes') {
                $query->where('fecha_hora', '>=', now());
            }
        }

        $citas = $query->get();

        $eventos = $citas->map(function ($cita) {
            return [
                'id' => $cita->id,
                'title' => $cita->paciente->nombre_completo ?? 'Paciente',
                'start' => $cita->fecha_hora,
                'extendedProps' => [
                    'motivo' => $cita->motivo,
                    'consultorio' => optional($cita->consultorio)->direccion,
                    'hora' => \Carbon\Carbon::parse($cita->fecha_hora)->format('H:i'),
                ]
            ];
        });

        // 🔁 Retornar eventos y días bloqueados por separado
        return response()->json([
            'events' => $eventos
        ]);
    }

    public function misCitasVideoconsulta()
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        return view('profesionales.misCitasVideoconsulta', compact('profesional'));
    }

    public function listadoCitasVideollamada(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        $query = Cita::where('profesional_id', $profesional->id)
            ->where('modalidad', 'videoconsulta');

        if ($request->filtro === 'pasadas') {
            $query->where('fecha_hora', '<', now());
        } elseif ($request->filtro === 'pendientes') {
            $query->where('fecha_hora', '>=', now());
        }

        $citas = $query->get();

        return view('profesionales.listadoCitasVideollamada', compact('citas'));
    }

    public function misCitasVideoconsultaPendientes()
    {
        return view('profesionales.misCitasVideoconsultaPendientes');
    }

    public function misPacientes()
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();

        $pacientes = $profesional->citas()
            ->with('paciente')
            ->get()
            ->pluck('paciente')
            ->unique('id')
            ->values();

        return view('profesionales.misPacientes', compact('profesional', 'pacientes'));
    }

    public function recetasFarmacia()
    {
        $profesional = Profesional::where('user_id', auth()->id())->firstOrFail();

        $recetas = DB::table('recetas as r')
            ->join('informes_consultas as ic', 'ic.id', '=', 'r.informe_consulta_id')
            ->join('citas as c', 'c.id', '=', 'ic.cita_id')
            ->join('profesionales as p', 'p.id', '=', 'c.profesional_id')
            ->join('pacientes as pac', 'pac.id', '=', 'c.paciente_id')
            ->where('p.id', $profesional->id)
            ->select('r.qr', 'r.fecha_emision', 'pac.nombre_completo', 'pac.cedula', 'c.motivo', 'ic.id as idInforme')
            ->get();

        return view('profesionales.recetasFarmacia', compact('recetas', 'profesional'));
    }

    public function recetasFarmaciaCrear()
    {
        $presentaciones = PresentacionMedicamento::all();
        $vias = ViaAdministracionMedicamento::all();
        $intervalos = IntervaloMedicamento::all();

        $profesional = Profesional::where('user_id', auth()->id())->firstOrFail();

        return view('profesionales.recetasFarmaciaCrear', compact('profesional', 'presentaciones', 'vias', 'intervalos'));
    }

    public function pedidosLaboratorio()
    {
        return view('profesionales.pedidosLaboratorio');
    }

    public function pedidosLaboratorioCrear()
    {
        return view('profesionales.pedidosLaboratorioCrear');
    }

    public function pedidosImagenes()
    {
        return view('profesionales.pedidosImagenes');
    }

    public function pedidosImagenesCrear()
    {
        return view('profesionales.pedidosImagenesCrear');
    }

    public function valoracionesComentarios()
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        return view('profesionales.valoracionesComentarios', compact('profesional'));
    }

    public function misDatos()
    {
        $seguros = SegurosMedicos::all();
        $profesional = Profesional::where('user_id', auth()->id())->first();
        $regiones = Region::orderBy('nombre', 'ASC')->get();
        $especialidades = Especialidad::where('padre_id', NULL)->orderBy('nombre', 'ASC')->get();

        // Obtener IDs si el profesional tiene ciudad
        $ciudad_id = $profesional->ciudad_id ?? null;
        $provincia_id = $profesional->ciudad->provincia_id ?? null;
        $region_id = $profesional->ciudad->provincia->region_id ?? null;

        $metodosPago = MetodoPago::all();

        $horarios = HorarioProfesional::with('detalles')
            ->where('profesional_id', $profesional->id)
            ->get()
            ->groupBy('dia_semana');

        $provincias = Provincia::orderBy('nombre', 'ASC')->get();


        return view('profesionales.misDatos', compact(
            'seguros',
            'profesional',
            'especialidades',
            'regiones',
            'region_id',
            'provincia_id',
            'ciudad_id',
            'metodosPago',
            'horarios',
            'provincias'
        ));
    }


    public function misPlanes()
    {
        $planes = Plan::all();
        $profesional = Profesional::where('user_id', Auth()->user()->id)->first();
        return view('profesionales.misPlanes', compact('planes', 'profesional'));
    }

    public function notificaciones()
    {
        return view('profesionales.notificaciones');
    }

    public function contactarAdministrador()
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        return view('profesionales.contactarAdministrador', compact('profesional'));
    }

    public function agendarCitaProfesional()
    {
        return view('profesionales.agendarCita');
    }

    public function historialClinicoPaciente($id)
    {
        $seguros = SegurosMedicos::all();
        $paciente = Paciente::find($id);

        $informes = InformeConsulta::whereHas('cita', function ($query) use ($paciente) {
            $query->where('paciente_id', $paciente->id);
        })->get();

        $recetas = DB::table('recetas as r')
            ->join('informes_consultas as ic', 'ic.id', '=', 'r.informe_consulta_id')
            ->join('citas as c', 'c.id', '=', 'ic.cita_id')
            ->join('profesionales as p', 'p.id', '=', 'c.profesional_id')
            ->join('pacientes as pac', 'pac.id', '=', 'c.paciente_id')
            ->where('pac.id', $paciente->id)
            ->select('r.id', 'r.fecha_emision', 'p.nombre_completo', 'pac.cedula', 'c.motivo', 'ic.id as idInforme', 'c.id as idCita')
            ->get();

        return view('profesionales.historialClinicoPaciente', compact('seguros', 'recetas', 'paciente', 'informes'));
    }


    public function crearPaciente()
    {
        $seguros = SegurosMedicos::all();
        return view('profesionales.crearPaciente', compact('seguros'));
    }

    public function listadoCitasPresencialesAceptadas()
    {
        return view('profesionales.listadoCitasPresenciales');
    }

    public function listadoCitasPresencialesPasadas()
    {
        return view('profesionales.listadoCitasPresencialesPasadas');
    }

    public function informeConsulta($id)
    {
        $seguros = SegurosMedicos::all();
        $cita = Cita::find($id);


        $informe = InformeConsulta::where('cita_id', '=', $cita->id)->first();
        $profesional = Profesional::where('user_id', Auth()->user()->id)->first();
        return view('profesionales.informeConsulta', compact('profesional', 'seguros', 'cita', 'informe'));
    }

    public function elegirPlan(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:planes,id',
        ]);

        $profesional = Profesional::where('user_id', auth()->id())->first();

        // Buscar suscripción activa
        $suscripcionActiva = SuscripcionPlan::where('profesional_id', $profesional->id)
            ->where('fecha_fin', '>=', now())
            ->latest('fecha_fin')
            ->first();

        if ($suscripcionActiva) {
            return redirect()->back()->with('error', 'Ya tienes una suscripción activa. No puedes cambiar de plan hasta que finalice.');
        }

        // Cambiar plan y crear nueva suscripción
        $profesional->update([
            'plan_id' => $request->plan_id,
        ]);

        $suscripcion = new SuscripcionPlan();
        $suscripcion->profesional_id = $profesional->id;
        $suscripcion->plan_id = $request->plan_id;
        $suscripcion->fecha_inicio = now();
        $suscripcion->fecha_fin = now()->addDays(30);
        $suscripcion->save();

        return redirect()->back()->with('success', 'Has cambiado de plan correctamente.');
    }


    public function realizarContactoAdministrador(Request $request)
    {
        $request->validate([
            'motivo' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $profesional = Profesional::where('user_id', auth()->id())->first();

        ContactoAdminProfesional::create([
            'profesional_id' => $profesional->id,
            'motivo' => $request->motivo,
            'descripcion' => $request->descripcion,
        ]);

        return back()->with('success', 'Consulta enviada correctamente.');
    }

    public function buscarPaciente(Request $request)
    {
        $query = $request->get('q', '');

        $pacientes = \App\Models\Paciente::where('nombre_completo', 'like', "%{$query}%")
            ->select('id', 'nombre_completo')
            ->limit(10)
            ->get();

        return response()->json($pacientes);
    }

    // App\Http\Controllers\ConsultorioController.php

    public function delProfesional()
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();

        $consultorios = \App\Models\ConsultorioProfesional::where('profesional_id', $profesional->id)
            ->select('id', 'direccion')
            ->get();

        return response()->json($consultorios);
    }


    public function guardarCita(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();

        $request->validate([
            'paciente_id'    => 'required|exists:pacientes,id',
            'fecha_hora'     => 'required|date',
            'modalidad'      => 'required|in:presencial,videoconsulta',
            'motivo'         => 'nullable|string',
            'consultorio_id' => 'nullable|exists:consultorios,id',
        ]);

        $cita = new Cita();
        $cita->paciente_id = $request->paciente_id;
        $cita->profesional_id = $profesional->id;
        $cita->fecha_hora = $request->fecha_hora;
        $cita->modalidad = $request->modalidad;
        $cita->motivo = $request->motivo;
        $cita->consultorio_id = $request->modalidad === 'presencial' ? $request->consultorio_id : null;
        $cita->url_meet = $request->modalidad === 'videoconsulta'
            ? 'https://meet.google.com/' . Str::lower(Str::random(3)) . '-' . Str::lower(Str::random(4))
            : null;
        $cita->codigo_qr = strtoupper(Str::random(8));
        $cita->save();

        return response()->json(['success' => true, 'message' => 'Cita agendada correctamente']);
    }


    public function informeConsultaCrear(Request $request, $id)
    {
        // Buscar si ya existe un informe para la cita
        $informe = InformeConsulta::where('cita_id', $id)->first();

        // Si no existe, se crea uno nuevo
        if (!$informe) {
            $informe = new InformeConsulta();
            $informe->cita_id = $id;
        }

        // Asignar o actualizar los datos
        $informe->motivo_consulta = $request->input('motivo_consulta');
        $informe->antecedentes_familiares = $request->input('antecedentes_familiares');
        $informe->antecedentes_personales = $request->input('antecedentes_personales');
        $informe->enfermedad_actual = $request->input('enfermedad_actual');
        $informe->exploracion_fisica = $request->input('exploracion_fisica');
        $informe->pruebas_complementarias = $request->input('pruebas_complementarias');
        $informe->juicio_clinico = $request->input('juicio_clinico');
        $informe->dibujo_dental = $request->input('dibujo_dental');
        $informe->plan_terapeutico = $request->input('plan_terapeutico');

        $informe->save();

        return redirect()->back()->with('success', 'Informe de consulta ' . ($informe->wasRecentlyCreated ? 'creado' : 'actualizado') . ' correctamente.');
    }

    public function actualizarFecha(Request $request)
    {
        $cita = Cita::findOrFail($request->cita_id);
        $cita->fecha_hora = $request->nueva_fecha;
        $cita->save();

        return redirect()->back()->with('success', 'Fecha actualizada correctamente.');
    }


    public function recetaInformeConsulta($id)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        $informe = InformeConsulta::find($id);
        $presentaciones = PresentacionMedicamento::all();
        $vias = ViaAdministracionMedicamento::all();
        $intervalos = IntervaloMedicamento::all();
        $medicamentos = Medicamento::orderBy('nombre', 'ASC')->get();

        $cita = Cita::where('id', '=', $informe->cita_id)->first();

        $recetas_informe = Receta::where('informe_consulta_id', '=', $informe->id)->count();

        if ($recetas_informe == 0) {
            $receta = new Receta();
            $receta->informe_consulta_id = $informe->id;
            $receta->fecha_emision = date("Y-m-d H:i:s");
            $receta->save();
        } else {
            $receta = Receta::where('informe_consulta_id', '=', $informe->id)->first();
        }


        return view('profesionales.recetasFarmaciaCrear', compact('profesional', 'receta', 'medicamentos', 'informe', 'cita', 'presentaciones', 'vias', 'intervalos'));
    }

    public function actualizarReceta(Request $request, $id)
    {
        $receta = Receta::findOrFail($id);
        $receta->qr = $request->qr;
        $receta->diagnostico = $request->diagnostico;
        $receta->comentarios = $request->comentarios;
        $receta->save();

        return redirect()->back()->with('success', 'Receta actualizada correctamente');
    }

    public function detalleReceta($id)
    {
        $presentaciones = PresentacionMedicamento::all();
        $vias = ViaAdministracionMedicamento::all();
        $intervalos = IntervaloMedicamento::all();
        $medicamentos = Medicamento::orderBy('nombre', 'ASC')->get();
        $receta = Receta::find($id);

        return view('profesionales.detalleReceta', compact('receta', 'medicamentos', 'presentaciones', 'vias', 'intervalos'));
    }

    public function eliminarTitulo($id)
    {
        $titulo = TituloUniversitario::find($id);

        if (!$titulo) {
            return response()->json(['success' => false, 'message' => 'Título no encontrado'], 404);
        }

        $titulo->delete();

        return response()->json(['success' => true, 'message' => 'Título eliminado correctamente']);
    }

    public function eliminarEspecializacion($id)
    {
        $especialidad = EspecializacionesProfesional::find($id);

        if (!$especialidad) {
            return response()->json(['success' => false, 'message' => 'Especialización no encontrada'], 404);
        }

        $especialidad->delete();

        return response()->json(['success' => true, 'message' => 'Especialización eliminada correctamente']);
    }

    public function eliminarFormacion($id)
    {
        $formacion = FormacionAdicional::find($id);

        $formacion->delete();

        return response()->json(['success' => true, 'message' => 'Formación eliminada correctamente']);
    }

    public function eliminarExperiencia($id)
    {
        $experiencia = ExperienciaLaboral::find($id);

        if (!$experiencia) {
            return response()->json(['success' => false, 'message' => 'Experiencia no encontrada'], 404);
        }

        $experiencia->delete();

        return response()->json(['success' => true, 'message' => 'Experiencia eliminada correctamente']);
    }

    public function eliminarConsultorio($id)
    {
        $consultorio = ConsultorioProfesional::find($id);
        if (!$consultorio) {
            return response()->json(['success' => false, 'message' => 'Consultorio no encontrado.'], 404);
        }

        $consultorio->delete();

        return response()->json(['success' => true]);
    }

    public function guardarSeguro(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        $profesional->segurosMedicos()->syncWithoutDetaching([$request->seguro_id]);

        return response()->json(['success' => true]);
    }

    public function eliminarSeguro(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        $profesional->segurosMedicos()->detach($request->seguro_id);

        return response()->json(['success' => true]);
    }

    public function actualizarNumeroCuenta(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        $profesional->numero_cuenta = $request->numero_cuenta;
        $profesional->save();

        $mensaje = "<i class='fa fa-edit'></i> Actualizar";

        if ($profesional->numero_cuenta == NULL) {
            $mensaje = "<i class='fa fa-plus'></i> Añadir";
        }

        return response()->json(['success' => true, 'mensaje' => $mensaje]);
    }

    public function actualizarDatos(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = Str::slug($profesional->id . '-' . time()) . '.' . $file->getClientOriginalExtension();
            $path = 'imagenes/medicos/' . $profesional->id;
            $file->move(public_path($path), $filename);

            // Guardar la ruta relativa en la base de datos
            $profesional->foto = $path . '/' . $filename;
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = Str::slug($profesional->id . '-' . time()) . '.' . $file->getClientOriginalExtension();
            $path = 'imagenes/medicos/' . $profesional->id;
            $file->move(public_path($path), $filename);

            // Guardar la ruta relativa en la base de datos
            $profesional->logo = $path . '/' . $filename;
        }

        $profesional->nombre_completo = $request->nombre_completo;
        $profesional->fecha_nacimiento = $request->fecha_nacimiento;
        $profesional->genero = $request->genero;
        $profesional->telefono_personal = $request->telefono_personal;
        $profesional->telefono_profesional = $request->telefono_profesional;
        $profesional->cedula_identidad = $request->cedula_identidad;
        $profesional->idiomas = $request->idiomas;
        $profesional->descripcion_profesional = $request->descripcion_profesional;
        $profesional->anios_experiencia = $request->anios_experiencia;
        $profesional->licencia_medica = $request->licencia_medica;
        $profesional->ciudad_id = $request->ciudad_id;
        $profesional->presencial = $request->presencial;
        $profesional->videoconsulta = $request->videoconsulta;

        $profesional->save();

        return response()->json(['success' => true]);
    }

    public function actualizarContrasena(Request $request)
    {

        $profesional = Profesional::where('user_id', auth()->id())->first();
        $usuario = User::where('id', '=', $profesional->user_id)->first();
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return response()->json(['message' => 'Contraseña actualizada']);
    }

    public function guardarTitulo(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();

        $titulo = new TituloUniversitario();
        $titulo->nombre = $request->nombre;
        $titulo->centro_educativo = $request->centro_educativo;
        $titulo->pais = $request->pais;
        $titulo->profesional_id = $profesional->id;
        $titulo->save();

        return response()->json($titulo);
    }

    public function guardarEspecializacion(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        $especializacion = new EspecializacionesProfesional();
        $especializacion->especialidad_id = $request->especialidad_id;
        $especializacion->sub_especialidad_id = $request->sub_especialidad_id;
        $especializacion->centro_educativo = $request->centro_educativo;
        $especializacion->pais = $request->pais;
        $especializacion->profesional_id = $profesional->id;
        $especializacion->precio_presencial = $request->precio_presencial;
        $especializacion->precio_videoconsulta = $request->precio_videoconsulta;
        $especializacion->save();

        return response()->json($especializacion);
    }

    public function guardarFormacionAdicional(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        $formacion = new FormacionAdicional();
        $formacion->nombre = $request->nombre;
        $formacion->tipo = $request->tipo;
        $formacion->profesional_id = $profesional->id;
        $formacion->save();

        return response()->json($formacion);
    }
    public function guardarExperiencia(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        $exp = new ExperienciaLaboral();
        $exp->profesional_id = $profesional->id;
        $exp->puesto = $request->puesto;
        $exp->clinica = $request->clinica;
        $exp->pais = $request->pais;
        $exp->anyo = $request->ciudad;
        $exp->save();

        return response()->json($exp);
    }

    public function guardarConsultorio(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->first();
        $consultorio = new ConsultorioProfesional();
        $consultorio->profesional_id = $profesional->id;
        $consultorio->direccion = $request->direccion;
        $consultorio->direccion_maps = $request->direccion_maps;
        $consultorio->imagenes = $request->imagenes;
        $consultorio->clinica = $request->clinica;
        $consultorio->info_adicional = $request->info_adicional;
        $consultorio->save();

        return response()->json($consultorio);
    }

    public function cancelar($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = 'cancelada'; // o elimínala si prefieres
        $cita->save();

        return response()->json(['success' => true]);
    }

    public function getProvincias($region_id)
    {
        return response()->json(Provincia::where('region_id', $region_id)->orderBy('nombre')->get());
    }

    public function getCiudades($provincia_id)
    {
        return response()->json(Ciudad::where('provincia_id', $provincia_id)->orderBy('nombre')->get());
    }

    public function updateMetodosPago(Request $request, Profesional $profesional)
    {
        $request->validate([
            'metodos_pago' => 'array',
            'metodos_pago.*' => 'exists:metodos_pagos,id',
        ]);

        // Sincroniza los métodos seleccionados
        $profesional->metodosPago()->sync($request->metodos_pago ?? []);

        return back()->with('success', 'Métodos de pago actualizados correctamente.');
    }

    public function guardarHorariosPresencial(Request $request)
    {
        $profesional = Profesional::where('user_id', auth()->id())->firstOrFail();
        $horariosData = $request->input('horarios', []);
        $añoActual = now()->year;

        foreach ($horariosData as $diaNumero => $rangos) {
            if (empty($rangos)) continue;

            // Validación local de los rangos enviados
            foreach ($rangos as $i => $rango) {
                $desde = $rango['desde'] ?? null;
                $hasta = $rango['hasta'] ?? null;
                $consultorio_id = $rango['consultorio_id'] ?? null;

                if (!$desde || !$hasta || !$consultorio_id) continue;

                $desdeMin = strtotime($desde);
                $hastaMin = strtotime($hasta);

                if ($desdeMin >= $hastaMin) {
                    return redirect()->back()->with('errors', 'El rango de horario no es válido: la hora de inicio debe ser menor que la hora de fin.');
                }

                // Verificar solapamiento con otros rangos del mismo request
                foreach ($rangos as $j => $otro) {
                    if ($i === $j) continue;
                    if ($consultorio_id != ($otro['consultorio_id'] ?? null)) continue;

                    $oDesdeMin = strtotime($otro['desde']);
                    $oHastaMin = strtotime($otro['hasta']);

                    // Si hay solapamiento
                    if (($desdeMin < $oHastaMin && $hastaMin > $oDesdeMin)) {
                        return redirect()->back()->with('errors', 'Los horarios no pueden solaparse entre sí en el mismo consultorio.');
                    }
                }

                // Verificar solapamiento con rangos ya existentes en DB
                $existentes = DetalleHorario::whereHas('horario', function ($q) use ($profesional, $diaNumero) {
                    $q->where('profesional_id', $profesional->id)
                        ->where('dia_semana', $diaNumero);
                })
                    ->where('consultorio_id', $consultorio_id)
                    ->get();

                foreach ($existentes as $existente) {
                    $exDesde = strtotime($existente->hora_desde);
                    $exHasta = strtotime($existente->hora_hasta);

                    if (
                        ($desdeMin < $exHasta && $hastaMin > $exDesde)
                    ) {
                        return redirect()->back()->with('errors', 'Los horarios ingresados se solapan con horarios ya existentes en la base de datos.');
                    }
                }
            }

            // Si pasa la validación, seguimos creando
            $diaCarbon = (int)$diaNumero;

            $fecha = Carbon::create($añoActual, date("m"), date("d"))->startOfDay();
            $fin = Carbon::create($añoActual, 12, 31)->endOfDay();

            while ($fecha->dayOfWeek !== $diaCarbon) {
                $fecha->addDay();
            }

            while ($fecha->lte($fin)) {
                $horario = HorarioProfesional::create([
                    'profesional_id' => $profesional->id,
                    'dia_semana' => $diaCarbon,
                    'fecha' => $fecha->toDateString(),
                ]);

                foreach ($rangos as $rango) {
                    if (
                        empty($rango['desde']) ||
                        empty($rango['hasta']) ||
                        empty($rango['consultorio_id'])
                    ) continue;

                    $horario->detalles()->create([
                        'hora_desde' => $rango['desde'],
                        'hora_hasta' => $rango['hasta'],
                        'bloqueado' => false,
                        'consultorio_id' => $rango['consultorio_id'],
                    ]);
                }

                $fecha->addWeek();
            }
        }

        return redirect()->back()->with('success', 'Horarios generados correctamente.');
    }


    public function eventosCalendario()
    {
        $profesional = Profesional::where('user_id', auth()->id())->firstOrFail();

        $eventos = HorarioProfesional::where('profesional_id', $profesional->id)
            ->get()
            ->map(function ($horario) {
                return [
                    'title' => '',
                    'start' => $horario->fecha,
                    'allDay' => true,
                    'display' => 'background',
                    'color' => 'transparent'
                ];
            });

        return response()->json($eventos);
    }

    public function horariosPorDia($fecha)
    {
        $profesional = Profesional::where('user_id', auth()->id())->firstOrFail();

        $horarios = HorarioProfesional::where('profesional_id', $profesional->id)
            ->whereDate('fecha', $fecha)
            ->with('detalles.consultorio') // Incluye también el consultorio en la relación
            ->get();

        if ($horarios->isEmpty()) {
            return response()->json([]);
        }

        $respuesta = [];

        foreach ($horarios as $horario) {
            foreach ($horario->detalles as $detalle) {
                $respuesta[] = [
                    'desde' => date("H:i", strtotime($detalle->hora_desde)),
                    'hasta' => date("H:i", strtotime($detalle->hora_hasta)),
                    'consultorio' => $detalle->consultorio->direccion ?? 'Sin dirección',
                ];
            }
        }

        return response()->json($respuesta);
    }


    public function eliminarDetalle($detalleId)
    {
        $profesional = Profesional::where('user_id', auth()->id())->firstOrFail();

        $detalle = DetalleHorario::with('horario')->findOrFail($detalleId);
        $horario = $detalle->horario;

        if ($horario->profesional_id !== $profesional->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        // Parámetros para filtrar
        $diaSemana = $horario->dia_semana;
        $horaDesde = $detalle->hora_desde;
        $horaHasta = $detalle->hora_hasta;
        $consultorioId = $detalle->consultorio_id;

        // Buscar todos los horarios con ese día y profesional
        $horarios = HorarioProfesional::where('profesional_id', $profesional->id)
            ->where('dia_semana', $diaSemana)
            ->with(['detalles' => function ($query) use ($horaDesde, $horaHasta, $consultorioId) {
                $query->where('hora_desde', $horaDesde)
                    ->where('hora_hasta', $horaHasta)
                    ->where('consultorio_id', $consultorioId);
            }])
            ->get();

        foreach ($horarios as $h) {
            foreach ($h->detalles as $d) {
                $d->delete(); // Eliminar solo los detalles que coinciden con el rango y consultorio
            }

            // Si después de borrar detalles ya no quedan más, borro el horario también
            if ($h->detalles()->count() === 0) {
                $h->delete();
            }
        }

        return response()->json(['success' => true]);
    }

    public function listaImagenesConsultorio($id)
    {
        $imagenes = ConsultorioImagen::where('consultorio_id', $id)->get();
        return response()->json($imagenes);
    }

    public function guardarImagenesConsultorio(Request $request, $id)
    {
        $request->validate([
            'imagenes.*' => 'required|image|max:2048'
        ]);

        $paths = [];

        foreach ($request->file('imagenes') as $imagen) {
            $nombreArchivo = uniqid() . '.' . $imagen->getClientOriginalExtension();

            $rutaDestino = public_path("consultorios/{$id}");

            // Crea la carpeta si no existe
            if (!File::exists($rutaDestino)) {
                File::makeDirectory($rutaDestino, 0755, true);
            }

            // Mueve el archivo
            $imagen->move($rutaDestino, $nombreArchivo);

            $rutaRelativa = "consultorios/{$id}/{$nombreArchivo}";

            // Guarda en la base de datos la ruta relativa
            $imagenRecord = ConsultorioImagen::create([
                'consultorio_id' => $id,
                'imagen_path' => $rutaRelativa
            ]);

            $paths[] = $imagenRecord;
        }

        return response()->json(['success' => true, 'imagenes' => $paths]);
    }

    public function eliminarImagenConsultorio($id)
    {
        $imagen = ConsultorioImagen::findOrFail($id);

        $ruta = public_path($imagen->imagen_path);
        if (File::exists($ruta)) {
            File::delete($ruta);
        }

        $imagen->delete();

        return response()->json(['success' => true]);
    }

    public function guardarDocumento(Request $request, $profesionalId)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'documento' => 'required|file|max:5120', // max 5MB, ajusta si quieres
        ]);

        // Guardar archivo en public/documentos/{profesionalId}/
        $file = $request->file('documento');
        $folder = public_path("documentos/{$profesionalId}");

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($folder, $filename);

        // Guardar registro en BD
        DocumentoProfesional::create([
            'profesional_id' => $profesionalId,
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'archivo' => "documentos/{$profesionalId}/{$filename}",
        ]);

        return redirect()->back()->with('success', 'Documento guardado correctamente.');
    }

    public function eliminarDocumento(DocumentoProfesional $documento)
    {
        // Eliminar archivo físico
        if (File::exists(public_path($documento->archivo))) {
            File::delete(public_path($documento->archivo));
        }

        // Eliminar registro DB
        $documento->delete();

        return back()->with('success', 'Documento eliminado correctamente.');
    }

    public function exportarRecetaPDF($id)
    {
        $receta = Receta::with([
            'medicamentosRecetados.medicamento',
            'medicamentosRecetados.presentacion',
            'medicamentosRecetados.viaAdministracion',
            'medicamentosRecetados.intervalo',
            'informeConsulta.cita.paciente',
            'informeConsulta.cita.profesional',
            'informeConsulta.cita.consultorio'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('profesionales.recetasFarmaciaPDF', compact('receta'));

        return $pdf->download('informe_consulta' . $receta->id . '.pdf');
    }

    public function pagarPlan(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:planes,id'
        ]);

        $profesional = Profesional::where('user_id', auth()->id())->firstOrFail();

        // Actualizar el plan actual
        $profesional->update([
            'plan_id' => $request->plan_id,
        ]);

        // Registrar la suscripción (y marcarla como pagada)
        $suscripcion = new SuscripcionPlan();
        $suscripcion->profesional_id = $profesional->id;
        $suscripcion->plan_id = $request->plan_id;
        $suscripcion->fecha_inicio = now();
        $suscripcion->fecha_fin = now()->addDays(30);
        $suscripcion->pagado = 1; // Marcar como pagado
        $suscripcion->save();

        return redirect()->route('profesionales.misPlanes')->with('success', 'Plan activado correctamente.');
    }
}
