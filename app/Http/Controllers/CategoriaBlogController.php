<?php

namespace App\Http\Controllers;

use App\Models\CategoriaBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = CategoriaBlog::orderBy('nombre')->get();
        return view('admin.blog.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias_blog,nombre',
            'descripcion' => 'nullable|string',
            'color' => 'required|string|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            'activo' => 'boolean'
        ]);

        CategoriaBlog::create($request->all());

        return redirect()->route('blog.categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Store a newly created resource via AJAX.
     */
    public function ajaxStore(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255|unique:categorias_blog,nombre',
                'descripcion' => 'nullable|string',
                'color' => 'required|string|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
            ]);

            // Crear nueva categoría con slug generado manualmente
            $categoria = CategoriaBlog::create([
                'nombre' => $request->nombre,
                'slug' => Str::slug($request->nombre),
                'descripcion' => $request->descripcion,
                'color' => $request->color,
                'activo' => true
            ]);

            return response()->json([
                'success' => true,
                'categoria' => $categoria,
                'message' => 'Categoría creada correctamente'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'Error de validación'
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriaBlog $categoria)
    {
        $categoria->load(['articulos' => function($query) {
            $query->publicado()->latest('fecha_publicacion')->take(10);
        }]);

        return view('admin.blog.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriaBlog $categoria)
    {
        return view('admin.blog.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoriaBlog $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias_blog,nombre,' . $categoria->id,
            'descripcion' => 'nullable|string',
            'color' => 'required|string|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            'activo' => 'boolean'
        ]);

        $categoria->update($request->all());

        return redirect()->route('blog.categorias.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaBlog $categoria)
    {
        // Verificar si tiene artículos asociados
        if ($categoria->articulos()->count() > 0) {
            return redirect()->route('blog.categorias.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene artículos asociados.');
        }

        $categoria->delete();

        return redirect()->route('blog.categorias.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}
