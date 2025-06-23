@extends('adminlte::page')

@section('title', 'Valoraciones y Comentarios')

@section('content_header')
    <h1>Mis valoraciones</h1>
@stop

@section('content')
    <div class="d-flex justify-content-between">
        <h5>Número de valoraciones: 100</h5>
        <h5>Puntuación media: 4,5/5</h5>
    </div>

    <div class="row p-2 mb-2 border">
        <div class="col-md mb-2">
            <input type="text" class="form-control" placeholder="Nombre paciente">
        </div>
        <div class="col-md mb-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md mb-2">
            <input type="text" class="form-control" placeholder="Presencial/videollamada">
        </div>
        <div class="col-md mb-2">
            <input type="text" class="form-control" placeholder="Valoración (estrellitas)">
        </div>
        <div class="col-md mb-2">
            <button class="btn btn-dark w-100">Ver comentario</button>
        </div>
        <div class="col-md-12 mb-2">
            <textarea class="form-control" rows="5"></textarea>
        </div>
    </div>

    <div class="row p-2 mb-2 border">
        <div class="col-md mb-2">
            <input type="text" class="form-control" placeholder="Nombre paciente">
        </div>
        <div class="col-md mb-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md mb-2">
            <input type="text" class="form-control" placeholder="Presencial/videollamada">
        </div>
        <div class="col-md mb-2">
            <input type="text" class="form-control" placeholder="Valoración (estrellitas)">
        </div>
        <div class="col-md mb-2">
            <button class="btn btn-dark w-100">Ver comentario</button>
        </div>
    </div>
    </div>
@stop
