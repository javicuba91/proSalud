@extends('frontend.pacientes.layout')

<title>@yield('title', 'ProSalud - Buscador Médicos')</title>

@section('content')
    <div class="container mt-4">
        <h3>Médicos</h3>
        <form action="{{ route('pacientes.buscar.medicos') }}" method="get">
            <div class="row">
                <div class="col-lg col-6 mb-2">
                    <select name="especialidad_id" id="" class="form-control form-select">
                        <option value="">-- Selecciona una especialidad -- </option>
                        @foreach ($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg col-6 mb-2">
                    <select name="sub_especialidad_id" id="" class="form-control form-select">
                        <option value="">-- Selecciona una sub-especialidad -- </option>

                    </select>
                </div>
                <div class="col-lg col-6 mb-2">
                    <input type="text" name="nombre_completo" placeholder="Nombre médico" class="form-control">
                </div>
                <div class="col-lg col-6 mb-2">
                    <select name="modalidad" id="" class="form-control form-select">
                        <option value="">-- Selecciona una modalidad -- </option>
                        <option value="presencial">Presencial</option>
                        <option value="videoconsulta">Videollamada</option>
                    </select>
                </div>
                <div class="col-lg col-6 mb-2">
                    <select class="form-control form-select" name="provincia_id" id="provincia_id">
                        <option value="">-- Seleccione la provincia -- </option>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->id }}">{{ $provincia->nombre }} -
                                {{ $provincia->region->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg col-6 mb-2">
                    <select class="form-control form-select" name="ciudad_id" id="ciudad_id">
                        <option value="">-- Seleccione la ciudad -- </option>
                    </select>
                </div>
                <div class="col-lg col-6 mb-2">
                    <select name="seguro_id" id="" class="form-control form-select">
                        <option value="">-- Selecciona un seguro -- </option>
                        @foreach ($seguros as $seguro)
                            <option value="{{ $seguro->id }}">{{ $seguro->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg col-6 mb-2">
                    <button type="submit" class="btn btn-dark w-100">Buscar</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-lg-5" id="col-listado">

                <div class="listadoMedicos">
                    @if ($medicos->count())
                        <div class="row mt-4">
                            @foreach ($medicos as $medico)
                                <div class="col-md-12 mb-3">
                                    <div class="card border position-relative">
                                        <!-- Ícono de favorito -->
                                        <a href="#" class="position-absolute top-0 end-0 m-2 text-danger"
                                            title="Añadir a favoritos">
                                            <i class="fas fa-heart fa-2x"></i>
                                        </a>

                                        <div class="card-body">
                                            <img src="{{ asset($medico->foto) }}" class="img img-fluid profile-image mb-2"
                                                alt="">

                                            <h5>{{ $medico->nombre_completo }}</h5>

                                            <p>Especialidades:
                                                @foreach ($medico->especializaciones as $esp)
                                                    {{ $esp->especialidad->nombre }}{{ !$loop->last ? ',' : '' }}
                                                @endforeach
                                            </p>

                                            <p>Modalidades:
                                                Presencial:
                                                @if ($medico->presencial == 1)
                                                    <i class="fa fa-check text-success"></i>
                                                @else
                                                    <i class="fa fa-remove text-danger"></i>
                                                @endif
                                                &nbsp;&nbsp;
                                                VideoConsulta:
                                                @if ($medico->videoconsulta == 1)
                                                    <i class="fa fa-check text-success"></i>
                                                @else
                                                    <i class="fa fa-remove text-danger"></i>
                                                @endif
                                            </p>

                                            <p>Seguros:
                                                @foreach ($medico->segurosMedicos as $seguro)
                                                    <span
                                                        class="badge bg-primary">{{ ucfirst(strtolower($seguro->nombre)) }}{{ !$loop->last ? ',' : '' }}</span>
                                                @endforeach
                                            </p>

                                            <p>Consultorios:
                                            <ul>
                                                @foreach ($medico->consultorios as $consultorio)
                                                    <li><span>Consultorio {{ $loop->index + 1 }}: </span>
                                                        {{ ucfirst($consultorio->direccion) }}{{ !$loop->last ? ',' : '' }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            </p>

                                            @php
                                                $promedio = round($medico->valoraciones->avg('puntuacion'), 1);
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

                                            @if ($medico->ciudad && $medico->ciudad->provincia)
                                                <p>Provincia: {{ $medico->ciudad->provincia->nombre }}</p>
                                            @else
                                                <p>Provincia: -</p>
                                            @endif

                                            @if ($medico->ciudad)
                                                <p>Ciudad: {{ $medico->ciudad->nombre }}</p>
                                            @else
                                                <p>Ciudad: -</p>
                                            @endif


                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <a href="/profesionales/ficha/{{ $medico->id }}"
                                                        class="btn btn-dark w-100">Ver perfil</a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a href="/profesionales/ficha/{{ $medico->id }}" class="btn btn-dark w-100">Pedir cita</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{ $medicos->links() }}
                    @else
                        <p class="mt-4">No se encontraron médicos con los filtros seleccionados.</p>
                    @endif

                </div>

            </div>

            <div class="col-lg-7" id="col-mapa">
                <div class="mt-4 sticky-map" id="map" style="height: 600px; width: 100%;"></div>
                <button id="toggleMapa" class="btn btn-outline-dark mt-2 w-100">Ampliar Mapa</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('select[name="especialidad_id"]').on('change', function() {
                var especialidadId = $(this).val();

                if (especialidadId) {
                    $.ajax({
                        url: '/subespecialidades/' + especialidadId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {

                            let $subSelect = $('select[name="sub_especialidad_id"]');
                            $subSelect.empty();
                            $subSelect.append(
                                '<option value="">-- Seleccione subespecialidad --</option>'
                            );

                            $.each(data, function(key, value) {
                                $subSelect.append('<option value="' + value.id + '">' +
                                    value.nombre + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="sub_especialidad_id"]').empty().append(
                        '<option value="">-- Seleccione subespecialidad --</option>');
                }
            });

            $('#provincia_id').on('change', function() {
                let provinciaID = $(this).val();
                cargarCiudades(provinciaID);
            });

            function cargarCiudades(provinciaId) {
                if (!provinciaId) return;

                $.get(`/get-ciudades/${provinciaId}`, function(data) {
                    $('#ciudad_id').empty().append('<option value="">-- Seleccione la ciudad --</option>');
                    $.each(data, function(i, ciudad) {

                        $('#ciudad_id').append(
                            `<option value="${ciudad.id}">${ciudad.nombre}</option>`
                        );
                    });
                });
            }
        });
    </script>
    <script>
        @php
            $consultoriosArray = $medicos->flatMap(function ($medico) {
                return $medico->consultorios->map(function ($consultorio) use ($medico) {
                    return [
                        'nombre' => $medico->nombre_completo,
                        'direccion' => $consultorio->direccion,
                        'logo' => asset($medico->logo),
                    ];
                });
            });
        @endphp

        const consultorios = @json($consultoriosArray);

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
        document.getElementById('toggleMapa').addEventListener('click', function() {
            const container = document.querySelector('.container');
            const isExpanded = container.classList.toggle('modo-mapa');

            const btn = document.getElementById('toggleMapa');
            btn.textContent = isExpanded ? 'Ver listado' : 'Ampliar Mapa';

            setTimeout(() => {
                map.invalidateSize(); // Corrige el tamaño del mapa tras el cambio de tamaño
            }, 300);
        });
    </script>
@endsection
