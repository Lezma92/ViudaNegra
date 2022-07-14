<div class="modal fade" id="modal_modificar" tabindex="-1" aria-labelledby="modal_modificar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_modificar">Modificar Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form method="POST" id="formModificarUsuarios">
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edt_nom">Nombre:</label>
                                <input type="text" id="edt_nom" name="edt_nom" class="form-control" required>
                            </div>
                        </div>
                        <input type="hidden" value="" name="id_usuarios" id="id_usuarios">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edt_app">Apellidos:</label>
                                <input type="text" id="edt_app" name="edt_app" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edt_tel">Núm. tel:</label>
                                <input type="number" id="edt_tel" name="edt_tel" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edt_usuario">Usuario:</label>
                                <input type="text" id="edt_usuario" name="edt_usuario" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edt_correo">Correo electronico:</label>
                        <input type="email" id="edt_correo" name="edt_correo" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edt_nivel_usuario">Nivel de usuario:</label>
                        <select name="edt_nivel_usuario" id="edt_nivel_usuario" class="form-control" required>
                            <option selected disabled>
                                <--seleccionar-->
                            </option>
                            <option value="ADMIN">Administrador</option>
                            <option value="MESERO">Mesero</option>
                            <option value="COCINERO">Cocinero</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edt_password">Contraseña:</label>
                        <input type="password" id="edt_password" name="edt_password" class="form-control" required>
                    </div>


                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" onclick="modificarDatosUsuarios();" class="btn btn-primary btn-lg">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>