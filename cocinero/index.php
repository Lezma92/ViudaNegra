<?php
session_name("sesion_viudanegra");
session_start();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario']) && isset($_SESSION['nivel_privilegios'])) {
  if ($_SESSION["nivel_privilegios"] == "COCINERO") {


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
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
      <script src="../js/sweetalert2.all.js"></script>

      <title>La Viuda Negra || Inicio</title>
    </head>

    <body>

      <?php include("modulos/headers.php"); ?>

      <div class="container-fluid">
        <div class="row">
          <?php include("modulos/nav_bar.php"); ?>
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="VistaEmpleado">
            <div class="card border-primary m-1">

              <div class="d-flex card-header justify-content-between flex-wrap flex-md-nowrap align-items-center" style="font-size: 18px;">

                <p class="m-2"><Strong>Lista de pedidos</Strong></p>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <div class="btn-group me-2">
                    <button type="button" class="btn btn-lg btn-outline-primary" id="btnActualizarTabla">
                      <i class="bi bi-arrow-repeat" style="font-size: 22px;"></i>
                      Actualizar
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row" id="cardPendientes">

                </div>

            
              </div>

            </div>
          </main>
        </div>
      </div>


    </body>

    <script src="../js/dashboard.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="scripts/cocinero_ordenes.js"></script>

    </html>
<?php
  } else {

    echo ("<script>window.location.href = '../controlador/logout.php';</script>");
  }
} else {

  echo ("<script>window.location.href = '../controlador/logout.php';</script>");
}
?>