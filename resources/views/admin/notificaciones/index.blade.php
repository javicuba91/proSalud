@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Notificaciones</h1>
        <button class="btn btn-primary" onclick="marcarTodasLeidas()">
            <i class="fas fa-check-double"></i> Marcar todas como leídas
        </button>
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Notificaciones</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#crearNotificacionModal">
                <i class="fas fa-plus"></i> Nueva Notificación
            </button>
        </div>
    </div>
    <div class="card-body">
        @if($notificaciones->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i>
                No tienes notificaciones en este momento.
            </div>
        @else
            <div class="timeline">
                @foreach($notificaciones as $notificacion)
                    <div class="time-label">
                        <span class="bg-{{ $notificacion->color ?? 'info' }}">
                            {{ $notificacion->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                    <div>
                        <i class="{{ $notificacion->icono ?? 'fas fa-bell' }} bg-{{ $notificacion->color ?? 'info' }}"></i>
                        <div class="timeline-item {{ $notificacion->leida ? '' : 'border-primary' }}">
                            <span class="time">
                                <i class="fas fa-clock"></i> {{ $notificacion->created_at->diffForHumans() }}
                                @if(!$notificacion->leida)
                                    <span class="badge badge-primary ml-2">Nueva</span>
                                @endif
                            </span>
                            <h3 class="timeline-header">
                                {{ $notificacion->titulo }}
                                @if($notificacion->url)
                                    <a href="{{ $notificacion->url }}" class="btn btn-sm btn-outline-primary ml-2">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                @endif
                            </h3>
                            <div class="timeline-body">
                                {{ $notificacion->mensaje }}
                            </div>
                            @if(!$notificacion->leida)
                                <div class="timeline-footer">
                                    <button class="btn btn-sm btn-primary" onclick="marcarLeida({{ $notificacion->id }})">
                                        <i class="fas fa-check"></i> Marcar como leída
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div>
                    <i class="fas fa-clock bg-gray"></i>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $notificaciones->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modal para crear nueva notificación -->
<div class="modal fade" id="crearNotificacionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formNotificacion" onsubmit="crearNotificacion(event)">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Notificación</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="info">Información</option>
                            <option value="success">Éxito</option>
                            <option value="warning">Advertencia</option>
                            <option value="danger">Error</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url">URL (opcional)</label>
                        <input type="url" class="form-control" id="url" name="url" placeholder="https://...">
                    </div>
                    <div class="form-group">
                        <label for="user_id">Usuario específico (opcional)</label>
                        <input type="number" class="form-control" id="user_id" name="user_id" placeholder="Dejar vacío para notificación global">
                    </div>
                    <div class="form-group">
                        <label for="fecha_expiracion">Fecha de expiración (opcional)</label>
                        <input type="datetime-local" class="form-control" id="fecha_expiracion" name="fecha_expiracion">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Notificación</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
function marcarLeida(id) {
    fetch(`/admin/notificaciones/${id}/marcar-leida`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'No se pudo marcar la notificación como leída', 'error');
    });
}

function marcarTodasLeidas() {
    fetch('/admin/notificaciones/marcar-todas-leidas', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'No se pudieron marcar las notificaciones como leídas', 'error');
    });
}

function crearNotificacion(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData);

    fetch('/admin/notificaciones', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#crearNotificacionModal').modal('hide');
            Swal.fire('Éxito', 'Notificación creada correctamente', 'success').then(() => {
                location.reload();
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'No se pudo crear la notificación', 'error');
    });
}
</script>
@stop

@section('css')
<style>
.timeline-item.border-primary {
    border-left: 3px solid #007bff !important;
    background-color: #f8f9fa;
}
</style>
@stop
