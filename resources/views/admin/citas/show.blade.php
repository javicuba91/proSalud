@extends('adminlte::page')

@section('title', 'Ver Cita')

@section('content_header')
    <h1>Ver Cita: {{$cita->id}}</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('citas.index') }}" class="btn btn-danger">
            <i class="fa fa-arrow-left"></i> Volver al listado</i>
        </a>
    </div>
@stop

@section('content')
  
    
@stop
