@extends('adminlte::page')

@section('title', 'Respuestas Expertos')

@section('content_header')
    <h1>Respuestas Expertos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('respuestas.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Respuesta Experto</i>
        </a>
    </div>

@stop

@section('content')

    <table id="respuestas" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Respuesta</th>
                <th>Profesional</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($respuestas as $respuesta)
                <tr>
                    <td>{{ $respuesta->pregunta->pregunta }}</td>
                    <td>{{ $respuesta->respuesta }}</td>
                    <td>{{ $respuesta->profesional->nombre_completo }}</td>
                    <td>
                        <a href="{{ route('respuestas.edit', $respuesta->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('respuestas.destroy', $respuesta->id) }}" method="POST"
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
            $('#respuestas').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
