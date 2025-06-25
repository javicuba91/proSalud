@extends('frontend.pacientes.layout')

@section('title', $articulo->titulo)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <h1 class="mb-3 fw-bold">{{ $articulo->titulo }}</h1>

            <div class="mb-4 text-muted small">
                Publicado el {{ $articulo->fecha_publicacion->format('d M Y') }}
                @if ($articulo->autor)
                    por <strong>{{ $articulo->autor->name }}</strong>
                @endif
            </div>

            @if ($articulo->imagen_destacada)
                <img src="{{ asset($articulo->imagen_destacada) }}" alt="{{ $articulo->titulo }}" class="img-fluid rounded mb-4 w-100">
            @endif

            <div class="mb-5 contenido-articulo">
                {!! nl2br($articulo->contenido) !!}
            </div>

            @if ($articulo->etiquetas->count())
                <div class="mb-5">
                    <strong>Etiquetas:</strong>
                    @foreach ($articulo->etiquetas as $etiqueta)
                        <span class="badge bg-light text-dark border me-1">{{ $etiqueta->nombre }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @if ($relacionados->count())
        <div class="row mt-5">
            <h3 class="mb-4 text-center">También te puede interesar</h3>
            @foreach ($relacionados as $rel)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <a href="{{ route('blog.detalle', $rel->slug) }}">
                            <img src="{{ asset($rel->imagen_destacada) }}" class="card-img-top" alt="{{ $rel->titulo }}">
                        </a>
                        <div class="card-body">
                            <h6 class="card-title mb-2">
                                <a href="{{ route('blog.detalle', $rel->slug) }}" class="text-dark text-decoration-none">
                                    {{ $rel->titulo }}
                                </a>
                            </h6>
                            <p class="small text-muted">{{ $rel->fecha_publicacion->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
