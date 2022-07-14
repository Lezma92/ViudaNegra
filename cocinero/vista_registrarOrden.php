<div class="row">
    <div class="col-md-4 p-1">
        <div class="card  border-primary">
            <div class="card-header">
                <strong class="text-success">Tomar orden</strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="tipoCoctel_editar">Menú:</label>
                    <select name="tipoCoctel_editar" id="tipoCoctel_editar" class="form-control" required>
                        <option selected disabled>
                            <--seleccionar-->
                        </option>
                        <?php
                        $lista = ControladorOrdenes::llenarComboMenuCyB();
                        foreach ($lista as $key => $valor) {
                            echo ("<option value='" . $valor["id"] . "'>" . $valor["nombremenu"] . "</option>");
                        }
                        ?>
                    </select>

                    <label for="tipos_tragos">Tipos de :</label>
                    <select name="tipos_tragos" id="tipos_tragos" class="form-control" required>
                    </select>

                </div>
                <div class="row" id="botonoeTiposCyB">

                </div>

                <div id="panelEnviar" hidden="">
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="etq_nombre_cyb" class="form-label">Nombre:</label>
                            <input type="text" id="etq_nombre_cyb" value="" name="etq_nombre_cyb" class="form-control Disabled " required>
                        </div>
                    </fieldset>
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="etq_precio_cyb" class="form-label">Precio:</label>
                            <input type="text" id="etq_precio_cyb" value="" name="etq_precio_cyb" class="form-control Disabled " required>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input id="cantidad" name="cantidad" class="form-control" type="number" min="1" max="50" name="qty" value="1" required>
                    </div>



                    <div class="form-group">
                        <label for="descripcion">Ingredientes:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <input type="hidden" id="id_tipo_cyb" name="id_tipo_cyb" required>
                    <div id="alertaError">
                    </div>
                    <div class="p-1 d-flex justify-content-center">

                        <button class="btn btn-info btn-lg" onclick="agregarOrden()">Agregar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-8 p-1">
        <div class="card border-primary">
            <div class="card-header">
                <strong class="text-success">Listado de ordenes</strong>
            </div>
            <div class="card-body pad table-responsive text-center">
                <div>
                    <form method="POST" id="formularioOrdenes">
                        <input type="hidden" name="id_cliente" value="<?php echo ($cliente); ?>" id="id_cliente">
                        <input type="hidden" name="idmesa" value="<?php echo ($id_mesa); ?>" id="idmesa">
                        <table class="table table-bordered table-primary table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio ($)</th>
                                    <th>Cantidad</th>
                                    <th>Descripción</th>
                                    <th>Total ($)</th>
                                    <th>X</th>
                                </tr>
                            </thead>
                            <tbody id="tablaOrdenes">

                            </tbody>


                        </table>
                        <div class="p-1 d-flex justify-content-center">
                            <button class="btn btn-success btn-lg" id="enviarOrden">Enviar orden</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>