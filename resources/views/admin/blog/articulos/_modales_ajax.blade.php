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
                    if (typeof toastr !== 'undefined') {
                        toastr.success('Categoría creada correctamente');
                    } else {
                        alert('Categoría creada correctamente');
                    }
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                let message = 'Error al crear la categoría';

                if (errors) {
                    message = Object.values(errors).flat().join('\n');
                }

                if (typeof toastr !== 'undefined') {
                    toastr.error(message);
                } else {
                    alert(message);
                }
            },
            complete: function() {
                submitBtn.prop('disabled', false).text(originalText);
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
                    // Agregar nueva etiqueta al contenedor
                    const newEtiqueta = `
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="etiqueta_${response.etiqueta.id}"
                                   name="etiquetas[]" value="${response.etiqueta.id}" checked>
                            <label class="form-check-label" for="etiqueta_${response.etiqueta.id}">
                                <span class="badge" style="background-color: ${response.etiqueta.color}">
                                    ${response.etiqueta.nombre}
                                </span>
                            </label>
                        </div>
                    `;

                    $('#etiquetas-container').append(newEtiqueta);

                    // Cerrar modal y limpiar formulario
                    $('#modalNuevaEtiqueta').modal('hide');
                    $('#formNuevaEtiqueta')[0].reset();
                    $('#etiqueta_color').val('#28a745'); // Reset color to default

                    // Mostrar mensaje de éxito
                    if (typeof toastr !== 'undefined') {
                        toastr.success('Etiqueta creada correctamente');
                    } else {
                        alert('Etiqueta creada correctamente');
                    }
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                let message = 'Error al crear la etiqueta';

                if (errors) {
                    message = Object.values(errors).flat().join('\n');
                }

                if (typeof toastr !== 'undefined') {
                    toastr.error(message);
                } else {
                    alert(message);
                }
            },
            complete: function() {
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });
});
</script>
