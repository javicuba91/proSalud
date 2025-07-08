@extends('adminlte::page')

@section('title', 'Elaboración de pedidos de laboratorio')

@section('content_header')
    <h1>Elaboración de pedidos de laboratorio</h1>
@stop

@section('content')
    <div class="row mt-3">
        <div class="col-lg-12">

            @if(isset($pedidos) && $pedidos->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No hay pedidos de laboratorio registrados.
                </div>
            @elseif(isset($pedidos))
                <div class="table-responsive">
                    <table id="pedidosTable" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Código QR</th>
                                <th>Fecha</th>
                                <th>Paciente</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                                <th>Pruebas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                                <tr>
                                    <td>
                                        <span >
                                            @if (!empty($pedido->qr))
                                                {{ QrCode::size(80)->generate($pedido->qr) }}
                                            @else
                                                Sin código
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        @if($pedido->fecha_hora)
                                            {{ \Carbon\Carbon::parse($pedido->fecha_hora)->format('d/m/Y H:i') }}
                                        @else
                                            {{ $pedido->created_at ? $pedido->created_at->format('d/m/Y H:i') : 'N/A' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($pedido->informeConsulta && $pedido->informeConsulta->cita && $pedido->informeConsulta->cita->paciente)
                                            {{ $pedido->informeConsulta->cita->paciente->nombre_completo }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::limit($pedido->motivo, 50) ?? 'N/A' }}</td>
                                    <td>
                                        @if($pedido->pruebas && $pedido->pruebas->isNotEmpty())
                                            @php
                                                $todasCompletadas = $pedido->pruebas->every(function($prueba) {
                                                    return $prueba->estado === 'completada';
                                                });
                                                $hayPendientes = $pedido->pruebas->some(function($prueba) {
                                                    return $prueba->estado === 'pendiente';
                                                });
                                            @endphp

                                            @if($todasCompletadas)
                                                <span class="badge badge-success">Completado</span>
                                            @elseif($hayPendientes)
                                                <span class="badge badge-warning">Pendiente</span>
                                            @else
                                                <span class="badge badge-secondary">Sin pruebas</span>
                                            @endif
                                        @else
                                            <span class="badge badge-secondary">Sin pruebas</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $pedido->pruebas ? $pedido->pruebas->count() : 0 }} prueba(s)
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-dark btn-sm" onclick="verPedido({{ $pedido->id }})" title="Ver detalles">
                                            <i class="fas fa-eye"></i> Ver pedido
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> No se pudieron cargar los pedidos de laboratorio.
                </div>
            @endif
        </div>
    </div>

    <!-- Modal para ver detalles del pedido -->
    <div class="modal fade" id="modalPedido" tabindex="-1" role="dialog" aria-labelledby="modalPedidoLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPedidoLabel">Detalles del Pedido de Laboratorio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalPedidoContent">
                    <!-- Contenido cargado dinámicamente -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <style>
        .table th {
            white-space: nowrap;
        }
        .badge {
            font-size: 0.8em;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            @if(isset($pedidos) && $pedidos->isNotEmpty())
            $('#pedidosTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                },
                responsive: true,
                pageLength: 10,
                order: [[1, 'desc']], // Ordenar por fecha descendente
                columnDefs: [
                    { targets: [6], orderable: false } // Columna de acciones no ordenable
                ]
            });
            @endif
        });

        function verPedido(pedidoId) {
            // Mostrar loading
            $('#modalPedidoContent').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Cargando...</div>');
            $('#modalPedido').modal('show');

            // Cargar contenido del pedido usando la URL correcta
            const url = `{{ url('/profesional/pedidos-laboratorio') }}/${pedidoId}/detalles`;
            console.log('Calling URL:', url);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    console.log('Success response:', response);
                    $('#modalPedidoContent').html(response);
                },
                error: function(xhr, status, error) {
                    console.log('Error details:', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText,
                        error: error
                    });

                    let errorMessage = 'Error al cargar los detalles del pedido.';

                    if (xhr.status === 404) {
                        errorMessage = 'Pedido no encontrado.';
                    } else if (xhr.status === 403) {
                        errorMessage = 'No tiene permisos para ver este pedido.';
                    } else if (xhr.status === 401) {
                        errorMessage = 'No está autenticado.';
                    } else if (xhr.responseText) {
                        // Si el servidor devuelve HTML de error, lo mostramos
                        $('#modalPedidoContent').html(xhr.responseText);
                        return;
                    }

                    $('#modalPedidoContent').html(`<div class="alert alert-danger">${errorMessage}</div>`);
                }
            });
        }
    </script>
@stop
