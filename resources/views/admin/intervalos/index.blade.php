@extends('adminlte::page')

@section('title', 'Intervalos Medicamentos')

@section('content_header')
    <h1>Intervalos Medicamentos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('intervalos.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Intervalo</i>
        </a>
    </div>

@stop

@section('content')

    <table id="intervalos" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($intervalos as $intervalo)
                <tr>
                    <td>{{ $intervalo->nombre }}</td>                    
                    <td>
                        <a href="{{ route('intervalos.edit', $intervalo->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('intervalos.destroy', $intervalo->id) }}" method="POST"
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
            $('#intervalos').DataTable({
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
                'El Intervalo de Medicación ha sido eliminada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection