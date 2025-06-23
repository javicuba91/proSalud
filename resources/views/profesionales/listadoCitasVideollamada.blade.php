@foreach($citas as $cita)
    <div class="row border p-2 mb-2">
        <div class="col-lg-12 mb-2">
            <input type="text" class="form-control" value="{{ $cita->paciente->nombre_completo ?? '' }}" readonly>
        </div>
        <div class="col-lg-12 mb-2">
            <input type="text" class="form-control" value="{{ $cita->fecha_hora }}" readonly>
        </div>
        <div class="col-lg-4 mb-2">
            <input type="text" class="form-control" value="{{ $cita->codigo_qr ?? '' }}" readonly>
        </div>
        <div class="col-lg-4 mb-2">
            <input type="text" class="form-control" value="{{ $cita->modalidad }}" readonly>
        </div>
        <div class="col-lg-4 mb-2">
            <input type="text" class="form-control" value="{{ $cita->motivo }}" readonly>
        </div>
        <div class="col-lg-6 mb-2">
            <a href="/profesional/mis-pacientes/historial" class="btn btn-outline-secondary w-100">Ver historial del paciente</a>
        </div>

        @if($cita->fecha_hora > now())
            {{-- Cita pendiente --}}
            <div class="col-lg-6 mb-2">
                <a href="#" class="btn btn-dark w-100">Aceptada</a>
            </div>
            <div class="col-md mb-2">
                <a data-toggle="modal" data-target="#modalVideoLlamada" href="#" class="btn btn-dark w-100">Acceder a videoconsulta</a>
            </div>
            <div class="col-md mb-2">
                <a href="#" class="btn btn-dark w-100">Enviar recordatorio de la cita</a>
            </div>
            <div class="col-md mb-2">
                <a href="#" class="btn btn-dark w-100 btn-cambiar-fecha" 
                data-toggle="modal" 
                data-target="#modalCambiarFecha" 
                data-id="{{ $cita->id }}" 
                data-fecha="{{ $cita->fecha_hora }}">
                Cambiar fecha
            </a>
            </div>
            <div class="col-md mb-2">
                <a href="#" class="btn btn-dark w-100 btn-cancelar-cita" data-id="{{ $cita->id }}"
                    data-toggle="modal" data-target="#modalCancelarCita">
                    Cancelar cita
                </a>
            </div>
            <div class="col-md mb-2">
                <a  href="/profesional/cita/informe-consulta/{{$cita->id}}" class="btn btn-dark w-100">Crear informe de consulta</a>
            </div>
        @else
            {{-- Cita pasada --}}
            <div class="col-lg-6 mb-2">
                <a href="#" class="btn btn-dark w-100">Pasada</a>
            </div>
            <div class="col-lg-12 mb-2">
                <a href="#" class="btn btn-dark w-100">Programar nueva cita</a>
            </div>
        @endif
    </div>
@endforeach


<div class="modal fade" id="modalVideoLlamada" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalVideoLlamadaLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVideoLlamadaLabel">VideoLlamada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCambiarFecha" tabindex="-1" role="dialog" aria-labelledby="modalCambiarFechaLabel" aria-hidden="true">
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
                    <input type="datetime-local" class="form-control" name="nueva_fecha" id="nueva_fecha" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalCancelarCita" tabindex="-1" role="dialog" aria-labelledby="modalCancelarCitaLabel" aria-hidden="true">
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