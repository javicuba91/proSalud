@extends('adminlte::page')

@section('title', 'Mis clínicas / pacientes')

@section('content_header')
    <h1>Mis clínicas / pacientes</h1>
@stop

@section('content')
    <div class="row border p-2 mb-2">
        <div class="col-lg-12 mb-2">
            <input type="text" class="form-control" placeholder="Buscar cliente/paciente">
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <h3 class="">Listado de pacientes</h3>
        </div>
    </div>

    <div class="row border p-2 mb-2">
        <div class="col-lg-6"><input type="text" class="form-control" placeholder="Nombre cliente/paciente"></div>
        <div class="col-lg-3"><a href="/proveedor/mis-citas/agendar" class="btn btn-primary w-100 ">Crear cita</a></div>
        <div class="col-lg-3"><a href="/proveedor/historial-pruebas" class="btn btn-primary w-100 ">Ver historial pruebas</a></div>
    </div>

    <div class="row border pt-2 pb-2 shadow fixed-bottom">
        <div class="col-lg-12">
          <a href="/profesional/paciente/crear" class="btn btn-light w-100">Añadir nuevo paciente</a>
        </div>
    </div>    
@stop
