<?php
require("opc_usuarios.php");
class AjaxUsuarios
{
    static public function agregarUsuarios()
    {
        $datos = array(
            "nombre" => $_POST["txtNombre"],
            "apellidos" => $_POST["txtApp"],
            "num_tel" => $_POST["txt_tel"],
            "correo" => $_POST["txt_correo"],
            "usuario" => $_POST["txt_usuario"],
            "password" => $_POST["txtpaswrd"],
            "nivel_usu" => $_POST["nivel_usuario"],
        );
        $insertar = ControladorSesiones::insertUsuarios($datos);
        echo json_encode($insertar);
    }

    static public function modificarUsuario()
    {
        $datos = array(
            "nombre" => $_POST["edt_nom"],
            "apellidos" => $_POST["edt_app"],
            "num_tel" => $_POST["edt_tel"],
            "correo" => $_POST["edt_correo"],
            "usuario" => $_POST["edt_usuario"],
            "password" => $_POST["edt_password"],
            "nivel_usu" => $_POST["edt_nivel_usuario"],
            "id_usuarios" => $_POST["id_usuarios"]
        );
        $modificar = ControladorSesiones::modificarDatosUsuarios($datos);
        echo json_encode($modificar);
    }

    static public function eliminarUsuarios()
    {
        //eliminarDatos($tabla,$campo,$val){
        $id_usuario = $_POST["id_usuario"];
        $eliminar = ControladorSesiones::eliminarDatos("usuarios_datos", "id", $id_usuario);
        if ($eliminar == "ok") {
            $eliminar = ControladorSesiones::eliminarDatos("usuarios", "id_datos_usuario", $id_usuario);
            if ($eliminar == "ok") {
                echo json_encode($eliminar);
            }
        }
    }
    static public function getDatosModificar(){
        $DatosModificar = ControladorSesiones::getDatosUsuarioModificar($_POST["idUsuario"]);
        echo json_encode($DatosModificar);
    }


}


if (isset($_POST["txt_usuario"])) {
    $registrar = new AjaxUsuarios();
    $registrar->agregarUsuarios();
}
if (isset($_POST["edt_nom"])) {
    $registrar = new AjaxUsuarios();
    $registrar->modificarUsuario();
}
if (isset($_POST["EiliminarUsuario"])) {
    $eliminar = new AjaxUsuarios();
    $eliminar->eliminarUsuarios();
}
if (isset($_POST["getDatos"])) {
    $eliminar = new AjaxUsuarios();
    $eliminar->getDatosModificar();
}
