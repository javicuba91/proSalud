<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProfesional;
use Illuminate\Http\Request;

class CategoriasProfesionalesController extends Controller
{
    public function index()
    {
        $categorias = CategoriaProfesional::orderBy('nombre')->get();

        return view('admin.categorias_profesionales.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias_profesionales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categoria_profesionales,nombre',
            'descripcion' => 'nullable|string',
            'orden' => 'nullable|integer|min:0'
        ]);

        CategoriaProfesional::create($request->only(['nombre', 'descripcion', 'orden']));

        return redirect()->route('categorias-profesionales.index')
                        ->with('success', 'Categoría profesional creada exitosamente.');
    }

    public function edit(CategoriaProfesional $categoriaProfesional)
    {
        return view('admin.categorias_profesionales.edit', compact('categoriaProfesional'));
    }

    public function update(Request $request, CategoriaProfesional $categoriaProfesional)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categoria_profesionales,nombre,' . $categoriaProfesional->id,
            'descripcion' => 'nullable|string',
            'orden' => 'nullable|integer|min:0'
        ]);

        $categoriaProfesional->update($request->only(['nombre', 'descripcion', 'orden']));

        return redirect()->route('categorias-profesionales.index')
                        ->with('success', 'Categoría profesional actualizada exitosamente.');
    }

    public function destroy(CategoriaProfesional $categoriaProfesional)
    {
        $categoriaProfesional->delete();

        return redirect()->route('categorias-profesionales.index')
                        ->with('eliminado', 'ok');
    }
}
