<?php
session_name("sesion_viudanegra");
session_start();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario']) && isset($_SESSION['nivel_privilegios'])) {
  if ($_SESSION['nivel_privilegios'] == "ADMIN") {
    $id_cliente = $_GET["cliente"];

    require("../controlador/reportes.php");
    $Historial =  ReportesConsulta::verReporteCliente($id_cliente);
    $totalGastos = 0;
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
            <div class="card border-primary m-1">

              <div class="d-flex card-header justify-content-between flex-wrap flex-md-nowrap align-items-center" style="font-size: 18px;">
                <p class="m-2"><Strong>Historia de pedidos</Strong></p>

              </div>
              <div class="card-body pad table-responsive" id="listaPendientes">
                <div class="alert alert-primary">
                  <h5 class="m-2"><strong><?php echo ("Cliente: " . $Historial[0]['nombre']); ?></strong></h5>
                  <table class="table table-danger table-bordered border-dark table-hover  table-responsive" id="tiposCoctelesBebidas">
                    <thead class="">
                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Ingredientes</th>
                        <th>Precio($)</th>
                        <th>Cantidad</th>
                        <th>Fecha/hora</th>
                        <th>Status</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php

                      foreach ($Historial as $key => $value) {
                        $totalGastos += $value["TotalCuenta"];
                      ?>
                        <tr>
                          <td><?php echo ($key + 1); ?></td>
                          <td><?php echo ($value["nombrecob"]); ?></td>
                          <td><?php echo ($value["ingredientes"]); ?></td>
                          <td><?php echo ("$" . $value["precio"] . ".00"); ?></td>
                          <td><?php echo ($value["cantidad"]); ?></td>
                          <td><?php echo ($value["fechayhora"]); ?></td>
                          <td><?php echo ($value["status_orden"]); ?></td>
                          <td><?php echo ("$" . $value["TotalCuenta"] . ".00"); ?></td>




                        </tr>
                      <?php

                      }
                      ?>
                    </tbody>
                  </table>
                  <div class="text-center text-danger">
                    <h4>Total neto: <?php echo ($totalGastos); ?></h4>
                  </div>
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/ajax_index.js"></script>




    <script>
      $(document).ready(function() {
        var table = $('#tablaReporteGe').DataTable({
          language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
            }
          },
        });
        $(document).ready(function() {
          $('#tablaReporteGe').DataTable();
        });

      });
    </script>

    </html>
<?php
  } else {

    echo ("<script>window.location.href = '../controlador/logout.php';</script>");
  }
} else {

  echo ("<script>window.location.href = '../controlador/logout.php';</script>");
}
?>