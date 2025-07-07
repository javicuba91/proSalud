@extends('adminlte::page')

@section('title', 'Especialidades Sanitarias')

@section('content_header')
    <h1>Especialidades Sanitarias</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('especialidades-sanitarios.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Especialidad Sanitaria</i>
        </a>
    </div>

@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table id="especialidades-sanitarios" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especialidades as $especialidad)
                <tr>
                    <td>{{ $especialidad->id }}</td>
                    <td>{{ $especialidad->nombre }}</td>
                    <td>{{ Str::limit($especialidad->descripcion, 50) }}</td>
                    <td>{{ $especialidad->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td>
                        <a href="{{ route('especialidades-sanitarios.edit', $especialidad->id) }}" class="btn btn-warning"><i
                                class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('especialidades-sanitarios.destroy', $especialidad->id) }}" method="POST"
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
            $('#especialidades-sanitarios').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false,
                order: [[1, 'asc']] // Ordenar por nombre por defecto
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
                'La especialidad sanitaria ha sido eliminada correctamente.',
                'success'
            )
        </script>
    @endif
@stop
