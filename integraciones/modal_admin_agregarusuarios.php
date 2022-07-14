<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario de Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <form method="POST" id="formUsuarios">
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txtNombre">Nombre:</label>
                                <input type="text" id="txtNombre" name="txtNombre" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txtApp">Apellidos:</label>
                                <input type="text" id="txtApp" name="txtApp" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_tel">Núm. tel:</label>
                                <input type="tel" id="txt_tel" name="txt_tel" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txt_usuario">Usuario:</label>
                                <input type="text" id="txt_usuario" name="txt_usuario" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="txt_correo">Correo electronico:</label>
                        <input type="email" id="txt_correo" name="txt_correo" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nivel_usuario">Nivel de usuario:</label>
                        <select name="nivel_usuario" id="nivel_usuario" class="form-control" required>
                            <option selected disabled>
                                <--seleccionar-->
                            </option>
                            <option value="ADMID">Administrador</option>
                            <option value="MESERO">Mesero</option>
                            <option value="COCINERO">Cocinero</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txtpaswrd">Contraseña:</label>
                        <input type="password" id="txtpaswrd" name="txtpaswrd" class="form-control" required>
                    </div>


                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>