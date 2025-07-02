@extends('adminlte::page')

@section('title', 'Mis Pedidos / Presupuestos')

@section('content_header')
    <h1>Mis Pedidos / Presupuestos</h1>
@stop

@section('content')
    @if (isset($pruebas) && $pruebas->count() > 0)
        <table id="pruebas" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profesional</th>
                    <th>Paciente</th>
                    <th>Tipo</th>
                    <th>Muestras</th>
                    <th>Indicaciones</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pruebas as $prueba)
                    <tr>
                        <td>{{ $prueba->id }}</td>

                        @if ($prueba->pedido_laboratorio_id != null)
                            <td>{{ $prueba->pedidoLaboratorio->informeConsulta->cita->profesional->nombre_completo ?? 'N/A' }}
                            </td>
                            <td>{{ $prueba->pedidoLaboratorio->informeConsulta->cita->paciente->nombre_completo ?? 'N/A' }}
                            </td>
                        @elseif ($prueba->pedido_imagen_id != null)
                            <td>{{ $prueba->pedidoImagen->informeConsulta->cita->profesional->nombre_completo ?? 'N/A' }}
                            </td>
                            <td>{{ $prueba->pedidoImagen->informeConsulta->cita->paciente->nombre_completo ?? 'N/A' }}</td>
                        @endif

                        <td>{{ $prueba->tipo }}</td>
                        <td>{{ $prueba->muestras }}</td>
                        <td>{{ $prueba->indicaciones }}</td>
                        <td>{{ ucfirst($prueba->prioridad) }}</td>
                        <td>{{ ucfirst($prueba->estado) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">No hay pruebas de laboratorio para mostrar.</div>
    @endif
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#pruebas').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false,
                order: [
                    [1, 'desc']
                ] // Ordenar por fecha/hora de forma descendente
            });
        });
    </script>
@endsection
