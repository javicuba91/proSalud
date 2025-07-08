<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Información del Pedido -->
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-x-ray"></i> Información del Pedido de Imágenes</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Código QR:</strong>
                                <span>
                                    @if (!empty($pedido->qr))
                                        {{ QrCode::size(80)->generate($pedido->qr) }}
                                    @else
                                        Sin código
                                    @endif
                                </span>
                            </p>
                            <p><strong>Fecha:</strong>
                                {{ $pedido->fecha_hora ? \Carbon\Carbon::parse($pedido->fecha_hora)->format('d/m/Y H:i') : 'N/A' }}
                            </p>
                            <p><strong>Motivo:</strong> {{ $pedido->motivo ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Síntomas:</strong> {{ $pedido->sintomas ?? 'N/A' }}</p>
                            <p><strong>Antecedentes:</strong> {{ $pedido->antecedentes ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información del Paciente -->
            @if ($pedido->informeConsulta && $pedido->informeConsulta->cita && $pedido->informeConsulta->cita->paciente)
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-user"></i> Información del Paciente</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nombre:</strong>
                                    {{ $pedido->informeConsulta->cita->paciente->nombre_completo }}</p>
                                <p><strong>Cédula:</strong>
                                    {{ $pedido->informeConsulta->cita->paciente->cedula ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email:</strong>
                                    {{ $pedido->informeConsulta->cita->paciente->user->email ?? 'N/A' }}</p>
                                <p><strong>Teléfono:</strong>
                                    {{ $pedido->informeConsulta->cita->paciente->celular ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Pruebas del Pedido -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-image"></i> Pruebas de Imágenes Solicitadas
                        ({{ $pedido->pruebas ? $pedido->pruebas->count() : 0 }})</h5>
                </div>
                <div class="card-body">
                    @if (!$pedido->pruebas || $pedido->pruebas->isEmpty())
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> No hay pruebas de imágenes asociadas a este
                            pedido.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tipo de Estudio</th>
                                        <th>Indicaciones</th>
                                        <th>Región Anatómica</th>
                                        <th>Prioridad</th>
                                        <th>Estado</th>
                                        <th>Presupuestos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedido->pruebas as $prueba)
                                        <tr>
                                            <td>{{ $prueba->tipo ?? 'N/A' }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($prueba->indicaciones, 100) ?? 'N/A' }}
                                            </td>
                                            <td>{{ $prueba->region_anatomica ?? 'N/A' }}</td>
                                            <td>
                                                @if ($prueba->prioridad === 'urgente')
                                                    <span class="badge badge-danger">Urgente</span>
                                                @else
                                                    <span class="badge badge-info">Programado</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($prueba->estado === 'completada')
                                                    <span class="badge badge-success">Completada</span>
                                                @else
                                                    <span class="badge badge-warning">Pendiente</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($prueba->presupuestos && $prueba->presupuestos->isNotEmpty())
                                                    <button class="btn btn-sm btn-outline-primary" type="button"
                                                        data-toggle="collapse"
                                                        data-target="#presupuestos-{{ $prueba->id }}">
                                                        Ver presupuestos
                                                    </button>
                                                    <div class="collapse mt-2" id="presupuestos-{{ $prueba->id }}">
                                                        <div class="table-responsive">
                                                            <table class="table table-sm table-bordered">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th>Proveedor</th>
                                                                        <th>Precio</th>
                                                                        <th>Estado</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($prueba->presupuestos as $presupuesto)
                                                                        <tr>
                                                                            <td>{{ $presupuesto->proveedor->nombre ?? 'N/A' }}
                                                                            </td>
                                                                            <td>${{ number_format($presupuesto->precio ?? 0, 2) }}
                                                                            </td>
                                                                            <td>
                                                                                @switch($presupuesto->estado)
                                                                                    @case('aprobado')
                                                                                        <span
                                                                                            class="badge badge-success">Aprobado</span>
                                                                                    @break

                                                                                    @case('denegado')
                                                                                        <span
                                                                                            class="badge badge-danger">Denegado</span>
                                                                                    @break

                                                                                    @default
                                                                                        <span
                                                                                            class="badge badge-warning">Pendiente</span>
                                                                                @endswitch
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">Sin presupuestos</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
