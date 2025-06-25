@extends('adminlte::page')

@section('title', 'Emergencias')


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

@section('content_header')
    <h1>Emergencias</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('emergencias.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Emergencia</i>
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
    <div class="card mb-4 {{ request()->hasAny(['tipo', 'provincia', 'ciudad']) ? 'filtros-activos' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtros
                @if(request()->hasAny(['tipo', 'provincia', 'ciudad']))
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
            <form method="GET" action="{{ route('emergencias.index') }}" id="filtros-form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="">Todos</option>
                                <option value="Farmacia 24 horas" {{ request('tipo') == 'Farmacia 24 horas' ? 'selected' : '' }}>Farmacia 24 horas</option>
                                <option value="Ambulancia 24 horas" {{ request('tipo') == 'Ambulancia 24 horas' ? 'selected' : '' }}>Ambulancia 24 horas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <select name="provincia" id="provincia" class="form-control">
                                <option value="">Todas</option>
                                @foreach($provincias as $provincia)
                                    <option value="{{ $provincia->nombre }}" {{ request('provincia') == $provincia->nombre ? 'selected' : '' }}>{{ $provincia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <select name="ciudad" id="ciudad" class="form-control">
                                <option value="">Todas</option>
                                @foreach($ciudades as $ciudad)
                                    <option value="{{ $ciudad->nombre }}" {{ request('ciudad') == $ciudad->nombre ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
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
                        <a href="{{ route('emergencias.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="emergencias" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Provincia</th>
                <th>Ciudad</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($emergencias as $emergencia)
                <tr>
                    <td>
                        {{ $emergencia->tipo }}<br>
                        <strong>Dirección: </strong> {{$emergencia->direccion}}
                    </td>
                    <td>{{ $emergencia->provincia->nombre }}</td>
                    <td>{{ $emergencia->ciudad->nombre }}</td>
                    <td>{{ $emergencia->telefono }}</td>
                    <td>
                        <a href="{{ route('emergencias.edit', $emergencia->id) }}" class="btn btn-warning"><i
                                class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('emergencias.destroy', $emergencia->id) }}"
                            method="POST" style="display:inline;">
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
            var table = $('#emergencias').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });

            // Filtrado personalizado
            $('#tipo-filter, #provincia-filter, #ciudad-filter').on('change', function() {
                var tipo = $('#tipo-filter').val();
                var provincia = $('#provincia-filter').val();
                var ciudad = $('#ciudad-filter').val();

                table.column(0).search(tipo).column(1).search(provincia).column(2).search(ciudad).draw();
            });

            // Filtrado personalizado
            $('#tipo-filter, #provincia-filter, #ciudad-filter').on('change', function() {
                var tipo = $('#tipo-filter').val();
                var provincia = $('#provincia-filter').val();
                var ciudad = $('#ciudad-filter').val();

                table.column(0).search(tipo).column(1).search(provincia).column(2).search(ciudad).draw();
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
                'El contacto de emergencia ha sido eliminado correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
