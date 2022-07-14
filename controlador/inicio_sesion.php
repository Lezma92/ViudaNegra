<?php 
require("opc_sesiones.php");
class cargarSesion{
    static public function iniciarSesion(){
        if (isset($_POST["btn_iniciar"]) && isset($_POST["userform"]) && isset($_POST["passform"])) {
            $datos = array(
                "usuario" => $_POST["userform"],
                "password" => $_POST["passform"],
            );
            FuncionesSesion::opcionesSesion($datos);
        }
    }
}

?>