@extends('adminlte::page')

@section('title', 'Elaboración de pedidos de laboratorio')

@section('content_header')
    <h1>Elaboración de pedidos de laboratorio</h1>
@stop

@section('content')
    <div class="row border p-2">
        <div class="col-lg-12">
            <a href="/profesional/pedidos-laboratorio/crear" class="btn btn-dark w-100 ">Crear una nuevo pedido</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <h5>Historial de pedidos de laboratorio</h5>
        </div>
    </div>

    <div class="row mb-2 border p-2">
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="Código QR">
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Nombre paciente">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Motivo consulta">
        </div>
        <div class="col-md-2">
            <button class="btn btn-dark w-100">Ver pedido</button>
        </div>
    </div>

    <div class="row mb-2 border p-2">
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="Código QR">
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Nombre paciente">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="Motivo consulta">
        </div>
        <div class="col-md-2">
            <button class="btn btn-dark w-100">Ver pedido</button>
        </div>
    </div>
@stop
