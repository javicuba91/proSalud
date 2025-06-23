<?php

namespace App\Http\Controllers;

use App\Models\DocumentoProfesional;
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
    public function destroy(DocumentoProfesional $documento)
    {
        if (File::exists(public_path($documento->archivo))) {
            File::delete(public_path($documento->archivo));
        }

        $documento->delete();
        return redirect()->route('documentos.index')->with('eliminado', 'ok');
    }
}
