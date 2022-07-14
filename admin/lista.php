<?php
session_name("sesion_viudanegra");
session_start();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario']) && isset($_SESSION['nivel_privilegios'])) {

  if ($_SESSION['nivel_privilegios'] == "ADMIN") {
    $id_categoriaMenu = $_GET["categoria"];
    $nombreCategoria = $_GET["nombrec"];
    include("../controlador/opc_coctelesybebidas.php");

    $respuesta = OperacionesCoctelesyBebidas::getCoctelesyBebidas($id_categoriaMenu);
    $cant_tipos  = count($respuesta);


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/dashboard.rtl.css">
      <link rel="stylesheet" href="../css/dashboard.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />

      <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
      <script src="../js/sweetalert2.all.js"></script>


      <title>Viuda Negra || Lista de productos</title>
    </head>

    <body>

      <?php include("../integraciones/headers.php"); ?>

      <div class="container-fluid">
        <div class="row">
          <?php include("../integraciones/nav_bar.php"); ?>

          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="card border-primary m-1">
              <div class="d-flex card-header justify-content-between flex-wrap flex-md-nowrap align-items-center" style="font-size: 18px;">
                <p class="m-2"><Strong>Categoria: </Strong><span class="text-success"><?php echo ($nombreCategoria); ?></span></p>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <div class="btn-group me-2">


                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#CoctelesyTragos">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                      </svg>
                      Alta Tipo
                    </button>

                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#ModalTiposCoctelesyTragos">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z" />
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                      </svg>

                      <?php echo ("Agregar " . $nombreCategoria); ?>

                    </button>

                  </div>
                </div>
              </div>
              <div class="card-body">
                <div>

                  <div class="alert alert-info text-center TT" role="alert">
                    <strong>
                      VARIEDAD:
                      <?php foreach ($respuesta as $key => $Tipo) {
                        echo ($Tipo["nombre"] . ", ");
                      } ?>
                    </strong>
                  </div>
                </div>
                <div class="pad table-responsive" id="tabla_lista_productos">

                </div>

              </div>
            </div>
          </main>
        </div>
      </div>
      <?php include("../integraciones/modal_tiposcoctelesytragos.php"); ?>
      <?php include("../integraciones/modal_coctelesytragos.php"); ?>


    </body>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="../js/dashboard.js"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../js/ajax_tiposcoctelesybebidas.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    





    <?php echo ("<script>llenarTablaTipos(" . $id_categoriaMenu . ");</script>"); ?>

    </html>


<?php
  } else {

    echo ("<script>window.location.href = '../controlador/logout.php';</script>");
  }
} else {

  echo ("<script>window.location.href = '../controlador/logout.php';</script>");
}
?>