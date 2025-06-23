@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Documentos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('documentos.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Documento</i>
        </a>
    </div>

@stop

@section('content')

    <table id="documentos" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Archivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $documento)
                <tr>
                    <td>{{ $documento->nombre }}</td>
                    <td>
                        <a href="{{ asset($documento->archivo) }}" target="_blank" class="d-block mb-1">
                            <i class="fa fa-file"></i> Abrir
                        </a>
                    </td>
                    <td><span class="badge bg-danger p-2">{{ ucfirst($documento->estado) }}</span></td>
                    <td>
                        <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-warning"><i
                                class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('documentos.destroy', $documento->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        @if ($documento->estado == 'pendiente')
                            <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-success"><i
                                    class="fa fa-check"></i></a>
                        @endif
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
            $('#documentos').DataTable({
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
                'El documento ha sido eliminado correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
