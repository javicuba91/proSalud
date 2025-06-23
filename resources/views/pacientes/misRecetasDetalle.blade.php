@extends('adminlte::page')

@section('title', 'Detalle receta')

@section('content_header')
    <h1>Detalle receta</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h5>Datos del paciente</h5>
    <div class="row mb-3 border p-2">
        <div class="col-lg-4 mb-3">
            <label class="form-label">Nombre paciente</label>
            <input value="{{ $cita->paciente->nombre_completo }}" type="text" class="form-control" readonly disabled>
        </div>
        <div class="col-lg-4 mb-3">
            <label class="form-label">Fecha de nacimiento</label>
            <input value="{{ $cita->paciente->fecha_nacimiento }}" type="date" class="form-control" readonly disabled>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Cédula</label>
            <input value="{{ $cita->paciente->cedula }}" type="text" class="form-control" readonly disabled>
        </div>
    </div>

    <!-- Datos del médico -->
    <h5>Datos del médico</h5>
    <div class="row mb-3 border p-2">
        <div class="col-md-6 mb-2">
            <input type="text" value="{{ $cita->profesional->nombre_completo }}" class="form-control" readonly disabled
                placeholder="Nombre completo">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" value="{{ $cita->profesional->fecha_nacimiento }}" class="form-control" readonly disabled
                placeholder="Especialidad">
        </div>
        <div class="col-md-6 mb-2">
            <input type="text" value="{{ $cita->profesional->num_colegiado }}" class="form-control" readonly disabled
                placeholder="Número de colegiado">
        </div>
        @if ($cita->modalidad == 'presencial')
            <div class="col-md-6 mb-2">
                <input type="text" value="{{ optional($cita->consultorio)->direccion }}" class="form-control" readonly
                    disabled placeholder="Centro médico o consultorio">
            </div>
        @else
            <div class="col-md-6 mb-2">
                <input type="text" value="{{ $cita->url_meet }}" class="form-control" readonly disabled
                    placeholder="Enlace de Google Meet">
            </div>
        @endif
        <div class="col-12">
            <input type="text" value="{{ $cita->profesional->email }} / {{ $cita->profesional->telefono_personal }}"
                class="form-control" readonly disabled placeholder="Forma de contacto (email/teléfono)">
        </div>
    </div>

    <!-- Datos de la receta -->
    <form action="{{ route('profesionales.receta.update', $receta->id) }}" method="POST">
        @csrf
        <h5>Datos de la receta</h5>
        @php
            use Illuminate\Support\Str;
            use SimpleSoftwareIO\QrCode\Facades\QrCode;

            // Valor de QR: el existente o uno aleatorio
            $qrValue = $receta->qr ?? Str::upper(Str::random(8));

            // Si quieres que el enlace codificado sea la URL de detalle:
            //$urlDetalle = route('recetas.show', ['id' => $receta->id, 'qr' => $qrValue]);

        @endphp

        <div class="row mb-3 border p-2">
            @if ($receta->qr)
                <div class="col-md-12 text-left mb-3">
                    {{-- Mostrar el QR --}}
                    {!! QrCode::size(150)->generate($receta->qr) !!}
                </div>
            @endif

            <div class="col-md-6 mb-2">
                <label class="form-label">Código QR</label>
                <input type="text" class="form-control" name="qr" value="{{ old('qr', $qrValue) }}"
                    placeholder="Código QR" />
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label">Fecha de emisión</label>
                <input type="datetime-local" class="form-control" name="fecha_emision"
                    value="{{ old('fecha_emision', \Carbon\Carbon::parse($receta->fecha_emision)->format('Y-m-d\TH:i')) }}" />
            </div>

            <div class="col-12 mb-3">
                <label class="form-label">Diagnóstico / Motivo</label>
                <textarea class="form-control" name="diagnostico" rows="2" placeholder="Diagnóstico o motivo de la prescripción">{{ old('diagnostico', $receta->diagnostico) }}</textarea>
            </div>
        </div>


        <h5>Indicaciones médicas</h5>
        <div class="border p-2">
            <div class="mb-3">
                <textarea class="form-control" name="comentarios" rows="2" placeholder="Comentarios">{{ $receta->comentarios }}</textarea>
            </div>
        </div>
    </form>

    <!-- Medicamentos recetados -->
    <div class="row align-items-center mb-3 mt-3">
        <div class="col">
            <h5 class="mb-0">Medicamentos recetados</h5>
        </div>
    </div>

    <div class="row border p-3">
        <div class="col-lg-12">
            @foreach ($receta->medicamentosRecetados as $med)
                <div class="border rounded p-3 mb-2 position-relative">
                    <strong>{{ $med->medicamento->nombre ?? 'Medicamento' }}</strong><br>
                    Dosis: {{ $med->dosis }}<br>
                    Presentación:
                    {{ App\Models\PresentacionMedicamento::find($med->presentacion_medicamentos_id)->nombre }}<br>
                    Vía de Administración:
                    {{ App\Models\ViaAdministracionMedicamento::find($med->via_administracion_medicamentos_id)->nombre }}<br>
                    Intervalo: {{ App\Models\IntervaloMedicamento::find($med->intervalo_medicamentos_id)->nombre }}<br>
                    Duración: {{ $med->duracion }}
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Añadir Medicamento -->
    <div class="modal fade" id="modalMedicamento" tabindex="-1" aria-labelledby="modalMedicamentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('profesionales.medicamentos_recetas.guardarMedicamentosReceta') }}">
                @csrf
                <input type="hidden" name="receta_id" value="{{ $receta->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMedicamentoLabel">Añadir Medicamento</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select name="medicamento_id" class="form-control">
                                    <option value="">Seleccione medicamento</option>
                                    @foreach ($medicamentos as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="presentacion_medicamentos_id" class="form-control">
                                    <option value="">Seleccione presentación</option>
                                    @foreach ($presentaciones as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4"><input name="dosis" type="text" class="form-control"
                                    placeholder="Dosis"></div>
                            <div class="col-md-4 mt-2">
                                <select name="via_administracion_medicamentos_id" class="form-control">
                                    <option value="">Seleccione vía</option>
                                    @foreach ($vias as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-2">
                                <select name="intervalo_medicamentos_id" class="form-control">
                                    <option value="">Seleccione intervalo</option>
                                    @foreach ($intervalos as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-2"><input name="duracion" type="text" class="form-control"
                                    placeholder="Duración del tratamiento"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
