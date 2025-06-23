@extends('adminlte::page')

@section('title', 'Emergencias')

@section('content_header')
    <h1>Emergencias</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('emergencias.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Emergencia</i>
        </a>
    </div>

@stop

@section('content')

    <table id="emergencias" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Provincia</th>
                <th>Ciudad</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($emergencias as $emergencia)
                <tr>
                    <td>{{ $emergencia->tipo }}</td>
                    <td>{{ $emergencia->provincia->nombre }}</td>
                    <td>{{ $emergencia->ciudad->nombre }}</td>
                    <td>{{ $emergencia->telefono }}</td>
                    <td>
                        <a href="{{ route('emergencias.edit', $emergencia->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('emergencias.destroy', $emergencia->id) }}" method="POST"
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
            $('#emergencias').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
