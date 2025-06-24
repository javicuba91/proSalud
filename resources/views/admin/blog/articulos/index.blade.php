@extends('adminlte::page')

@section('title', 'Artículos del Blog')

@section('content_header')
    <h1>Artículos del Blog</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('blog.articulos.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Crear Artículo
        </a>
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Filtros -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filtros</h3>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('blog.articulos.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="">Todas las categorías</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                            {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="">Todos los estados</option>
                                <option value="borrador" {{ request('estado') == 'borrador' ? 'selected' : '' }}>Borrador</option>
                                <option value="publicado" {{ request('estado') == 'publicado' ? 'selected' : '' }}>Publicado</option>
                                <option value="archivado" {{ request('estado') == 'archivado' ? 'selected' : '' }}>Archivado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <select name="autor" id="autor" class="form-control">
                                <option value="">Todos los autores</option>
                                @foreach($autores as $autor)
                                    <option value="{{ $autor->id }}"
                                            {{ request('autor') == $autor->id ? 'selected' : '' }}>
                                        {{ $autor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="buscar">Buscar</label>
                            <input type="text" name="buscar" id="buscar" class="form-control"
                                   value="{{ request('buscar') }}" placeholder="Título, resumen o contenido">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i> Filtrar
                        </button>
                        <a href="{{ route('blog.articulos.index') }}" class="btn btn-secondary">
                            <i class="fa fa-undo"></i> Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista de artículos -->
    <div class="card">
        <div class="card-body">
            @if($articulos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Título</th>
                                <th>Categoría</th>
                                <th>Autor</th>
                                <th>Estado</th>
                                <th>Vistas</th>
                                <th>Fecha Pub.</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articulos as $articulo)
                                <tr>
                                    <td>
                                        @if($articulo->imagen_destacada)
                                            <img src="{{ asset('storage/' . $articulo->imagen_destacada) }}"
                                                 alt="{{ $articulo->titulo }}" class="img-thumbnail"
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light text-center" style="width: 50px; height: 50px; line-height: 50px;">
                                                <i class="fa fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $articulo->titulo }}</strong>
                                        @if($articulo->destacado)
                                            <span class="badge badge-warning ml-1">Destacado</span>
                                        @endif
                                        <br>
                                        <small class="text-muted">{{ $articulo->resumen_corto }}</small>
                                    </td>
                                    <td>
                                        <span class="badge" style="background-color: {{ $articulo->categoria->color }}">
                                            {{ $articulo->categoria->nombre }}
                                        </span>
                                    </td>
                                    <td>{{ $articulo->autor->name }}</td>
                                    <td>
                                        @switch($articulo->estado)
                                            @case('borrador')
                                                <span class="badge badge-secondary">Borrador</span>
                                                @break
                                            @case('publicado')
                                                <span class="badge badge-success">Publicado</span>
                                                @break
                                            @case('archivado')
                                                <span class="badge badge-dark">Archivado</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $articulo->vistas }}</span>
                                    </td>
                                    <td>
                                        @if($articulo->fecha_publicacion)
                                            {{ $articulo->fecha_publicacion->format('d/m/Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('blog.articulos.show', $articulo) }}"
                                               class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('blog.articulos.edit', $articulo) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="fa fa-cog"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <form action="{{ route('blog.articulos.duplicar', $articulo) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa fa-copy"></i> Duplicar
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('blog.articulos.destroy', $articulo) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"
                                                            onclick="return confirm('¿Está seguro de eliminar este artículo?')">
                                                        <i class="fa fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-center">
                    {{ $articulos->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fa fa-file-text fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay artículos para mostrar</h5>
                    <p class="text-muted">Crea tu primer artículo para comenzar.</p>
                    <a href="{{ route('blog.articulos.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Crear Artículo
                    </a>
                </div>
            @endif
        </div>
    </div>
@stop
