@extends('adminlte::page')

@section('title', 'Ciudades')

@section('content_header')
    <h1>Ciudades</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('ciudades.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Ciudad</i>
        </a>
    </div>

@stop

@section('content')

    <table id="ciudades" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Provincia</th>
                <th>Región</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ciudades as $ciudad)
                <tr>
                    <td>{{ $ciudad->nombre }}</td>     
                    <td>{{ $ciudad->provincia->nombre }}</td>     
                    <td>{{ $ciudad->provincia->region->nombre }}</td>                    
                    <td>
                        <a href="{{ route('ciudades.edit', $ciudad->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('ciudades.destroy', $ciudad->id) }}" method="POST"
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
            $('#ciudades').DataTable({
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
                'La ciudad ha sido eliminada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
