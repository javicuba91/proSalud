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
                        <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form class="form-eliminar" action="{{ route('citas.destroy', $cita->id) }}" method="POST"
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
                'La cita médica ha sido eliminada correctamente.',
                'success'
            );
        </script>
    @endif
@endsection
