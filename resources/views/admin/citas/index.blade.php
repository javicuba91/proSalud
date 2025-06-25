@extends('adminlte::page')

@section('title', 'Citas')

@section('content_header')
    <h1>Citas</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('citas.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Cita</i>
        </a>
    </div>

@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table id="citas" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Fecha / Hora</th>
                <th>Modalidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
                <tr>
                    <td>{{ $cita->paciente->nombre_completo }}</td>
                    <td>{{ $cita->profesional->nombre_completo }}</td>
                    <td>{{ date("d-m-Y H:i", strtotime($cita->fecha_hora)) }}</td>
                    <td>{{ ucfirst($cita->modalidad) }}</td>
                    <td><span class="badge bg-primary p-2">{{ ucfirst($cita->estado) }}</span></td>

                    <td>
                        <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        <form class="form-eliminar" action="{{ route('citas.cancelar', $cita->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            <button title="Cancelar Cita" type="submit" class="btn btn-info"><i class="fa fa-times"></i></button>
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
            $('#citas').DataTable({
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
                    text: "¿Deseas cancelar esta cita?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, cancelar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    @if (session('cancelado') == 'ok')
        <script>
            Swal.fire(
                'Cancelado',
                'La cita médica ha sido cancelada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
