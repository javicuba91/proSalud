@extends('adminlte::page')

@section('title', 'Preguntas Expertos')

@section('content_header')
    <h1>Preguntas Expertos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('preguntas.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Pregunta Experto</i>
        </a>
    </div>

@stop

@section('content')

    <table id="preguntas" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Especialidad</th>
                <th>Subespecialidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preguntas as $pregunta)
                <tr>
                    <td>{{ $pregunta->pregunta }}</td>
                    <td>{{ $pregunta->especialidad->nombre }}</td>
                    <td>{{ $pregunta->subespecialidad->nombre }}</td>
                    <td>
                        <a href="{{ route('preguntas.edit', $pregunta->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('preguntas.destroy', $pregunta->id) }}" method="POST"
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
            $('#preguntas').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
