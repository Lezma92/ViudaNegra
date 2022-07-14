<?php
require("../controlador/reportes.php");

?>

<table class="table table-bordered table-hover  table-responsive" id="example">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Terraza</th>
            <th>Mesa</th>
            <th>Atendió</th>
            <th>Estado</th>
            <th>Tot. Pedidos</th>
            <th>($) Consumo Total</th>
            <th>acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $respuesta = ReportesConsulta::tablaIndex($_GET["fecha"]);
        foreach ($respuesta as $key => $value) {
        ?>
            <tr>
                <td><?php echo ($key + 1); ?></td>
                <td><?php echo ($value["nombre"]); ?></td>
                <td><?php echo ($value["nombreterraza"]); ?></td>
                <td><?php echo ($value["nummesa"]); ?></td>
                <td><?php echo ($value["usuario"]); ?></td>
                <td><?php echo ($value["estado"]); ?></td>
                <td><?php echo ($value["totalPedidos"]); ?></td>
                <td><?php echo ($value["totalConsumo"]); ?></td>

                <td>

                    <div class='btn-group'>
                        <button class='btn btn-info m-1'><i class='bi bi-file-earmark-arrow-down'></i></button>
                        <a class='btn btn-warning m-1' href="historial.php?cliente=<?php echo($value['idcliente']);?>"><i class='bi bi-arrow-repeat'>Historial</i></a>
                    </div>

                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
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
            $('#example').DataTable();
        });

    });
</script>