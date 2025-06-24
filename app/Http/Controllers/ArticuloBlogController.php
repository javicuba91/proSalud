<?php

namespace App\Http\Controllers;

use App\Models\ArticuloBlog;
use App\Models\CategoriaBlog;
use App\Models\EtiquetaBlog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticuloBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        return view('admin.blog.articulos.index', compact('articulos', 'categorias', 'autores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = CategoriaBlog::activo()->orderBy('nombre')->get();
        $etiquetas = EtiquetaBlog::orderBy('nombre')->get();

        return view('admin.blog.articulos.create', compact('categorias', 'etiquetas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255|unique:articulos_blog,titulo',
            'resumen' => 'required|string|max:500',
            'contenido' => 'required|string',
            'categoria_id' => 'required|exists:categorias_blog,id',
            'estado' => 'required|in:borrador,publicado,archivado',
            'fecha_publicacion' => 'nullable|date',
            'imagen_destacada' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas_blog,id',
            'destacado' => 'boolean',
            'permite_comentarios' => 'boolean',
            'seo_title' => 'nullable|string|max:60',
            'seo_description' => 'nullable|string|max:160',
            'seo_keywords' => 'nullable|string'
        ]);

        // Preparar datos sin imagen
        $data = $request->except('imagen_destacada');
        $data['autor_id'] = Auth::id();
        $data['seo'] = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'keywords' => $request->seo_keywords
        ];

        if ($data['estado'] === 'publicado' && !$data['fecha_publicacion']) {
            $data['fecha_publicacion'] = now();
        }

        // Crear el artículo sin imagen
        $articulo = ArticuloBlog::create($data);

        // Procesar la imagen ahora que tenemos el ID
        if ($request->hasFile('imagen_destacada')) {
            $image = $request->file('imagen_destacada');
            $filename = time() . '_' . Str::slug($request->titulo) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path("blog/{$articulo->id}/imagenes");

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $filename);

            // Actualizar artículo con la ruta de la imagen
            $articulo->update([
                'imagen_destacada' => "blog/{$articulo->id}/imagenes/{$filename}"
            ]);
        }

        // Sincronizar etiquetas
        if ($request->filled('etiquetas')) {
            $articulo->etiquetas()->sync($request->etiquetas);
        }

        return redirect()->route('blog.articulos.index')
            ->with('success', 'Artículo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticuloBlog $articulo)
    {
        $articulo->load(['categoria', 'autor', 'etiquetas']);
        return view('admin.blog.articulos.show', compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticuloBlog $articulo)
    {
        $categorias = CategoriaBlog::activo()->orderBy('nombre')->get();
        $etiquetas = EtiquetaBlog::orderBy('nombre')->get();
        $articulo->load('etiquetas');

        return view('admin.blog.articulos.edit', compact('articulo', 'categorias', 'etiquetas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArticuloBlog $articulo)
    {
        $request->validate([
            'titulo' => 'required|string|max:255|unique:articulos_blog,titulo,' . $articulo->id,
            'resumen' => 'required|string|max:500',
            'contenido' => 'required|string',
            'categoria_id' => 'required|exists:categorias_blog,id',
            'estado' => 'required|in:borrador,publicado,archivado',
            'fecha_publicacion' => 'nullable|date',
            'imagen_destacada' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas_blog,id',
            'destacado' => 'boolean',
            'permite_comentarios' => 'boolean',
            'seo_title' => 'nullable|string|max:60',
            'seo_description' => 'nullable|string|max:160',
            'seo_keywords' => 'nullable|string'
        ]);

        $data = $request->all();

        // Manejar imagen destacada
        if ($request->hasFile('imagen_destacada')) {
            // Eliminar imagen anterior si existe
            if ($articulo->imagen_destacada && file_exists(public_path($articulo->imagen_destacada))) {
                unlink(public_path($articulo->imagen_destacada));
            }

            $image = $request->file('imagen_destacada');
            $filename = time() . '_' . Str::slug($request->titulo) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path("blog/{$articulo->id}/imagenes");

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $filename);

            $data['imagen_destacada'] = "blog/{$articulo->id}/imagenes/{$filename}";
        }

        // Manejar SEO
        $data['seo'] = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'keywords' => $request->seo_keywords
        ];

        // Si se cambia a publicado y no tiene fecha, establecerla
        if ($data['estado'] === 'publicado' && !$articulo->fecha_publicacion && !$data['fecha_publicacion']) {
            $data['fecha_publicacion'] = now();
        }

        $articulo->update($data);

        // Sincronizar etiquetas
        $articulo->etiquetas()->sync($request->etiquetas ?? []);

        return redirect()->route('blog.articulos.index')
            ->with('success', 'Artículo actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticuloBlog $articulo)
    {
        // Eliminar imagen destacada
        if ($articulo->imagen_destacada) {
            Storage::disk('public')->delete($articulo->imagen_destacada);
        }

        $articulo->delete();

        return redirect()->route('blog.articulos.index')
            ->with('success', 'Artículo eliminado correctamente.');
    }

    /**
     * Cambiar estado del artículo
     */
    public function cambiarEstado(Request $request, ArticuloBlog $articulo)
    {
        $request->validate([
            'estado' => 'required|in:borrador,publicado,archivado'
        ]);

        $data = ['estado' => $request->estado];

        // Si se publica y no tiene fecha, establecerla
        if ($request->estado === 'publicado' && !$articulo->fecha_publicacion) {
            $data['fecha_publicacion'] = now();
        }

        $articulo->update($data);

        return redirect()->back()
            ->with('success', 'Estado del artículo actualizado correctamente.');
    }

    /**
     * Duplicar artículo
     */
    public function duplicar(ArticuloBlog $articulo)
    {
        $nuevoArticulo = $articulo->replicate();
        $nuevoArticulo->titulo = $articulo->titulo . ' (Copia)';
        $nuevoArticulo->slug = Str::slug($nuevoArticulo->titulo);
        $nuevoArticulo->estado = 'borrador';
        $nuevoArticulo->fecha_publicacion = null;
        $nuevoArticulo->vistas = 0;
        $nuevoArticulo->save();

        // Copiar etiquetas
        $nuevoArticulo->etiquetas()->sync($articulo->etiquetas->pluck('id'));

        return redirect()->route('blog.articulos.edit', $nuevoArticulo)
            ->with('success', 'Artículo duplicado correctamente.');
    }
}
