@extends('adminlte::page')

@section('title', 'Mis clínicas / pacientes')

@section('content_header')
    <h1>Listado de pacientes</h1>
@stop

@section('content')

    @if(isset($pacientes) && $pacientes->count())
        <div class="table-responsive">
            <table id="pacientes-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td>{{ $paciente->nombre_completo ?? '-' }}</td>
                            <td>{{ $paciente->email ?? '-' }}</td>
                            <td>{{ $paciente->celular ?? '-' }}</td>
                            <td>
                                <a href="{{ route('proveedores.pacientes.presupuestos.historial', $paciente->id) }}" class="btn btn-info btn-sm"><i class="fa fa-history"></i> Ver historial</a>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">No hay pacientes con presupuestos aceptados.</div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pacientes-table').DataTable({
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    emptyTable: "No hay datos disponibles en la tabla"
                }
            });
        });
    </script>
@stop
