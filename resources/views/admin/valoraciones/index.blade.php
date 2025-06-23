@extends('adminlte::page')

@section('title', 'Valoraciones')

@section('content_header')
    <h1>Valoraciones</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('valoraciones.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Valoración</i>
        </a>
    </div>

@stop

@section('content')

    <table id="valoraciones" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Fecha / Hora</th>
                <th>Modalidad</th>
                <th>Puntuación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
           
            @foreach ($valoraciones as $valoracion)
                <tr>
                    <td>{{ $valoracion->paciente->nombre_completo }}</td>
                    <td>{{ $valoracion->profesional->nombre_completo }}</td>
                    <td>{{ date("d-m-Y", strtotime($valoracion->fecha)) }}</td>
                    <td>{{ ucfirst($valoracion->modalidad) }}</td>
                 
                    <td>
                        @for ($i = 1; $i <= $valoracion->puntuacion; $i++)
                            <i class="fas fa-star text-warning"></i>
                        @endfor
                    </td>
                    <td>
                        <a href="{{ route('valoraciones.edit', $valoracion->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('valoraciones.destroy', $valoracion->id) }}" method="POST"
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
    <script>
        $(document).ready(function() {
            $('#valoraciones').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
