@extends('adminlte::page')

@section('title', 'Especialidades')

@section('content_header')
    <h1>Especialidades</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('especialidades.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Especialidad</i>
        </a>
    </div>

@stop

@section('content')

    <table id="especialidades" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especialidades as $especialidad)
                <tr>
                    <td>{{ $especialidad->nombre }}</td>
                    <td>{{ $especialidad->descripcion }}</td>
                    <td>
                        <a href="{{ route('especialidades.edit', $especialidad->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('especialidades.destroy', $especialidad->id) }}" method="POST"
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
            $('#especialidades').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
