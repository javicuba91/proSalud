@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Usuario</i>
        </a>
    </div>

@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table id="usuarios" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Categoria</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    @if ($usuario->role == 'paciente' && $usuario->paciente)
                        <td>{{ $usuario->paciente->nombre_completo }}</td>
                    @elseif ($usuario->role == 'profesional' && $usuario->profesional)
                        <td>{{ $usuario->profesional->nombre_completo }}</td>
                    @elseif ($usuario->role == 'proveedor' && $usuario->proveedor)
                        <td>{{ $usuario->proveedor->nombre }}</td>
                    @else
                        <td>{{ $usuario->name }}</td>
                    @endif
                    <td>{{ $usuario->email }}</td>
                    <td>{{ ucfirst($usuario->role) }}</td>
                    <td>
                        @if ($usuario->role == 'profesional' && $usuario->profesional && $usuario->profesional->categoria)
                            {{ $usuario->profesional->categoria->nombre }}
                        @elseif ($usuario->role == 'proveedor' && $usuario->proveedor && $usuario->proveedor->tipo)
                            {{ $usuario->proveedor->tipo }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-primary" title="Ver detalles">
                            <i class="fa fa-eye"></i>
                        </a>
                        @php
                            $editRoute = match ($usuario->role) {
                                'paciente' => route('pacientes.edit', $usuario->id),
                                'profesional' => route('profesionales.edit', $usuario->id),
                                'proveedor' => route('proveedores.edit', $usuario->id),
                                'admin' => route('administradores.edit', $usuario->id),
                                default => route('usuarios.edit', $usuario->id),
                            };
                        @endphp
                        <a href="{{ $editRoute }}" class="btn btn-warning" title="Editar usuario">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form class="form-eliminar" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
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
            $('#usuarios').DataTable({
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
                'El usuario ha sido eliminado correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
