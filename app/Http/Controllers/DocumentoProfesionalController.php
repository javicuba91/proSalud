<?php

namespace App\Http\Controllers;

use App\Models\DocumentoProfesional;
use App\Models\Notificacion;
use App\Models\Profesional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DocumentoProfesionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DocumentoProfesional::with('profesional');

        // Aplicar filtros
        if ($request->filled('profesional_id')) {
            $query->where('profesional_id', $request->profesional_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $documentos = $query->orderBy('created_at', 'desc')->get();

        // Obtener datos para los filtros
        $profesionales = Profesional::orderBy('nombre_completo', 'ASC')->get();

        return view('admin.documentos-profesional.index', compact('documentos', 'profesionales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profesionales = Profesional::with('user')->get();
        return view('admin.documentos-profesional.create', compact('profesionales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'profesional_id' => 'required|exists:profesionales,id',
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'documento' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // max 5MB
        ]);

        // Guardar archivo en public/documentos/{profesionalId}/
        $file = $request->file('documento');
        $profesionalId = $request->profesional_id;
        $folder = public_path("documentos_profesional/{$profesionalId}");

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
            'archivo' => "documentos_profesional/{$profesionalId}/{$filename}",
            'estado' => 'pendiente', // Estado por defecto
        ]);

        return redirect()->route('documentos-profesional.index')->with('success', 'Documento guardado correctamente.');
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
    public function destroy(DocumentoProfesional $documento)
    {
        if (File::exists(public_path($documento->archivo))) {
            File::delete(public_path($documento->archivo));
        }

        $documento->delete();
        return redirect()->route('documentos-profesional.index')->with('eliminado', 'ok');
    }

    public function aprobar($id)
    {
        $documento = DocumentoProfesional::findOrFail($id);
        $documento->estado = 'aprobado';
        $documento->save();

        $notificacion = new Notificacion();
        $notificacion->usuario_id_destino = $documento->profesional->user_id;
        $notificacion->usuario_id = NULL;
        $notificacion->titulo = "El documento ".$documento->nombre." ha sido aprobado";
        $notificacion->mensaje = "El documento ".$documento->nombre." ha sido aprobado";        
        $notificacion->tipo = "documento_profesional";
        $notificacion->icono = "fa fa-file";
        $notificacion->leida = 0;
        $notificacion->save();

        return response()->json(['success' => true, 'message' => 'Documento aprobado']);
    }

    public function denegar($id)
    {
        $documento = DocumentoProfesional::findOrFail($id);
        $documento->estado = 'denegado';
        $documento->save();

        return response()->json(['success' => true]);
    }
}
