@extends('adminlte::page')

@section('title', 'Añadir nuevo paciente')

@section('content_header')
    <h1>Añadir nuevo paciente</h1>
@stop

@section('content')
    <div class="row border p-2 mb-2">

        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Nombre completo">
        </div>
        <div class="col-md-4 mb-2">
            <input type="date" class="form-control" placeholder="Fecha de nacimiento">
        </div>

        <div class="col-lg-4 mb-2">
            <select name="" id="" class="form-control form-select">
                <option value="">Seleccione su género</option>
                <option value="">Hombre</option>
                <option value="">Mujer</option>
                <option value="">Otro</option>
            </select>
        </div>

        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Estado civil">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Nacionalidad">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Teléfono">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Email">
        </div>
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Dirección de residencia">
        </div>

    </div>

    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <h3 class="">Consideraciones médicas</h3>
        </div>
    </div>

    <div class="row border p-2 mb-2">
        <div class="col-lg-6 mb-2">
            <input type="text" class="form-control" placeholder="Alergias">
        </div>
        <div class="col-lg-6 mb-2">
            <input type="text" class="form-control" placeholder="Condiciones médicas preexistentes">
        </div>
        <div class="col-lg-12 mb-2">
            <input type="text" class="form-control" placeholder="Medicamentos que consume habitualmente">
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <h3 class="">Seguro de salud</h3>
        </div>
    </div>

    <div class="row border p-2 mb-2">
        <div class="col-lg-12 mb-2">
            <select class="form-control form-select" name="" id="">
                <option value="-1">Seleccione el seguro médico</option>
                @foreach ($seguros as $seguro)
                    <option value="{{ $seguro->id }}">{{ $seguro->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <h3 class="">Datos de emergencia</h3>
        </div>
    </div>

    <div class="row border p-2 mb-2">
        <div class="col-lg-12 mb-2">
            <input type="text" class="form-control" placeholder="Datos de contacto de persona en caso de emergencia">
        </div>
    </div>

    <div class="row border p-2 mb-2">
        <div class="col-lg-12">
            <a href="" class="btn btn-dark w-100">Guardar datos</a>
        </div>
    </div>

    
@stop
