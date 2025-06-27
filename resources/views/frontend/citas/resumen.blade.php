@extends('frontend.pacientes.layout')

<title>@yield('title', 'ProSalud - Resumen Cita: ')</title>


@section('content')
    <div class="container">
        @if ($cita->paciente->user_id == Auth::user()->id)
            <div class="card p-3">
                <h3 class="mb-4">Resumen de tu cita</h3>
                

                <div class="border p-3 mb-2">
                    <div class="row">
                        <div class="col-lg-2">
                            {!! $codigoQR !!}
                        </div>
                        <div class="col-lg-10">
                            <p class="mt-2"><strong>Profesional:</strong> {{ $cita->profesional->nombre_completo }}</p>
                            
                            @if ($cita->modalidad == 'presencial')
                                <p><strong>Modalidad:</strong> Presencial</p>
                                <p><strong>Consultorio:</strong> {{ $cita->consultorio->direccion }}</p>
                            @else
                                <p><strong>Modalidad:</strong> Videoconsulta</p>
                                <p><strong>Url Meet:</strong> {{ $cita->url_meet }}</p>
                            @endif                            
                            
                            <p><strong>Fecha y hora:</strong> {{ \Carbon\Carbon::parse($cita->fecha_hora)->format('d/m/Y H:i') }}
                            </p>
                            <p><strong>Motivo:</strong> {{ $cita->motivo }}</p>
                            <p><strong>Estado Cita:</strong> {{ ucfirst($cita->estado) }}</p>
                        </div>
                    </div>
                   
                </div>

                <div class="border p-3">
                    <p><strong>Método de pago: </strong> {{ $detalleCita->metodoPago->nombre }}</p>
                    <p><strong>Estado Pago:</strong> {{ ucfirst($detalleCita->estado_pago) }}</p>
                    <p><strong>Monto: </strong> {{ $detalleCita->monto }}€</p>
                </div>
                @if ($detalleCita->estado_pago == 'pendiente' && strtolower($detalleCita->metodoPago->nombre) == 'tarjeta')
                    <!-- Botón para abrir el modal -->
                    <div class="text-center mt-3">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalPago">Pagar ahora</button>
                    </div>
                    <div class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPagoLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Pago con tarjeta</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="mb-3">Completa los datos de tu tarjeta para simular el pago.</p>

                                    <div class="mb-2">
                                        <label for="numero_tarjeta" class="form-label">Número de tarjeta</label>
                                        <input type="text" id="numero_tarjeta" class="form-control"
                                            placeholder="**** **** **** 1234">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label for="caducidad" class="form-label">Caducidad</label>
                                            <input type="text" id="caducidad" class="form-control" placeholder="MM/AA">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="cvv" class="form-label">CVV</label>
                                            <input type="text" id="cvv" class="form-control" placeholder="123">
                                        </div>
                                    </div>
                                    <p class="mt-3">Monto: <strong>{{ $detalleCita->monto ?? '0.00' }}€</strong></p>
                                </div>
                                <div class="modal-footer">
                                    <button id="btnSimularPago" class="btn btn-primary">Confirmar pago</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($detalleCita->metodoPago->nombre === 'Efectivo')
                    <div class="alert alert-warning mt-3">
                        <strong>Pago en Efectivo:</strong> Recuerda llevar el importe exacto el día de tu cita.
                    </div>
                @elseif ($detalleCita->metodoPago->nombre === 'Transferencia')
                    <div class="alert alert-info mt-3">
                        <strong>Pago por Transferencia:</strong><br>
                        <span>Número de cuenta: <strong>ES12 3456 7890 1234 5678 9012</strong></span><br>
                        <span>Concepto: <strong>CITA-{{ $cita->codigo_qr }}</strong></span><br>
                        <span>Por favor realiza la transferencia al menos 24 horas antes de tu cita.</span><br>
                        <span>Envía el justificante al email <strong>pagos@prosalud.com</strong>.</span>
                    </div>
                @endif

            </div>
        @else
            <h3>No tienes permisos para ver el detalle de esta cita</h3>
        @endif

    </div>
@endsection

@section('js')
    <script>
        document.getElementById('btnSimularPago').addEventListener('click', function() {
            fetch("{{ route('pacientes.citas.pago', ['id' => $detalleCita->id]) }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        estado_pago: 'pagado'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Pago realizado correctamente.");
                        location.reload(); // Recargar para ver el estado actualizado
                    } else {
                        alert("Error al procesar el pago.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Algo salió mal.");
                });
        });
    </script>
@endsection
