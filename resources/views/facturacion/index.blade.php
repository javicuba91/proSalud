@extends('adminlte::page')

@section('title', 'Facturación')

@section('content_header')
    <h1>Facturación - Suscripciones de Planes</h1>
@endsection

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
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profesional</th>
                        <th>Plan</th>
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
                                <a href="{{ route('facturacion.show', $suscripcion->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                @if(!$suscripcion->pagado)
                                    <a href="{{ route('facturacion.pagar', $suscripcion->id) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Realizar Pago</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
