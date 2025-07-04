<?php

namespace App\Http\Controllers;

use App\Models\ArticuloBlog;
use App\Models\CategoriaBlog;
use App\Models\CategoriaProfesional;
use App\Models\Cita;
use App\Models\DetalleCita;
use App\Models\Emergencia;
use App\Models\Especialidad;
use App\Models\HorarioProfesional;
use App\Models\HorarioVideollamada;
use App\Models\Paciente;
use App\Models\PreguntaExperto;
use App\Models\Profesional;
use App\Models\Provincia;
use App\Models\RespuestaExperto;
use App\Models\SegurosMedicos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PacienteFrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especialidades = Especialidad::where('padre_id', '=', NULL)->orderBy('nombre', 'ASC')->get();
        $seguros = SegurosMedicos::orderBy('nombre', 'ASC')->get();
        $provincias = Provincia::orderBy('nombre', 'ASC')->get();

        return view('frontend.pacientes.index', compact('provincias', 'especialidades', 'seguros'));
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

    public function registro()
    {
        return view('frontend.pacientes.registro');
    }

    public function registroPaciente(Request $request)
    {
        $usuario = new User();
        $usuario->name = $request->nombre;
        $usuario->email = $request->email;
        $usuario->role = "paciente";
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        $paciente = new Paciente();
        $paciente->user_id = $usuario->id;
        $paciente->nombre_completo = $request->nombre;
        $paciente->email = $request->email;
        $paciente->save();

        return redirect()->route('pacientes.registro')->with('success', 'Gracias por registrate. Accede a tu panel');
    }

    public function contacto()
    {
        return view('frontend.pacientes.contacto');
    }

    public function login()
    {
        return view('frontend.pacientes.login');
    }

    public function preguntasExpertos()
    {
        $categorias = CategoriaProfesional::orderBy('nombre', 'ASC')->get();
        $especialidades = Especialidad::where('padre_id', '=', NULL)->orderBy('nombre', 'ASC')->get();
        $respuestas = RespuestaExperto::orderBy('id', 'DESC')->get();
        return view('frontend.pacientes.preguntasExpertos', compact('especialidades', 'respuestas', 'categorias'));
    }

    public function preguntasExpertosGuardar(Request $request)
    {
        $preguntaExperto = new PreguntaExperto();

        // Manejar categoría
        if ($request->categoria_id == -1) {
            $preguntaExperto->categoria_id = null;
        } else {
            $preguntaExperto->categoria_id = $request->categoria_id;
        }

        // Manejar especialidad
        if ($request->especialidad_id == -1) {
            $preguntaExperto->especialidad_id = null;
        } else {
            $preguntaExperto->especialidad_id = $request->especialidad_id;
        }

        // Manejar subespecialidad
        if ($request->sub_especialidad_id == -1) {
            $preguntaExperto->sub_especialidad_id = null;
        } else {
            $preguntaExperto->sub_especialidad_id = $request->sub_especialidad_id;
        }

        $preguntaExperto->pregunta = $request->pregunta;
        $preguntaExperto->save();

        return redirect()->route('pacientes.preguntasExpertos')->with('success', 'Pregunta enviada a los expertos');
    }

    public function pacientePreguntaRespuestaFiltro(Request $request)
    {
        $query = RespuestaExperto::with(['pregunta.categoria', 'pregunta.especialidad', 'pregunta.subespecialidad']);

        // Filtro por categoría de la pregunta
        if ($request->filled('categoria_id')) {
            $query->whereHas('pregunta', function ($q) use ($request) {
                $q->where('categoria_id', $request->categoria_id);
            });
        }

        // Filtro por especialidad de la pregunta
        if ($request->filled('especialidad_id')) {
            $query->whereHas('pregunta', function ($q) use ($request) {
                $q->where('especialidad_id', $request->especialidad_id);
            });
        }

        // Filtro por subespecialidad de la pregunta
        if ($request->filled('sub_especialidad_id')) {
            $query->whereHas('pregunta', function ($q) use ($request) {
                $q->where('sub_especialidad_id', $request->sub_especialidad_id);
            });
        }

        $respuestas = $query->get();
        $categorias = CategoriaProfesional::orderBy('nombre', 'ASC')->get();
        $especialidades = Especialidad::where('padre_id', '=', NULL)->orderBy('nombre', 'ASC')->get();

        return view('frontend.pacientes.preguntasExpertos', compact('respuestas', 'categorias', 'especialidades'));
    }

    public function buscarMedicosPaciente(Request $request)
    {
        $especialidades = Especialidad::where('padre_id', '=', NULL)->orderBy('nombre', 'ASC')->get();
        $seguros = SegurosMedicos::orderBy('nombre', 'ASC')->get();
        $provincias = Provincia::orderBy('nombre', 'ASC')->get();

        $query = Profesional::with(['user', 'especializaciones', 'consultorios', 'segurosMedicos']);

        // Filtro por especialidad
        if ($request->filled('especialidad_id')) {
            $query->whereHas('especializaciones', function ($q) use ($request) {
                $q->where('especialidad_id', $request->especialidad_id);
            });
        }

        // Filtro por subespecialidad (si aplica)
        if ($request->filled('sub_especialidad_id')) {
            $query->whereHas('especializaciones', function ($q) use ($request) {
                $q->where('sub_especialidad_id', $request->sub_especialidad_id);
            });
        }

        // Filtro por seguro médico
        if ($request->filled('seguro_id')) {
            $query->whereHas('segurosMedicos', function ($q) use ($request) {
                $q->where('seguros_medicos.id', $request->seguro_id);
            });
        }

        if ($request->filled('provincia_id') && !$request->filled('ciudad_id')) {
            $query->whereHas('ciudad.provincia', function ($q) use ($request) {
                $q->where('id', $request->provincia_id);
            });
        }

        // ✅ Filtro por ciudad
        if ($request->filled('ciudad_id')) {
            $query->where('ciudad_id', $request->ciudad_id);
        }

        if ($request->filled('nombre_completo')) {
            $query->where('nombre_completo', 'LIKE', '%' . $request->nombre_completo . '%');
        }

        if ($request->modalidad == "presencial") {
            $query->where('presencial', 1);
        }

        if ($request->modalidad == "videoconsulta") {
            $query->where('videoconsulta', 1);
        }


        $medicos = $query->paginate(10);
        return view('frontend.pacientes.buscador.medicos', compact('especialidades', 'seguros', 'medicos', 'provincias'));
    }

    public function buscarEmergenciasPaciente(Request $request)
    {
        $provincias = Provincia::orderBy('nombre', 'ASC')->get();

        $query = Emergencia::with(['provincia', 'ciudad']);

        if ($request->filled('provincia_id1') && !$request->filled('ciudad_id1')) {
            $query->whereHas('ciudad.provincia', function ($q) use ($request) {
                $q->where('id', $request->provincia_id1);
            });
        }

        // ✅ Filtro por ciudad
        if ($request->filled('ciudad_id1')) {
            $query->where('ciudad_id', $request->ciudad_id1);
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', '=', $request->tipo);
        }

        if ($request->filled('ciudad')) {
            $query->where('direccion', 'LIKE', '%' . $request->ciudad . '%');
        }

        $emergencias = $query->paginate(10);

        return view('frontend.pacientes.buscador.emergencias', compact('emergencias', 'provincias'));
    }

    public function eventosCalendarioProfesional($id)
    {
        $profesional = Profesional::find($id);

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

    public function eventosCalendarioProfesionalVideollamada($id)
    {
        $profesional = Profesional::find($id);

        $eventos = HorarioVideollamada::where('profesional_id', $profesional->id)
            ->get()
            ->map(function (HorarioVideollamada $horario) {
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

    public function horariosPorDiaProfesional($profesional_id, $fecha)
    {
        $profesional = Profesional::findOrFail($profesional_id);

        $horarios = HorarioProfesional::where('profesional_id', $profesional->id)
            ->whereDate('fecha', $fecha)
            ->with('detalles.consultorio')
            ->get();

        $citas = Cita::where('profesional_id', $profesional->id)
            ->whereDate('fecha_hora', $fecha)
            ->pluck('fecha_hora')
            ->map(function ($f) {
                return date("H:i", strtotime($f));
            })
            ->toArray();

        $respuesta = [];

        foreach ($horarios as $horario) {
            foreach ($horario->detalles as $detalle) {
                $desde = date("H:i", strtotime($detalle->hora_desde));
                $hasta = date("H:i", strtotime($detalle->hora_hasta));

                // Genera los turnos de 30 min
                $turnosDisponibles = [];
                $start = strtotime($desde);
                $end = strtotime($hasta);

                while ($start < $end) {
                    $hora = date("H:i", $start);
                    if (!in_array($hora, $citas)) {
                        $turnosDisponibles[] = $hora;
                    }
                    $start = strtotime("+30 minutes", $start);
                }

                if (!empty($turnosDisponibles)) {
                    $respuesta[] = [
                        'desde' => $desde,
                        'hasta' => $hasta,
                        'consultorio' => $detalle->consultorio->direccion ?? 'Sin dirección',
                        'turnos' => $turnosDisponibles
                    ];
                }
            }
        }

        return response()->json($respuesta);
    }


    public function horariosPorDiaProfesionalVideollamada($profesional_id, $fecha)
    {
        $profesional = Profesional::findOrFail($profesional_id);

        $horarios = HorarioVideollamada::where('profesional_id', $profesional->id)
            ->whereDate('fecha', $fecha)
            ->get();

        $citas = Cita::where('profesional_id', $profesional->id)
            ->whereDate('fecha_hora', $fecha)
            ->where('modalidad', '=', 'videoconsulta')
            ->pluck('fecha_hora')
            ->map(function ($f) {
                return date("H:i", strtotime($f));
            })
            ->toArray();

        $respuesta = [];

        foreach ($horarios as $horario) {
            foreach ($horario->detalles as $detalle) {
                $desde = date("H:i", strtotime($detalle->hora_desde));
                $hasta = date("H:i", strtotime($detalle->hora_hasta));

                // Genera los turnos de 30 min
                $turnosDisponibles = [];
                $start = strtotime($desde);
                $end = strtotime($hasta);

                while ($start < $end) {
                    $hora = date("H:i", $start);
                    if (!in_array($hora, $citas)) {
                        $turnosDisponibles[] = $hora;
                    }
                    $start = strtotime("+30 minutes", $start);
                }

                if (!empty($turnosDisponibles)) {
                    $respuesta[] = [
                        'desde' => $desde,
                        'hasta' => $hasta,
                        'turnos' => $turnosDisponibles
                    ];
                }
            }
        }

        return response()->json($respuesta);
    }



    public function storeAjax(Request $request)
    {
        $paciente = Paciente::where('user_id', '=', Auth::user()->id)->first();

        $cita = new Cita();
        $cita->paciente_id = $paciente->id;
        $cita->profesional_id = $request->profesional_id;
        $cita->fecha_hora = $request->fecha_hora;
        $cita->modalidad = "presencial";
        $cita->motivo = $request->motivo;
        $cita->especializacion_id = $request->especialidad_id;
        $cita->estado = "aceptada";
        $cita->consultorio_id = $request->consultorio_id;
        $cita->url_meet = null;
        $cita->codigo_qr = strtoupper(Str::random(8));
        $cita->save();

        $detalleCita = new DetalleCita();
        $detalleCita->cita_id = $cita->id;
        $detalleCita->metodo_pago_id = $request->metodo_pago_id;
        $detalleCita->monto = $cita->especializacion->precio_presencial;
        $detalleCita->save();

        return response()->json(['success' => true, 'redirect' => route('pacientes.citas.resumen', $cita->id)]);
    }

    public function storeAjaxVideollamada(Request $request)
    {
        $paciente = Paciente::where('user_id', '=', Auth::user()->id)->first();

        $cita = new Cita();
        $cita->paciente_id = $paciente->id;
        $cita->profesional_id = $request->profesional_id;
        $cita->fecha_hora = $request->fecha_hora;
        $cita->modalidad = "videoconsulta";
        $cita->motivo = $request->motivo;
        $cita->especializacion_id = $request->especialidad_id;
        $cita->estado = "aceptada";
        $cita->url_meet = 'https://meet.google.com/' . Str::lower(Str::random(3)) . '-' . Str::lower(Str::random(4));
        $cita->codigo_qr = strtoupper(Str::random(8));
        $cita->save();

        $detalleCita = new DetalleCita();
        $detalleCita->cita_id = $cita->id;
        $detalleCita->metodo_pago_id = $request->metodo_pago_id;
        $detalleCita->monto = $cita->especializacion->precio_presencial;
        $detalleCita->save();

        return response()->json(['success' => true, 'redirect' => route('pacientes.citas.resumen', $cita->id)]);
    }

    public function resumenCita($id)
    {
        if (Auth::user()) {
            $paciente = Paciente::where('user_id', '=', Auth::user()->id)->firstOrFail();
            $cita = Cita::with(['profesional', 'consultorio'])
                ->where('id', $id)
                ->where('paciente_id', $paciente->id)
                ->firstOrFail();
            $detalleCita = $cita->detalleCita;

            $urlDetalle = route('pacientes.citas.resumen', ['id' => $cita->id]);

            // Generar el código QR con la URL
            $codigoQR = QrCode::size(150)->generate($urlDetalle);

            return view('frontend.citas.resumen', compact('cita', 'codigoQR', 'detalleCita'));
        } else {
            echo "No tienes permisos sufiencientes para ver esta cita";
        }
    }

    public function simularPago(Request $request, $id)
    {
        $detalle = DetalleCita::where('id', $id)
            ->whereHas('cita', function ($query) {
                $query->where('paciente_id', auth()->id());
            })
            ->firstOrFail();

        $detalle->estado_pago = $request->estado_pago ?? 'pagado';
        $detalle->fecha_pago = date("Y-m-d");
        $detalle->save();

        $cita = Cita::find($detalle->cita->id);
        $cita->estado = "aceptada";
        $cita->save();

        return response()->json(['success' => true]);
    }


    public function blog(Request $request)
    {
        $query = ArticuloBlog::with(['categoria', 'autor', 'etiquetas']);

        // Filtros
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('autor')) {
            $query->where('autor_id', $request->autor);
        }

        if ($request->filled('buscar')) {
            $query->buscar($request->buscar);
        }

        $articulos = $query->latest()->paginate(15);

        // Para los filtros
        $categorias = CategoriaBlog::activo()->orderBy('nombre')->get();
        $autores = User::where('role', 'admin')->orderBy('name')->get();

        return view('frontend.pacientes.blog', compact('articulos', 'categorias', 'autores'));
    }

    public function detalleBlog($slug)
    {
        $articulo = ArticuloBlog::with(['categoria', 'autor', 'etiquetas'])
            ->where('slug', $slug)
            ->publicado()
            ->firstOrFail();

        // Incrementar contador de vistas
        $articulo->incrementarVistas();

        // Artículos relacionados (opcional, por categoría)
        $relacionados = ArticuloBlog::publicado()
            ->where('categoria_id', $articulo->categoria_id)
            ->where('id', '!=', $articulo->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.pacientes.blog-detalle', compact('articulo', 'relacionados'));
    }

     public function ayuda()
    {
        return view('frontend.pacientes.ayuda');
    }
}
