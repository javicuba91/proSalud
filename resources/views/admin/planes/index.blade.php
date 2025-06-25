@extends('adminlte::page')

@section('title', 'Planes')

@section('content_header')
    <h1>Planes</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('planes.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Plan</i>
        </a>
    </div>

@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table id="planes" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($planes as $plan)
                <tr>
                    <td>{{ $plan->nombre }}</td>
                    <td>{{ $plan->descripcion }}</td>
                    <td>{{ $plan->precio }}€</td>
                    <td>
                        <a href="{{ route('planes.show', $plan->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('planes.edit', $plan->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('planes.destroy', $plan->id) }}" method="POST"
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
            $('#planes').DataTable({
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
                'El plan ha sido eliminado correctamente.',
                'success'
            );
        </script>
    @endif
    </script>
@endsection
