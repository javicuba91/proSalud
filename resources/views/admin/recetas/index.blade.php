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
                        <strong>Fecha: </strong> {{ date("d-m-Y H:i", strtotime($receta->informeConsulta->cita->fecha_hora)) }}
                    </td>
                    <td>{{ $receta->informeConsulta->cita->paciente->nombre_completo }}</td>
                    <td>{{ $receta->informeConsulta->cita->profesional->nombre_completo }}</td>
                    <td>{{ date("d-m-Y H:i", strtotime($receta->fecha_emision)) }}</td>                                     
                    <td>
                        <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('recetas.destroy', $receta->id) }}" method="POST"
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
            $('#recetas').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
