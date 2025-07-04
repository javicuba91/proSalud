<?php

namespace App\Http\Controllers;

use App\Models\Emergencia;
use App\Models\Provincia;
use App\Models\Ciudad;
use App\Models\Region;
use Illuminate\Http\Request;

class EmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Emergencia::query();

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }
        if ($request->filled('provincia')) {
            $query->whereHas('provincia', function($q) use ($request) {
                $q->where('nombre', $request->provincia);
            });
        }
        if ($request->filled('ciudad')) {
            $query->whereHas('ciudad', function($q) use ($request) {
                $q->where('nombre', $request->ciudad);
            });
        }

        $emergencias = $query->get();
        $provincias = Provincia::orderBy('nombre')->get();
        $ciudades = Ciudad::orderBy('nombre')->get();

        return view('admin.emergencias.index', compact('emergencias', 'provincias', 'ciudades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $region = Region::all();
        $provincias = Provincia::all();
        $ciudades = Ciudad::all();
        return view('admin.emergencias.create', compact('region', 'provincias', 'ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:Farmacia 24 horas,Ambulancia 24 horas',
            'region_id' => 'required|exists:regiones,id',
            'provincia_id' => 'required|exists:provincias,id',
            'ciudad_id' => 'required|exists:ciudades,id',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20'
        ]);

        Emergencia::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'region_id' => $request->region_id,
            'provincia_id' => $request->provincia_id,
            'ciudad_id' => $request->ciudad_id,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono
        ]);

        return redirect()->route('emergencias.index')->with('creado', 'ok');
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
    public function edit(Emergencia $emergencia)
    {
        $region = Region::all();
        $provincias = Provincia::all();
        $ciudades = Ciudad::all();
        return view('admin.emergencias.edit', compact('emergencia', 'region', 'provincias', 'ciudades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Emergencia $emergencia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:Farmacia 24 horas,Ambulancia 24 horas',
            'provincia_id' => 'required|exists:provincias,id',
            'ciudad_id' => 'required|exists:ciudades,id',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20'
        ]);

        $emergencia->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'provincia_id' => $request->provincia_id,
            'ciudad_id' => $request->ciudad_id,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono
        ]);

        return redirect()->route('emergencias.index')->with('actualizado', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emergencia $emergencia)
    {
        $emergencia->delete();
        return redirect()->route('emergencias.index')->with('eliminado', 'ok');
    }
}
