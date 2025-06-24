@extends('adminlte::page')

@section('title', 'Recetas')

@section('content_header')
    <h1>Recetas</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('recetas.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Informe</i>
        </a>
    </div>

@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="recetas" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Cita</th>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Fecha / Hora</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recetas as $receta)
                <tr>
                    <td>
                        <strong>ID: </strong> {{ $receta->informeConsulta->cita->id }}<br>
                        <strong>Fecha: </strong>
                        {{ date('d-m-Y H:i', strtotime($receta->informeConsulta->cita->fecha_hora)) }}
                    </td>
                    <td>{{ $receta->informeConsulta->cita->paciente->nombre_completo }}</td>
                    <td>{{ $receta->informeConsulta->cita->profesional->nombre_completo }}</td>
                    <td>{{ date('d-m-Y H:i', strtotime($receta->fecha_emision)) }}</td>
                    <td>
                        <a href="{{ route('recetas.show', $receta->id) }}" class="btn btn-primary"><i
                                class="fa fa-eye"></i></a>
                        <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-warning"><i
                                class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('recetas.destroy', $receta->id) }}" method="POST"
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
            $('#recetas').DataTable({
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
                'La receta ha sido eliminada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
