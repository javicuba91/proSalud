<?php

namespace App\Http\Controllers;


use App\Models\DocumentosProveedor;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DocumentoProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DocumentosProveedor::with('proveedor');

        // Aplicar filtros
        if ($request->filled('proveedor_id')) {
            $query->where('proveedor_id', $request->proveedor_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $documentos = $query->orderBy('created_at', 'desc')->get();

        // Obtener datos para los filtros
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->get();

        return view('admin.documentos-proveedor.index', compact('documentos', 'proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::with('user')->get();
        return view('admin.documentos-proveedor.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'documento' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // max 5MB
        ]);

        // Guardar archivo en public/documentos/{proveedorId}/
        $file = $request->file('documento');
        $proveedorId = $request->proveedor_id;
        $folder = public_path("documentos_proveedor/{$proveedorId}");

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($folder, $filename);

        // Guardar registro en BD
        DocumentosProveedor::create([
            'proveedor_id' => $proveedorId,
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'archivo' => "documentos_proveedor/{$proveedorId}/{$filename}",
            'estado' => 'pendiente', // Estado por defecto
        ]);

        return redirect()->route('documentos-proveedor.index')->with('success', 'Documento guardado correctamente.');
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
    public function destroy(DocumentosProveedor $documento)
    {
        if (File::exists(public_path($documento->archivo))) {
            File::delete(public_path($documento->archivo));
        }

        $documento->delete();
        return redirect()->route('documentos-proveedor.index')->with('eliminado', 'ok');
    }

    public function aprobar($id)
    {
        $documento = DocumentosProveedor::findOrFail($id);
        $documento->estado = 'aprobado';
        $documento->save();

        return response()->json(['success' => true, 'message' => 'Documento aprobado']);
    }

    public function denegar($id)
    {
        $documento = DocumentosProveedor::findOrFail($id);
        $documento->estado = 'denegado';
        $documento->save();

        return response()->json(['success' => true]);
    }
}
