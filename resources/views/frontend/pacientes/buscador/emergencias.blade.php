@extends('frontend.pacientes.layout')

<title>@yield('title', 'ProSalud - Buscador Emergencias')</title>

@section('content')
    <div class="container mt-4">
        <h3>Emergencias</h3>
        <form action="{{ route('pacientes.buscar.emergencias') }}" method="get">
            <div class="row">
                <div class="col">
                    <select name="tipo" id="" class="form-control form-select">
                        <option value="">-- Seleccione tipo de servicio -- </option>
                        <option value="Farmacia 24 horas">Farmacia 24 horas</option>
                        <option value="Ambulancia 24 horas">Ambulancia 24 horas</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-control form-select" name="provincia_id1" id="provincia_id1">
                        <option value="">-- Seleccione la provincia -- </option>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->id }}">{{ $provincia->nombre }} -
                                {{ $provincia->region->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select class="form-control form-select" name="ciudad_id1" id="ciudad_id1">
                        <option value="">-- Seleccione la ciudad -- </option>
                    </select>
                </div>
                <!--<div class="col">
                    <button type="button" id="btn-geolocalizar"
                        class="btn btn-outline-primary w-100 mb-2">Geolocalizar</button>
                    @if (request('ciudad'))
                        <input type="hidden" name="ciudad" value="{{ request('ciudad') }}">
                    @endif
                </div>-->
                <div class="col">
                    <button type="submit" class="btn btn-dark w-100">Buscar</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-lg-12">
                @if (request('ciudad'))
                    <div class="alert alert-info mt-2">
                        Emergencias filtradas por ciudad: <strong>{{ request('ciudad') }}</strong>
                        <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary ms-2">Quitar filtro</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5" id="col-listado">

                <div class="listadoEmergencias">
                    @if ($emergencias->count())
                        <div class="row mt-4">
                            @foreach ($emergencias as $emergencia)
                                <div class="col-md-12 mb-3">
                                    <div class="card border position-relative">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 mb-2">
                                                    <button class="btn btn-dark w-100">Tipo de servicio:
                                                        {{ $emergencia->tipo }}</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 mb-2">
                                                    <input type="text" class="form-control"
                                                        value="{{ $emergencia->provincia->nombre }}"
                                                        placeholder="Provincia">
                                                </div>
                                                <div class="col-lg-6 mb-2">
                                                    <input type="text" value="{{ $emergencia->ciudad->nombre }}"
                                                        class="form-control" placeholder="Ciudad">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mb-2">
                                                    <input type="text" value="{{ $emergencia->direccion }}"
                                                        class="form-control" placeholder="Dirección completa">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mb-2">
                                                    <input type="text" class="form-control"
                                                        value="{{ $emergencia->nombre }}"
                                                        placeholder="Nombre">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p>Valoraciones:</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 mb-2">
                                                    <a type="text"
                                                        class="btn btn-dark btn-danger text-white w-100">Favorito</a>
                                                </div>
                                                
                                                    <div class="col-lg-6 mb-2">
                                                        <button class="btn btn-dark w-100"
                                                            data-telefono="{{ $emergencia->telefono }}"
                                                            onclick="mostrarTelefono(this)">
                                                            Solicitar
                                                        </button>
                                                    </div>
                                               

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{ $emergencias->links() }}
                    @else
                        <p class="mt-4">No se encontraron emergencias con los filtros seleccionados.</p>
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
        function mostrarTelefono(boton) {
            const telefono = boton.getAttribute('data-telefono');
            boton.textContent = telefono;
            boton.disabled = true; // opcional, para que no pueda cambiarse otra vez
        }
    </script>

    <script>
        $(document).ready(function() {

            $('#provincia_id1').on('change', function() {
                let provinciaID = $(this).val();
                cargarCiudades2(provinciaID);
            });

            function cargarCiudades2(provinciaId) {
                if (!provinciaId) return;

                $.get(`/get-ciudades/${provinciaId}`, function(data) {
                    $('#ciudad_id1').empty().append('<option value="">-- Seleccione la ciudad --</option>');
                    $.each(data, function(i, ciudad) {

                        $('#ciudad_id1').append(
                            `<option value="${ciudad.id}">${ciudad.nombre}</option>`
                        );
                    });
                });
            }

        });
    </script>
    <script>
        @php
            $emergenciasArray = $emergencias->map(function ($emergencia) {
                return [
                    'tipo' => $emergencia->tipo,
                    'direccion' => $emergencia->direccion,
                ];
            });
        @endphp


        const emergencias = @json($emergenciasArray);

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
            for (const c of emergencias) {
                const coords = await geocode(c.direccion);

                if (coords) {
                    const marker = L.marker([coords.lat, coords.lng]).addTo(map);
                    marker.bindPopup(`
                        <div style="text-align:center;">                            
                            <strong>${c.tipo}</strong><br>
                            <small>${c.direccion}</small>
                        </div>
                    `);

                    bounds.extend([coords.lat, coords.lng]);
                }

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


    <script>
        document.getElementById('btn-geolocalizar').addEventListener('click', function() {
            if (navigator.geolocation) {
               navigator.geolocation.getCurrentPosition(success, error, {
                    enableHighAccuracy: true
                });
               
            } else {
                alert('Tu navegador no soporta geolocalización.');
            }

            function success(position) {


                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                const apiKey = '7e23c4c064ce4c3a8fa0f7400f082735'; // ← Reemplaza esto por tu clave real

                

                fetch(`https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lon}&key=${apiKey}&language=es`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.results.length > 0) {
                            const components = data.results[0].components;

                            // Obtenemos la ciudad
                            const ciudad = components.city || components.town || components.village ||
                                components.municipality;

                            if (ciudad) {
                                const url = new URL(window.location.href);
                                url.searchParams.set('ciudad', ciudad);



                                console.log('Coordenadas:', lat, lon);
                                console.log('Respuesta OpenCage:', data);

                                //window.location.href = url.toString();

                            } else {
                                alert('No se pudo determinar tu ciudad.');
                            }
                        } else {
                            alert('No se encontró ninguna coincidencia para tu ubicación.');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Error al obtener los datos de ubicación.');
                    });
            }

            function error(err) {
                alert('No se pudo obtener tu ubicación: ' + err.message);
            }
        });
    </script>
@endsection
