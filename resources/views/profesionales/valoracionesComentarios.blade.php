@extends('adminlte::page')

@section('title', 'Valoraciones y Comentarios')

@section('content_header')
    <h1>Mis valoraciones</h1>
@stop

@section('content')

    <div class="d-flex justify-content-between">
        <h5>Número de valoraciones: {{ $profesional->valoraciones->count() }}</h5>
        <h5>Puntuación media: 
            {{ number_format($profesional->valoraciones->avg('puntuacion'), 1) }}/5
        </h5>
    </div>

    @foreach ($profesional->valoraciones as $valoracion)
        <div class="row p-2 mb-2 border">
            <div class="col-md mb-2">
                <input type="text" class="form-control" 
                       value="{{ $valoracion->paciente->nombre_completo ?? 'N/A' }}" 
                       placeholder="Nombre paciente" readonly>
            </div>
            <div class="col-md mb-2">
                <input type="text" class="form-control" 
                       value="{{ date("d-m-Y",strtotime($valoracion->fecha)) }}" 
                       placeholder="Fecha" readonly>
            </div>
            <div class="col-md mb-2">
                <input type="text" class="form-control" 
                       value="{{ ucfirst($valoracion->modalidad) }}" 
                       placeholder="Modalidad" readonly>
            </div>
            <div class="col-md mb-2">
                <input type="text" class="form-control" 
                       value="{{ $valoracion->puntuacion }} estrellas" 
                       placeholder="Puntuación" readonly>
            </div>
            <div class="col-md mb-2">
                <button class="btn btn-dark w-100" type="button" 
                    data-toggle="collapse" 
                    data-target="#comentario-{{ $valoracion->id }}">
                    Ver comentario
                </button>
            </div>
            <div class="col-md-12 mb-2 collapse" id="comentario-{{ $valoracion->id }}">
                <textarea class="form-control" rows="5" readonly>{{ $valoracion->comentario }}</textarea>
            </div>
        </div>
    @endforeach

@endsection
