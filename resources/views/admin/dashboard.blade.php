@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel de Administración</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración de ProSalud</p>
@stop

@section('js')
<script>
$(document).ready(function() {
    // Función para actualizar el contador de notificaciones
    function updateNotificationCount() {
        $.get('/admin/notificaciones/count')
            .done(function(data) {
                $('#my-notification .badge').text(data.count);
                if (data.count > 0) {
                    $('#my-notification .badge').show();
                } else {
                    $('#my-notification .badge').hide();
                }
            })
            .fail(function() {
                console.log('Error al cargar el contador de notificaciones');
            });
    }

    // Función para cargar las notificaciones en el dropdown
    function loadNotificationDropdown() {
        $.get('/admin/notificaciones/dropdown')
            .done(function(data) {
                $('#my-notification .dropdown-menu .dropdown-item').not(':last').remove();
                $('#my-notification .dropdown-menu').prepend(data.html);
            })
            .fail(function() {
                console.log('Error al cargar las notificaciones');
            });
    }

    // Actualizar contador al cargar la página
    updateNotificationCount();

    // Cargar notificaciones cuando se hace clic en la campana
    $('#my-notification').on('click', function() {
        loadNotificationDropdown();
    });

    // Actualizar cada 10 segundos
    setInterval(function() {
        updateNotificationCount();
    }, 10000);

    // Marcar notificación como leída al hacer clic
    $(document).on('click', '#my-notification .dropdown-item[data-id]', function(e) {
        var notificationId = $(this).data('id');
        if (notificationId) {
            $.post('/admin/notificaciones/' + notificationId + '/marcar-leida', {
                _token: $('meta[name="csrf-token"]').attr('content')
            }).done(function() {
                updateNotificationCount();
            });
        }
    });
});
</script>
@stop
