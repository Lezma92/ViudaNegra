<?php

require("../../controlador/conexion.php");
class AjaxClientes
{

    static public function addCliente()
    {

        $datosCliente = array(
            "ID_USUARIO" => $_POST["id_usuario"],
            "ID_MESA" => $_POST["id_mesa"],
            "nombre" => $_POST["txt_nombre_cliente"]
        );


        $conMysql = Conexion::getConexion()->prepare("INSERT INTO clientes VALUES(null,
            :id_usuario,:id_mesa,:nombre,CURRENT_TIMESTAMP());");

        $conMysql->bindParam(":id_usuario", $datosCliente["ID_USUARIO"], PDO::PARAM_INT);
        $conMysql->bindParam(":id_mesa", $datosCliente["ID_MESA"], PDO::PARAM_INT);
        $conMysql->bindParam(":nombre", $datosCliente["nombre"], PDO::PARAM_STR);
        if ($conMysql->execute()) {
            echo (json_encode("ok"));
        } else {
            return $conMysql->errorInfo();
        }
    }
}


if (isset($_POST["txt_nombre_cliente"])) {
    $funAjax = new AjaxClientes();
    $funAjax->addCliente();

    // echo (json_encode($_POST["txt_nombre_cliente"]."idu".$_POST["id_usuario"]."idm".$_POST["id_mesa"]));
}
