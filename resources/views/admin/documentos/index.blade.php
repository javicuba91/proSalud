@extends('adminlte::page')

@section('title', 'Documentos')

@section('css')
    <style>
        .filtros-activos {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
        }
    </style>
@stop


@section('content_header')
    <h1>Documentos</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('documentos.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Documento</i>
        </a>
    </div>

@stop

@section('css')
    <style>
        .filtros-activos {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
        }
    </style>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Panel de Filtros -->
    <div class="card mb-4 {{ request()->hasAny(['profesional_id', 'estado']) ? 'filtros-activos' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtros
                @if(request()->hasAny(['profesional_id', 'estado']))
                    <span class="badge badge-info ml-2">Activos</span>
                @endif
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('documentos.index') }}" id="filtros-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profesional_id">Profesional</label>
                            <select name="profesional_id" id="profesional_id" class="form-control">
                                <option value="">Todos los profesionales</option>
                                @foreach($profesionales as $profesional)
                                    <option value="{{ $profesional->id }}"
                                        {{ request('profesional_id') == $profesional->id ? 'selected' : '' }}>
                                        {{ $profesional->nombre_completo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="">Todos los estados</option>
                                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>
                                <option value="aprobado" {{ request('estado') == 'aprobado' ? 'selected' : '' }}>
                                    Aprobado
                                </option>
                                <option value="denegado" {{ request('estado') == 'denegado' ? 'selected' : '' }}>
                                    Denegado
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Aplicar Filtros
                        </button>
                        <a href="{{ route('documentos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table id="documentos" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Profesional</th>
                <th>Nombre</th>
                <th>Profesional</th>
                <th>Archivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $documento)
                <tr>
                    <td>{{ $documento->profesional->nombre_completo }}</td>
                    <td>{{ $documento->nombre }}</td>
                    <td>{{ $documento->profesional->nombre_completo ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ asset($documento->archivo) }}" target="_blank" class="d-block mb-1">
                            <i class="fa fa-file"></i> Abrir
                        </a>
                    </td>
                    <td>
                        @if ($documento->estado == 'aprobado')
                            <span class="badge bg-success p-2">{{ ucfirst($documento->estado) }}</span>
                        @else
                            <span class="badge bg-danger p-2">{{ ucfirst($documento->estado) }}</span>
                        @endif
                    </td>
                    <td>
                        <form class="form-eliminar" action="{{ route('documentos.destroy', $documento->id) }}"
                            method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        {{-- Mostrar botón "Aprobar" si el estado es pendiente o denegado --}}
                        @if ($documento->estado === 'pendiente' || $documento->estado === 'denegado')
                            <button title="Aprobar" class="btn btn-success btn-aprobar" data-id="{{ $documento->id }}">
                                <i class="fa fa-check"></i>
                            </button>
                        @endif

                        {{-- Mostrar botón "Denegar" solo si el estado es pendiente --}}
                        @if ($documento->estado === 'pendiente' || $documento->estado === 'aprobado')
                            <button title="Denegar" class="btn btn-info btn-denegar" data-id="{{ $documento->id }}">
                                <i class="fa fa-ban"></i>
                            </button>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#documentos').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false,
                order: [[0, 'asc']] // Ordenar por nombre de forma ascendente
            });

            // Mejorar los selectores con Select2 si está disponible
            if ($.fn.select2) {
                $('#profesional_id').select2({
                    placeholder: 'Seleccionar...',
                    allowClear: true
                });
            }

            $('.form-eliminar').submit(function(e) {
                e.preventDefault();

                const form = this;

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Mostrar contador de resultados
            const totalDocumentos = $('#documentos tbody tr').length;
            if (totalDocumentos === 0) {
                $('#documentos_wrapper').after('<div class="alert alert-info mt-3"><i class="fas fa-info-circle"></i> No se encontraron documentos con los filtros aplicados.</div>');
            } else {
                $('#documentos_wrapper').after('<div class="alert alert-success mt-3"><i class="fas fa-check-circle"></i> Se encontraron ' + totalDocumentos + ' documento(s).</div>');
            }
        });
    </script>

    @if (session('eliminado') == 'ok')
        <script>
            Swal.fire(
                'Eliminado',
                'El documento ha sido eliminado correctamente.',
                'success'
            );
        </script>
    @endif

    <script>
        $('.btn-aprobar').click(function() {
            const id = $(this).data('id');

            Swal.fire({
                title: '¿Aprobar documento?',
                text: "Esta acción marcará el documento como aprobado.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, aprobar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/documentos-profesional/${id}/aprobar`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire('Aprobado', response.message, 'success').then(() => {
                                location.reload(); // Opcional: recargar tabla
                            });
                        },
                        error: function() {
                            Swal.fire('Error', 'No se pudo aprobar el documento.', 'error');
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.btn-denegar', function() {
            const id = $(this).data('id');

            Swal.fire({
                title: '¿Denegar documento?',
                text: "El estado cambiará a 'denegado'.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, denegar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar solicitud POST via AJAX
                    $.ajax({
                        url: `/admin/documentos-profesional/${id}/denegar`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire('Denegado', 'El documento ha sido denegado.', 'success')
                                .then(() => location.reload());
                        },
                        error: function() {
                            Swal.fire('Error', 'No se pudo denegar el documento.', 'error');
                        }
                    });
                }
            });
        });
    </script>

@endsection
