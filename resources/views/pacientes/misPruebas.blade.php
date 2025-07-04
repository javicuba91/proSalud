@extends('adminlte::page')

@section('title', 'Mis Pruebas')

@section('content_header')
    <h1>Mis Pruebas</h1>
@stop

@section('content')

    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
        <style>
            .estado-pendiente { background: #fff3cd !important; color: #856404 !important; }
            .estado-aprobada, .estado-completada { background: #d4edda !important; color: #155724 !important; }
            .estado-rechazada { background: #f8d7da !important; color: #721c24 !important; }
        </style>
    @endpush

    @if ($pruebas->count() > 0)
        <div class="table-responsive">
            <table id="tablaPruebas" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Pedido</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pruebas as $prueba)
                        <tr>
                            <td>{{ $prueba->tipo ?? '-' }}</td>
                            <td>{{ $prueba->created_at ? $prueba->created_at->format('d-m-Y H:i:s') : '-' }}</td>
                            <td>
                                @if ($prueba->pedido_laboratorio_id)
                                    Laboratorio
                                @elseif($prueba->pedido_imagen_id)
                                    Imagen
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ ucfirst($prueba->prioridad ?? '-') }}</td>
                            <td>
                                @php
                                    $estado = strtolower($prueba->estado ?? '');
                                    $claseEstado = match($estado) {
                                        'pendiente' => 'estado-pendiente',
                                        'aprobada', 'completada' => 'estado-aprobada',
                                        'rechazada' => 'estado-rechazada',
                                        default => '',
                                    };
                                @endphp
                                <span class="badge {{ $claseEstado }}">{{ ucfirst($prueba->estado ?? '-') }}</span>
                            </td>
                            <td>
                                @if ($prueba->pedido_imagen_id || $prueba->pedido_laboratorio_id)
                                    @if ($prueba->estado != 'pendiente')
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#modalImagenesPrueba{{ $prueba->id }}">
                                        <i class="fa fa-images"></i> Ver imágenes
                                    </button>
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalImagenesPrueba{{ $prueba->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modalLabel{{ $prueba->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $prueba->id }}">Imágenes de
                                                        la prueba</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @php
                                                        $imagenes = \App\Models\ImagenesPrueba::where('prueba_id', $prueba->id)->get();
                                                    @endphp
                                                    @if ($imagenes->count())
                                                        <div class="row">
                                                            @foreach ($imagenes as $img)
                                                                <div class="col-md-4 mb-3 text-center position-relative">
                                                                    <img src="/{{ $img->ruta }}" alt="Imagen prueba"
                                                                        class="img-fluid rounded mb-2"
                                                                        style="max-height:180px;">
                                                                    <div>{{ $img->descripcion }}</div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="alert alert-info">No hay imágenes asociadas a esta
                                                            prueba.
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif (isset($prueba->archivo) && $prueba->archivo)
                                    <a href="{{ asset('ruta/a/archivos/' . $prueba->archivo) }}" target="_blank"
                                        class="btn btn-sm btn-primary">Ver archivo</a>
                                @else
                                    <span class="text-muted">Sin archivo</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">No hay pruebas registradas.</div>
    @endif

@push('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tablaPruebas').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                order: [[1, 'desc']]
            });
        });
    </script>
@endpush
@stop
