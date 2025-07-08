@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_header')
    <h1>Notificaciones</h1>
@stop

@section('content')
    <div class="row mt-1">
        <div class="col-lg-12">
            <h6>¿Cómo deseas recibir las notificaciones?</h6>
        </div>
        <div class="col-lg-12 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    Solo por la aplicación
                </label>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2">
                <label class="form-check-label" for="flexCheckChecked2">
                    Por correo electrónico
                </label>
            </div>
        </div>
        <div class="col-lg-12 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked3">
                <label class="form-check-label" for="flexCheckChecked3">
                    Por Whatsapp
                </label>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <h5>Notificaciones recibidas</h5>
            <table class="table table-bordered table-hover" id="tabla-notificaciones">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Título</th>
                        <th>Mensaje</th>
                        <th>Leída</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $notificaciones = \App\Models\Notificacion::where('usuario_id_destino', Auth::id())
                            ->orderBy('created_at', 'desc')
                            ->get();
                    @endphp
                    @foreach ($notificaciones as $notificacion)
                        <tr>
                            <td>{{ $notificacion->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $notificacion->titulo }}</td>
                            <td>{{ $notificacion->mensaje }}</td>
                            <td>
                                @if ($notificacion->leida)
                                    <span class="badge bg-success">Sí</span>
                                @else
                                    <span class="badge bg-warning text-dark">No</span>
                                @endif
                            </td>
                            <td>
                                @if ($notificacion->leida == 0)
                                    <button class="btn btn-sm btn-primary" onclick="marcarLeida({{ $notificacion->id }})">
                                        <i class="fas fa-check"></i> Marcar como leída
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@push('js')
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <script>
        $(document).ready(function() {
            $('#tabla-notificaciones').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                },
                order: [
                    [0, 'desc']
                ]
            });
        });

        function marcarLeida(id) {
            fetch(`/profesional/notificaciones/${id}/marcar-leida`, {
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
    </script>
@endpush
