<!-- Modal Nueva Categoría -->
<div class="modal fade" id="modalNuevaCategoria" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNuevaCategoriaLabel">Nueva Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formNuevaCategoria">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoria_nombre">Nombre *</label>
                        <input type="text" class="form-control" id="categoria_nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="categoria_descripcion">Descripción</label>
                        <textarea class="form-control" id="categoria_descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoria_color">Color</label>
                        <input type="color" class="form-control" id="categoria_color" name="color" value="#007bff">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Categoría</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Nueva Etiqueta -->
<div class="modal fade" id="modalNuevaEtiqueta" tabindex="-1" role="dialog" aria-labelledby="modalNuevaEtiquetaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNuevaEtiquetaLabel">Nueva Etiqueta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formNuevaEtiqueta">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="etiqueta_nombre">Nombre *</label>
                        <input type="text" class="form-control" id="etiqueta_nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="etiqueta_descripcion">Descripción</label>
                        <textarea class="form-control" id="etiqueta_descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="etiqueta_color">Color</label>
                        <input type="color" class="form-control" id="etiqueta_color" name="color" value="#28a745">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Etiqueta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // AJAX para crear nueva categoría
    $('#formNuevaCategoria').on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.text();

        submitBtn.prop('disabled', true).text('Creando...');

        $.ajax({
            url: '{{ route("blog.categorias.ajax.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Agregar nueva opción al select
                    $('#categoria_id').append(
                        `<option value="${response.categoria.id}" selected>${response.categoria.nombre}</option>`
                    );

                    // Cerrar modal y limpiar formulario
                    $('#modalNuevaCategoria').modal('hide');
                    $('#formNuevaCategoria')[0].reset();
                    $('#categoria_color').val('#007bff'); // Reset color to default

                    // Mostrar mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).text(originalText);

                let errorMessage = 'Ha ocurrido un error al crear la categoría';
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                    } else if (xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage
                });
            }
        });
    });

    // AJAX para crear nueva etiqueta
    $('#formNuevaEtiqueta').on('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.text();

        submitBtn.prop('disabled', true).text('Creando...');

        $.ajax({
            url: '{{ route("blog.etiquetas.ajax.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Agregar nueva etiqueta a la lista de selección
                    let newTag = `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="etiquetas[]"
                                   value="${response.etiqueta.id}" id="etiqueta_${response.etiqueta.id}" checked>
                            <label class="form-check-label" for="etiqueta_${response.etiqueta.id}">
                                ${response.etiqueta.nombre}
                            </label>
                        </div>
                    `;
                    $('#etiquetas_container').append(newTag);

                    // Cerrar modal y limpiar formulario
                    $('#modalNuevaEtiqueta').modal('hide');
                    $('#formNuevaEtiqueta')[0].reset();
                    $('#etiqueta_color').val('#28a745'); // Reset color to default

                    // Mostrar mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).text(originalText);

                let errorMessage = 'Ha ocurrido un error al crear la etiqueta';
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                    } else if (xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage
                });
            }
        });
    });
});
</script>
