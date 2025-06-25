@extends('adminlte::page')

@section('title', 'Informes de Consulta')

@section('content_header')
    <h1>Informes de Consulta</h1>
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
    <div class="card mb-4 {{ request()->hasAny(['paciente_id', 'profesional_id', 'modalidad']) ? 'filtros-activos' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtros
                @if(request()->hasAny(['paciente_id', 'profesional_id', 'modalidad']))
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
            <form method="GET" action="{{ route('informes.index') }}" id="filtros-form">
                <div class="row">
                    <div class="col-md-4">
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

                    <div class="col-md-4">
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

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="modalidad">Modalidad</label>
                            <select name="modalidad" id="modalidad" class="form-control">
                                <option value="">Todas las modalidades</option>
                                <option value="presencial" {{ request('modalidad') == 'presencial' ? 'selected' : '' }}>
                                    Presencial
                                </option>
                                <option value="videoconsulta" {{ request('modalidad') == 'videoconsulta' ? 'selected' : '' }}>
                                    Videoconsulta
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
                        <a href="{{ route('informes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="informes" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Fecha / Hora</th>
                <th>Modalidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($informes as $informe)
                <tr>
                    <td>{{ $informe->cita->paciente->nombre_completo }}</td>
                    <td>{{ $informe->cita->profesional->nombre_completo }}</td>
                    <td>{{ date("d-m-Y H:i", strtotime($informe->created_at)) }}</td>
                    <td>{{ ucfirst($informe->cita->modalidad) }}</td>
                    <td>
                        <a href="{{ route('informes.show', $informe->id) }}" class="btn btn-primary"><i
                            class="fa fa-eye"></i></a>
                        <a href="{{ route('informes.edit', $informe->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('informes.destroy', $informe->id) }}" method="POST"
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
            $('#informes').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false,
                order: [[2, 'desc']] // Ordenar por fecha/hora de forma descendente
            });

            // Mejorar los selectores con Select2 si está disponible
            if ($.fn.select2) {
                $('#paciente_id, #profesional_id').select2({
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
            const totalInformes = $('#informes tbody tr').length;
            if (totalInformes === 0) {
                $('#informes_wrapper').after('<div class="alert alert-info mt-3"><i class="fas fa-info-circle"></i> No se encontraron informes con los filtros aplicados.</div>');
            } else {
                $('#informes_wrapper').after('<div class="alert alert-success mt-3"><i class="fas fa-check-circle"></i> Se encontraron ' + totalInformes + ' informe(s).</div>');
            }
        });
    </script>

    @if (session('eliminado') == 'ok')
        <script>
            Swal.fire(
                'Eliminado',
                'El informe de consulta ha sido eliminado correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
