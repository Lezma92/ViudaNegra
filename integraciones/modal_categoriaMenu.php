<div class="modal fade" id="categoriaMenu" tabindex="-1" aria-labelledby="categoriaMenu" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoriaMenu">Registrar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST"  enctype="multipart/form-data" id="formularioCategoria">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txt_nombre_categoria">Nombre:</label>
                                <input type="text" id="txt_nombre_categoria" name="txt_nombre_categoria" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="img_ilustracion" class="form-label">Imagem de Portada:</label>
                                <input class="form-control" type="file" id="img_ilustracion" type="file" name="img_ilustracion" accept=",.png" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" id="GuardarCategoria" class="btn btn-primary btn-lg">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>