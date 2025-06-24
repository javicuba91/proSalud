<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    // Mostrar todas las especialidades
    public function index()
    {
        $especialidades = Especialidad::whereNull('padre_id')->get();
        return view('admin.especialidades.index', compact('especialidades'));
    }

    // Formulario para crear una nueva especialidad
    public function create()
    {
        return view('admin.especialidades.create');
    }

    // Almacenar nueva especialidad
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Especialidad::create($request->all());

        return redirect()->route('especialidades.index')
            ->with('success', 'Especialidad creada correctamente.');
    }

    // Mostrar detalles de una especialidad
    public function show(Especialidad $especialidad)
    {
        return view('admin.especialidades.show', compact('especialidad'));
    }

    // Formulario para editar una especialidad
    public function edit(Especialidad $especialidad)
    {
        return view('admin.especialidades.edit', compact('especialidad'));
    }

    // Actualizar especialidad
    public function update(Request $request, $id)
    {
        $especialidad = Especialidad::find($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $especialidad->update($request->all());

        return redirect()->route('especialidades.index')
            ->with('success', 'Especialidad actualizada correctamente.');
    }

    // Eliminar una especialidad
    public function destroy(Especialidad $especialidad)
    {
        $especialidad->delete();

        return redirect()->route('especialidades.index')
            ->with('success', 'Especialidad eliminada correctamente.');
    }
}
