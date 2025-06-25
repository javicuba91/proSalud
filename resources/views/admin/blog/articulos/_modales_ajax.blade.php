
        <!-- Modal Nueva Categoría -->
    <div class="modal fade" id="modalNuevaCategoria" tabindex="-1" role="dialog"
        aria-labelledby="modalNuevaCategoriaLabel" aria-hidden="true">
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
    <div class="modal fade" id="modalNuevaEtiqueta" tabindex="-1" role="dialog"
        aria-labelledby="modalNuevaEtiquetaLabel" aria-hidden="true">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear Etiqueta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
