<?php

require("opc_coctelesybebidas.php");
class AjaxCoctelesyBebidas
{
    static public function registrarCategoria()
    {
        $hoy = date("d-m-Y-H.i.s");
        $img = $_FILES["img_ilustracion"]["name"];
        list($nom, $tipo_dat) = explode(".", $img);
        $img = $hoy . "." . $tipo_dat;
        $archivo = $_FILES["img_ilustracion"]["tmp_name"];
        $ruta = "../img/" . $img;
        move_uploaded_file($archivo, $ruta);
        $datos = array(
            "nomCa" => $_POST["txt_nombre_categoria"],
            "img_ilustra" => $img
        );


        $respuestaRegistro = OperacionesCoctelesyBebidas::AgregarCategoriasCoctelesyBebidas($datos);
        if ($respuestaRegistro == "ok") {
            echo json_encode($respuestaRegistro);
        } else {
            echo json_encode("HayunError");
        }
    }

    static public function eliminarCategoria()
    {
        $datos_categoria = OperacionesCoctelesyBebidas::getIDDatosCategoria($_POST["id_categoria"]);
        $eliminarImagen = "../img/" . $datos_categoria["url_imagen"];
        unlink($eliminarImagen);
        $accionEliminar = OperacionesCoctelesyBebidas::eliminarCategoria("categoriademenu", "id", $_POST["id_categoria"]);
        echo json_encode($accionEliminar);
    }
}


if (isset($_POST["txt_nombre_categoria"]) && isset($_FILES["img_ilustracion"]["name"])) {
    if (
        $_POST["txt_nombre_categoria"] != "" && $_POST["txt_nombre_categoria"] != NULL
        && $_FILES["img_ilustracion"]["name"] != "" && $_FILES["img_ilustracion"]["name"] != null
    ) {
        $registrar = new AjaxCoctelesyBebidas();
        $registrar->registrarCategoria();
    }
}

if (isset($_POST["EliminarCategorias"])) {
    $EliminarCategoria = new AjaxCoctelesyBebidas();
    $EliminarCategoria->eliminarCategoria();
}
