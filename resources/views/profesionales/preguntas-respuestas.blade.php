@extends('adminlte::page')

@section('title', 'Preguntas y Respuestas de Expertos')

@section('content_header')
    <h1>Preguntas y Respuestas de Expertos</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="preguntas-tab" data-toggle="tab" href="#preguntas" role="tab" aria-controls="preguntas" aria-selected="true">
                    <i class="fas fa-question-circle"></i> Preguntas sin responder
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mis-respuestas-tab" data-toggle="tab" href="#mis-respuestas" role="tab" aria-controls="mis-respuestas" aria-selected="false">
                    <i class="fas fa-reply"></i> Mis respuestas
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content mt-3" id="myTabContent">
            <!-- Preguntas sin responder -->
            <div class="tab-pane fade show active" id="preguntas" role="tabpanel" aria-labelledby="preguntas-tab">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-question-circle"></i>
                            Preguntas de tu especialidad pendientes de respuesta
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($preguntas->count() > 0)
                            @foreach($preguntas as $pregunta)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge badge-primary">{{ $pregunta->especialidad->nombre }}</span>
                                                @if($pregunta->subespecialidad)
                                                    <span class="badge badge-secondary">{{ $pregunta->subespecialidad->nombre }}</span>
                                                @endif
                                            </div>
                                            <small class="text-muted">{{ $pregunta->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Pregunta:</h5>
                                        <p class="card-text">{{ $pregunta->pregunta }}</p>

                                        @php
                                            $yaRespondida = $pregunta->respuestas->where('profesional_id', $profesional->id)->count() > 0;
                                        @endphp

                                        @if(!$yaRespondida)
                                            <button class="btn btn-success btn-sm" onclick="mostrarFormularioRespuesta({{ $pregunta->id }})">
                                                <i class="fas fa-reply"></i> Responder
                                            </button>
                                        @else
                                            <span class="badge badge-success">
                                                <i class="fas fa-check"></i> Ya respondida por ti
                                            </span>
                                        @endif

                                        <!-- Formulario de respuesta (inicialmente oculto) -->
                                        <div id="form-respuesta-{{ $pregunta->id }}" class="mt-3" style="display: none;">
                                            <div class="form-group">
                                                <label for="respuesta-{{ $pregunta->id }}">Tu respuesta:</label>
                                                <textarea class="form-control" id="respuesta-{{ $pregunta->id }}" rows="4" placeholder="Escribe tu respuesta aquí..."></textarea>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-sm" onclick="enviarRespuesta({{ $pregunta->id }})">
                                                <i class="fas fa-paper-plane"></i> Enviar respuesta
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-sm" onclick="ocultarFormularioRespuesta({{ $pregunta->id }})">
                                                Cancelar
                                            </button>
                                        </div>

                                        <!-- Mostrar otras respuestas si existen -->
                                        @if($pregunta->respuestas->count() > 0)
                                            <div class="mt-3">
                                                <h6>Otras respuestas de profesionales:</h6>
                                                @foreach($pregunta->respuestas as $respuesta)
                                                    <div class="alert alert-info">
                                                        <strong>Dr. {{ $respuesta->profesional->nombre_completo }}</strong>
                                                        <small class="text-muted">({{ $respuesta->created_at->format('d/m/Y H:i') }})</small>
                                                        <p class="mb-0 mt-2">{{ $respuesta->respuesta }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <!-- Paginación -->
                            <div class="d-flex justify-content-center">
                                {{ $preguntas->links() }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                No hay preguntas pendientes de tu especialidad en este momento.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Mis respuestas -->
            <div class="tab-pane fade" id="mis-respuestas" role="tabpanel" aria-labelledby="mis-respuestas-tab">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-reply"></i>
                            Mis respuestas enviadas
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($misRespuestas->count() > 0)
                            @foreach($misRespuestas as $respuesta)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge badge-primary">{{ $respuesta->pregunta->especialidad->nombre }}</span>
                                                @if($respuesta->pregunta->subespecialidad)
                                                    <span class="badge badge-secondary">{{ $respuesta->pregunta->subespecialidad->nombre }}</span>
                                                @endif
                                            </div>
                                            <small class="text-muted">Respondida el {{ $respuesta->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="text-muted">Pregunta original:</h6>
                                        <p class="text-muted">{{ $respuesta->pregunta->pregunta }}</p>

                                        <h6 class="text-primary">Tu respuesta:</h6>
                                        <div class="alert alert-success">
                                            {{ $respuesta->respuesta }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Paginación -->
                            <div class="d-flex justify-content-center">
                                {{ $misRespuestas->links() }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                Aún no has respondido ninguna pregunta.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .nav-tabs .nav-link {
        color: #6c757d;
    }
    .nav-tabs .nav-link.active {
        color: #007bff;
        border-color: #007bff #007bff #fff;
    }
    .card {
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    }
</style>
@stop

@section('js')
<script>
// Funciones para manejar los formularios de respuesta
function mostrarFormularioRespuesta(preguntaId) {
    document.getElementById('form-respuesta-' + preguntaId).style.display = 'block';
}

function ocultarFormularioRespuesta(preguntaId) {
    document.getElementById('form-respuesta-' + preguntaId).style.display = 'none';
    document.getElementById('respuesta-' + preguntaId).value = '';
}

function enviarRespuesta(preguntaId) {
    const respuesta = document.getElementById('respuesta-' + preguntaId).value.trim();

    if (respuesta.length < 10) {
        Swal.fire({
            icon: 'warning',
            title: 'Respuesta muy corta',
            text: 'La respuesta debe tener al menos 10 caracteres.'
        });
        return;
    }

    // Mostrar loading
    Swal.fire({
        title: 'Enviando respuesta...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });

    // Enviar respuesta via AJAX
    fetch('{{ route("profesionales.responderPregunta") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            pregunta_id: preguntaId,
            respuesta: respuesta
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: '¡Respuesta enviada!',
                text: data.message,
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.reload(); // Recargar la página para mostrar la respuesta
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al enviar la respuesta. Por favor, inténtalo de nuevo.'
        });
        console.error('Error:', error);
    });
}

// Inicializar Bootstrap tabs si es necesario
document.addEventListener('DOMContentLoaded', function() {
    // Usar jQuery si está disponible (AdminLTE lo incluye)
    if (typeof $ !== 'undefined') {
        $('#myTab a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    }
});
</script>
@stop
