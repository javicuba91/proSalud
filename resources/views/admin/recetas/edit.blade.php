@extends('adminlte::page')

@section('title', 'Editar Recetas')

@section('content_header')
    <h1>Editar Recetas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('recetas.update', $receta->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="informe_consulta_id">Informe Consulta ID</label>
                    <input type="number" name="informe_consulta_id" id="informe_consulta_id" class="form-control @error('informe_consulta_id') is-invalid @enderror" value="{{ old('informe_consulta_id', $receta->informe_consulta_id) }}" required readonly>
                    @error('informe_consulta_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label fw-bold">QR generado</label>
                        @if (!empty($receta->qr))
                            <div>{!! QrCode::size(120)->generate($receta->qr) !!}</div>
                        @else
                            <div class="text-muted">No hay QR para mostrar</div>
                        @endif
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label fw-bold">Informe de Consulta</label>
                        <p>
                            <a href="/admin/informes-consulta/{{ $receta->informe_consulta_id }}">
                                {{ $receta->informe_consulta_id }} ({{ $receta->informeConsulta->motivo_consulta ?? '' }})
                            </a>
                        </p>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label fw-bold">Paciente</label>
                        <p>
                            <a href="/admin/usuario/{{ $receta->informeConsulta->cita->paciente->id ?? '' }}">
                                {{ $receta->informeConsulta->cita->paciente->nombre_completo ?? '' }}
                            </a>
                        </p>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label fw-bold">Profesional</label>
                        <p>
                            <a href="/admin/usuario/{{ $receta->informeConsulta->cita->profesional->id ?? '' }}">
                                {{ $receta->informeConsulta->cita->profesional->nombre_completo ?? '' }}
                            </a>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fecha_emision">Fecha de Emisión</label>
                    <input type="datetime-local" name="fecha_emision" id="fecha_emision" class="form-control @error('fecha_emision') is-invalid @enderror" value="{{ old('fecha_emision', isset($receta->fecha_emision) ? \Carbon\Carbon::parse($receta->fecha_emision)->format('Y-m-d\TH:i') : null) }}" required>
                    @error('fecha_emision')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="diagnostico">Diagnóstico</label>
                    <textarea name="diagnostico" id="diagnostico" class="form-control @error('diagnostico') is-invalid @enderror">{{ old('diagnostico', $receta->diagnostico) }}</textarea>
                    @error('diagnostico')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="comentarios">Comentarios</label>
                    <textarea name="comentarios" id="comentarios" class="form-control @error('comentarios') is-invalid @enderror">{{ old('comentarios', $receta->comentarios) }}</textarea>
                    @error('comentarios')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Firma</label><br>
                    @if ($receta->ruta_firma)
                        <img src="{{ asset($receta->ruta_firma) }}" alt="Firma" class="img-fluid" style="max-height: 150px;">
                    @else
                        <span class="text-muted">Sin firma</span>
                    @endif
                    <input type="text" name="ruta_firma" id="ruta_firma" class="form-control mt-2 @error('ruta_firma') is-invalid @enderror" value="{{ old('ruta_firma', $receta->ruta_firma) }}" placeholder="Ruta de la firma">
                    @error('ruta_firma')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="paciente_id">Paciente</label>
                    <select name="paciente_id" id="paciente_id" class="form-control @error('paciente_id') is-invalid @enderror" required>
                        <option value="">Seleccione un paciente</option>
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->id }}" {{ (old('paciente_id', optional($receta->informeConsulta->cita->paciente ?? null)->id) == $paciente->id) ? 'selected' : '' }}>
                                {{ $paciente->nombre_completo ?? 'Paciente #'.$paciente->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('paciente_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">Medicamentos recetados</label>
                        <div class="row">
                            @foreach ($receta->medicamentosRecetados as $i => $med)
                                <div class="col-lg-6">
                                    <div style="padding:10px; border-radius:6px; background:#f0f8ff; margin-bottom:10px; color:black; font-size:16px;">
                                        <strong class="text-danger">{{ $med->medicamento->nombre ?? 'Medicamento' }}</strong><br>
                                        Dosis: <input type="text" name="medicamentos[{{ $i }}][dosis]" value="{{ old('medicamentos.'.$i.'.dosis', $med->dosis) }}" class="form-control mb-1">
                                        Presentación:
                                        <select name="medicamentos[{{ $i }}][presentacion_id]" class="form-control mb-1">
                                            @foreach($presentaciones as $pres)
                                                <option value="{{ $pres->id }}" {{ (old('medicamentos.'.$i.'.presentacion_id', $med->presentacion_medicamentos_id) == $pres->id) ? 'selected' : '' }}>{{ $pres->nombre }}</option>
                                            @endforeach
                                        </select>
                                        Vía:
                                        <select name="medicamentos[{{ $i }}][via_id]" class="form-control mb-1">
                                            @foreach($vias as $via)
                                                <option value="{{ $via->id }}" {{ (old('medicamentos.'.$i.'.via_id', $med->via_administracion_medicamentos_id) == $via->id) ? 'selected' : '' }}>{{ $via->nombre }}</option>
                                            @endforeach
                                        </select>
                                        Intervalo:
                                        <select name="medicamentos[{{ $i }}][intervalo_id]" class="form-control mb-1">
                                            @foreach($intervalos as $intervalo)
                                                <option value="{{ $intervalo->id }}" {{ (old('medicamentos.'.$i.'.intervalo_id', $med->intervalo_medicamentos_id) == $intervalo->id) ? 'selected' : '' }}>{{ $intervalo->nombre }}</option>
                                            @endforeach
                                        </select>
                                        Duración: <input type="text" name="medicamentos[{{ $i }}][duracion]" value="{{ old('medicamentos.'.$i.'.duracion', $med->duracion) }}" class="form-control mb-1">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <a href="{{ route('recetas.index') }}" class="btn btn-secondary">Cancelar</a>
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
        console.log('Editar Región!');
    </script>
@stop
