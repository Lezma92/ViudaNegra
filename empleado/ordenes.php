<?php
session_name("sesion_viudanegra");
session_start();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario']) && isset($_SESSION['nivel_privilegios'])) {
  if ($_SESSION['nivel_privilegios'] == "MESERO") {

    require("controller/controlador_ordenes.php");
    $id_mesa = $_GET["mesa"];
    $cliente = $_GET["cliente"];
    $datosClientes = ControladorOrdenes::datos_Cliente($id_mesa);
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

      <script src="../js/sweetalert2.all.js"></script>
      <title>Bary restaurante viuda negra</title>
    </head>

    <body>

      <?php include("modulos/headers.php"); ?>

      <div class="container-fluid">
        <div class="row">
          <?php include("modulos/nav_bar.php"); ?>
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="VistaEmpleado">
            <div class="card border-primary m-1">

              <div class="d-flex card-header justify-content-between flex-wrap flex-md-nowrap align-items-center" style="font-size: 18px;">

                <p class="m-2"><Strong>Administración de ordenes</Strong></p>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-info" id="verHistorial">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                      </svg>
                      <strong>Atiendes a: </strong><span class="text-success"><?php echo ($datosClientes["nombre"]); ?></span>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-info" id="cambiar_form_ordenar">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                      </svg>
                      Ordenar
                    </button>
                  </div>
                </div>
              </div>
              <div class="p-2">
                <div class="btn-group">


                  <button type="submit" class="btn btn-info btn-sm m-1" data-bs-toggle="modal" data-bs-target="#finalizarCuenta" id="cerrarCuenta">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                      <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                      <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                    </svg>
                    Finalizar Cuenta
                  </button>



                  <form method="post" action="ticketdecompra.php" target="_bank">

                    <input name="imprimirTicket" type="hidden" value="CrearPDF">
                    <input name="id_cliente" type="hidden" value="<?php echo ($datosClientes["idcliente"]); ?>">
                    <input name="name_user" type="hidden" value="<?php echo ($_SESSION["usuario"]); ?>">
                    <input name="accionReporte" type="hidden" value="I">
                    <button type="submit" class="btn btn-warning btn-sm m-1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                      </svg>
                      Descargar
                    </button>

                  </form>


                </div>
              </div>

              <div class="card-body pad table-responsive" hidden="" id="historialOrdenes">
                <?php include("historial_ordenes.php"); ?>
              </div>
              <div class="card-body" id="vistaPricipal" hidden="">
                <?php include("vista_registrarOrden.php"); ?>
              </div>
            </div>
          </main>
        </div>

        <?php include("modulos/modal_finalizarcuenta.php"); ?>
      </div>


    </body>
    <script src="../js/dashboard.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="scripts/scripts_ordenes.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    </html>

<?php
  } else {
    echo ("<script>window.location.href = '../controlador/logout.php';</script>");
  }
} else {

  echo ("<script>window.location.href = '../controlador/logout.php';</script>");
}
?>