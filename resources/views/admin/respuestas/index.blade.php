@extends('adminlte::page')

@section('title', 'Respuestas Expertos')

@section('css')
    <style>
        .filtros-activos {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
        }
    </style>
@stop


@section('content_header')
    <h1>Respuestas Expertos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('respuestas.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Respuesta Experto</i>
        </a>
    </div>

@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Panel de Filtros -->
    <div class="card mb-4 {{ request()->hasAny(['especialidad_id', 'profesional_id']) ? 'filtros-activos' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtros
                @if(request()->hasAny(['especialidad_id', 'profesional_id']))
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
            <form method="GET" action="{{ route('respuestas.index') }}" id="filtros-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="especialidad_id">Especialidad</label>
                            <select name="especialidad_id" id="especialidad_id" class="form-control">
                                <option value="">Todas las especialidades</option>
                                @foreach($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}" {{ request('especialidad_id') == $especialidad->id ? 'selected' : '' }}>{{ $especialidad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Aplicar Filtros
                        </button>
                        <a href="{{ route('respuestas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="respuestas" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
                <th>Profesional</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($respuestas as $respuesta)
                <tr>
                    <td>
                        {{ $respuesta->pregunta->pregunta }} <br>
                        <strong>Especialidad: </strong> {{ $respuesta->pregunta->especialidad->nombre ?? 'Sin especialidad' }} <br>
                        <strong>Sub-Especialidad: </strong> {{ $respuesta->pregunta->subespecialidad->nombre ?? 'Sin subespecialidad' }}
                    </td>
                    <td>{{ $respuesta->respuesta }}</td>
                    <td>{{ $respuesta->profesional->nombre_completo ?? 'Sin profesional' }}</td>
                    <td>
                        <a href="{{ route('respuestas.edit', $respuesta->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('respuestas.destroy', $respuesta->id) }}" method="POST"
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
            $('#respuestas').DataTable({
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
                'La respuesta experta ha sido eliminada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
