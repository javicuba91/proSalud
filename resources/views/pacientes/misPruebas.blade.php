@extends('adminlte::page')

@section('title', 'Mis Pruebas')

@section('content_header')
    <h1>Mis Pruebas</h1>
@stop

@section('content')
<div class="row mb-3">
    <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Código QR">
    </div>
    <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Fecha">
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" placeholder="Nombre clínica/centro">
    </div>
    <div class="col-md-2">
        <input type="text" class="form-control" placeholder="(3 archivos adjuntos)">
    </div>
    <div class="col-md-3">
        <button class="btn btn-dark w-100">Ver pruebas</button>
    </div>
</div>
@stop
