<div class="modal fade" id="AltaCliente" tabindex="-1" aria-labelledby="AltaCliente" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AltaCliente">Registro de visita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="formularioCliente">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id_mesa" name="id_mesa" required>
                        <input type="hidden" id="id_usuario" value="<?php echo ($_SESSION["id_usuario"]) ?>" name="id_usuario" required>
                        <div class="col-md-6">
                            <fieldset disabled>
                                <div class="form-group">
                                    <label for="txt_lo_atiende" class="form-label">Lo antiende: </label>
                                    <input type="text" id="txt_lo_atiende" value="<?php echo ($_SESSION["usuario"]) ?>" name="txt_lo_atiende" class="form-control Disabled " required>
                                </div>
                            </fieldset>

                        </div>
                        <div class="col-md-6">
                            <fieldset disabled>
                                <div class="form-group">
                                    <label for="txt_lo_atiende" class="form-label">Terraza:</label>
                                    <input type="text" id="txt_lo_atiende" value="<?php echo ($valor["nombreterraza"]); ?>" name="txt_lo_atiende" class="form-control Disabled " required>
                                </div>
                            </fieldset>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_nombre_cliente">Nombre del cliente:</label>
                                <input type="text" id="txt_nombre_cliente" name="txt_nombre_cliente" class="form-control" required>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" id="guardarCliente" name="btn_registrar_cliente" class="btn btn-primary btn-lg">Registrar</button>
                </div>
            </form>

            <?php //$f = ControladorMesero::setDatosClientes();
            ?>
        </div>

    </div>
</div>