@extends('adminlte::page')

@section('title', 'Detalle comentario')

@section('content_header')
    <h1>Detalle comentario (médico o especialista)</h1>
@stop

@section('content')

    <div class="row mb-3">
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Nombre del médico">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Comentario">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Puntuación (Estrellitas)">
        </div>
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Indicar si está aprobado o no por moderador">
        </div>
        <div class="col-md-6 mb-2">
            <a href="#" class="btn btn-dark w-100">Editar comentario</a>
        </div>
        <div class="col-md-6 mb-2">
            <a href="#" class="btn btn-dark w-100">Eliminar comentario</a>
        </div>   
    </div>
   
@stop
