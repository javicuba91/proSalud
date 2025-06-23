@extends('adminlte::page')

@section('title', 'Mis Citas Canceladas')

@section('content_header')
    <h1>Mis Citas Canceladas</h1>
@stop

@section('content')
    <div class="row mb-3 border p-3">
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Nombre médico">
        </div>
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md-2 mb-2">
            <input type="text" class="form-control" placeholder="Código cita QR">
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Tipo de consulta (presencial, videollamada)">
        </div>
        <div class="col-md-3 mb-2">
            <input type="text" class="form-control" placeholder="Motivo de la consulta">
        </div>
        <div class="col-md-3 mb-2">
            <a href="#" class="btn btn-danger w-100">Cancelada</a>
        </div>
        <div class="col-md-4 mb-2">
            <a href="#" class="btn btn-dark w-100">Pedir cita con mismo médico</a>
        </div>
        <div class="col-md-4 mb-2">
            <a href="#" class="btn btn-dark w-100">Exportar datos</a>
        </div>
        <div class="col-md-4 mb-2">
            <a href="#" class="btn btn-dark w-100">Dejar valoración</a>
        </div>
    </div>

    <div class="row mb-3 border p-3">
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Nombre médico">
        </div>
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md-2 mb-2">
            <input type="text" class="form-control" placeholder="Código cita QR">
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Tipo de consulta (presencial, videollamada)">
        </div>
        <div class="col-md-3 mb-2">
            <input type="text" class="form-control" placeholder="Motivo de la consulta">
        </div>
        <div class="col-md-3 mb-2">
            <a href="#" class="btn btn-danger w-100">Cancelada</a>
        </div>
        <div class="col-md-4 mb-2">
            <a href="#" class="btn btn-dark w-100">Pedir cita con mismo médico</a>
        </div>
        <div class="col-md-4 mb-2">
            <a href="#" class="btn btn-dark w-100">Exportar datos</a>
        </div>
        <div class="col-md-4 mb-2">
            <a href="#" class="btn btn-dark w-100">Dejar valoración</a>
        </div>
    </div>
@stop
