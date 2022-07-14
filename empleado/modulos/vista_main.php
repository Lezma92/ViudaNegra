<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Terrazas asignadas</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
</div>


<p style="font-size: 18px;">Selecciona la terraza en la cual vas a operar</p>
<div class="card text-primary">
    <div class="card-body">
        <div class="row">
            <?php include("controller/controlador_mesero.php"); ?>

            <?php
            $terrazas = ControladorMesero::terrazas();
            $n = count($terrazas);
            $tamanoCard = "col-md-6 m-0 p-1";
            $anchoCard = "max-width: 30rem;";

            if ($n >= 3) {
                $tamanoCard = "col-md-4 m-0 p-1";
                $anchoCard = "max-width: 25rem;";
            }
            foreach ($terrazas as $key => $value) {
            ?>
                <div class="<?php echo ($tamanoCard); ?>">
                    <div class="card border-danger" style="<?php echo ($anchoCard); ?>">
                        <div class="card-header" style="background: rgba(223, 63, 63, 0.356);">
                            <p class="font-weight-bold text-center" style="font-size: 17px;">
                                <strong><?php echo ($value["nombreterraza"]); ?></strong>
                            </p>
                        </div>

                        <div class="card-body text-center">
                            <img class="card-img-top m-2 p-1" height="200px" width="70%" src="<?php echo ('../img/logo1.png'); ?>" alt="Imagenes">

                            <div>
                                <button type="button" onclick="cambiarContenedor(<?php echo ($value['idterrazas']); ?>);" class="btn btn-info btn-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                    Seleccionar
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>