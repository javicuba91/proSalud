<?php

namespace App\Http\Controllers;

use App\Models\SegurosMedicos;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proveedores.index');
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
    public function destroy(string $id)
    {
        //
    }

    public function misEstadisticas()
    {
        return view('proveedores.misEstadisticas');
    }

    public function contactarAdministrador()
    {
        return view('proveedores.contactarAdministrador');
    }

    public function notificaciones()
    {
        return view('proveedores.notificaciones');
    }

    public function misPlanes()
    {
        return view('proveedores.misPlanes');
    }

    public function valoracionesComentarios()
    {
        return view('proveedores.valoracionesComentarios');
    }

    public function compartirResultados()
    {
        return view('proveedores.compartirResultados');
    }

    public function misDatos()
    {
        $seguros = SegurosMedicos::all();
        return view('proveedores.misDatos', compact('seguros'));
    }

    public function misCitas()
    {
        return view('proveedores.misCitas');
    }

    public function listadoCitasPasadas()
    {
        return view('proveedores.listadoCitasPasadas');
    }

    public function listadoCitasAceptadas()
    {
        return view('proveedores.listadoCitasAceptadas');
    }

    public function listadoCitasPendientes()
    {
        return view('proveedores.listadoCitasPendientes');
    }

    public function agendarCitaProveedor()
    {
        return view('proveedores.agendarCitaProveedor');
    }

    public function misClinicasPacientes()
    {
        return view('proveedores.misClinicasPacientes');
    }

    public function historialPruebas()
    {
        return view('proveedores.historialPruebas');
    }
    
}
