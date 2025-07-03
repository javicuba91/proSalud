@extends('adminlte::page')

@section('title', 'Historial de pruebas del paciente')

@section('content_header')
    <h1>Historial de pruebas con paciente: <strong
            class="text-danger">{{ $presupuestos[0]->nombre_completo ?? '-' }}</strong></h1>
@stop

@section('content')
    @if (count($presupuestos))
        <div class="table-responsive">
            <table id="pruebas-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Región Anatómica / Muestras</th>
                        <th>Prioridad</th>
                        <th>Estado Prueba</th>
                        <th>Fecha Solicitud Prueba</th>
                        <th>Precio($) / Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presupuestos as $presupuesto)
                        <tr>
                            <td>{{ $presupuesto->tipo ?? '-' }}</td>
                            <td>{{ $presupuesto->muestras ?? $presupuesto->region_anatomica }}</td>
                            <td>{{ ucfirst($presupuesto->prioridad) ?? '-' }}</td>
                            <td>
                                @if ($presupuesto->estadoPrueba === 'pendiente')
                                    <span class="badge bg-warning">{{ ucfirst($presupuesto->estadoPrueba) }}</span>
                                @else
                                    <span class="badge bg-success">{{ ucfirst($presupuesto->estadoPrueba) }}</span>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($presupuesto->fechaSolicitudPrueba)) }}</td>
                            <td>{{ $presupuesto->precio ?? '-' }} - {{ ucfirst($presupuesto->estadoPresupuesto) }}</td>
                            <td>
                                @if ($presupuesto->estadoPresupuesto == 'aprobado')
                                    @if ($presupuesto->estadoPrueba === 'pendiente')
                                        <form action="{{ route('prueba.marcarCompletada', $presupuesto->idPrueba) }}"
                                            method="POST" style="display:inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm"
                                                title="Marcar como completada">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <button title="Subir fotos" type="button" class="btn btn-primary btn-sm"
                                        data-toggle="modal" data-target="#modalSubirFotos{{ $presupuesto->idPrueba }}">
                                        <i class="fa fa-upload"></i>
                                    </button>
                                    <button title="Ver imágenes" type="button" class="btn btn-info btn-sm"
                                        data-toggle="modal" data-target="#modalVerFotos{{ $presupuesto->idPrueba }}">
                                        <i class="fa fa-image"></i>
                                    </button>
                                    <!-- Modal subir fotos -->
                                    <div class="modal fade" id="modalSubirFotos{{ $presupuesto->idPrueba }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $presupuesto->idPrueba }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $presupuesto->idPrueba }}">
                                                        Subir
                                                        fotos para la prueba</h5>
                                                    <i data-dismiss="modal" aria-label="Cerrar"
                                                        class="fa fa-times btn-close"></i>
                                                </div>
                                                <form action="{{ route('prueba.subirImagen', $presupuesto->idPrueba) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="imagen{{ $presupuesto->idPrueba }}"
                                                                class="form-label">Seleccionar imágenes</label>
                                                            <input type="file" class="form-control" name="imagen[]"
                                                                id="imagen{{ $presupuesto->idPrueba }}" accept="image/*"
                                                                multiple required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="descripcion{{ $presupuesto->idPrueba }}"
                                                                class="form-label">Descripción (opcional, se aplicará a
                                                                todas)</label>
                                                            <input type="text" class="form-control" name="descripcion"
                                                                id="descripcion{{ $presupuesto->idPrueba }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Subir</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal ver fotos -->
                                    <div class="modal fade" id="modalVerFotos{{ $presupuesto->idPrueba }}" tabindex="-1"
                                        aria-labelledby="modalVerFotosLabel{{ $presupuesto->idPrueba }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="modalVerFotosLabel{{ $presupuesto->idPrueba }}">Imágenes
                                                        asociadas
                                                        a la prueba</h5>
                                                    <i data-dismiss="modal" aria-label="Cerrar"
                                                        class="fa fa-times btn-close"></i>
                                                </div>
                                                <div class="modal-body">
                                                    @php
                                                        $imagenes = \App\Models\ImagenesPrueba::where(
                                                            'prueba_id',
                                                            $presupuesto->idPrueba,
                                                        )->get();
                                                    @endphp
                                                    @if ($imagenes->count())
                                                        <div class="row">
                                                            @foreach ($imagenes as $img)
                                                                <div class="col-md-4 mb-3 text-center position-relative">
                                                                    <form
                                                                        action="{{ route('prueba.eliminarImagen', $img->id) }}"
                                                                        method="POST"
                                                                        style="position:absolute;top:5px;right:10px;z-index:2;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-sm p-1"
                                                                            title="Eliminar imagen"
                                                                            onclick="return confirm('¿Seguro que deseas eliminar esta imagen?')">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </form>
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
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">No hay pruebas con presupuesto aprobado para este paciente.</div>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#pruebas-table').DataTable({
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
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Aceptar',
                    timer: 2500
                });
            @endif
        });
    </script>
@stop
