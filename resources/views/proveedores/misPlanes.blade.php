@extends('adminlte::page')

@section('title', 'Mis Planes')

@section('content_header')
    <h1>Mis Planes</h1>
@stop

@section('content')
    <style>
        .plan-card {
            border: 1px solid #dee2e6;
            padding: 2rem;
            background-color: #f8f9fa;
            height: 100%;
        }

        .plan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .plan-price {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .plan-current {
            background-color: #dee2e6;
            color: black;
        }

        .btn-plan {
            margin-top: 1.5rem;
        }
    </style>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($proveedor->suscripciones)
        <div class="mt-3 text-center">
            <strong>Inicio:</strong> {{ date('d-m-y', strtotime($proveedor->suscripciones->fecha_inicio)) }}<br>
            <strong>Vence:</strong> {{ date('d-m-y', strtotime($proveedor->suscripciones->fecha_fin)) }}
        </div>
    @endif


    <div class="row mb-2">
        <!-- Planes -->
        @foreach ($planes as $plan)
            <div class="col-md-4 mb-2">
                <form method="POST" action="{{ route('proveedor.elegir.plan') }}">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                    <div class="plan-card {{ $proveedor->plan_id === $plan->id ? 'plan-current' : '' }}">
                        <div class="plan-header">
                            <div>{{ $plan->nombre }}</div>
                            <div class="plan-price">{{ $plan->precio }}$</div>
                        </div>
                        <p class="mt-3">{{ $plan->descripcion }}</p>
                        <ul class="mt-3">
                            @foreach (json_decode($plan->caracteristicas) as $caracteristica)
                                <li>{{ $caracteristica }}</li>
                            @endforeach
                        </ul>

                        @if ($proveedor->documentosAprobados())
                            @if ($proveedor->plan_id === $plan->id)
                                <button class="btn btn-dark w-100 mt-3" disabled>Plan actual</button>
                            @else
                                <button type="button" class="btn btn-outline-dark w-100 mt-3 btn-abrir-modal"
                                    data-id="{{ $plan->id }}" data-nombre="{{ $plan->nombre }}"
                                    data-descripcion="{{ $plan->descripcion }}" data-precio="{{ $plan->precio }}">
                                    Cambiar a este plan
                                </button>
                            @endif
                        @endif

                    </div>
                </form>
            </div>
        @endforeach
    </div>

    <!-- Modal de Pago -->
    <div class="modal fade" id="modalPagoPlan" tabindex="-1" role="dialog" aria-labelledby="modalPagoPlanLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('proveedor.pagar.plan') }}">
                @csrf
                <input type="hidden" name="plan_id" id="modal_plan_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPagoPlanLabel">Confirmar Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nombre del plan:</strong> <span id="modal_plan_nombre"></span></p>
                        <p><strong>Descripción:</strong> <span id="modal_plan_descripcion"></span></p>
                        <p><strong>Precio:</strong> $<span id="modal_plan_precio"></span></p>
                        <div class="form-group">
                            <label for="metodo_pago">Método de pago</label>
                            <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                                <option value="tarjeta">Tarjeta de crédito/débito</option>
                                <option value="transferencia">Transferencia bancaria</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Confirmar pago y activar plan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn-abrir-modal').click(function() {
                let id = $(this).data('id');
                let nombre = $(this).data('nombre');
                let descripcion = $(this).data('descripcion');
                let precio = $(this).data('precio');

                $('#modal_plan_id').val(id);
                $('#modal_plan_nombre').text(nombre);
                $('#modal_plan_descripcion').text(descripcion);
                $('#modal_plan_precio').text(precio);

                $('#modalPagoPlan').modal('show');
            });
        });
    </script>
@endsection
