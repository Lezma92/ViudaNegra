<?php
session_name("sesion_viudanegra");
session_start();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario']) && isset($_SESSION['nivel_privilegios'])) {

  if ($_SESSION['nivel_privilegios'] == "ADMIN") {
    # code...

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
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
      <script src="../js/sweetalert2.all.js"></script>

      <title>Bary restaurante viuda negra</title>
    </head>

    <body>

      <?php include("../integraciones/headers.php"); ?>

      <div class="container-fluid">
        <div class="row">
          <?php include("../integraciones/nav_bar.php"); ?>

          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h2>Reporte General</h2>


            </div>
            <div class="form-control m-1 d-flex justify-content-between flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
              <div>
                <label for="fechaActual">Selecciona una fecha</label>
                <input type="date" class="form-control" placeholder="Fecha vista" name="fechaActual" id="fechaActual" style="width: 100%;" form="formularioImprimir">
              </div>
              <div>
                <div class="btn-toolbar mb-2 mb-md-0">

                  <form action="report.genera.php" method="post" target="_blank" id="formularioImprimir">
                    <button class="btn btn-primary m-1" type="submit">Imprimir</button>
                  </form>

                </div>

              </div>
            </div>

            <div class="pad table-responsive ">
              <div  id="informacionReportes">
               
              </div>


            </div>
          </main>
        </div>
      </div>


    </body>
    <script src="../js/dashboard.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/ajax_index.js"></script>




   

    </html>
<?php
  } else {

    echo ("<script>window.location.href = '../controlador/logout.php';</script>");
  }
} else {

  echo ("<script>window.location.href = '../controlador/logout.php';</script>");
}
?>