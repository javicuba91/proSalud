@extends('adminlte::page')

@section('title', 'Informes de Consulta')

@section('content_header')
    <h1>Informes de Consulta</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('informes.create') }}" class="btn btn-primary">
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
    <table id="informes" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Fecha / Hora</th>
                <th>Modalidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($informes as $informe)
                <tr>
                    <td>{{ $informe->cita->paciente->nombre_completo }}</td>
                    <td>{{ $informe->cita->profesional->nombre_completo }}</td>
                    <td>{{ date("d-m-Y H:i", strtotime($informe->created_at)) }}</td>
                    <td>{{ ucfirst($informe->cita->modalidad) }}</td>
                    <td>
                        <a href="{{ route('informes.edit', $informe->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('informes.destroy', $informe->id) }}" method="POST"
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
            $('#informes').DataTable({
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
                'El informe de consulta ha sido eliminado correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
