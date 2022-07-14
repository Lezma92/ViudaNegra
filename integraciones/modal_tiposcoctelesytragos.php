<div class="modal fade" id="ModalTiposCoctelesyTragos" tabindex="-1" aria-labelledby="ModalTiposCocteles" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTiposCocteles">Agregar tipos de cocteles/tragos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="formTiposCoctelesyTragos">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo ($id_categoriaMenu); ?>" name="id_botellasycocteles" id="id_botellasycocteles">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txtNombreTipo">Nombre o Etiqueta:</label>
                                <input type="text" id="txtNombreTipo" name="txtNombreTipo" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_ingredientes">Ingredientes:</label>
                                <textarea class="form-control" id="txt_ingredientes" name="txt_ingredientes" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_precio">Precio:</label>
                                <input type="tel" id="txt_precio" name="txt_precio" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_descripcion">Descripción:</label>
                                <textarea class="form-control" id="txt_descripcion" name="txt_descripcion" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="tipoCoctel">Tipo:</label>
                        <select name="tipoCoctel" id="tipoCoctel" class="form-control" required>
                            <option selected disabled>
                                <--seleccionar-->
                            </option>
                            <?php
                            foreach ($respuesta as $key => $Tipo) {
                                echo ("<option value=" . $Tipo["id"] . ">" . $Tipo["nombre"] . "</option>");
                            } ?>
                        </select>
                    </div>


                </div>

                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="ModalTiposCoctelesyTragosEditar" tabindex="-1" aria-labelledby="ModalTiposCoctelesEditar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTiposCoctelesEditar">Actualización de datos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="formTiposCoctelesyTragosEditar">
                <div class="modal-body">
                    <input type="hidden" name="id_tipos_tragoCocteles" id="id_tipos_tragoCocteles">
                    <input type="hidden" value="<?php echo ($id_categoriaMenu); ?>" name="id_botellasycocteles_ed" id="id_botellasycocteles_ed">



                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txtNombreTipo_editar">Nombre o Etiqueta:</label>
                                <input type="text" id="txtNombreTipo_editar" name="txtNombreTipo_editar" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_ingredientes_editar">Ingredientes:</label>
                                <textarea class="form-control" id="txt_ingredientes_editar" name="txt_ingredientes_editar" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_precio_editar">Precio:</label>
                                <input type="tel" id="txt_precio_editar" name="txt_precio_editar" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_descripcion_editar">Descripción:</label>
                                <textarea class="form-control" id="txt_descripcion_editar" name="txt_descripcion_editar" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="tipoCoctel_editar">Tipo:</label>
                        <select name="tipoCoctel_editar" id="tipoCoctel_editar" class="form-control" required>
                            <option selected disabled>
                                <--seleccionar-->
                            </option>
                            <?php
                            foreach ($respuesta as $key => $Tipo) {
                                echo ("<option value=" . $Tipo["id"] . ">" . $Tipo["nombre"] . "</option>");
                            } ?>
                        </select>
                    </div>


                </div>

                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
