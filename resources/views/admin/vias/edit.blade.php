@extends('adminlte::page')

@section('title', 'Editar Vía de Administración')

@section('content_header')
    <h1>Editar Vía de Administración</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('vias.update', $via->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $via->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('vias.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Editar Vía de Administración!');
    </script>
@stop
