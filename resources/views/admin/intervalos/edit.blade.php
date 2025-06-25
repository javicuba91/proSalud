@extends('adminlte::page')

@section('title', 'Editar Intervalo de Medicamento')

@section('content_header')
    <h1>Editar Intervalo de Medicamento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('intervalos.update', $intervalo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $intervalo->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <a href="{{ route('intervalos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
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
        console.log('Editar Intervalo de Medicamento!');
    </script>
@stop
