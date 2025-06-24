<?php

namespace App\Http\Controllers;

use App\Models\EtiquetaBlog;
use Illuminate\Http\Request;

class EtiquetaBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etiquetas = EtiquetaBlog::orderBy('nombre')->get();
        return view('admin.blog.etiquetas.index', compact('etiquetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.etiquetas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:etiquetas_blog,nombre',
            'descripcion' => 'nullable|string',
            'color' => 'required|string|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
        ]);

        EtiquetaBlog::create($request->all());

        return redirect()->route('blog.etiquetas.index')
            ->with('success', 'Etiqueta creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EtiquetaBlog $etiqueta)
    {
        $etiqueta->load(['articulos' => function($query) {
            $query->publicado()->latest('fecha_publicacion')->take(10);
        }]);

        return view('admin.blog.etiquetas.show', compact('etiqueta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EtiquetaBlog $etiqueta)
    {
        return view('admin.blog.etiquetas.edit', compact('etiqueta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EtiquetaBlog $etiqueta)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:etiquetas_blog,nombre,' . $etiqueta->id,
            'descripcion' => 'nullable|string',
            'color' => 'required|string|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
        ]);

        $etiqueta->update($request->all());

        return redirect()->route('blog.etiquetas.index')
            ->with('success', 'Etiqueta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EtiquetaBlog $etiqueta)
    {
        // Verificar si tiene artículos asociados
        if ($etiqueta->articulos()->count() > 0) {
            return redirect()->route('blog.etiquetas.index')
                ->with('error', 'No se puede eliminar la etiqueta porque tiene artículos asociados.');
        }

        $etiqueta->delete();

        return redirect()->route('blog.etiquetas.index')
            ->with('success', 'Etiqueta eliminada correctamente.');
    }
}
