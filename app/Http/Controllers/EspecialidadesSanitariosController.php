<?php

namespace App\Http\Controllers;

use App\Models\EspecialidadSanitario;
use App\Models\CategoriaProfesional;
use Illuminate\Http\Request;

class EspecialidadesSanitariosController extends Controller
{
    public function index()
    {
        $especialidades = EspecialidadSanitario::with('categoria')
            ->orderBy('nombre')
            ->get();

        return view('admin.especialidades_sanitarios.index', compact('especialidades'));
    }

    public function create()
    {
        $categorias = CategoriaProfesional::orderBy('nombre')->get();
        return view('admin.especialidades_sanitarios.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades_sanitarios,nombre',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categoria_profesionales,id'
        ]);

        EspecialidadSanitario::create($request->only(['nombre', 'descripcion', 'categoria_id']));

        return redirect()->route('especialidades-sanitarios.index')
                        ->with('success', 'Especialidad sanitaria creada exitosamente.');
    }

    public function edit(EspecialidadSanitario $especialidadSanitario)
    {
        $categorias = CategoriaProfesional::orderBy('nombre')->get();
        return view('admin.especialidades_sanitarios.edit', compact('especialidadSanitario', 'categorias'));
    }

    public function update(Request $request, EspecialidadSanitario $especialidadSanitario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades_sanitarios,nombre,' . $especialidadSanitario->id,
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categoria_profesionales,id'
        ]);

        $especialidadSanitario->update($request->only(['nombre', 'descripcion', 'categoria_id']));

        return redirect()->route('especialidades-sanitarios.index')
                        ->with('success', 'Especialidad sanitaria actualizada exitosamente.');
    }

    public function destroy(EspecialidadSanitario $especialidadSanitario)
    {
        $especialidadSanitario->delete();

        return redirect()->route('especialidades-sanitarios.index')
                        ->with('eliminado', 'ok');
    }
}
