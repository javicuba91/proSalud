<?php

namespace App\Http\Controllers;

use App\Models\Emergencia;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
