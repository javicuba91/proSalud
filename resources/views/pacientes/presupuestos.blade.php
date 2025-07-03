@extends('adminlte::page')

@section('title', 'Mis presupuestos solicitados/aceptados')

@section('content_header')
    <h1>Mis presupuestos solicitados/aceptados</h1>
@stop

@section('content')
    <h5>Presupuestos de pruebas</h5>
    @if (isset($pruebas) && $pruebas->count())
        <div class="table-responsive">
            <table id="tabla-presupuestos" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Prueba</th>
                        <th>Tipo</th>
                        <th>Proveedor</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pruebas as $prueba)
                        @foreach ($prueba->presupuestos as $presupuesto)
                            <tr>
                                <td>{{ $prueba->id }}</td>
                                <td>{{ $prueba->tipo ?? '-' }}</td>
                                <td>
                                    {{ $presupuesto->proveedor->nombre ?? '-' }}
                                    <strong>({{ ucfirst($presupuesto->proveedor->tipo) ?? '-' }})</strong>
                                </td>
                                <td>${{ number_format($presupuesto->precio, 2) }}</td>
                                <td>
                                    @if ($presupuesto->estado == 'pendiente')
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @elseif($presupuesto->estado == 'aprobado')
                                        <span class="badge bg-success">Aceptado</span>
                                    @elseif($presupuesto->estado == 'denegado')
                                        <span class="badge bg-danger">Denegado</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($presupuesto->estado) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($presupuesto->estado == 'pendiente')
                                        <div class="row">
                                            <div class="col">
                                                <form method="POST"
                                                    action="{{ route('paciente.presupuestos.aceptar', $presupuesto->id) }}"
                                                    class="form-aceptar-presupuesto">
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-success btn-sm btn-aceptar-presupuesto"><i class="fa fa-check"></i> Aceptar</button>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <form method="POST"
                                                    action="{{ route('paciente.presupuestos.denegar', $presupuesto->id) }}"
                                                    class="form-aceptar-presupuesto">
                                                    @csrf
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm btn-denegar-presupuesto"><i class="fa fa-times"></i> Denegar</button>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">No hay presupuestos para mostrar.</div>
    @endif
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"></script>
    <script>
        $(document).ready(function() {
            $('#tabla-presupuestos').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: true,
                order: [
                    [0, 'desc']
                ],
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).addClass('form-control form-control-sm').appendTo($(column
                                .footer()).empty())
                            .on('keyup change clear', function() {
                                if (column.search() !== this.value) {
                                    column.search(this.value).draw();
                                }
                            });
                    });
                }
            });

            // SweetAlert2 para aceptar presupuesto
            $('.btn-aceptar-presupuesto').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Deseas aceptar este presupuesto?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

             $('.btn-denegar-presupuesto').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Deseas denegar este presupuesto?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, denegar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
