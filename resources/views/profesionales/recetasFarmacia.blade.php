@extends('adminlte::page')

@section('title', 'Elaboración receta digital')

@section('content_header')
    <h1>Elaboración receta digital</h1>
@stop

@section('content')
    <div class="row border p-2">
        <div class="col-lg-12">
            <a href="/profesional/recetas-farmacia-digitales/crear" class="btn btn-dark w-100 ">Crear una nueva receta</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <h5>Historial de recetas</h5>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-lg-12 border p-2">
            <input type="text" class="form-control" placeholder="Buscar paciente">
        </div>
    </div>

    @foreach ($recetas as $receta)
        <div class="row mb-2 border p-2">
            <div class="col-md">
                <input type="text" value="{{$receta->qr}}" class="form-control" readonly disabled placeholder="Código QR">
            </div>
            <div class="col-md">
                <input type="text" value="{{$receta->cedula}}" class="form-control" readonly disabled placeholder="Cédula">
            </div>
            <div class="col-md">
                <input type="text" value="{{$receta->fecha_emision}}" class="form-control" readonly disabled placeholder="Fecha">
            </div>
            <div class="col-md">
                <input type="text" value="{{$receta->nombre_completo}}" class="form-control" readonly disabled placeholder="Nombre paciente">
            </div>
            <div class="col-md">
                <input type="text" value="{{$receta->motivo}}" class="form-control" readonly disabled placeholder="Motivo consulta">
            </div>
            <div class="col-md">
                <a href="/profesional/cita/informe-consulta/{{$receta->idInforme}}/receta" class="btn btn-dark w-100">Ver receta</a>
            </div>
        </div>
    @endforeach

@stop
