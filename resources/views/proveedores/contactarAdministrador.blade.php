@extends('adminlte::page')

@section('title', 'Contactar al Administrador')

@section('content_header')
    <h1>Contactar al Administrador</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h6>Contactar con atención al cliente</h6>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <h4>Atención al cliente</h4>
        </div>
        <div class="col-lg-12 mb-2">
            <i class="fa fa-phone"></i> 600 000 000
        </div>
        <div class="col-lg-12 mb-2">
            <i class="fa fa-clock"></i> Horario de atención: 9:00 a 16:00 horas
        </div>
        <div class="col-lg-12 mb-2">
            <i class="fa fa-envelope"></i> Contactar por chat
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <h5>Contactar con el administrador</h5>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Breve motivo de tu consulta">
        </div>
        <div class="col-md-12 mb-2">
            <textarea rows="5" class="form-control" placeholder="Descripción de tu consulta"></textarea>
        </div>
        <div class="col-md-12 mb-2 text-center mt-2">
            <button class="btn btn-dark">Enviar</button>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <h5>Mis consultas pendientes</h5>
        </div>
    </div>
    <div class="row mt-1 border p-2">
        <div class="col-md-5 mb-2">
            <input type="text" class="form-control" placeholder="Motivo de la consulta">
        </div>
        <div class="col-md-5 mb-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md-2 mb-2">
            <button class="btn btn-dark w-100">Ver consulta</button>
        </div>

        <div class="col-md-5 mb-2">
            <input type="text" class="form-control" placeholder="Motivo de la consulta">
        </div>
        <div class="col-md-5 mb-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md-2 mb-2">
            <button class="btn btn-dark w-100">Ver consulta</button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <h5>Mis consultas pasadas</h5>
        </div>
    </div>
    <div class="row mt-1 border p-2">
        <div class="col-md-5 mb-2">
            <input type="text" class="form-control" placeholder="Motivo de la consulta">
        </div>
        <div class="col-md-5 mb-2">
            <input type="text" class="form-control" placeholder="Fecha">
        </div>
        <div class="col-md-2 mb-2">
            <button class="btn btn-dark w-100">Ver consulta</button>
        </div>
    </div>
@stop
