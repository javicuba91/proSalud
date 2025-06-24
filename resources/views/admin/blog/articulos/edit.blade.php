@extends('adminlte::page')

@section('title', 'Editar Artículo del Blog')

@section('content_header')
    <h1>Editar Artículo del Blog</h1>
@stop

@section('css')
    <!-- Include TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
@stop

@section('content')
    <form action="{{ route('blog.articulos.update', $articulo) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Columna principal -->
            <div class="col-lg-8">
                <!-- Información básica -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Información Básica</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="titulo">Título *</label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror"
                                   id="titulo" name="titulo" value="{{ old('titulo', $articulo->titulo) }}" required>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="resumen">Resumen *</label>
                            <textarea class="form-control @error('resumen') is-invalid @enderror"
                                      id="resumen" name="resumen" rows="3" maxlength="500" required>{{ old('resumen', $articulo->resumen) }}</textarea>
                            <small class="form-text text-muted">Máximo 500 caracteres</small>
                            @error('resumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contenido">Contenido *</label>
                            <textarea class="form-control @error('contenido') is-invalid @enderror"
                                      id="contenido" name="contenido" rows="10" required>{{ old('contenido', $articulo->contenido) }}</textarea>
                            @error('contenido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Configuración SEO</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="seo_title">Meta Título</label>
                            <input type="text" class="form-control @error('seo_title') is-invalid @enderror"
                                   id="seo_title" name="seo_title" value="{{ old('seo_title', $articulo->seo['title'] ?? '') }}" maxlength="60">
                            <small class="form-text text-muted">Máximo 60 caracteres</small>
                            @error('seo_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="seo_description">Meta Descripción</label>
                            <textarea class="form-control @error('seo_description') is-invalid @enderror"
                                      id="seo_description" name="seo_description" rows="2" maxlength="160">{{ old('seo_description', $articulo->seo['description'] ?? '') }}</textarea>
                            <small class="form-text text-muted">Máximo 160 caracteres</small>
                            @error('seo_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="seo_keywords">Palabras Clave</label>
                            <input type="text" class="form-control @error('seo_keywords') is-invalid @enderror"
                                   id="seo_keywords" name="seo_keywords" value="{{ old('seo_keywords', $articulo->seo['keywords'] ?? '') }}"
                                   placeholder="palabra1, palabra2, palabra3">
                            <small class="form-text text-muted">Separadas por comas</small>
                            @error('seo_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Publicación -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Publicación</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="estado">Estado *</label>
                            <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                                <option value="borrador" {{ old('estado', $articulo->estado) == 'borrador' ? 'selected' : '' }}>Borrador</option>
                                <option value="publicado" {{ old('estado', $articulo->estado) == 'publicado' ? 'selected' : '' }}>Publicado</option>
                                <option value="archivado" {{ old('estado', $articulo->estado) == 'archivado' ? 'selected' : '' }}>Archivado</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fecha_publicacion">Fecha de Publicación</label>
                            <input type="datetime-local" class="form-control @error('fecha_publicacion') is-invalid @enderror"
                                   id="fecha_publicacion" name="fecha_publicacion"
                                   value="{{ old('fecha_publicacion', $articulo->fecha_publicacion ? $articulo->fecha_publicacion->format('Y-m-d\TH:i') : '') }}">
                            <small class="form-text text-muted">Si se deja vacío y el estado es "Publicado", se usará la fecha actual</small>
                            @error('fecha_publicacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="destacado" name="destacado" value="1"
                                       {{ old('destacado', $articulo->destacado) ? 'checked' : '' }}>
                                <label class="form-check-label" for="destacado">
                                    Artículo destacado
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="permite_comentarios" name="permite_comentarios" value="1"
                                       {{ old('permite_comentarios', $articulo->permite_comentarios) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permite_comentarios">
                                    Permitir comentarios
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Estadísticas</label>
                            <ul class="list-unstyled">
                                <li><strong>Vistas:</strong> {{ $articulo->vistas }}</li>
                                <li><strong>Tiempo de lectura:</strong> {{ $articulo->tiempo_lectura }} min</li>
                                <li><strong>Creado:</strong> {{ $articulo->created_at->format('d/m/Y H:i') }}</li>
                                <li><strong>Actualizado:</strong> {{ $articulo->updated_at->format('d/m/Y H:i') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Categoría -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categoría</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="categoria_id">Categoría *</label>
                            <select name="categoria_id" id="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror" required>
                                <option value="">Seleccionar categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                            {{ old('categoria_id', $articulo->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Etiquetas -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Etiquetas</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            @foreach($etiquetas as $etiqueta)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="etiqueta_{{ $etiqueta->id }}"
                                           name="etiquetas[]" value="{{ $etiqueta->id }}"
                                           {{ in_array($etiqueta->id, old('etiquetas', $articulo->etiquetas->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="etiqueta_{{ $etiqueta->id }}">
                                        <span class="badge" style="background-color: {{ $etiqueta->color }}">
                                            {{ $etiqueta->nombre }}
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Imagen destacada -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Imagen Destacada</h3>
                    </div>
                    <div class="card-body">
                        @if($articulo->imagen_destacada)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $articulo->imagen_destacada) }}"
                                     alt="{{ $articulo->titulo }}" class="img-fluid rounded">
                                <small class="form-text text-muted">Imagen actual</small>
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="file" class="form-control-file @error('imagen_destacada') is-invalid @enderror"
                                   id="imagen_destacada" name="imagen_destacada" accept="image/*">
                            <small class="form-text text-muted">
                                Formatos: JPG, PNG, GIF. Máximo: 2MB
                                @if($articulo->imagen_destacada)
                                    <br>Deja vacío para mantener la imagen actual
                                @endif
                            </small>
                            @error('imagen_destacada')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="preview-imagen" style="display: none;">
                            <img id="preview" src="" alt="Preview" class="img-fluid rounded">
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="card">
                    <div class="card-body">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-save"></i> Actualizar Artículo
                            </button>
                            <a href="{{ route('blog.articulos.index') }}" class="btn btn-secondary btn-block">
                                <i class="fa fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('js')
<script>
    // TinyMCE
    tinymce.init({
        selector: '#contenido',
        height: 400,
        plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_css: 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'
    });

    // Preview de imagen
    document.getElementById('imagen_destacada').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview-imagen').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('preview-imagen').style.display = 'none';
        }
    });
</script>
@stop
