<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\ContactoAdminProfesional;
use App\Models\ContactoAdminProveedores;
use App\Models\DocumentoProfesional;
use App\Models\DocumentosProveedor;
use App\Models\Emergencia;
use App\Models\Medicamento;
use App\Models\Notificacion;
use App\Models\Paciente;
use App\Models\Profesional;
use App\Models\Proveedor;
use App\Models\SuscripcionesPlanesProveedores;
use App\Models\SuscripcionPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Smalot\PdfParser\Parser;
use Spatie\PdfToText\Pdf;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total_profesionales = Profesional::count();
        $total_pacientes = Paciente::count();
        $total_proveedores = Proveedor::count();
        $total_emergencias = Emergencia::count();
        $total_citas = Cita::count();
        $total_citas_canceladas = Cita::where('estado', '=', 'cancelada')->count();
        $total_citas_pendientes = Cita::where('estado', '=', 'pendiente')->count();

        $total_ingresos_profesionales = SuscripcionPlan::where('pagado', '=', 1)
            ->with('plan')
            ->get()
            ->sum(function (SuscripcionPlan $suscripcion) {
                return $suscripcion->plan->precio ?? 0;
            });

        $total_ingresos_proveedor = SuscripcionesPlanesProveedores::where('pagado', '=', 1)
            ->with('plan')
            ->get()
            ->sum(function (SuscripcionesPlanesProveedores $suscripcion) {
                return $suscripcion->plan->precio ?? 0;
            });

        $total_ingresos = $total_ingresos_profesionales + $total_ingresos_proveedor;

        $year = Carbon::now()->year;
        $tipos = ['proveedor', 'profesional', 'paciente'];

        $datos = [];

        foreach ($tipos as $tipo) {
            $usuarios = DB::table('users')
                ->selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
                ->whereYear('created_at', $year)
                ->where('role', $tipo)
                ->groupBy('mes')
                ->pluck('total', 'mes');

            $mensuales = [];
            for ($i = 1; $i <= 12; $i++) {
                $mensuales[] = $usuarios[$i] ?? 0;
            }

            $datos[$tipo] = $mensuales;
        }

        $usuariosPorTipo = $datos;

        $total_documentos_profesional = DocumentoProfesional::where('estado', '=', 'pendiente')->count();
        $total_documentos_proveedor = DocumentosProveedor::where('estado', '=', 'pendiente')->count();

        $documentos_profesionales = Notificacion::where('leida', 0)
            ->where('usuario_id_destino', null)
            ->where('tipo', 'documento_profesional')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $documentos_proveedores = Notificacion::where('leida', 0)
            ->where('usuario_id_destino', null)
            ->where('tipo', 'documento_proveedor')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $contacto_profesionales = Notificacion::where('leida', 0)
            ->where('usuario_id_destino', null)
            ->where('tipo', 'contacto_profesional')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $contacto_proveedores = Notificacion::where('leida', 0)
            ->where('usuario_id_destino', null)
            ->where('tipo', 'contacto_proveedor')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $valoraciones_profesionales = Notificacion::where('leida', 0)
            ->where('usuario_id_destino', null)
            ->where('tipo', 'valoracion_profesional')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $valoraciones_proveedores = Notificacion::where('leida', 0)
            ->where('usuario_id_destino', null)
            ->where('tipo', 'valoracion_proveedor')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $total_notificaciones = Notificacion::where('leida', 0)
            ->where('usuario_id_destino', null)
            ->count();

        return view('admin.index', compact(
            'total_documentos_proveedor',
            'total_documentos_profesional',
            'total_ingresos_profesionales',
            'total_ingresos_proveedor',
            'usuariosPorTipo',
            'total_ingresos',
            'total_citas_pendientes',
            'total_citas_canceladas',
            'total_citas',
            'total_profesionales',
            'total_pacientes',
            'total_proveedores',
            'total_emergencias',
            'total_notificaciones',
            'documentos_profesionales',
            'documentos_proveedores',
            'contacto_profesionales',
            'contacto_proveedores',
            'valoraciones_profesionales',
            'valoraciones_proveedores'
        ));
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


    public function cargarMedicamentos()
    {
        $rutaArchivo = public_path('medicamentos/medicamentos.txt');

        // Verificar si el archivo existe
        if (!file_exists($rutaArchivo)) {
            $this->error('El archivo medicamentos.txt no existe en la ruta especificada.');
            return;
        }

        // Leer el contenido del archivo
        $contenido = file_get_contents($rutaArchivo);
        $lineas = explode("\n", $contenido);

        foreach ($lineas as $linea) {
            // Eliminamos espacios extra
            $linea = preg_replace('/\s+/', ' ', trim($linea));
            $partes = explode(' ', $linea, 3);

            if (count($partes) >= 3) {
                $nombreBruto = $partes[2];

                $nombre = preg_split('/\s+(TAB|INY|VIAL|UNG|CAP|ML|MG|G|UNIDAD|%|\d+ ?mg|\d+ ?ml)/i', $nombreBruto)[0];
                $nombre = trim($nombre);

                if (!empty($nombre)) {
                    Medicamento::firstOrCreate(['nombre' => $nombre]);
                }
            }
        }

        return response()->json([
            'contenido' => "Carga completada"
        ]);
    }

    public function adminContactoProveedores(Request $request)
    {
        $query = ContactoAdminProveedores::with('proveedor');

        // Aplicar filtros
        if ($request->filled('proveedor_id')) {
            $query->where('proveedor_id', $request->proveedor_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $contactos = $query->orderBy('created_at', 'desc')->get();

        // Obtener datos para los filtros
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->get();

        return view('admin.contacto_proveedores.index', compact('contactos', 'proveedores'));
    }
    public function adminContactoProfesional(Request $request)
    {
        $query = ContactoAdminProfesional::with('profesional');

        // Aplicar filtros
        if ($request->filled('profesional_id')) {
            $query->where('profesional_id', $request->profesional_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $contactos = $query->orderBy('created_at', 'desc')->get();

        // Obtener datos para los filtros
        $profesionales = Profesional::orderBy('nombre_completo', 'ASC')->get();

        return view('admin.contacto_profesional.index', compact('contactos', 'profesionales'));
    }

    public function responderContactoProveedor(Request $request, $id)
    {
        $request->validate([
            'respuesta' => 'required|string',
        ]);

        $contacto = ContactoAdminProveedores::findOrFail($id);
        $contacto->respuesta = $request->respuesta;
        $contacto->estado = 'respondido';
        $contacto->fecha_respuesta = now();
        $contacto->save();

        return response()->json([
            'success' => true,
            'message' => 'Respuesta enviada correctamente'
        ]);
    }

    public function responderContactoProfesional(Request $request, $id)
    {
        $request->validate([
            'respuesta' => 'required|string',
        ]);

        $contacto = ContactoAdminProfesional::findOrFail($id);
        $contacto->respuesta = $request->respuesta;
        $contacto->estado = 'respondido';
        $contacto->fecha_respuesta = now();
        $contacto->save();

        return response()->json([
            'success' => true,
            'message' => 'Respuesta enviada correctamente'
        ]);
    }
}
