@extends('adminlte::page')

@section('title', 'Ver Artículo del Blog')

@section('content_header')
    <h1>{{ $articulo->titulo }}</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('blog.articulos.edit', $articulo) }}" class="btn btn-warning mr-2">
            <i class="fa fa-edit"></i> Editar
        </a>
        <a href="{{ route('blog.articulos.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Volver
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <!-- Contenido principal -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    @if($articulo->imagen_destacada)
                        <div class="mb-4">
                            <img src="{{ asset($articulo->imagen_destacada) }}"
                                 alt="{{ $articulo->titulo }}" class="img-fluid rounded">
                        </div>
                    @endif

                    <div class="mb-3">
                        <span class="badge" style="background-color: {{ $articulo->categoria->color }}">
                            {{ $articulo->categoria->nombre }}
                        </span>
                        @if($articulo->destacado)
                            <span class="badge badge-warning ml-1">Destacado</span>
                        @endif
                    </div>

                    <div class="mb-4">
                        <h5>Resumen</h5>
                        <p class="text-muted">{{ $articulo->resumen }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Contenido</h5>
                        <div class="content">
                            {!! $articulo->contenido !!}
                        </div>
                    </div>

                    @if($articulo->etiquetas->count() > 0)
                        <div class="mb-3">
                            <h6>Etiquetas:</h6>
                            @foreach($articulo->etiquetas as $etiqueta)
                                <span class="badge mr-1" style="background-color: {{ $etiqueta->color }}">
                                    {{ $etiqueta->nombre }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Información del artículo -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Información del Artículo</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-6">Estado:</dt>
                        <dd class="col-sm-6">
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
                        </dd>

                        <dt class="col-sm-6">Autor:</dt>
                        <dd class="col-sm-6">{{ $articulo->autor->name }}</dd>

                        <dt class="col-sm-6">Vistas:</dt>
                        <dd class="col-sm-6">{{ $articulo->vistas }}</dd>

                        <dt class="col-sm-6">Tiempo de lectura:</dt>
                        <dd class="col-sm-6">{{ $articulo->tiempo_lectura }} min</dd>

                        @if($articulo->fecha_publicacion)
                            <dt class="col-sm-6">Fecha publicación:</dt>
                            <dd class="col-sm-6">{{ $articulo->fecha_publicacion->format('d/m/Y H:i') }}</dd>
                        @endif

                        <dt class="col-sm-6">Creado:</dt>
                        <dd class="col-sm-6">{{ $articulo->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-6">Actualizado:</dt>
                        <dd class="col-sm-6">{{ $articulo->updated_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-6">Comentarios:</dt>
                        <dd class="col-sm-6">
                            @if($articulo->permite_comentarios)
                                <span class="badge badge-success">Habilitados</span>
                            @else
                                <span class="badge badge-secondary">Deshabilitados</span>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>

            @if($articulo->seo && (isset($articulo->seo['title']) || isset($articulo->seo['description']) || isset($articulo->seo['keywords'])))
                <!-- Información SEO -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">SEO</h3>
                    </div>
                    <div class="card-body">
                        @if(isset($articulo->seo['title']) && $articulo->seo['title'])
                            <div class="mb-2">
                                <strong>Meta Título:</strong><br>
                                <small>{{ $articulo->seo['title'] }}</small>
                            </div>
                        @endif

                        @if(isset($articulo->seo['description']) && $articulo->seo['description'])
                            <div class="mb-2">
                                <strong>Meta Descripción:</strong><br>
                                <small>{{ $articulo->seo['description'] }}</small>
                            </div>
                        @endif

                        @if(isset($articulo->seo['keywords']) && $articulo->seo['keywords'])
                            <div class="mb-2">
                                <strong>Palabras Clave:</strong><br>
                                <small>{{ $articulo->seo['keywords'] }}</small>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Acciones -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Acciones</h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('blog.articulos.edit', $articulo) }}" class="btn btn-warning btn-block">
                            <i class="fa fa-edit"></i> Editar Artículo
                        </a>

                        <form action="{{ route('blog.articulos.duplicar', $articulo) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info btn-block">
                                <i class="fa fa-copy"></i> Duplicar Artículo
                            </button>
                        </form>

                        @if($articulo->estado === 'borrador')
                            <form action="{{ route('blog.articulos.cambiarEstado', $articulo) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="estado" value="publicado">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fa fa-check"></i> Publicar
                                </button>
                            </form>
                        @elseif($articulo->estado === 'publicado')
                            <form action="{{ route('blog.articulos.cambiarEstado', $articulo) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="estado" value="archivado">
                                <button type="submit" class="btn btn-secondary btn-block">
                                    <i class="fa fa-archive"></i> Archivar
                                </button>
                            </form>
                        @endif

                        <hr>

                        <form action="{{ route('blog.articulos.destroy', $articulo) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block"
                                    onclick="return confirm('¿Está seguro de eliminar este artículo?')">
                                <i class="fa fa-trash"></i> Eliminar Artículo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    .content img {
        max-width: 100%;
        height: auto;
    }

    .content {
        line-height: 1.6;
    }

    .content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .content p {
        margin-bottom: 1rem;
    }
</style>
@stop
