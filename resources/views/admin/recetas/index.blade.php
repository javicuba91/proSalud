@extends('adminlte::page')

@section('title', 'Recetas')

@section('content_header')
    <h1>Recetas</h1>
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
    <div class="card mb-4 {{ request()->hasAny(['paciente_id', 'profesional_id', 'fecha']) ? 'filtros-activos' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtros
                @if(request()->hasAny(['paciente_id', 'profesional_id', 'fecha']))
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
            <form method="GET" action="{{ route('recetas.index') }}" id="filtros-form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paciente_id">Paciente</label>
                            <select name="paciente_id" id="paciente_id" class="form-control">
                                <option value="">Todos los pacientes</option>
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}" {{ request('paciente_id') == $paciente->id ? 'selected' : '' }}>{{ $paciente->nombre_completo }}</option>
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
                                    <option value="{{ $profesional->id }}" {{ request('profesional_id') == $profesional->id ? 'selected' : '' }}>{{ $profesional->nombre_completo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ request('fecha') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Aplicar Filtros
                        </button>
                        <a href="{{ route('recetas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="recetas" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Cita</th>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Fecha / Hora</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recetas as $receta)
                <tr>
                    <td>
                        <strong>ID: </strong> {{ $receta->informeConsulta->cita->id }}<br>
                        <strong>Fecha: </strong>
                        {{ date('d-m-Y H:i', strtotime($receta->informeConsulta->cita->fecha_hora)) }}
                    </td>
                    <td>{{ $receta->informeConsulta->cita->paciente->nombre_completo }}</td>
                    <td>{{ $receta->informeConsulta->cita->profesional->nombre_completo }}</td>
                    <td>{{ date('d-m-Y H:i', strtotime($receta->fecha_emision)) }}</td>
                    <td>
                        <a href="{{ route('recetas.show', $receta->id) }}" class="btn btn-primary"><i
                                class="fa fa-eye"></i></a>
                        <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-warning"><i
                                class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('recetas.destroy', $receta->id) }}" method="POST"
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
            $('#recetas').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });

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
        });
    </script>

    @if (session('eliminado') == 'ok')
        <script>
            Swal.fire(
                'Eliminado',
                'La receta ha sido eliminada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
