@extends('adminlte::page')

@section('title', 'Agendar Cita')

@section('content_header')
    <h1>Agendar Cita</h1>
@stop

@section('content')
<div class="row border p-2">
    
    <div class="col-lg-12 mb-2">
        <input type="text" class="form-control" placeholder="Nombre del paciente">
    </div>

    <div class="col-lg-2 mb-2">
        <input type="text" class="form-control" placeholder="Código cita QR">
    </div>
    <div class="col-lg-2 mb-2">
        <input type="text" class="form-control" placeholder="Fecha">
    </div>
    <div class="col-lg-4 mb-2">
        <input type="text" class="form-control" placeholder="Modalidad (presencial, videoconsulta)">
    </div>
    <div class="col-lg-4 mb-2">
        <input type="text" class="form-control" placeholder="Breve motivo de la consulta">
    </div>

    <div class="col-lg-12 mb-2">
        <input type="text" class="form-control" placeholder="Elegir clinica/centro">
    </div>

    <div class="col-lg-12 mb-2">
        <a href="" class="btn btn-dark w-100">Guardar datos</a>
    </div>

</div>
@stop
