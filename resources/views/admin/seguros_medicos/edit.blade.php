@extends('adminlte::page')

@section('title', 'Editar Seguro Médico')

@section('content_header')
    <h1>Editar Seguro Médico</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('seguros_medicos.update', $seguro) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $seguro->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('seguros_medicos.index') }}" class="btn btn-secondary">Cancelar</a>
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
        console.log('Editar Seguro Médico!');
    </script>
@stop
