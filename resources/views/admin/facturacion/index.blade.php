@extends('adminlte::page')

@section('title', 'Facturación')

@section('content_header')
    <h1>Facturación - Suscripciones de Planes</h1>
@endsection

@section('css')
    <style>
        .filtros-activos {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
        }
    </style>
@stop

@section('content')
    @if(session('pago_exitoso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Pago realizado!',
                    text: 'El pago se realizó correctamente.',
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    @endif

    <!-- Panel de Filtros -->
    <div class="card mb-4 {{ request()->hasAny(['profesional_id', 'plan_id', 'fecha_inicio', 'fecha_fin', 'estado_pago']) ? 'filtros-activos' : '' }}">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-filter"></i> Filtros
                @if(request()->hasAny(['profesional_id', 'plan_id', 'fecha_inicio', 'fecha_fin', 'estado_pago']))
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
            <form method="GET" action="{{ route('admin.facturacion.index') }}" id="filtros-form">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="profesional_id">Profesional</label>
                            <select name="profesional_id" id="profesional_id" class="form-control">
                                <option value="">Todos los profesionales</option>
                                @foreach($profesionales as $profesional)
                                    <option value="{{ $profesional->id }}"
                                        {{ request('profesional_id') == $profesional->id ? 'selected' : '' }}>
                                        {{ $profesional->nombre_completo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-group">
                            <label for="plan_id">Plan</label>
                            <select name="plan_id" id="plan_id" class="form-control">
                                <option value="">Todos los planes</option>
                                @foreach($planes as $plan)
                                    <option value="{{ $plan->id }}"
                                        {{ request('plan_id') == $plan->id ? 'selected' : '' }}>
                                        {{ $plan->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                                value="{{ request('fecha_inicio') }}">
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-group">
                            <label for="fecha_fin">Fecha de Fin</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                                value="{{ request('fecha_fin') }}">
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-group">
                            <label for="estado_pago">Estado de Pago</label>
                            <select name="estado_pago" id="estado_pago" class="form-control">
                                <option value="">Todos los estados</option>
                                <option value="1" {{ request('estado_pago') == '1' ? 'selected' : '' }}>
                                    Pagado
                                </option>
                                <option value="0" {{ request('estado_pago') == '0' ? 'selected' : '' }}>
                                    Pendiente
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
                        <a href="{{ route('admin.facturacion.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Limpiar Filtros
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="facturacion" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profesional</th>
                        <th>Plan</th>
                        <th>Monto</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Estado de Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suscripciones as $suscripcion)
                        <tr>
                            <td>{{ $suscripcion->id }}</td>
                            <td>{{ $suscripcion->profesional->nombre_completo ?? 'N/A' }}</td>
                            <td>{{ $suscripcion->plan->nombre ?? 'N/A' }}</td>
                            <td>{{ $suscripcion->plan->precio }}€</td>
                            <td>{{ date("d-m-Y",strtotime($suscripcion->fecha_inicio)) ?? 'N/A' }}</td>
                            <td>{{ date("d-m-Y",strtotime($suscripcion->fecha_fin)) ?? 'N/A' }}</td>
                            <td>
                                @if($suscripcion->pagado)
                                    <span class="badge badge-success">Pagado</span>
                                @else
                                    <span class="badge badge-warning">Pendiente</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.facturacion.show', $suscripcion->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                @if(!$suscripcion->pagado)
                                    @php
                                        $fechaActual = \Carbon\Carbon::now();
                                        $fechaInicio = \Carbon\Carbon::parse($suscripcion->fecha_inicio);
                                        $fechaFin = \Carbon\Carbon::parse($suscripcion->fecha_fin);
                                        $enRangoFechas = $fechaActual->between($fechaInicio, $fechaFin);
                                    @endphp
                                    @if($enRangoFechas)
                                        <a href="{{ route('admin.facturacion.pagar', $suscripcion->id) }}" class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i> Realizar Pago
                                        </a>
                                    @else
                                        <span class="btn btn-secondary btn-sm disabled" title="Fuera del período de vigencia">
                                            <i class="fa fa-clock"></i> Fuera de período
                                        </span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#facturacion').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                autoWidth: false,
                order: [[3, 'desc']] // Ordenar por fecha de inicio de forma descendente
            });

            // Mejorar los selectores con Select2 si está disponible
            if ($.fn.select2) {
                $('#profesional_id, #plan_id').select2({
                    placeholder: 'Seleccionar...',
                    allowClear: true
                });
            }

            // Mostrar contador de resultados
            const totalSuscripciones = $('#facturacion tbody tr').length;
            if (totalSuscripciones === 0) {
                $('#facturacion_wrapper').after('<div class="alert alert-info mt-3"><i class="fas fa-info-circle"></i> No se encontraron suscripciones con los filtros aplicados.</div>');
            } else {
                $('#facturacion_wrapper').after('<div class="alert alert-success mt-3"><i class="fas fa-check-circle"></i> Se encontraron ' + totalSuscripciones + ' suscripción(es).</div>');
            }
        });
    </script>
@endsection
