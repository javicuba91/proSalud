@extends('adminlte::page')

@section('title', 'Preguntas Expertos')

@section('css')
    <style>
        .filtros-activos {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
        }
    </style>
@stop


@section('content_header')
    <h1>Preguntas Expertos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('preguntas.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Pregunta Experto</i>
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
    <div class="card mb-4 {{ request()->hasAny(['categoria_id', 'especialidad_id', 'subespecialidad_id']) ? 'filtros-activos' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtros
                @if(request()->hasAny(['categoria_id', 'especialidad_id', 'subespecialidad_id']))
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
            <form method="GET" action="{{ route('preguntas.index') }}" id="filtros-form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="categoria_id">Categoría</label>
                            <select name="categoria_id" id="categoria_id" class="form-control">
                                <option value="">Todas las categorías</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subespecialidad_id">Subespecialidad</label>
                            <select name="subespecialidad_id" id="subespecialidad_id" class="form-control">
                                <option value="">Todas las subespecialidades</option>
                                @foreach($subespecialidades as $subespecialidad)
                                    <option value="{{ $subespecialidad->id }}" {{ request('subespecialidad_id') == $subespecialidad->id ? 'selected' : '' }}>{{ $subespecialidad->nombre }}</option>
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
                        <a href="{{ route('preguntas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="preguntas" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Categoría/Especialidad/Subespecialidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preguntas as $pregunta)
                <tr>
                    <td>{{ $pregunta->pregunta }}</td>
                    <td>
                        @if($pregunta->categoria)
                            <span class="badge badge-primary">{{ $pregunta->categoria->nombre }}</span>
                        @endif
                        @if($pregunta->especialidad)
                            <span class="badge badge-success">{{ $pregunta->especialidad->nombre }}</span>
                        @endif
                        @if($pregunta->subespecialidad)
                            <span class="badge badge-info">{{ $pregunta->subespecialidad->nombre }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('preguntas.edit', $pregunta->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('preguntas.destroy', $pregunta->id) }}" method="POST"
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
            $('#preguntas').DataTable({
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
                'La pregunta experta ha sido eliminada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
