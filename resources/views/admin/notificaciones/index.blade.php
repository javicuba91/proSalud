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
