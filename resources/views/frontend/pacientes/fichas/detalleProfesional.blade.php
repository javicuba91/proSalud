@extends('frontend.pacientes.layout')

<title>@yield('title', 'ProSalud - Ficha del Profesional: '){{ $profesional->nombre_completo }}</title>


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4>{{ $profesional->nombre_completo }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6" id="col-listado">

            <div class="listadoMedicos">

                <div class="row mt-2">

                    <div class="col-md-12 mb-3">
                        <div class="card border position-relative">
                            <!-- Ícono de favorito -->
                            <a href="#" class="position-absolute top-0 end-0 m-2 text-danger"
                                title="Añadir a favoritos">
                                <i class="fas fa-heart fa-2x"></i>
                            </a>

                            <div class="card-body">
                                <img src="{{ asset($profesional->foto) }}" class="img img-fluid profile-image mb-2"
                                    alt="">

                                <h5>{{ $profesional->nombre_completo }}</h5>

                                <p>Número colegiado: {{ $profesional->num_colegiado }}</p>

                                <p>Modalidades:
                                    Presencial:
                                    @if ($profesional->presencial == 1)
                                        <i class="fa fa-check text-success"></i>
                                    @else
                                        <i class="fa fa-remove text-danger"></i>
                                    @endif
                                    &nbsp;&nbsp;
                                    VideoConsulta:
                                    @if ($profesional->videoconsulta == 1)
                                        <i class="fa fa-check text-success"></i>
                                    @else
                                        <i class="fa fa-remove text-danger"></i>
                                    @endif
                                </p>

                                <p>Seguros:
                                    @foreach ($profesional->segurosMedicos as $seguro)
                                        <span
                                            class="badge bg-primary">{{ ucfirst(strtolower($seguro->nombre)) }}{{ !$loop->last ? ',' : '' }}</span>
                                    @endforeach
                                </p>

                                <p>Consultorios:
                                <ul>
                                    @foreach ($profesional->consultorios as $consultorio)
                                        <li>Consultorio {{ $loop->index + 1 }}, {{$consultorio->clinica}}, {{ ucfirst($consultorio->direccion) }}{{ !$loop->last ? ',' : '' }}
                                        </li>
                                    @endforeach
                                </ul>
                                </p>

                                @php
                                    $promedio = round($profesional->valoraciones->avg('puntuacion'), 1);
                                    $entero = floor($promedio);
                                    $decimal = $promedio - $entero;
                                @endphp

                                <p>Valoraciones:
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $entero)
                                            <i class="fas fa-star text-warning"></i>
                                        @elseif ($i == $entero + 1 && $decimal >= 0.5)
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    ({{ number_format($promedio, 1) }})
                                </p>

                                <p>Idiomas: {{ $profesional->idiomas }}</p>

                                <p>Provincia: {{ $profesional->ciudad->provincia->nombre }}</p>
                                <p>Ciudad: {{ $profesional->ciudad->nombre }}</p>

                                <p>Especialidades:
                                    @foreach ($profesional->especializaciones as $esp)
                                        {{ $esp->especialidad->nombre }}{{ !$loop->last ? ',' : '' }}
                                    @endforeach
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="card border position-relative">
                            <div class="card-body">
                                <h5><i class="fa fa-graduation-cap"></i> Currículum</h5>

                                @if ($profesional->especializaciones->count() > 0)
                                    <p class="mb-0 mt-3"><b class="text-primary">Especialización:</b> </p>
                                    <ul>
                                        @foreach ($profesional->especializaciones as $esp)
                                            <li>{{ $esp->especialidad->nombre }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($profesional->titulosUniversitarios->count() > 0)
                                    <p class="mb-0 mt-3"><b class="text-primary">Títulos:</b> </p>
                                    <ul>
                                        @foreach ($profesional->titulosUniversitarios as $titulo)
                                            <li>{{ $titulo->nombre }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($profesional->formacionesAdicionales->where('tipo', 'curso')->count() > 0)
                                    <p class="mb-0 mt-3"><b class="text-primary">Cursos:</b> </p>
                                    <ul>
                                        @foreach ($profesional->formacionesAdicionales->where('tipo', 'curso') as $curso)
                                            <li>{{ $curso->nombre }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($profesional->formacionesAdicionales->where('tipo', 'master')->count() > 0)
                                    <p class="mb-0 mt-3"><b class="text-primary">Másters:</b> </p>
                                    <ul>
                                        @foreach ($profesional->formacionesAdicionales->where('tipo', 'master') as $master)
                                            <li>{{ $master->nombre }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($profesional->formacionesAdicionales->where('tipo', 'taller')->count() > 0)
                                    <p class="mb-0 mt-3"><b class="text-primary">Talleres:</b> </p>
                                    <ul>
                                        @foreach ($profesional->formacionesAdicionales->where('tipo', 'taller') as $taller)
                                            <li>{{ $taller->nombre }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($profesional->formacionesAdicionales->where('tipo', 'seminario')->count() > 0)
                                    <p class="mb-0 mt-3"><b class="text-primary">Seminario:</b> </p>
                                    <ul>
                                        @foreach ($profesional->formacionesAdicionales->where('tipo', 'seminario') as $seminario)
                                            <li>{{ $seminario->nombre }}</li>
                                        @endforeach
                                    </ul>
                                @endif


                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="card border position-relative">
                            <div class="card-body">
                                <h5 class="text-primary"><i class="fa fa-images"></i> Imágenes Consultorios</h5>
                                
                                <div class="row">
                                    @foreach ($profesional->consultorios as $consultorio)
                                        <h6>Consultorio {{ $loop->index + 1 }}, {{$consultorio->clinica}}, {{ ucfirst($consultorio->direccion) }}{{ !$loop->last ? ',' : '' }}</h6>
                                        @php
                                            $imagenes = App\Models\ConsultorioImagen::where('consultorio_id', $consultorio->id)->get();
                                        @endphp
                                        @foreach ($imagenes as $imagen)
                                            <div class="col-lg-6 position-relative mb-3">
                                                <img src="{{ asset($imagen->imagen_path) }}" alt="Imagen"
                                                    class="img img-thumbnail w-100 shadow imgConsultorio">
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                           
                            </div>
                        </div>
                    </div>



                    <div class="col-md-12 mb-3">
                        <div class="card border position-relative">
                            <div class="card-body">
                                <h5><i class="fa fa-map-marker"></i> Consultorios</h5>
                                <div class="mt-4 sticky-map" id="map" style="height: 400px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="card border position-relative">
                            <div class="card-body">

                                {{-- Calcular promedio --}}
                                @php
                                    $promedio = $profesional->valoraciones->avg('puntuacion') ?? 0;
                                    $entero = floor($promedio);
                                    $decimal = $promedio - $entero;
                                @endphp

                                {{-- Título + Promedio de estrellas --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">
                                        <i class="fas fa-star me-2 text-warning"></i>Opiniones
                                    </h5>
                                    <div>
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $entero)
                                                <i class="fas fa-star text-warning"></i>
                                            @elseif ($i == $entero + 1 && $decimal >= 0.5)
                                                <i class="fas fa-star-half-alt text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-1 text-muted">({{ number_format($promedio, 1) }})</span>
                                    </div>
                                </div>

                                {{-- Opiniones --}}
                                @forelse ($profesional->valoraciones->sortByDesc('fecha') as $valoracion)
                                    @php
                                        $entero = floor($valoracion->puntuacion);
                                        $decimal = $valoracion->puntuacion - $entero;
                                        $nombre = $valoracion->paciente->nombre_completo ?? 'N/A';

                                    @endphp

                                    <div class="d-flex justify-content-between align-items-start p-3 border rounded mb-3 bg-white shadow-sm">
                                        <div class="me-3">
                                            <div class="mb-1">
                                                {{-- Estrellas por reseña --}}
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $entero)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @elseif ($i == $entero + 1 && $decimal >= 0.5)
                                                        <i class="fas fa-star-half-alt text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-warning"></i>
                                                    @endif
                                                @endfor
                                            </div>

                                            <div class="text-muted">
                                                <i class="fas fa-quote-left me-2 text-secondary"></i>
                                                {{ $valoracion->comentario }}
                                            </div>

                                            <div class="mt-2 text-secondary small fw-bold">
                                                {{ $nombre }} &nbsp; {{ date('d/m/Y', strtotime($valoracion->fecha)) }}
                                            </div>
                                        </div>

                                        <div class="text-success fw-semibold small d-flex align-items-center">
                                            <i class="fas fa-thumbs-up me-1"></i>
                                            Verificada
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">No hay valoraciones disponibles.</p>
                                @endforelse

                            </div>
                        </div>
                    </div>



                </div>

            </div>

        </div>

        <div class="col-lg-6" id="col-citas">

            <div class="card shadow-sm p-3 mt-2">

                    <div class="btn-group mb-3 w-100" role="group">
                        <button type="button" class="btn btn-warning text-white fw-bold" id="btn-tab-presencial">Cita presencial</button>
                        <button type="button" class="btn btn-outline-secondary fw-bold" id="btn-tab-videoconsulta">VideoConsulta</button>
                    </div>

                    {{-- FORMULARIO: CITA PRESENCIAL --}}
                    <div id="form-presencial">
                        <form id="form-agendar-cita">
                            @csrf
                            <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
                            <input type="hidden" name="modalidad" value="presencial">

                            <p class="fw-semibold text-primary mb-2">Pide cita presencial:</p>
                            <p class="small text-muted mb-3">El servicio de gestión de cita es gratuito</p>

                            <div class="border rounded p-2 mb-2">
                                <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                <span class="fw-semibold">Consultorio</span><br>
                                <select name="consultorio_id" class="form-control form-select mt-2">
                                    @foreach ($profesional->consultorios as $consultorio )
                                        <option value="{{ $consultorio->id }}">
                                            {{ $consultorio->clinica }}, {{ ucfirst($consultorio->direccion) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="border rounded p-2 mb-2">
                                <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                <span class="fw-semibold">Especialidad</span><br>
                                <select name="especialidad_id" class="form-control form-select mt-2">
                                    @foreach ($profesional->especializaciones as $especialidad )
                                        <option value="{{ $especialidad->id }}">
                                            {{ $especialidad->especialidad->nombre }} ({{ $especialidad->precio_presencial }}€)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="border rounded p-2 mb-2">
                                <i class="fas fa-edit text-primary me-1"></i>
                                <span class="fw-semibold">Motivo de consulta</span><br>
                                <input placeholder="Explique el motivo de la consulta" type="text" name="motivo" class="form-control mt-2">
                            </div>

                            <div class="border rounded p-2 mb-2">
                                <i class="fas fa-credit-card text-primary me-1"></i>
                                <span class="fw-semibold">Método de pago</span><br>
                                <select name="metodo_pago_id" class="form-select form-control mt-1">
                                    @forelse ($profesional->metodosPago as $metodo)
                                        <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                                    @empty
                                        <option selected>No especificado</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="border rounded p-2 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-calendar text-primary me-1"></i>
                                    <span class="fw-semibold">Disponibilidad</span><br>
                                    <small class="text-muted">Ver disponibilidades</small>
                                </div>
                                <span class="badge bg-dark fs-6" role="button" data-bs-toggle="modal" data-bs-target="#modalVerCalendario">
                                    Ver Calendario
                                </span>
                                <div>
                                    <input id="fecha_hora" class="form-control mt-2" type="datetime-local" name="fecha_hora">
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="btn-agendar-cita" type="button" class="btn btn-dark">Agendar Cita Presencial</button>
                            </div>
                        </form>
                    </div>

                    {{-- FORMULARIO: VIDEOCONSULTA --}}
                    <div id="form-videoconsulta" style="display: none;">
                        <form id="form-agendar-cita-videollamada">
                            @csrf
                            <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
                            <input type="hidden" name="modalidad" value="videoconsulta">

                            <p class="fw-semibold text-primary mb-2">Solicita videoconsulta:</p>
                            <p class="small text-muted mb-3">Recibirás un enlace seguro para acceder a tu cita virtual</p>

                            <div class="border rounded p-2 mb-2">
                                <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                <span class="fw-semibold">Especialidad</span><br>
                                <select name="especialidad_id" class="form-control form-select mt-2">
                                    @foreach ($profesional->especializaciones as $especialidad )
                                        @if ($especialidad->precio_videoconsulta)
                                            <option value="{{ $especialidad->id }}">
                                                {{ $especialidad->especialidad->nombre }} ({{ $especialidad->precio_videoconsulta }}€)
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="border rounded p-2 mb-2">
                                <i class="fas fa-edit text-primary me-1"></i>
                                <span class="fw-semibold">Motivo de consulta</span><br>
                                <input placeholder="Explique el motivo de la consulta" type="text" name="motivo" class="form-control mt-2">
                            </div>

                            <div class="border rounded p-2 mb-2">
                                <i class="fas fa-credit-card text-primary me-1"></i>
                                <span class="fw-semibold">Método de pago</span><br>
                                <select name="metodo_pago_id" class="form-select form-control mt-1">
                                    @forelse ($profesional->metodosPago as $metodo)
                                        <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                                    @empty
                                        <option selected>No especificado</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="border rounded p-2 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-calendar text-primary me-1"></i>
                                    <span class="fw-semibold">Disponibilidad</span><br>
                                    <small class="text-muted">Ver disponibilidades</small>
                                </div>
                                <span class="badge bg-dark fs-6" role="button" data-bs-toggle="modal" data-bs-target="#modalVerCalendarioVideollamada">
                                    Ver Calendario
                                </span>
                                <div>
                                    <input id="fecha_hora_videollamada" class="form-control mt-2" type="datetime-local" name="fecha_hora">
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="btn-agendar-cita-videollamada" type="button" class="btn btn-dark">Agendar Videoconsulta</button>
                            </div>
                        </form>
                    </div>

            </div>


        </div>
    </div>

    <!-- Modal Login -->
        <div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Iniciar sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                <form id="login-form">
                    @csrf
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                        </div>
                    <div class="mb-3">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="text-danger d-none" id="login-error">Credenciales incorrectas</div>
                    <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>
                <a href="/pacientes/registro" class="btn btn-dark">¿No tienes cuenta? Regístrate aquí</a>
                </div>
            </div>
            </div>
        </div>



    <div class="modal fade" id="modalVerCalendario" tabindex="-1" aria-labelledby="modalVerCalendarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seleccionar disponibilidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <div id="calendarioFullCalendar"></div>
                        </div>
                        <div class="col-lg-3">
                            <h6 class="text-center">Horarios disponibles</h6>
                            <ul id="lista-horarios" class="list-group"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="modalVerCalendarioVideollamada" tabindex="-1" aria-labelledby="modalVerCalendarioVideollamadaLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seleccionar disponibilidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <div id="calendarioFullCalendarVideollamada"></div>
                        </div>
                        <div class="col-lg-3">
                            <h6 class="text-center">Horarios disponibles</h6>
                            <ul id="lista-horarios-videollamada" class="list-group"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        const consultorios = @json(
        $profesional->consultorios->map(function ($consultorio) use ($profesional) {
            return [
                'nombre' => $profesional->nombre_completo,
                'direccion' => $consultorio->direccion,
                'logo' => asset($profesional->logo)
            ];
        })
    );

        const map = L.map('map').setView([0, 0], 4);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const bounds = L.latLngBounds();

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        const API_KEY = '7e23c4c064ce4c3a8fa0f7400f082735'; // 🔐 clave OpenCage

        async function geocode(direccion) {
            const url =
                `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(direccion)}&key=${API_KEY}&language=es`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.results && data.results.length > 0) {
                    const location = data.results[0].geometry;
                    return {
                        lat: location.lat,
                        lng: location.lng
                    };
                } else {
                    console.warn("No se encontraron coordenadas para: ", direccion);
                    return null;
                }
            } catch (error) {
                console.error("Error en geocodificación:", error);
                return null;
            }
        }

        async function agregarMarcadores() {
            for (const c of consultorios) {
                const coords = await geocode(c.direccion);

                if (coords) {
                    const marker = L.marker([coords.lat, coords.lng]).addTo(map);
                    marker.bindPopup(`
                        <div style="text-align:center;">
                            <img src="${c.logo}" alt="${c.nombre}" style="width:100px; height:100px; object-fit:cover; border-radius:50%; margin-bottom:5px;"><br>
                            <strong>${c.nombre}</strong><br>
                            <small>${c.direccion}</small>
                        </div>
                    `);

                    bounds.extend([coords.lat, coords.lng]);
                }

                // Espera 1 segundo entre peticiones para evitar saturar el servicio
                await sleep(1000);
            }

            if (bounds.isValid()) {
                map.fitBounds(bounds);
            } else {
                map.setView([0, 0], 6);
            }
        }

        agregarMarcadores();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendarioFullCalendar');
            let fechaSeleccionada = null;

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 600,
                eventDisplay: 'background',
                validRange: {
                    start: new Date().toISOString().split('T')[0] // hoy como mínimo
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '/api/frontend/profesional/horarios/{{$profesional->id}}',
                        method: 'GET',
                        success: function (data) {
                            let eventos = data.map(item => ({
                                title: '',
                                start: item.fecha,
                                allDay: true,
                                backgroundColor: '#8B0000',
                            }));
                            successCallback(eventos);
                        },
                        error: failureCallback
                    });
                },
                dateClick: function (info) {

                    fechaSeleccionada = info.dateStr;

                    $.ajax({
                        url: '/api/frontend/profesional/horarios/{{$profesional->id}}/' + info.dateStr,
                        method: 'GET',
                        success: function (response) {

                            let lista = $('#lista-horarios');
                            lista.empty();

                            if (response.length === 0) {
                                lista.append('<li class="list-group-item text-muted">Sin horarios</li>');
                            } else {
                                response.forEach((horario, index) => {
                                let turnosHtml = horario.turnos.map(t => `
                                    <button class="btn btn-outline-success btn-sm m-1 btn-turno" data-hora="${t}">
                                        ${t}
                                    </button>
                                `).join('');

                                lista.append(`
                                    <li class="list-group-item">
                                        <strong>${horario.desde} - ${horario.hasta}</strong><br>
                                        <small>${horario.consultorio}</small>
                                        <div class="mt-2">${turnosHtml}</div>
                                    </li>
                                `);
                            });
                            }
                        }
                    });
                }

             });

            $('#modalVerCalendario').on('shown.bs.modal', function () {
                calendar.render();
            });

            // Función para generar turnos de 30 minutos
            function generarTurnos(desde, hasta) {
                const turnos = [];
                const [hd, md] = desde.split(':').map(Number);
                const [hh, mh] = hasta.split(':').map(Number);

                let start = new Date();
                start.setHours(hd, md, 0, 0);

                const end = new Date();
                end.setHours(hh, mh, 0, 0);

                while (start < end) {
                    const hora = start.getHours().toString().padStart(2, '0');
                    const min = start.getMinutes().toString().padStart(2, '0');
                    turnos.push(`${hora}:${min}`);
                    start.setMinutes(start.getMinutes() + 30);
                }

                return turnos;
            }

            // Delegado para seleccionar turno (marcar activo)
            $('#lista-horarios').on('click', '.btn-turno', function () {
            $('.btn-turno').removeClass('btn-success').addClass('btn-outline-success');
            $(this).removeClass('btn-outline-success').addClass('btn-success');

            if (fechaSeleccionada) {
                const hora = $(this).data('hora');
                const datetimeLocal = fechaSeleccionada + 'T' + hora;
                $('#fecha_hora').val(datetimeLocal);
                $('#modalVerCalendario').modal('hide');
            }
        });
    });
    </script>

<script>
    document.getElementById('btn-agendar-cita').addEventListener('click', function () {
        fetch('/check-auth')
            .then(res => res.json())
            .then(data => {
                if (data.authenticated) {
                    agendarCita();
                } else {
                    const modal = new bootstrap.Modal(document.getElementById('modalLogin'));
                    modal.show();
                }
            });
    });

    document.getElementById('btn-agendar-cita-videollamada').addEventListener('click', function () {
        fetch('/check-auth')
            .then(res => res.json())
            .then(data => {
                if (data.authenticated) {
                    agendarCitaVideollamada();
                } else {
                    const modal = new bootstrap.Modal(document.getElementById('modalLogin'));
                    modal.show();
                }
            });
    });

    document.getElementById('login-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch("{{ route('ajax.login') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalLogin'));
                modal.hide();
                window.location.reload();
            } else {
                document.getElementById('login-error').classList.remove('d-none');
            }
        });
    });

    function agendarCita() {
        const form = document.getElementById('form-agendar-cita');
        const formData = new FormData(form);

        // Validación del campo fecha_hora
        const fechaHora = document.getElementById('fecha_hora').value;
        if (!fechaHora) {
            alert('Por favor seleccione una fecha y hora para la cita');
            return;
        }

        fetch("{{ route('citas.ajax.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            }else {
                alert('Error al agendar la cita');
            }
        })
        .catch(err => {
            console.error('Error al crear cita:', err);
            alert('Error inesperado');
        });
    }

    function agendarCitaVideollamada() {
        const form = document.getElementById('form-agendar-cita-videollamada');
        const formData = new FormData(form);

        // Validación del campo fecha_hora_videollamada
        const fechaHora = document.getElementById('fecha_hora_videollamada').value;
        if (!fechaHora) {
            alert('Por favor seleccione una fecha y hora para la videoconsulta');
            return;
        }

        fetch("{{ route('citas.videollamada.ajax.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            }else {
                alert('Error al agendar la cita');
            }
        })
        .catch(err => {
            console.error('Error al crear cita:', err);
            alert('Error inesperado');
        });
    }
    </script>

    <script>
    document.getElementById('btn-tab-presencial').addEventListener('click', function() {
        document.getElementById('form-presencial').style.display = 'block';
        document.getElementById('form-videoconsulta').style.display = 'none';

        this.classList.add('btn-warning', 'text-white');
        this.classList.remove('btn-outline-secondary');
        document.getElementById('btn-tab-videoconsulta').classList.remove('btn-warning', 'text-white');
        document.getElementById('btn-tab-videoconsulta').classList.add('btn-outline-secondary');
    });

    document.getElementById('btn-tab-videoconsulta').addEventListener('click', function() {
        document.getElementById('form-presencial').style.display = 'none';
        document.getElementById('form-videoconsulta').style.display = 'block';

        this.classList.add('btn-warning', 'text-white');
        this.classList.remove('btn-outline-secondary');
        document.getElementById('btn-tab-presencial').classList.remove('btn-warning', 'text-white');
        document.getElementById('btn-tab-presencial').classList.add('btn-outline-secondary');
    });
    </script>

 <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendarioFullCalendarVideollamada');
            let fechaSeleccionada = null;

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 600,
                eventDisplay: 'background',
                validRange: {
                    start: new Date().toISOString().split('T')[0] // hoy como mínimo
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({
                        url: '/api/frontend/profesional/horarios-videollamada/{{$profesional->id}}',
                        method: 'GET',
                        success: function (data) {
                            let eventos = data.map(item => ({
                                title: '',
                                start: item.fecha,
                                allDay: true,
                                backgroundColor: '#8B0000',
                            }));
                            successCallback(eventos);
                        },
                        error: failureCallback
                    });
                },
                dateClick: function (info) {

                    fechaSeleccionada = info.dateStr;

                    $.ajax({
                        url: '/api/frontend/profesional/horarios-videollamada/{{$profesional->id}}/' + info.dateStr,
                        method: 'GET',
                        success: function (response) {

                            let lista = $('#lista-horarios-videollamada');
                            lista.empty();

                            if (response.length === 0) {
                                lista.append('<li class="list-group-item text-muted">Sin horarios</li>');
                            } else {
                                response.forEach((horario, index) => {
                                let turnosHtml = horario.turnos.map(t => `
                                    <button class="btn btn-outline-success btn-sm m-1 btn-turno" data-hora="${t}">
                                        ${t}
                                    </button>
                                `).join('');

                                lista.append(`
                                    <li class="list-group-item">
                                        <strong>${horario.desde} - ${horario.hasta}</strong><br>
                                        <div class="mt-2">${turnosHtml}</div>
                                    </li>
                                `);
                            });
                            }
                        }
                    });
                }

             });

            $('#modalVerCalendarioVideollamada').on('shown.bs.modal', function () {
                calendar.render();
            });

            // Función para generar turnos de 30 minutos
            function generarTurnos(desde, hasta) {
                const turnos = [];
                const [hd, md] = desde.split(':').map(Number);
                const [hh, mh] = hasta.split(':').map(Number);

                let start = new Date();
                start.setHours(hd, md, 0, 0);

                const end = new Date();
                end.setHours(hh, mh, 0, 0);

                while (start < end) {
                    const hora = start.getHours().toString().padStart(2, '0');
                    const min = start.getMinutes().toString().padStart(2, '0');
                    turnos.push(`${hora}:${min}`);
                    start.setMinutes(start.getMinutes() + 30);
                }

                return turnos;
            }

            // Delegado para seleccionar turno (marcar activo)
            $('#lista-horarios-videollamada').on('click', '.btn-turno', function () {
            $('.btn-turno').removeClass('btn-success').addClass('btn-outline-success');
            $(this).removeClass('btn-outline-success').addClass('btn-success');

            if (fechaSeleccionada) {
                const hora = $(this).data('hora');
                const datetimeLocal = fechaSeleccionada + 'T' + hora;
                $('#fecha_hora_videollamada').val(datetimeLocal);
                $('#modalVerCalendarioVideollamada').modal('hide');
            }
        });
    });
    </script>
@endsection
