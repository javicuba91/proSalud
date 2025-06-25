    <div class="card">
        <div class="card-body">
            <h4>Resumen del Plan</h4>
            <ul>
                <li><strong>Nombre del plan:</strong> {{ $plan->nombre ?? '' }}</li>
                <li><strong>Descripción:</strong> {{ $plan->descripcion ?? '' }}</li>
                <li><strong>Precio:</strong> ${{ number_format($plan->precio ?? 0, 2) }}</li>
            </ul>
            <form method="POST" action="{{ route('profesional.pagar.plan') }}">
                @csrf
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                <div class="form-group">
                    <label for="metodo_pago">Método de pago</label>
                    <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                        <option value="tarjeta">Tarjeta de crédito/débito</option>
                        <option value="transferencia">Transferencia bancaria</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-3">Confirmar pago y activar plan</button>
                <a href="{{ route('profesionales.misPlanes') }}" class="btn btn-secondary mt-3">Cancelar</a>
            </form>
        </div>
    </div>
