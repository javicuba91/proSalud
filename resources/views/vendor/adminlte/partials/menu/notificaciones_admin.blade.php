{{-- Dropdown de notificaciones para el admin --}}
<li class="nav-item dropdown" id="my-notification">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell"></i>
        <span class="badge badge-danger" style="display:none;">0</span>
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        {{-- Ejemplo de contenido para el dropdown de notificaciones de admin --}}
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <strong>Notificación 1:</strong> Nuevo usuario registrado.
                <span class="text-muted float-right small">hace 2 min</span>
            </li>
            <li class="list-group-item">
                <strong>Notificación 2:</strong> Se ha generado una nueva cita.
                <span class="text-muted float-right small">hace 10 min</span>
            </li>
            <li class="list-group-item">
                <strong>Notificación 3:</strong> Mensaje de contacto recibido.
                <span class="text-muted float-right small">hace 1 hora</span>
            </li>
        </ul>
        {{-- Puedes reemplazar este contenido por un @foreach de tus notificaciones reales --}}
    </div>
</li>
