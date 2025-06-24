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
    public function index()
    {

        $emergencias = Emergencia::all();
        return view('admin.emergencias.index', compact('emergencias'));
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
            'tipo' => 'required|in:Farmacia 24 horas,Ambulancia 24 horas',
            'provincia_id' => 'required|exists:provincias,id',
            'ciudad_id' => 'required|exists:ciudades,id',
            'direccion' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20'
        ]);

        Emergencia::create([
            'tipo' => $request->tipo,

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
    public function destroy(Emergencia $emergencia)
    {
        $emergencia->delete();
        return redirect()->route('emergencias.index')->with('eliminado', 'ok');
    }
}
