@extends('adminlte::page')

@section('title', 'Intervalos Medicamentos')

@section('content_header')
    <h1>Intervalos Medicamentos</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('intervalos.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"> Crear Intervalo</i>
        </a>
    </div>

@stop

@section('content')

    <table id="intervalos" class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($intervalos as $intervalo)
                <tr>
                    <td>{{ $intervalo->nombre }}</td>                    
                    <td>
                        <a href="{{ route('intervalos.edit', $intervalo->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('intervalos.destroy', $intervalo->id) }}" method="POST"
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
            $('#intervalos').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
