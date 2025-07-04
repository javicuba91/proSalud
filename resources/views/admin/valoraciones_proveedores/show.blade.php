@extends('adminlte::page')

@section('title', 'Ver Valoración de Proveedor')

@section('content_header')
    <h1>Ver Valoración de Proveedor: {{ $valoracionProveedor->id }}</h1>
@stop

@section('content')

    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-primary text-white clearfix">
            <h5 class="mb-0 d-inline">Detalle de la Valoración</h5>
            <a style="font-weight: bold;" href="{{ route('valoraciones_proveedores.index') }}" class="float-right">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>


        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-bold">Paciente</label>
                <input type="text" class="form-control-plaintext"
                    value="{{ $valoracionProveedor->paciente->nombre_completo ?? 'N/A' }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Proveedor</label>
                <input type="text" class="form-control-plaintext"
                    value="{{ $valoracionProveedor->proveedor->nombre ?? 'N/A' }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Fecha</label>
                <input type="text" class="form-control-plaintext"
                    value="{{ date('d-m-Y', strtotime($valoracionProveedor->fecha)) }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Modalidad</label>
                <input type="text" class="form-control-plaintext" value="{{ ucfirst($valoracionProveedor->modalidad) }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Puntuación</label>
                <div>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $valoracionProveedor->puntuacion)
                            <i class="fa fa-star text-warning"></i>
                        @else
                            <i class="fa fa-star text-muted"></i>
                        @endif
                    @endfor
                    <span class="ms-2">({{ $valoracionProveedor->puntuacion }} estrellas)</span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Comentario</label>
                <div class="">{{ $valoracionProveedor->comentario }}</div>
            </div>
        </div>
    </div>


@stop
