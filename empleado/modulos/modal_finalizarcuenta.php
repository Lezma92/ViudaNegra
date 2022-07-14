<div class="modal fade" id="finalizarCuenta" tabindex="-1" aria-labelledby="finalizarCuentaModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="finalizarCuentaModal">Ticket de compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="formularioFinalizar" style="font-size: 1rem;">
                <div class="modal-body">
                    <div class="row">

                        <!-- Lineas de necesarias para generarTicket -->


                        <input name="CrearTicket" type="hidden" value="CrearTicket">
                        <input name="name_user_finalizar" type="hidden" value="<?php echo ($_SESSION["usuario"]); ?>">
                        <input name="accionReporte_finalizar" type="hidden" value="D">
                        <!-- Lineas de necesarias para generarTicket -->


                        <input type="hidden" id="id_cliente_finalizar" name="id_cliente_finalizar" value="<?php echo ($datosClientes["idcliente"]) ?>" required>
                        <input type="hidden" id="id_usuario_finalizar" value="<?php echo ($_SESSION["id_usuario"]) ?>" name="id_usuario_finalizar" required>
                        <input type="hidden" id="id_mesa_finalizar" value="<?php echo ($id_mesa) ?>" name="id_mesa_finalizar" required>
                        <div class="col-md-6">
                            <fieldset disabled>
                                <div class="form-group">
                                    <label for="txt_lo_atiende_finalizar" class="form-label">Lo atendió: </label>
                                    <input type="text" id="txt_lo_atiende_finalizar" value="<?php echo ($_SESSION["usuario"]) ?>" name="txt_lo_atiende_finalizar" class="form-control Disabled " required>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset disabled>
                                <div class="form-group">
                                    <label for="txt_nom_cliente_finalizar" class="form-label">Cliente: </label>
                                    <input type="text" id="txt_nom_cliente_finalizar" value="<?php echo ($datosClientes["nombre"]); ?>" name="txt_nom_cliente_finalizar" class="form-control Disabled " required>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="p-2">
                        <li class='d-flex justify-content-between align-items-center'>
                            <strong>Nombre</strong>

                            <span class='badge-primary badge-pill'><strong>Cantidad</strong></span>
                            <span class='badge-primary badge-pill'><strong>Precio</strong></span>
                            <span class='badge-primary badge-pill'><strong>Total</strong></span>
                        </li>
                        <div id="llenarCuenta">

                        </div>
                    </div>

                    <div id="totalPagar" class="text-end p-2">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" id="btnFinalizarCuenta" name="btnFinalizarCuenta" class="btn btn-primary btn-lg">Finalizar</button>
                </div>
            </form>
        </div>

    </div>
</div>