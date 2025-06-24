<?php

namespace App\Http\Controllers;

use App\Models\SegurosMedicos;
use Illuminate\Http\Request;

class SeguroMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seguros_medicos = SegurosMedicos::all();
        return view('admin.seguros_medicos.index', compact('seguros_medicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.seguros_medicos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        SegurosMedicos::create($request->all());

        return redirect()->route('seguros_medicos.index')
            ->with('success', 'Seguro Médico creado correctamente.');
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
    public function destroy(SegurosMedicos $seguro)
    {
        $seguro->delete();
        return redirect()->route('seguros_medicos.index')->with('eliminado', 'ok');
    }
}
