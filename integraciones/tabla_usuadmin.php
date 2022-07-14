<?php
require("../controlador/opc_usuarios.php");

?>


<table class="table table-bordered table-hover  table-responsive" id="example">
    <thead>
        <tr>
            <th>#</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Núm. Tel</th>
            <th>Correo</th>
            <th>Nivel</th>
            <th>Ult. Conexión</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $respuesta = ControladorSesiones::getDatosUsuarios();
        foreach ($respuesta as $key => $value) {
        ?>
            <tr>
                <td><?php echo ($key + 1); ?></td>
                <td><?php echo ($value["usuario"]); ?></td>
                <td><?php echo ($value["nombre"]); ?></td>
                <td><?php echo ($value["apellidos"]); ?></td>
                <td><?php echo ($value["num_tel"]); ?></td>
                <td><?php echo ($value["correo"]); ?></td>
                <td><?php echo ($value["tipo_usu"]); ?></td>
                <td><?php echo ($value["ult_fecha_conexion"]); ?></td>

                <td>

                    <div class="btn-group">
                        <button type="buttom" class="btn btn-info" onclick="getDatosModificar(<?php echo ($value['id_datos']); ?>)" data-bs-toggle="modal" data-bs-target="#modal_modificar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </button>
                        <button id="btn_eliminar" onclick="eliminarUsuarios(<?php echo ($value['id_datos']); ?>,'<?php echo ($value['usuario']); ?>')" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>

                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php include("modal_admin_editarusuarios.php"); ?>

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