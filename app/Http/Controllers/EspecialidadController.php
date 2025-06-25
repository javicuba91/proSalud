<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    // Mostrar todas las especialidades
    public function index()
    {
        $especialidades = Especialidad::orderBy('nombre')->get();
        return view('admin.especialidades.index', compact('especialidades'));
    }

    // Formulario para crear una nueva especialidad
    public function create()
    {
        // Obtener solo las especialidades principales (padre_id es NULL)
        $especialidadesPadre = Especialidad::whereNull('padre_id')->orderBy('nombre')->get();
        return view('admin.especialidades.create', compact('especialidadesPadre'));
    }

    // Almacenar nueva especialidad
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'padre_id' => 'nullable|exists:especialidades,id',
        ]);

        $data = $request->all();
        // Si padre_id está vacío, asignamos NULL
        if (empty($data['padre_id'])) {
            $data['padre_id'] = null;
        }

        Especialidad::create($data);

        return redirect()->route('especialidades.index')
            ->with('success', 'Especialidad creada correctamente.');
    }

    // Mostrar detalles de una especialidad
    public function show(Especialidad $especialidad)
    {
        //
    }

    // Formulario para editar una especialidad
    public function edit(Especialidad $especialidad)
    {
        // Obtener especialidades principales, excluyendo la especialidad actual si es principal
        // Si la especialidad tiene padre, incluirlo en la lista para que pueda ser seleccionado
        $especialidadesPadre = Especialidad::whereNull('padre_id')
            ->where('id', '!=', $especialidad->id)
            ->get();

        // Si la especialidad actual tiene un padre, asegurarse de que esté incluido en la lista
        if ($especialidad->padre_id && !$especialidadesPadre->contains('id', $especialidad->padre_id)) {
            $padreActual = Especialidad::find($especialidad->padre_id);
            if ($padreActual) {
                $especialidadesPadre->push($padreActual);
                // Ordenar por nombre para mantener consistencia
                $especialidadesPadre = $especialidadesPadre->sortBy('nombre');
            }
        }

        return view('admin.especialidades.edit', compact('especialidad', 'especialidadesPadre'));
    }

    // Actualizar especialidad
    public function update(Request $request, $id)
    {
        $especialidad = Especialidad::find($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'padre_id' => 'nullable|exists:especialidades,id',
        ]);

        $data = $request->all();
        // Si padre_id está vacío, asignamos NULL
        if (empty($data['padre_id'])) {
            $data['padre_id'] = null;
        }

        $especialidad->update($data);

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
