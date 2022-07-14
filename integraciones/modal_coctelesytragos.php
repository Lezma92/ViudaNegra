<div class="modal fade" id="CoctelesyTragos" tabindex="-1" aria-labelledby="ModalCoctelesyTragos" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalCoctelesyTragos">Tipo de <?php echo ($nombreCategoria); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="formCoctelesyTragos">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo ($id_categoriaMenu); ?>" name="id_tiposycocteles" id="id_tiposycocteles">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="etq_tipo">Nombre o Etiqueta:</label>
                                <input type="text" id="etq_tipo" name="etq_tipo" placeholder="Ej. Ron, Tequila, Cocteles, Cocteles sin alcohol, etc." class="form-control" required>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>