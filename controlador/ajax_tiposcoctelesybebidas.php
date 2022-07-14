<?php

require("opc_coctelesybebidas.php");
class AjaxTiposCoctelesyBebidas
{
    static public function addTiposCoctelesyTragos()
    {
        //INSERT INTO `tiposcoctelesytragos`(`id`, `id_botellasycocteles`, `nombrecob`, `ingredientes`, `precio`, `descripcion`) 

        $datosTipos = array(
            "nombrecob" => $_POST["txtNombreTipo"],
            "ingredientes" => $_POST["txt_ingredientes"],
            "precio" => $_POST["txt_precio"],
            "descripcion" => $_POST["txt_descripcion"],
            "id_botellasycocteles" => $_POST["tipoCoctel"]
        );
        $respuestaAlAgregar = OperacionesCoctelesyBebidas::AgregarTiposCoctelesyBebidas($datosTipos);
        echo (json_encode($respuestaAlAgregar));
    }
    static public function updateTiposCoctelesyTragos()
    {
        //INSERT INTO `tiposcoctelesytragos`(`id`, `id_botellasycocteles`, `nombrecob`, `ingredientes`, `precio`, `descripcion`) 

        $datosTipos = array(
            "nombrecob" => $_POST["txtNombreTipo_editar"],
            "ingredientes" => $_POST["txt_ingredientes_editar"],
            "precio" => $_POST["txt_precio_editar"],
            "descripcion" => $_POST["txt_descripcion_editar"],
            "id_botellasycocteles" => $_POST["tipoCoctel_editar"],
            "idTipos" => $_POST["id_tipos_tragoCocteles"]
        );
        $respuestaActualizar = OperacionesCoctelesyBebidas::actualizarDatosTiposCoctelesyBebidas($datosTipos);
        echo (json_encode($respuestaActualizar));
    }
    static public function addTipos()
    {

        $tipos = array(
            "id_categoriademenu" => $_POST["id_tiposycocteles"],
            "nombre" => strtoupper($_POST["etq_tipo"]),
            "estadocontrol" => "vigente",
        );
        $respuestaTipos = OperacionesCoctelesyBebidas::agregarTipo($tipos);
        echo (json_encode($respuestaTipos));
    }
    static public function deleteTipos()
    {
        $datos_categoria = OperacionesCoctelesyBebidas::eliminarCategoria("tiposcoctelesytragos", "id", $_POST["id_tipo"]);
        echo (json_encode($datos_categoria));
    }
    static public function datosBotellasCocteles()
    {
        $datosTiposCoctelesyBebidas = OperacionesCoctelesyBebidas::getDatosTiposCoctelesyBeb($_POST["id_tipos_coctelesybebidas"]);
        echo (json_encode($datosTiposCoctelesyBebidas));
    }
}

if (isset($_POST["id_botellasycocteles"]) && isset($_POST["txtNombreTipo"]) && isset($_POST["txt_ingredientes"]) && isset($_POST["txt_precio"]) && isset($_POST["tipoCoctel"])) {
    $addTipo = new AjaxTiposCoctelesyBebidas();
    $addTipo->addTiposCoctelesyTragos();
}
if (isset($_POST["id_tiposycocteles"]) && isset($_POST["etq_tipo"])) {
    $addTipo = new AjaxTiposCoctelesyBebidas();
    $addTipo->addTipos();
}
if (isset($_POST["EliminarTipos"])) {
    $addTipo = new AjaxTiposCoctelesyBebidas();
    $addTipo->deleteTipos();
}

if (isset($_POST["getDatos"])) {
    $listarDatos = new AjaxTiposCoctelesyBebidas();
    $listarDatos->datosBotellasCocteles();
}
if (isset($_POST["id_tipos_tragoCocteles"]) && isset($_POST["txtNombreTipo_editar"]) && isset($_POST["txt_ingredientes_editar"]) && isset($_POST["txt_precio_editar"]) && isset($_POST["tipoCoctel_editar"])) {
    $addTipo = new AjaxTiposCoctelesyBebidas();
    $addTipo->updateTiposCoctelesyTragos();
}
