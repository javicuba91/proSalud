<?php

namespace App\Http\Controllers;

use App\Models\DocumentoProfesional;
use App\Models\Profesional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DocumentoProfesionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentos = DocumentoProfesional::all();
        return view('admin.documentos.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profesionales = Profesional::with('user')->get();
        return view('admin.documentos.create', compact('profesionales'));
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

        return redirect()->route('documentos.index')->with('success', 'Documento guardado correctamente.');
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
        return redirect()->route('documentos.index')->with('eliminado', 'ok');
    }

    public function aprobar($id)
    {
        $documento = DocumentoProfesional::findOrFail($id);
        $documento->estado = 'aprobado';
        $documento->save();

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
