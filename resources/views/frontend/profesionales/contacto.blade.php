@extends('frontend.profesionales.layout')

<title>@yield('title', 'ProSalud - Contacto')</title>

@section('content')
    <div class="container mt-5">
        <!-- Contacto y atención al cliente -->
        <div class="row mb-5 g-5 formContacto">
            <!-- Formulario de contacto -->
            <div class="col-md-6">
                <h4 class="mb-4">Formulario de contacto</h4>
                <form>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="col">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" placeholder="Teléfono">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Mensaje"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-dark">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Atención al cliente -->
            <div class="col-md-6">
                <h4 class="mb-4">Atención al cliente</h4>
                <p><i class="fa fa-phone"></i> 600 000 000</p>
                <p><i class="fa fa-envelope"></i> email@email.com</p>
                <p><i class="fa fa-clock"></i> Horario de atención: 9:00 a 16:00 horas</p>
            </div>
        </div>

        <!-- Preguntas frecuentes -->
        <h4>Preguntas frecuentes</h4>
        <div class="accordion" id="faqAccordion">

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        Lorem ipsum dolor sit amet
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Respuesta a la pregunta. Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo">
                        Lorem ipsum dolor sit amet
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Contenido de la respuesta.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree">
                        Lorem ipsum dolor sit amet
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Contenido de la respuesta.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour">
                        Lorem ipsum dolor sit amet
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Contenido de la respuesta.
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection()
