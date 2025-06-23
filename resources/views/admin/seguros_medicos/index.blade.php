@extends('adminlte::page')

@section('title', 'Seguros Médicos')

@section('content_header')
    <h1>Seguros Médicos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('seguros_medicos.create') }}" class="btn btn-primary p-2">
            <i class="fa fa-plus"> Crear Seguro Médico</i>
        </a>
    </div>

@stop

@section('content')

    <table id="seguros_medicos" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($seguros_medicos as $seguro)
                <tr>
                    <td>{{ $seguro->nombre }}</td>
                    <td>
                        <a href="{{ route('seguros_medicos.edit', $seguro->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('seguros_medicos.destroy', $seguro->id) }}" method="POST"
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
            $('#seguros_medicos').DataTable({
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
                'El seguro médico ha sido eliminado correctamente.',
                'success'
            );
        </script>
    @endif
@endsection