@extends('adminlte::page')

@section('title', 'Historial de pruebas')

@section('content_header')
    <h1>Historial de pruebas de (nombre paciente)</h1>
@stop

@section('content')
    <div class="row mb-3 border p-2">
        <div class="col-md">
            <input type="text" class="form-control" placeholder="Código QR">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Nombre paciente">
        </div>
        <div class="col-md">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md">
            <input type="text" class="form-control" placeholder="Breve motivo consulta">
        </div>
        <div class="col-md">
            <input type="text" class="form-control" placeholder="(3 archivos adjuntos)">
        </div>
        <div class="col-md">
            <button class="btn btn-dark w-100">Compartir resultados</button>
        </div>
    </div>
@stop
