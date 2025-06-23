@extends('adminlte::page')

@section('title', 'Mis Datos')

@section('content_header')
    <div class="row">
        <div class="col-lg-6 d-flex align-items-center">
            <h1>Datos personales propietario</h1>
        </div>
        <div class="col-lg-6 d-flex justify-content-end align-items-center">
            <a href="" class="btn btn-outline-secondary">Editar datos</a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <p>
                Estos datos solo serán para uso de la plataforma, para validar información o por si tuviésemos que contactar contigo.
            </p>
        </div>
    </div>
    <div class="row border p-2">
        <div class="col-md-6 mb-2">
            <input type="date" class="form-control" placeholder="Fecha de nacimiento">
        </div>
        <div class="col-md-6 mb-2">
            <select name="" id="" class="form-control form-select">
                <option value="">Seleccione su género</option>
                <option value="">Hombre</option>
                <option value="">Mujer</option>
                <option value="">Otro</option>
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Teléfono personal">
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Cédula de identidad">
        </div>
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Teléfono profesional">
        </div>
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Email">
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <h5>Datos clínica/centro</h5>
        </div>
    </div>

    <div class="row mt-2 border p-2">
        <div class="col-lg-12">
            <h6>Clínica/centro 1</h6>
        </div>
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Nombre clinica/centro">
        </div>    
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Número RUC">
        </div> 
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Especialización">
        </div> 
        <div class="col-md-4 mb-2">
            <input type="file" class="form-control" placeholder="Licencia (opción de subir documento)">
        </div>   
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Dirección escrita">
        </div> 
        <div class="col-md-6 mb-2">
            <input type="text" class="form-control" placeholder="Dirección en Google maps">
        </div>  
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Imágenes">
        </div> 
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Imagen corporativa/logo del consultorio">
        </div> 
        <div class="col-md-4 mb-2">
            <input type="text" class="form-control" placeholder="Clínica/edificio">
        </div> 
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Información adicional">
        </div> 
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Listado de servicios">
        </div> 
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <h5>Seguros</h5>
        </div>
    </div>

    <div class="row mt-2 border p-2">
        <div class="col-md-12">
            <select class="form-control form-select" name="" id="">
                @foreach ($seguros as $seguro)
                    <option value="{{ $seguro->id }}">{{ $seguro->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <h5>Horario de atención</h5>
        </div>
    </div>
    <div class="row mt-2 border p-2">
        <div class="col-md-12">
            <input type="text" class="form-control" placeholder="Horarios">
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <h5>Validación profesional</h5>
        </div>
    </div>
    <div class="row mt-2 border p-2">
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Subir certificado del SRI con el RUC">
        </div>
        <div class="col-md-12 mb-2">
            <input type="text" class="form-control" placeholder="Subir licencia del centro">
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <h5>Usuarios de gestión</h5>
        </div>
    </div>
    <div class="row mt-2 border p-2">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Usuario">
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Contraseña">
        </div>
    </div>

    <div class="row mt-2 border p-2">
        <div class="col-lg-12 w-100">
            <a href="" class="btn btn-dark w-100">Añadir nuevo usuario de administración</a>
        </div>
    </div>

@stop
