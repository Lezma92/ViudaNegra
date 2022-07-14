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
        $respuesta = AjaxClientes::insertarClientes($datosCliente);
        if ($respuesta == "ok") {
            $respuesta = AjaxClientes::actualizarEstadoMesa($_POST["id_mesa"], "ocupada");
            if ($respuesta == "ok") {
                $datos = AjaxClientes::getDatosCli($_POST["id_mesa"]);
                echo (json_encode($datos));
            }
        }
    }
    static public function getDatosCli($idmesa)
    {
        $conMysql = Conexion::getConexion()->prepare("select * from clientes as cli inner join mesas as m on cli.id_mesa = m.idmesas and m.estado = 'ocupada'and cli.estado <> 'Finalizado' WHERE m.idmesas = :id_mesas;");
        $conMysql->bindParam(":id_mesas", $idmesa, PDO::PARAM_INT);
        $conMysql->execute();
        return $conMysql->fetch();
    }
    static public function insertarClientes($datosCliente)
    {
        $conMysql = Conexion::getConexion()->prepare("INSERT INTO clientes VALUES(null,:id_usuario,:id_mesa,:nombre,'Abierto',CURRENT_TIMESTAMP());");

        $conMysql->bindParam(":id_usuario", $datosCliente["ID_USUARIO"], PDO::PARAM_INT);
        $conMysql->bindParam(":id_mesa", $datosCliente["ID_MESA"], PDO::PARAM_INT);
        $conMysql->bindParam(":nombre", $datosCliente["nombre"], PDO::PARAM_STR);
        if ($conMysql->execute()) {
            return "ok";
        } else {
            return $conMysql->errorInfo();
        }
    }

    static public function actualizarEstadoMesa($idmesa, $estado)
    {
        $conMysql = Conexion::getConexion()->prepare("UPDATE mesas SET estado = :estado WHERE idmesas = :id_mesa");
        $conMysql->bindParam(":id_mesa", $idmesa, PDO::PARAM_INT);
        $conMysql->bindParam(":estado", $estado, PDO::PARAM_STR);
        if ($conMysql->execute()) {
            return "ok";
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
