@extends('adminlte::page')

@section('title', 'Regiones')

@section('content_header')
    <h1>Regiones</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('regiones.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Región</i>
        </a>
    </div>

@stop

@section('content')

    <table id="regiones" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($regiones as $region)
                <tr>
                    <td>{{ $region->nombre }}</td>                    
                    <td>
                        <a href="{{ route('regiones.edit', $region->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('regiones.destroy', $region->id) }}" method="POST"
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
            $('#regiones').DataTable({
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
                'La región ha sido eliminada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
