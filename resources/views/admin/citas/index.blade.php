@extends('adminlte::page')

@section('title', 'Citas')

@section('content_header')
    <h1>Citas</h1>
@stop

@section('css')
    <style>
        .badge-estado {
            font-size: 0.9em;
            padding: 5px 10px;
        }
        .badge-pendiente { background-color: #ffc107; color: #212529; }
        .badge-aceptada { background-color: #28a745; }
        .badge-cancelada { background-color: #dc3545; }
        .badge-completada { background-color: #007bff; }
        .badge-noacude { background-color: #6c757d; }

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
    <div class="card mb-4 {{ request()->hasAny(['paciente_id', 'profesional_id', 'modalidad', 'estado']) ? 'filtros-activos' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtros
                @if(request()->hasAny(['paciente_id', 'profesional_id', 'modalidad', 'estado']))
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
            <form method="GET" action="{{ route('citas.index') }}" id="filtros-form">
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
                                <option value="videoconsulta" {{ request('modalidad') == 'videoconsulta' ? 'selected' : '' }}>
                                    Videoconsulta
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="">Todos los estados</option>
                                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>
                                <option value="aceptada" {{ request('estado') == 'aceptada' ? 'selected' : '' }}>
                                    Aceptada
                                </option>
                                <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>
                                    Cancelada
                                </option>
                                <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>
                                    Completada
                                </option>
                                <option value="noacude" {{ request('estado') == 'noacude' ? 'selected' : '' }}>
                                    No Acude
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
                        <a href="{{ route('citas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="citas" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Fecha / Hora</th>
                <th>Modalidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
                <tr>
                    <td>{{ $cita->paciente->nombre_completo }}</td>
                    <td>{{ $cita->profesional->nombre_completo }}</td>
                    <td>{{ date("d-m-Y H:i", strtotime($cita->fecha_hora)) }}</td>
                    <td>{{ ucfirst($cita->modalidad) }}</td>
                    <td>
                        <span class="badge badge-estado badge-{{ $cita->estado }}">
                            {{ ucfirst($cita->estado) }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-primary btn-sm" title="Ver detalles">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if($cita->estado !== 'cancelada' && $cita->estado !== 'completada')
                            <form class="form-eliminar" action="{{ route('citas.cancelar', $cita->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button title="Cancelar Cita" type="submit" class="btn btn-warning btn-sm">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
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
            $('#citas').DataTable({
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

            // Enviar formulario automáticamente cuando cambie un filtro
            $('#paciente_id, #profesional_id, #modalidad, #estado').change(function() {
                $('#filtros-form').submit();
            });

            $('.form-eliminar').submit(function(e) {
                e.preventDefault();

                const form = this;

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas cancelar esta cita?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, cancelar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Mostrar contador de resultados
            const totalCitas = $('#citas tbody tr').length;
            if (totalCitas === 0) {
                $('#citas_wrapper').after('<div class="alert alert-info mt-3"><i class="fas fa-info-circle"></i> No se encontraron citas con los filtros aplicados.</div>');
            } else {
                $('#citas_wrapper').after('<div class="alert alert-success mt-3"><i class="fas fa-check-circle"></i> Se encontraron ' + totalCitas + ' cita(s).</div>');
            }
        });
    </script>

    @if (session('cancelado') == 'ok')
        <script>
            Swal.fire(
                'Cancelado',
                'La cita médica ha sido cancelada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
