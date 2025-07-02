@extends('adminlte::page')

@section('title', 'Mis Pedidos / Presupuestos')

@section('content_header')
    <h1>Mis Pedidos / Presupuestos</h1>
@stop

@section('content')
    @if (isset($pruebas) && $pruebas->count() > 0)
     @php
          $proveedor = App\Models\Proveedor::where('user_id', auth()->id())->first();
     @endphp
        <table id="pruebas" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profesional</th>
                    <th>Paciente</th>
                    <th>Tipo</th>
                    @if ($proveedor->tipo == 'laboratorio')
                        <th>Muestras</th>
                    @else
                        <th>Región Anatómica</th>
                    @endif

                    <th>Indicaciones</th>                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Presupuesto</th>
                        <th>Acciones</th>
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
                        @if ($prueba->pedido_laboratorio_id != null)
                            <td>{{ $prueba->muestras }}</td>
                        @else
                            <td>{{ $prueba->region_anatomica }}</td>
                        @endif

                        <td>{{ $prueba->indicaciones }}</td>
                        <td>{{ ucfirst($prueba->prioridad) }}</td>
                        <td>{{ ucfirst($prueba->estado) }}</td>
                        <td>
                            @php
                                $presupuesto = $prueba->presupuestoProveedor($proveedor->id);
                            @endphp
                            @if($presupuesto)
                                {{ number_format($presupuesto->precio, 2) }} € - {{ ucfirst($presupuesto->estado) }}
                            @else
                                No disponible
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm"
                                data-toggle="modal"
                                data-target="#modalPresupuesto"
                                data-prueba-id="{{ $prueba->id }}"
                                data-precio="{{ $presupuesto->precio ?? '' }}"
                                data-estado="{{ $presupuesto->estado ?? 'pendiente' }}">
                                {{ $presupuesto ? 'Editar presupuesto' : 'Añadir presupuesto' }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">No hay pruebas de laboratorio para mostrar.</div>
    @endif

    <!-- Modal para añadir/editar presupuesto -->
    <div class="modal fade" id="modalPresupuesto" tabindex="-1" role="dialog" aria-labelledby="modalPresupuestoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPresupuestoLabel">Gestionar Presupuesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formPresupuesto" action="{{ route('presupuestos.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="prueba_id" id="prueba_id">
                        <input type="hidden" name="proveedor_id" value="{{ $proveedor->id }}">

                        <div class="form-group">
                            <label for="precio">Precio (€)</label>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

            // Modal de presupuesto
            $('#modalPresupuesto').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var pruebaId = button.data('prueba-id');
                var precio = button.data('precio');
                var estado = button.data('estado');

                var modal = $(this);
                modal.find('#prueba_id').val(pruebaId);
                modal.find('#precio').val(precio);
                modal.find('#estado').val(estado);

                // Ajustar título según si es edición o creación
                if (precio) {
                    modal.find('.modal-title').text('Editar Presupuesto');
                } else {
                    modal.find('.modal-title').text('Añadir Presupuesto');
                }
            });

            // Enviar formulario mediante AJAX
            $('#formPresupuesto').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            title: 'Éxito',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        for (var field in errors) {
                            errorMessage += errors[field][0] + '<br>';
                        }

                        Swal.fire({
                            title: 'Error',
                            html: errorMessage || 'Ha ocurrido un error al guardar el presupuesto.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            });
        });
    </script>
@endsection
