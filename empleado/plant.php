<?php
session_name("sesion_viudanegra");
session_start();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario']) && isset($_SESSION['nivel_privilegios'])) {
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
    <title>Bary restaurante viuda negra</title>
  </head>

  <body>

    <?php include("modulos/headers.php"); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include("modulos/nav_bar.php"); ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="VistaEmpleado">


          <?php

          if (isset($_SESSION["id_terraza"])) {
            if ($_SESSION["id_terraza"] == "NoAsignada") {
              include("modulos/vista_main.php");
            } else {
              include("mesas.php");
            }
          } else {
            $_SESSION["id_terraza"] = "NoAsignada";
            include("modulos/vista_main.php");
          }
          ?>
        </main>
      </div>
    </div>


  </body>
  <script src="scripts/scripts_mesero_terrazas.js"></script>

  <script src="../js/dashboard.js"></script>
  <script src="../dist/js/bootstrap.min.js"></script>
  <script src="../js/jquery-3.5.1.min.js"></script>

  </html>
<?php

} else {

  echo ("<script>window.location.href = '../controlador/logout.php';</script>");
}
?>