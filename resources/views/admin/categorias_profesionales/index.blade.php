@extends('adminlte::page')

@section('title', 'Categorías Profesionales')

@section('content_header')
    <h1>Categorías Profesionales</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('categorias-profesionales.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Categoría Profesional</i>
        </a>
    </div>

@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table id="categorias-profesionales" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Orden</th>

                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ Str::limit($categoria->descripcion, 50) }}</td>
                    <td>{{ $categoria->orden ?? '-' }}</td>
                    <td>
                        <a href="{{ route('categorias-profesionales.edit', $categoria->id) }}" class="btn btn-warning"><i
                                class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('categorias-profesionales.destroy', $categoria->id) }}" method="POST"
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
            $('#categorias-profesionales').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false,
                order: [[3, 'asc']] // Ordenar por columna de orden por defecto
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
                'La categoría profesional ha sido eliminada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
