@extends('adminlte::page')

@section('title', 'Valoraciones de Profesionales')

@section('content_header')
    <h1>Valoraciones de Profesionales</h1>
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
    <div class="card mb-4 {{ request()->hasAny(['paciente_id', 'profesional_id', 'modalidad', 'puntuacion']) ? 'filtros-activos' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtros
                @if(request()->hasAny(['paciente_id', 'profesional_id', 'modalidad', 'puntuacion']))
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
            <form method="GET" action="{{ route('valoraciones.index') }}" id="filtros-form">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="paciente_id">Paciente</label>
                            <select name="paciente_id" id="paciente_id" class="form-control">
                                <option value="">Todos los pacientes</option>
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}"
                                        {{ request('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                        {{ $paciente->nombre_completo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
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

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="modalidad">Modalidad</label>
                            <select name="modalidad" id="modalidad" class="form-control">
                                <option value="">Todas las modalidades</option>
                                <option value="presencial" {{ request('modalidad') == 'presencial' ? 'selected' : '' }}>
                                    Presencial
                                </option>
                                <option value="Videollamada" {{ request('modalidad') == 'Videollamada' ? 'selected' : '' }}>
                                    Videollamada
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="puntuacion">Puntuación</label>
                            <select name="puntuacion" id="puntuacion" class="form-control">
                                <option value="">Todas las puntuaciones</option>
                                <option value="1" {{ request('puntuacion') == '1' ? 'selected' : '' }}>
                                    1 Estrella
                                </option>
                                <option value="2" {{ request('puntuacion') == '2' ? 'selected' : '' }}>
                                    2 Estrellas
                                </option>
                                <option value="3" {{ request('puntuacion') == '3' ? 'selected' : '' }}>
                                    3 Estrellas
                                </option>
                                <option value="4" {{ request('puntuacion') == '4' ? 'selected' : '' }}>
                                    4 Estrellas
                                </option>
                                <option value="5" {{ request('puntuacion') == '5' ? 'selected' : '' }}>
                                    5 Estrellas
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
                        <a href="{{ route('valoraciones.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table id="valoraciones" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Fecha / Hora</th>
                <th>Modalidad</th>
                <th>Puntuación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($valoraciones as $valoracion)
                <tr>
                    <td>{{ $valoracion->paciente->nombre_completo }}</td>
                    <td>{{ $valoracion->profesional->nombre_completo }}</td>
                    <td>{{ date("d-m-Y", strtotime($valoracion->fecha)) }}</td>
                    <td>{{ ucfirst($valoracion->modalidad) }}</td>

                    <td>
                        @for ($i = 1; $i <= $valoracion->puntuacion; $i++)
                            <i class="fas fa-star text-warning"></i>
                        @endfor
                    </td>
                    <td>
                        <a href="{{ route('valoraciones.show', $valoracion->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        <form action="{{ route('valoraciones.destroy', $valoracion->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
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
            $('#valoraciones').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false,
                order: [[2, 'desc']] // Ordenar por fecha de forma descendente
            });

            // Mejorar los selectores con Select2 si está disponible
            if ($.fn.select2) {
                $('#paciente_id, #profesional_id').select2({
                    placeholder: 'Seleccionar...',
                    allowClear: true
                });
            }

            // Confirmación para eliminar valoraciones
            $('form[action*="valoraciones"][method="POST"]').submit(function(e) {
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
            const totalValoraciones = $('#valoraciones tbody tr').length;
            if (totalValoraciones === 0) {
                $('#valoraciones_wrapper').after('<div class="alert alert-info mt-3"><i class="fas fa-info-circle"></i> No se encontraron valoraciones con los filtros aplicados.</div>');
            } else {
                $('#valoraciones_wrapper').after('<div class="alert alert-success mt-3"><i class="fas fa-check-circle"></i> Se encontraron ' + totalValoraciones + ' valoración(es).</div>');
            }
        });
    </script>

    @if (session('eliminado') == 'ok')
        <script>
            Swal.fire(
                'Eliminado',
                'La valoración ha sido eliminada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
