// Notificaciones AdminLTE
$(document).ready(function () {
    $(".dropdown-footer").html("");

    $('#myToast').toast('show');

    // Función para actualizar el contador de notificaciones
    function updateNotificationCount() {
        $.ajax({
            url: "/admin/notificaciones/count",
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                var badge = $("#my-notification .badge");
                badge.text(data.count);

                if (data.count > 0) {
                    badge.show().removeClass("d-none");
                } else {
                    badge.hide().addClass("d-none");
                }
            },
            error: function () {
                console.log("Error al cargar el contador de notificaciones");
            },
        });
    }

    // Función para cargar las notificaciones en el dropdown
    function loadNotificationDropdown() {
        $.ajax({
            url: "/admin/notificaciones/dropdown",
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data) {
                // Limpiar contenido anterior (excepto el footer)
                var dropdown = $("#my-notification .dropdown-menu");
                dropdown.find(".dropdown-item").not(":last-child").remove();
                dropdown.find(".dropdown-divider").remove();

                // Agregar nuevo contenido
                dropdown.prepend(data.html);
            },
            error: function () {
                console.log("Error al cargar las notificaciones");
            },
        });
    }

    // Inicializar
    if ($("#my-notification").length > 0) {
        // Actualizar contador al cargar la página
        updateNotificationCount();

        // Cargar notificaciones cuando se hace clic en la campana
        $("#my-notification").on("click", function (e) {
            e.preventDefault();
            loadNotificationDropdown();
        });

        // Actualizar cada 10 segundos
        setInterval(function () {
            updateNotificationCount();
        }, 10000);
    }
});
