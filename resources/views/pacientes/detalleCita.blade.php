@extends('adminlte::page')

@section('title', 'Detalle Cita: ')

@section('content_header')
    <h1>Mis Citas</h1>
@stop

@section('content')

    @php
        use Illuminate\Support\Str;
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
    @endphp

    <div class="row mb-3">
        <div class="col-lg-12">
            <h5>Detalle Cita: {{ $cita->id }} ({{ ucfirst($cita->estado) }})</h5>
        </div>
    </div>

    @if ($cita->estado == 'aceptada')
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row mb-3 border p-3">            
            <div class="col-lg-3 mb-2">
                {!! QrCode::size(pixels: 150)->generate($cita->codigo_qr) !!}
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <input aria-readonly="true" disabled value="{{ $cita->profesional->nombre_completo }}" type="text"
                            class="form-control" placeholder="Nombre médico">
                    </div>
                    <div class="col-md-12 mb-2">
                        <input aria-readonly="true" disabled value="{{ $cita->fecha_hora }}" type="datetime-local"
                            class="form-control" placeholder="Fecha">
                    </div>
                    <div class="col-md-6 mb-2">
                        <select name="" id="" class="form-control" aria-readonly="true" disabled>
                            <option value="{{ $cita->modalidad }}">{{ ucfirst($cita->modalidad) }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input aria-readonly="true" disabled value="{{ $cita->motivo }}" type="text" class="form-control"
                            placeholder="Motivo de la consulta">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" placeholder="Resultado">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" placeholder="Comentarios">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" placeholder="Pruebas solicitadas">
                    </div>
                    <div class="col-12 mb-3 mt-3">
                        <h5 class="mb-0">Medicamentos recetados</h5>
                    </div>
                
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
                    
                    <div class="col-md-4 mb-2">
                        <a href="/profesionales/ficha/{{ $cita->profesional->id }}" target="_blank"
                            class="btn btn-dark w-100">Pedir cita con mismo médico</a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <a href="#" class="btn btn-dark w-100">Exportar datos</a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button class="btn btn-dark w-100" data-toggle="modal" data-target="#modalValoracion">
                            Dejar valoración
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalValoracion" tabindex="-1" aria-labelledby="modalValoracionLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('pacientes.valoraciones.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalValoracionLabel">Dejar una valoración</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            {{-- Ocultos para identificar paciente y profesional --}}
                            <input type="hidden" name="paciente_id" value="{{ $cita->paciente_id}}">
                            <input type="hidden" name="profesional_id" value="{{ $cita->profesional->id }}">

                            {{-- Fecha de valoración --}}
                            <div class="mb-3">
                                <label class="form-label">Fecha</label>
                                <input class="form-control form-select" type="date" name="fecha" value="">
                            </div>

                            {{-- Modalidad --}}
                            <div class="mb-3">
                                <label class="form-label">Modalidad</label>
                                <select name="modalidad" class="form-control form-select" required>
                                    <option value="presencial">Presencial</option>
                                    <option value="videollamada">Videollamada</option>
                                </select>
                            </div>

                            {{-- Puntuación --}}
                            <div class="mb-3">
                                <label class="form-label">Puntuación</label>
                                <select name="puntuacion" class="form-control form-select" required>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}">{{ $i }}
                                            estrella{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Comentario --}}
                            <div class="mb-3">
                                <label class="form-label">Comentario (opcional)</label>
                                <textarea name="comentario" class="form-control" rows="3" placeholder="Tu experiencia..."></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Enviar valoración</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @elseif($cita->estado == 'pendiente')
        <div class="row mb-3 border p-3">
            <div class="col-lg-3 mb-2">
                {!! QrCode::size(pixels: 150)->generate($cita->codigo_qr) !!}
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <input aria-readonly="true" disabled value="{{ $cita->fecha_hora }}" type="datetime-local"
                            class="form-control" placeholder="Fecha y hora">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input aria-readonly="true" disabled value="{{ $cita->profesional->nombre_completo }}"
                            type="text" class="form-control" placeholder="Médico asignado">
                    </div>
                    <div class="col-md-4 mb-2">
                        <select name="" id="" class="form-control" aria-readonly="true" disabled>
                            <option value="{{ $cita->modalidad }}">{{ ucfirst($cita->modalidad) }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input aria-readonly="true" disabled value="{{ $cita->motivo }}" type="text"
                            class="form-control" placeholder="Breve motivo de la consulta">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input aria-readonly="true" disabled value="{{ ucfirst($cita->estado) }}" type="text"
                            class="form-control" placeholder="Estado (aceptada, pendiente de confirmar)">
                    </div>
                    <div class="col-md-6 mb-2">
                        <a href="#" class="btn btn-dark w-100 btn-cambiar-fecha" data-toggle="modal"
                            data-target="#modalCambiarFecha" data-id="{{ $cita->id }}"
                            data-fecha="{{ $cita->fecha_hora }}">
                            Cambiar fecha
                        </a>
                    </div>
                    <div class="col-md-6 mb-2">
                        <a href="#" class="btn btn-dark w-100 btn-cancelar-cita" data-id="{{ $cita->id }}"
                            data-toggle="modal" data-target="#modalCancelarCita">
                            Cancelar cita
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCambiarFecha" tabindex="-1" role="dialog"
            aria-labelledby="modalCambiarFechaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{ route('profesional.citas.actualizarFecha') }}">
                    @csrf
                    <input type="hidden" value="" name="cita_id" id="cita_id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cambiar Fecha de la Cita</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="nueva_fecha">Nueva Fecha y Hora:</label>
                            <input type="datetime-local" class="form-control" name="nueva_fecha" id="nueva_fecha"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modalCancelarCita" tabindex="-1" role="dialog"
            aria-labelledby="modalCancelarCitaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="form-cancelar-cita">
                    @csrf
                    <input type="hidden" id="cancelar_cita_id" name="cita_id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cancelar Cita</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas cancelar esta cita?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Sí, cancelar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, volver</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @elseif($cita->estado == 'cancelada')
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mb-3 border p-3">
            <div class="col-lg-3 mb-2">
                {!! QrCode::size(pixels: 150)->generate($cita->codigo_qr) !!}
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <input aria-readonly="true" disabled value="{{ $cita->profesional->nombre_completo }}"
                            type="text" class="form-control" placeholder="Nombre médico">
                    </div>
                    <div class="col-md-12 mb-2">
                        <input aria-readonly="true" disabled value="{{ $cita->fecha_hora }}" type="text"
                            class="form-control" placeholder="Fecha">
                    </div>
                    <div class="col-md-4 mb-2">
                        <select name="" id="" class="form-control" aria-readonly="true" disabled>
                            <option value="{{ $cita->modalidad }}">{{ ucfirst($cita->modalidad) }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <input aria-readonly="true" disabled value="{{ $cita->motivo }}" type="text"
                            class="form-control" placeholder="Motivo de la consulta">
                    </div>
                    <div class="col-md-4 mb-2">
                        <a href="#" class="btn btn-danger w-100">Cancelada</a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <a href="/profesionales/ficha/{{ $cita->profesional->id }}" target="_blank"
                            class="btn btn-dark w-100">Pedir cita con mismo médico</a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <a href="#" class="btn btn-dark w-100">Exportar datos</a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button class="btn btn-dark w-100" data-toggle="modal" data-target="#modalValoracion">
                            Dejar valoración
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalValoracion" tabindex="-1" aria-labelledby="modalValoracionLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('pacientes.valoraciones.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalValoracionLabel">Dejar una valoración</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            {{-- Ocultos para identificar paciente y profesional --}}
                            <input type="hidden" name="paciente_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="profesional_id" value="{{ $cita->profesional->id }}">

                            {{-- Fecha de valoración --}}
                            <div class="mb-3">
                                <label class="form-label">Fecha</label>
                                <input class="form-control form-select" type="date" name="fecha" value="">
                            </div>

                            {{-- Modalidad --}}
                            <div class="mb-3">
                                <label class="form-label">Modalidad</label>
                                <select name="modalidad" class="form-control form-select" required>
                                    <option value="presencial">Presencial</option>
                                    <option value="videollamada">Videollamada</option>
                                </select>
                            </div>

                            {{-- Puntuación --}}
                            <div class="mb-3">
                                <label class="form-label">Puntuación</label>
                                <select name="puntuacion" class="form-control form-select" required>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}">{{ $i }}
                                            estrella{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Comentario --}}
                            <div class="mb-3">
                                <label class="form-label">Comentario (opcional)</label>
                                <textarea name="comentario" class="form-control" rows="3" placeholder="Tu experiencia..."></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Enviar valoración</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    @endif

@stop

@section('js')

    <script>
        $(document).on('click', '.btn-cambiar-fecha', function() {
            var citaId = $(this).data('id');
            var fechaActual = $(this).data('fecha');

            $('#cita_id').val(citaId);

            // Formatea la fecha para el input datetime-local
            let date = new Date(fechaActual);
            let formatted = date.toISOString().slice(0, 16);
            $('#nueva_fecha').val(formatted);

            const now = new Date();
            const offset = now.getTimezoneOffset();
            const localISOTime = new Date(now.getTime() - offset * 60000).toISOString().slice(0, 16);
            $('#nueva_fecha').attr('min', localISOTime);
        });

        $(document).on('click', '.btn-cancelar-cita', function() {
            const citaId = $(this).data('id');
            $('#cancelar_cita_id').val(citaId);
        });

        // Manejar el formulario de cancelación por AJAX
        $(document).on('submit', '#form-cancelar-cita', function(e) {
            e.preventDefault();
            const citaId = $('#cancelar_cita_id').val();

            $.ajax({
                url: '/profesional/citas/cancelar/' + citaId,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function() {
                    $('#modalCancelarCita').modal('hide');
                    alert('Cita cancelada correctamente');
                    location.reload(); // Recargar página o recargar solo la lista de citas
                },
                error: function() {
                    alert('Error al cancelar la cita');
                }
            });
        });
    </script>

@endsection
