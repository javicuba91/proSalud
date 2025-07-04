@extends('adminlte::page')

@section('title', 'Contactos de Profesionales')

@section('css')
    <style>
        .filtros-activos {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
        }
    </style>
@stop

@section('content_header')
    <h1>Mensajes de Profesionales</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Panel de Filtros -->
    <div class="card mb-4 {{ request()->hasAny(['profesional_id', 'estado']) ? 'filtros-activos' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtros
                @if (request()->hasAny(['profesional_id', 'estado']))
                    <span class="badge badge-info ml-2">Activos</span>
                @endif
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.contacto_profesional') }}" id="filtros-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profesional_id">Profesional</label>
                            <select name="profesional_id" id="profesional_id" class="form-control">
                                <option value="">Todos los profesionales</option>
                                @foreach ($profesionales as $profesional)
                                    <option value="{{ $profesional->id }}"
                                        {{ request('profesional_id') == $profesional->id ? 'selected' : '' }}>
                                        {{ $profesional->nombre_completo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="">Todos los estados</option>
                                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>
                                <option value="respondido" {{ request('estado') == 'respondido' ? 'selected' : '' }}>
                                    Respondido
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Aplicar Filtros
                        </button>
                        <a href="{{ route('admin.contacto_profesional') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="contactos" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Profesional</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Fecha Pregunta</th>
                        <th>Fecha Respuesta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contactos as $contacto)
                        <tr>
                            <td>{{ $contacto->profesional->nombre_completo }}</td>
                            <td>{{ $contacto->motivo }}</td>
                            <td>
                                @if ($contacto->estado == 'respondido')
                                    <span class="badge bg-success p-2">Respondido</span>
                                @else
                                    <span class="badge bg-warning p-2">Pendiente</span>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($contacto->created_at)) }}</td>
                            @if ($contacto->estado == 'respondido' && $contacto->fecha_respuesta)
                                <td>{{ date('d-m-Y H:i:s', strtotime($contacto->fecha_respuesta)) }}</td>
                            @else
                                <td>Sin responder</td>
                            @endif
                            <td>
                                <button class="btn btn-info btn-ver-detalle" data-id="{{ $contacto->id }}"
                                    data-profesional="{{ $contacto->profesional->nombre_completo }}"
                                    data-motivo="{{ $contacto->motivo }}" data-descripcion="{{ $contacto->descripcion }}"
                                    data-respuesta="{{ $contacto->respuesta }}" data-estado="{{ $contacto->estado }}">
                                    <i class="fa fa-eye"></i>
                                </button>

                                @if ($contacto->estado === 'pendiente')
                                    <button class="btn btn-primary btn-responder" data-id="{{ $contacto->id }}"
                                        data-profesional="{{ $contacto->profesional->nombre_completo }}"
                                        data-motivo="{{ $contacto->motivo }}"
                                        data-descripcion="{{ $contacto->descripcion }}">
                                        <i class="fa fa-reply"></i>
                                    </button>
                                @endif

                                @if ($contacto->estado === 'respondido')
                                    <button class="btn btn-warning btn-editar-respuesta" data-id="{{ $contacto->id }}"
                                        data-profesional="{{ $contacto->profesional->nombre_completo }}"
                                        data-motivo="{{ $contacto->motivo }}"
                                        data-descripcion="{{ $contacto->descripcion }}"
                                        data-respuesta="{{ $contacto->respuesta }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Respuesta -->
    <div class="modal fade" id="modalResponder" tabindex="-1" role="dialog" aria-labelledby="modalResponderLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalResponderLabel">Responder al Mensaje</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formResponder">
                        <input type="hidden" id="contactoId" name="contacto_id">

                        <div class="form-group">
                            <label>Profesional:</label>
                            <p id="profesionalNombre" class="font-weight"></p>
                        </div>

                        <div class="form-group">
                            <label>Motivo:</label>
                            <p id="contactoMotivo"></p>
                        </div>

                        <div class="form-group">
                            <label>Mensaje:</label>
                            <div id="contactoDescripcion" class="bg-light rounded"></div>
                        </div>

                        <div class="form-group">
                            <label for="respuesta">Tu Respuesta:</label>
                            <textarea id="respuesta" name="respuesta" class="form-control" rows="5" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnEnviarRespuesta">Enviar Respuesta</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Detalle -->
    <div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modalDetalleLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="modalDetalleLabel">Detalles del Mensaje</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Profesional:</label>
                        <p id="detalleProfesionalNombre" class="font-weight"></p>
                    </div>

                    <div class="form-group">
                        <label>Motivo:</label>
                        <p id="detalleContactoMotivo"></p>
                    </div>

                    <div class="form-group">
                        <label>Mensaje:</label>
                        <div id="detalleContactoDescripcion" class="bg-light rounded"></div>
                    </div>

                    <div class="form-group respuesta-container">
                        <label>Respuesta:</label>
                        <div id="detalleContactoRespuesta" class="bg-light rounded"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Editar Respuesta -->
    <div class="modal fade" id="modalEditarRespuesta" tabindex="-1" role="dialog" aria-labelledby="modalEditarRespuestaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="modalEditarRespuestaLabel">Editar Respuesta</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarRespuesta">
                        <input type="hidden" id="editContactoId" name="contacto_id">

                        <div class="form-group">
                            <label>Profesional:</label>
                            <p id="editProfesionalNombre" class="font-weight-bold"></p>
                        </div>

                        <div class="form-group">
                            <label>Motivo:</label>
                            <p id="editContactoMotivo"></p>
                        </div>

                        <div class="form-group">
                            <label>Mensaje original:</label>
                            <div id="editContactoDescripcion" class="bg-light rounded"></div>
                        </div>

                        <div class="form-group">
                            <label for="editRespuesta">Respuesta:</label>
                            <textarea id="editRespuesta" name="respuesta" class="form-control" rows="5" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" id="btnGuardarRespuestaEditada">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#contactos').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false,
                order: [
                    [4, 'desc']
                ] // Ordenar por fecha descendente
            });

            // Mejorar los selectores con Select2 si está disponible
            if ($.fn.select2) {
                $('#profesional_id').select2({
                    placeholder: 'Seleccionar...',
                    allowClear: true
                });
            }

            // Mostrar contador de resultados
            const totalContactos = $('#contactos tbody tr').length;
            if (totalContactos === 0) {
                $('#contactos_wrapper').after(
                    '<div class="alert alert-info mt-3"><i class="fas fa-info-circle"></i> No se encontraron mensajes con los filtros aplicados.</div>'
                );
            } else {
                $('#contactos_wrapper').after(
                    '<div class="alert alert-success mt-3"><i class="fas fa-check-circle"></i> Se encontraron ' +
                    totalContactos + ' mensaje(s).</div>');
            }

            // Abrir modal de respuesta
            $('.btn-responder').click(function() {
                const id = $(this).data('id');
                const profesional = $(this).data('profesional');
                const motivo = $(this).data('motivo');
                const descripcion = $(this).data('descripcion');

                $('#contactoId').val(id);
                $('#profesionalNombre').text(profesional);
                $('#contactoMotivo').text(motivo);
                $('#contactoDescripcion').text(descripcion);

                $('#modalResponder').modal('show');
            });

            // Abrir modal de detalle
            $('.btn-ver-detalle').click(function() {
                const id = $(this).data('id');
                const profesional = $(this).data('profesional');
                const motivo = $(this).data('motivo');
                const descripcion = $(this).data('descripcion');
                const respuesta = $(this).data('respuesta');
                const estado = $(this).data('estado');

                $('#detalleProfesionalNombre').text(profesional);
                $('#detalleContactoMotivo').text(motivo);
                $('#detalleContactoDescripcion').text(descripcion);

                if (estado === 'respondido' && respuesta) {
                    $('.respuesta-container').show();
                    $('#detalleContactoRespuesta').text(respuesta);
                } else {
                    $('.respuesta-container').hide();
                }

                $('#modalDetalle').modal('show');
            });

            // Abrir modal de editar respuesta
            $('.btn-editar-respuesta').click(function() {
                const id = $(this).data('id');
                const profesional = $(this).data('profesional');
                const motivo = $(this).data('motivo');
                const descripcion = $(this).data('descripcion');
                const respuesta = $(this).data('respuesta');

                $('#editContactoId').val(id);
                $('#editProfesionalNombre').text(profesional);
                $('#editContactoMotivo').text(motivo);
                $('#editContactoDescripcion').text(descripcion);
                $('#editRespuesta').val(respuesta);

                $('#modalEditarRespuesta').modal('show');
            });

            // Enviar respuesta
            $('#btnEnviarRespuesta').click(function() {
                const id = $('#contactoId').val();
                const respuesta = $('#respuesta').val();

                if (!respuesta.trim()) {
                    Swal.fire('Error', 'Debes escribir una respuesta', 'error');
                    return;
                }

                $.ajax({
                    url: `/admin/contacto-profesional/${id}/responder`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        respuesta: respuesta
                    },
                    success: function(response) {
                        $('#modalResponder').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                            showConfirmButton: true
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo enviar la respuesta', 'error');
                    }
                });
            });

            // Guardar respuesta editada
            $('#btnGuardarRespuestaEditada').click(function() {
                const id = $('#editContactoId').val();
                const respuesta = $('#editRespuesta').val();

                if (!respuesta.trim()) {
                    Swal.fire('Error', 'Debes escribir una respuesta', 'error');
                    return;
                }

                $.ajax({
                    url: `/admin/contacto-profesional/${id}/responder`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        respuesta: respuesta
                    },
                    success: function(response) {
                        $('#modalEditarRespuesta').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                            showConfirmButton: true
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo guardar la respuesta', 'error');
                    }
                });
            });
        });
    </script>
@endsection
