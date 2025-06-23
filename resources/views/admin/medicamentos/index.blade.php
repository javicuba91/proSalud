@extends('adminlte::page')

@section('title', 'Medicamentos')

@section('content_header')
    <h1>Medicamentos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('medicamentos.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Medicamento</i>
        </a>
    </div>

@stop

@section('content')

    <table id="medicamentos" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicamentos as $medicamento)
                <tr>
                    <td>{{ $medicamento->nombre }}</td>                    
                    <td>
                        <a href="{{ route('medicamentos.edit', $medicamento->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('medicamentos.destroy', $medicamento->id) }}" method="POST"
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
            $('#medicamentos').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
