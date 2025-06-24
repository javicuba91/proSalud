@extends('adminlte::page')

@section('title', 'Ver Receta')

@section('content_header')
    <h1 class="mb-0">Ver Receta: {{ $receta->id }}</h1>
@stop

@section('content')
    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-primary text-white clearfix">
            <h5 class="mb-0 d-inline">Detalle de la Receta</h5>
            <a style="font-weight: bold;" href="{{ route('recetas.index') }}" class="float-right">
                <i class="fa fa-arrow-left"></i> Volver al listado
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 mb-3">
                    {!! QrCode::size(120)->generate($receta->qr) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <label class="form-label fw-bold">ID Informe de Consulta</label>
                    <p><a href="/admin/informes-consulta/{{ $receta->informe_consulta_id }}">{{ $receta->informe_consulta_id }}
                            ({{ $receta->informeConsulta->motivo_consulta }})</a></p>
                </div>

                <div class="col-lg-3">
                    <label class="form-label fw-bold">Paciente</label>
                    <p>
                        <a href="/admin/usuario/{{ $receta->informeConsulta->cita->paciente->id }}">
                            {{ $receta->informeConsulta->cita->paciente->nombre_completo }}
                        </a>
                    </p>
                </div>

                <div class="col-lg-3">
                    <label class="form-label fw-bold">Profesional</label>
                    <p>
                        <a href="/admin/usuario/{{ $receta->informeConsulta->cita->profesional->id }}">
                            {{ $receta->informeConsulta->cita->profesional->nombre_completo }}
                        </a>
                    </p>
                </div>

                <div class="col-lg-3">
                    <label class="form-label fw-bold">Fecha de Emisión</label>
                    <p>{{ \Carbon\Carbon::parse($receta->fecha_emision)->format('d-m-Y H:i') }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-3">
                    <label class="form-label fw-bold">Diagnóstico</label>
                    <div class="border rounded p-2 bg-light">{{ $receta->diagnostico }}</div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-3">
                    <label class="form-label fw-bold">Comentarios</label>
                    <div class="border rounded p-2 bg-light">{{ $receta->comentarios ?? 'Sin comentarios' }}</div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Firma</label><br>
                @if ($receta->ruta_firma)
                    <img src="{{ asset($receta->ruta_firma) }}" alt="Firma" class="img-fluid"
                        style="max-height: 150px;">
                @else
                    <span class="text-muted">Sin firma</span>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-12 mb-3">
                    <label class="form-label fw-bold">Medicamentos recetados</label>
                    <div class="row">
                        @foreach ($receta->medicamentosRecetados as $med)
                            <div class="col-lg-6">
                                <div
                                    style="padding:10px; border-radius:6px; background:#f0f8ff; margin-bottom:10px; color:black; font-size:16px;">
                                    <strong class="text-danger">{{ $med->medicamento->nombre ?? 'Medicamento' }}</strong><br>
                                    Dosis: {{ $med->dosis }}<br>
                                    Presentación:
                                    {{ App\Models\PresentacionMedicamento::find($med->presentacion_medicamentos_id)->nombre }}<br>
                                    Vía:
                                    {{ App\Models\ViaAdministracionMedicamento::find($med->via_administracion_medicamentos_id)->nombre }}<br>
                                    Intervalo:
                                    {{ App\Models\IntervaloMedicamento::find($med->intervalo_medicamentos_id)->nombre }}<br>
                                    Duración: {{ $med->duracion }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
