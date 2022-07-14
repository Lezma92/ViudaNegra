<?php
session_name("sesion_viudanegra");
session_start();

if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario']) && isset($_SESSION['nivel_privilegios'])) {
    require("controller/controlador_ordenes.php");

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
        <script src="../js/sweetalert2.all.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />

        <title>Bar la viuda negra</title>
    </head>

    <body>

        <?php include("modulos/headers.php"); ?>

        <div class="container-fluid">
            <div class="row">
                <?php include("modulos/nav_bar.php"); ?>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="card border-primary m-1">
                        <div class="card-header text-center">
                            <h5>
                                <p>Historial de pedidos</p>
                            </h5>
                            <?php echo ("<p class='text-primary'>Hola <strong class='text-danger'>" . $_SESSION['usuario'] . "</strong> en esté apartado se muentran los pedidos que has realizado, estos se mostrarán en orden conforme su status de atención</p>"); ?>

                        </div>
                        <div class="card-body pad table-responsive">

                            <table class="table table-bordered  table-hover " id="tablaHistorial">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>No. Mesa</th>
                                        <th>Cliente</th>
                                        <th>Orden</th>
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
                                    $colorFila = "table-info";
                                    $Historial =  ControladorOrdenes::verHistorialDiario($_SESSION['id_usuario']);
                                    foreach ($Historial as $key => $value) {
                                        if ($value["status_orden"] == "preparacion") {
                                            $colorFila = "table-info";
                                        }

                                        if ($value["status_orden"] == "servido") {
                                            $colorFila = "table-warning";
                                        }
                                        if ($value["status_orden"] == "cancelado") {
                                            $colorFila = "table-danger";
                                        }
                                        if ($value["status_orden"] == "finalizado") {
                                            $colorFila = "table-success";
                                        }

                                    ?>
                                        <tr class="<?php echo ($colorFila); ?>">
                                            <td><?php echo ($key + 1); ?></td>
                                            <td><?php echo ($value["nummesa"]); ?></td>
                                            <td><?php echo ($value["nombreCliente"]); ?></td>
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
                            <div class="p-1">
                                <h5>
                                    <p>Simbología de colores de la tabla</p>
                                    <p>Status de ordenes</p>
                                </h5>
                                <div class="btn-group">
                                    <div class="alert alert-info m-1">
                                        Preparación
                                    </div>
                                    <div class="alert alert-warning m-1">
                                        Servida
                                    </div>
                                    <div class="alert alert-danger m-1">
                                        Cancelada
                                    </div>
                                    <div class="alert alert-success m-1">
                                        Cerrada
                                    </div>
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


    <script>
        $(document).ready(function() {
            var table = $('#tablaHistorial').DataTable({
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
                $('#tablaHistorial').DataTable();
            });

        });
    </script>

    </html>
<?php

} else {

    echo ("<script>window.location.href = '../controlador/logout.php';</script>");
}
?>