@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_header')
    <h1>Notificaciones</h1>
@stop

@section('content')
    <div class="row mt-1">
        <div class="col-lg-12">
            <h6>¿Cómo deseas recibir las notificaciones?</h6>
        </div>
        <div class="col-lg-12 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    Solo por la aplicación
                </label>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                <label class="form-check-label" for="flexCheckChecked2">
                    Por correo electrónico
                </label>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked3">
                <label class="form-check-label" for="flexCheckChecked3">
                    Por Whatsapp
                </label>
            </div>
        </div>
    </div>
@stop
