@extends('adminlte::page')

@section('title', 'Etiquetas del Blog')

@section('content_header')
    <h1>Etiquetas del Blog</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('blog.etiquetas.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Crear Etiqueta
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

    <div class="card">
        <div class="card-body">
            <table id="etiquetas" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Color</th>
                        <th>Artículos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($etiquetas as $etiqueta)
                        <tr>
                            <td>
                                <span class="badge" style="background-color: {{ $etiqueta->color }}">
                                    {{ $etiqueta->nombre }}
                                </span>
                            </td>
                            <td>{{ Str::limit($etiqueta->descripcion, 50) }}</td>
                            <td>{{ $etiqueta->color }}</td>
                            <td>
                                <span class="badge badge-info">{{ $etiqueta->articulos->count() }}</span>
                            </td>
                            <td>
                                <a href="{{ route('blog.etiquetas.show', $etiqueta) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('blog.etiquetas.edit', $etiqueta) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('blog.etiquetas.destroy', $etiqueta) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('¿Está seguro de eliminar esta etiqueta?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#etiquetas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            }
        });
    });
</script>
@stop
