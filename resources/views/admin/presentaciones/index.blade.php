@extends('adminlte::page')

@section('title', 'Presentaciones Medicamentos')

@section('content_header')
    <h1>Presentaciones Medicamentos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('presentaciones.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Presentación</i>
        </a>
    </div>

@stop

@section('content')

    <table id="presentaciones" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presentaciones as $presentacion)
                <tr>
                    <td>{{ $presentacion->nombre }}</td>                    
                    <td>
                        <a href="{{ route('presentaciones.edit', $presentacion->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('presentaciones.destroy', $presentacion->id) }}" method="POST"
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
            $('#presentaciones').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
