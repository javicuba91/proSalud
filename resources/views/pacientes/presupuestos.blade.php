@extends('adminlte::page')

@section('title', 'Mis presupuestos solictados/aceptados')

@section('content_header')
    <h1>Mis presupuestos solictados/aceptados</h1>
@stop

@section('content')
    <h5>Presupuestos solicitados</h5>
    <div class="row mb-2">
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Código QR"></div>
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Nombre paciente"></div>
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Fecha"></div>
        <div class="col-md-3"><input type="text" class="form-control" placeholder="Descripción breve de la petición">
        </div>
        <div class="col-md-3"><input type="text" class="form-control" placeholder="Dirección del local"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 1"></div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 2"></div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 3"></div>
    </div>
    <div class="row mb-4">
        <div class="col-md-6"><button class="btn btn-dark w-100">Volver a solicitar presupuesto</button></div>
        <div class="col-md-6"><button class="btn btn-dark w-100">Cancelar</button></div>
    </div>

    <h5>Presupuestos pendientes de aceptar</h5>
    <div class="row mb-2">
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Código QR"></div>
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Nombre paciente"></div>
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Fecha"></div>
        <div class="col-md-3"><input type="text" class="form-control" placeholder="Descripción breve de la petición">
        </div>
        <div class="col-md-3"><input type="text" class="form-control" placeholder="Dirección del local"></div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 1"></div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 2"></div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 3"></div>
    </div>
    <div class="mb-2">
        <input type="text" class="form-control mb-2" placeholder="Presupuesto $">
        <button class="btn btn-outline-dark w-100 mb-2 text-left">Ver presupuesto (pdf)</button>
    </div>
    <div class="row mb-4">
        <div class="col-md-6"><button class="btn btn-dark w-100">Aceptar</button></div>
        <div class="col-md-6"><button class="btn btn-dark w-100">Rechazar</button></div>
    </div>

    <!-- Presupuestos aceptados -->
    <h5>Presupuestos aceptados</h5>
    <div class="row mb-2">
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Código QR"></div>
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Nombre paciente"></div>
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Fecha"></div>
        <div class="col-md-3"><input type="text" class="form-control" placeholder="Descripción breve de la petición">
        </div>
        <div class="col-md-3"><input type="text" class="form-control" placeholder="Dirección del local"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 1"></div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 2"></div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 3"></div>
    </div>
    <div class="mb-4">
        <button class="btn btn-outline-dark w-100 mb-2 text-left">Ver presupuesto (pdf)</button>
        <button class="btn btn-dark w-100">Agendar cita</button>
    </div>

    <h5>Presupuestos rechazados</h5>
    <div class="row mb-2">
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Código QR"></div>
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Nombre paciente"></div>
        <div class="col-md-2"><input type="text" class="form-control" placeholder="Fecha"></div>
        <div class="col-md-3"><input type="text" class="form-control" placeholder="Descripción breve de la petición">
        </div>
        <div class="col-md-3"><input type="text" class="form-control" placeholder="Dirección del local"></div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 1"></div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 2"></div>
        <div class="col-md-4"><input type="text" class="form-control" placeholder="Archivo 3"></div>
    </div>
    <div class="mb-4">
        <button class="btn btn-outline-dark w-100 text-left">Ver presupuesto (pdf)</button>
    </div>
@stop
