@extends('adminlte::page')

@section('title', 'Mis Valoraciones')

@section('content_header')
    <h1>Mis Valoraciones</h1>
@stop

@section('content')


    @foreach ($valoraciones as $valoracion)
        <div class="row p-2 mb-2 border">
            <div class="col-md mb-2">
                <input type="text" class="form-control" value="{{ $valoracion->profesional->nombre_completo ?? 'N/A' }}"
                    placeholder="Nombre médico" readonly>
            </div>
            <div class="col-md mb-2">
                <input type="text" class="form-control" value="{{ date('d-m-Y', strtotime($valoracion->fecha)) }}"
                    placeholder="Fecha" readonly>
            </div>
            <div class="col-md mb-2">
                <input type="text" class="form-control" value="{{ ucfirst($valoracion->modalidad) }}"
                    placeholder="Modalidad" readonly>
            </div>
            <div class="col-md mb-2">
                <div class="form-control bg-white">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $valoracion->puntuacion)
                            <span class="text-warning">★</span>
                        @else
                            <span class="text-muted">☆</span>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="col-md mb-2">
                <button class="btn btn-dark w-100" type="button" data-toggle="collapse"
                    data-target="#comentario-{{ $valoracion->id }}">
                    Ver comentario
                </button>
            </div>
            <div class="col-md-12 mb-2 collapse" id="comentario-{{ $valoracion->id }}">
                <textarea class="form-control" rows="5" readonly>{{ $valoracion->comentario }}</textarea>
            </div>
        </div>
    @endforeach




@stop
