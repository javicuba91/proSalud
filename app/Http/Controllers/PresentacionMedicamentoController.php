<?php

namespace App\Http\Controllers;

use App\Models\PresentacionMedicamento;
use Illuminate\Http\Request;

class PresentacionMedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentaciones = PresentacionMedicamento::all();
        return view('admin.presentaciones.index', compact('presentaciones'));
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
    public function destroy(PresentacionMedicamento $presentacion)
    {
        $presentacion->delete();
        return redirect()->route('presentaciones.index')->with('eliminado', 'ok');
    }
}
