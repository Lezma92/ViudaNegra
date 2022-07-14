<?php

require("conexion.php");
class FuncionesSesion
{


    static public function opcionesSesion($datos)
    {
        $datosSesion = FuncionesSesion::ValidarDatos($datos["usuario"], $datos["password"]);
        if ($datosSesion["usuario"] == $datos["usuario"] && $datosSesion["passw"] == $datos["password"]) {
            $_SESSION['id_usuario'] = $datosSesion['id'];
            $_SESSION['usuario'] = $datosSesion['usuario'];
            $_SESSION['nivel_privilegios'] = $datosSesion['tipo_usu'];
            if ($datosSesion["tipo_usu"] == "ADMIN") {
                echo ("<script>window.location.href = 'admin/index.php';</script>");
            }
            if ($datosSesion["tipo_usu"] == "MESERO") {
                echo ("<script>window.location.href = 'empleado/index.php';</script>");
            }
            if ($datosSesion["tipo_usu"] == "COCINERO") {
                echo ("<script>window.location.href = 'cocinero/index.php';</script>");
            }
        } else {
        }
    }

    static public function ValidarDatos($usuario, $passw)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT * FROM usuarios WHERE usuario = :usuario and passw = :passw");
        $conMySql->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $conMySql->bindParam(":passw", $passw, PDO::PARAM_STR);
        if ($conMySql->execute()) {
            return $conMySql->fetch();
        } else {
            print_r($conMySql->errorInfo());
        }
    }
}