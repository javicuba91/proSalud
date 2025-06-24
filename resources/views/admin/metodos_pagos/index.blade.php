@extends('adminlte::page')

@section('title', 'Métodos de Pago')

@section('content_header')
    <h1>Métodos de Pago</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('metodos-pagos.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Método de Pago</i>
        </a>
    </div>

@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table id="metodos_pagos" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($metodos as $metodo)
                <tr>
                    <td>{{ $metodo->nombre }}</td>
                    <td>
                        <a href="{{ route('metodos-pagos.edit', $metodo->id) }}" class="btn btn-warning"><i
                                class="fa fa-edit"></i></a>
                        <form action="{{ route('metodos-pagos.destroy', $metodo->id) }}" method="POST" class="form-eliminar"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
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
            $('#metodos_pagos').DataTable({
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
                'El método de pago ha sido eliminado correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
