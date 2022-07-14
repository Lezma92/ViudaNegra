<?php
if (!isset($_SESSION["id_terraza"])) {
    session_name("sesion_viudanegra");
    session_start();
    $id_terraza = $_GET["id_terraza"];
    $_SESSION["id_terraza"] = $id_terraza;
}
?>
<?php include("controller/controlador_mesero.php");

$datos_terraza = ControladorMesero::terrazaXID($_SESSION["id_terraza"]);
$todasTerraza = ControladorMesero::terrazas();

?>

<div class="">

</div>

<div class="card">
    <div class="card-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom p-2">
        <h1 class="h2"><?php echo ("Estás operando en la " . $datos_terraza["nombreterraza"]); ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <?php
                foreach ($todasTerraza as $key => $valor) {
                    if ($valor["idterrazas"] == $_SESSION["id_terraza"]) {
                        $boton = "btn btn-sm btn-outline-success active";
                    } else {
                        $boton = "btn btn-sm btn-outline-info";
                    }
                ?>
                    <button type="button" class="<?php echo ($boton) ?>" onclick="cambiarContenedor(<?php echo ($valor['idterrazas']); ?>);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                        <?php echo ($valor["nombreterraza"]); ?>
                    </button>
                <?php
                }

                ?>
            </div>
        </div>
    </div>
    <div class="card-body ">
        <div class="row">

            <?php
            $terrazas = ControladorMesero::mesas($_SESSION["id_terraza"]);
            $n = count($terrazas);
            $tamanoCard = "col-md-6 m-0 p-1";
            $anchoCard = "max-width: 30rem;";

            if ($n >= 3) {
                $tamanoCard = "col-md-4 m-0 p-1";
                $anchoCard = "max-width: 25rem;";
            }
            foreach ($terrazas as $key => $value) {
                $estado = "";
                $textoEstado = "";
                $cardDiseño = "card border-primary text-white";
                $cardHeader = "card-header bg-info";
                $btn_card  = "btn btn-info";
                if ($value["estado"] == "ocupada") {
                    $estado = "alert alert-danger";
                    $textoEstado = "Ocupada";
                    $cardDiseño = "card border-danger text-white";
                    $cardHeader = "card-header bg-danger";
                    $btn_card  = "btn btn-danger m-1";
                }
                if ($value["estado"] == "vacia") {
                    $estado = "alert alert-info text-center";
                    $textoEstado = "Disponible";
                    $cardDiseño = "card border-info text-white";
                    $cardHeader = "card-header bg-info";
                    $btn_card  = "btn btn-info m-1";
                }
                if ($value["estado"] == "mantenimiento") {
                    $estado = "alert alert-warning text-center";
                    $textoEstado = "Mantenimiento";
                    $cardDiseño = "card border-warning text-white";
                    $cardHeader = "card-header bg-warning";
                }
            ?>
                <div class="<?php echo ($tamanoCard); ?>">
                    <div class="<?php echo ($cardDiseño); ?>" style="<?php echo ($anchoCard); ?>">
                        <div class="<?php echo ($cardHeader); ?>">
                            <p class="font-weight-bold text-center" style="font-size: 20px;">
                                <strong><?php echo ($value["nummesa"]); ?></strong>
                            </p>
                        </div>
                        <div class="card-body">
                            <img class="card-img-top m-2 p-1" height="200px" width="70%" src="<?php echo ('../img/mesa1.png'); ?>" alt="Imagenes">
                            <div class="<?php echo ($estado); ?>" role="alert">
                                <?php echo ($textoEstado); ?>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">

                            <?php
                            if ($value["estado"] == "ocupada") {
                                $datosClientes = ControladorMesero::verDatosClientes($value['idmesas']);
                            ?>
                                <div class="btn-group me-1">
                                    <button class="<?php echo ($btn_card); ?> m-1" onclick="pasarOrden(<?php echo ($datosClientes['idmesas']); ?>,<?php echo ($datosClientes['idcliente']); ?>)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                                        </svg>
                                        Agregar Orden
                                    </button>
                                </div>
                            <?php
                            }

                            ?>
                            <?php
                            if ($value["estado"] == "vacia") {
                            ?>
                                <button class="<?php echo ($btn_card); ?>" onclick="enviarDatosFormulario(<?php echo ($value['idmesas']); ?>);" data-bs-toggle="modal" data-bs-target="#AltaCliente">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-hearts" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566ZM9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z" />
                                    </svg>
                                    Nuevo Cliente
                                </button>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
    <?php include("modulos/nvo_cliente.php");
    ?>
</div>