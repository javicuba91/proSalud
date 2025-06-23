@extends('adminlte::page')

@section('title', 'Mis Citas Pendientes')

@section('content_header')
    <h1>Mis Citas Pendientes</h1>
@stop

@section('content')
     
     <div class="row mb-3 border p-3">    
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Código cita QR">
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Fecha y hora">
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Médico asignado">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Tipo de consulta (presencial, videollamada)">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Breve motivo de la consulta">
        </div>
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Estado (aceptada, pendiente de confirmar)">
        </div>
        <div class="col-md-6 mb-2">
            <a href="#" class="btn btn-dark w-100">Cambiar fecha</a>
        </div>
        <div class="col-md-6 mb-2">
            <a href="#" class="btn btn-dark w-100">Cancelar cita</a>
        </div>
    </div>

@stop
