<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Models\Region;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provincias = Provincia::all();
        return view('admin.provincias.index', compact('provincias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regiones = Region::all();
        return view('admin.provincias.create', compact('regiones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'region_id' => 'required|exists:regiones,id',
        ]);

        Provincia::create($request->all());

        return redirect()->route('provincias.index')
            ->with('success', 'Provincia creada correctamente.');
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
        $provincia = Provincia::find($id);
        $regiones = Region::all();
        return view('admin.provincias.edit', compact('provincia', 'regiones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'region_id' => 'required|exists:regiones,id',
        ]);

        $provincia = Provincia::find($id);
        $provincia->update($request->all());

        return redirect()->route('provincias.index')
            ->with('success', 'Provincia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provincia $provincia)
    {
        $provincia->delete();
        return redirect()->route('provincias.index')->with('eliminado', 'ok');
    }
}
