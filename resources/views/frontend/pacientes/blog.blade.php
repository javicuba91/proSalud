@extends('frontend.pacientes.layout')

@section('title', 'Blog')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Blog</h2>

    {{-- Filtros --}}
    <form method="GET" class="mb-4 row g-3">
        <div class="col-md-3">
            <select name="categoria" class="form-control">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-7">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar..." value="{{ request('buscar') }}">
        </div>

        <div class="col-md-2">
            <button class="btn btn-dark w-100"><i class="fa fa-search"></i> Filtrar</button>
        </div>
    </form>

    {{-- Listado de artículos --}}
    <div class="row">
        @forelse($articulos as $articulo)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($articulo->imagen_destacada)
                        <img src="{{ asset($articulo->imagen_destacada) }}" class="card-img-top" alt="{{ $articulo->titulo }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('blog.detalle', $articulo->slug) }}" class="text-decoration-none text-dark">
                                {{ $articulo->titulo }}
                            </a>
                        </h5>

                        <p class="text-muted small mb-2">
                            <i class="fas fa-user"></i> {{ $articulo->autor->name ?? 'Sin autor' }} |
                            <i class="fas fa-calendar-alt"></i> {{ $articulo->fecha_publicacion->format('d/m/Y') }} |
                            <i class="fas fa-folder-open"></i> {{ $articulo->categoria->nombre ?? 'Sin categoría' }}
                        </p>

                        <p class="card-text flex-grow-1">{{ $articulo->resumenCorto }}</p>

                        <div class="d-flex justify-content-between align-items-center mt-3">                          
                            <a href="{{ route('blog.detalle', $articulo->slug) }}" class="btn btn-sm btn-outline-primary">
                                Leer más
                            </a>
                        </div>
                        <hr>
                        @if($articulo->etiquetas->count())
                            <div class="">
                                @foreach($articulo->etiquetas as $etiqueta)
                                    <span class="badge bg-light text-dark border">
                                        #{{ $etiqueta->nombre }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>No se encontraron artículos.</p>
            </div>
        @endforelse
    </div>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $articulos->appends(request()->query())->links() }}
    </div>
</div>
@endsection
