@extends('adminlte::page')

@section('title', 'Mis Citas Aceptadas y Únicas')

@section('content_header')
    <h1>Mis Citas Aceptadas y Únicas</h1>
@stop

@section('content')
    <div class="row mb-3 border p-3">
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Nombre médico">
        </div>
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Código cita QR">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Tipo de consulta (presencial, videollamada)">
        </div>
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Motivo de la consulta">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Resultado">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Comentarios">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Medicamentos recetados">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Pruebas solicitadas">
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
