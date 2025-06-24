@extends('adminlte::page')

@section('title', 'Crear Seguro Médico')

@section('content_header')
    <h1>Crear Seguro Médico</h1>
@stop

@section('content')
    <form action="{{ route('seguros_medicos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop
