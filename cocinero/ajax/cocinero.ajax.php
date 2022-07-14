<?php

require("../../controlador/conexion.php");
class AjaxCocinero
{


    static public function getPendientes()
    {
        $conMysql = Conexion::getConexion()->prepare("SELECT 
        me.idmesas, me.nummesa, cl.idcliente, cl.nombre,
        count(ped.id_clientes) as CantPedidos FROM mesas AS me
        INNER JOIN clientes AS cl ON me.idmesas = cl.id_mesa
        INNER JOIN pedidos AS ped ON ped.status_orden <> 'servido' AND ped.status_orden <> 'cancelado' 
        AND cl.idcliente = ped.id_clientes WHERE me.estado = 'ocupada'
        AND cl.estado = 'Abierto' AND me.estado = 'ocupada' AND DATE(ped.fechayhora) = CURDATE() 
        GROUP BY ped.id_clientes ORDER BY ped.fechayhora ASC;");

        $conMysql->execute();
        return $conMysql->fetchAll();
    }

    static public function listarPedidisPorClientes()
    {
        $conMysql = Conexion::getConexion()->prepare("SELECT 
        ped.idpedididos, ped.id_clientes,tcyt.nombrecob, ped.ingredientes, ped.cantidad, 
        ped.status_orden FROM pedidos AS ped INNER JOIN tiposcoctelesytragos AS tcyt 
        ON ped.id_tiposcoctelesytragos = tcyt.id WHERE ped.id_clientes = :id_cliente  AND ped.status_orden <> 'servido' AND ped.status_orden <> 'cancelado' 
        ORDER BY ped.fechayhora DESC, ped.status_orden ASC;");

        $conMysql->bindParam(":id_cliente", $_POST["id_cliente"], PDO::PARAM_INT);
        $conMysql->execute();
        return $conMysql->fetchAll();
    }
    static public function CambiarStatus()
    {
        //UPDATE `pedidos` SET `status_orden`=[value-7] WHERE 1
        $conMysql = Conexion::getConexion()->prepare("UPDATE pedidos SET status_orden = :status_orden WHERE idpedididos = :idpedididos;");
        $conMysql->bindParam(":idpedididos", $_POST["IDPEDIDO"], PDO::PARAM_INT);
        $conMysql->bindParam(":status_orden", $_POST["status_orden"], PDO::PARAM_STR);
        if ($conMysql->execute()) {
            return "ok";
        } else {
            return $conMysql->errorInfo();
        }
    }
}

if (isset($_POST["pedidos"])) {
    $respuesta = AjaxCocinero::getPendientes();
    echo (json_encode($respuesta));
}
if (isset($_POST["ListarPedidos"])) {
    $respuesta = AjaxCocinero::listarPedidisPorClientes();
    echo (json_encode($respuesta));
}
if (isset($_POST["CancelarPedido"])) {
    $respuesta = AjaxCocinero::CambiarStatus();
    echo (json_encode($respuesta));
}
if (isset($_POST["PrepararPedido"])) {
    $respuesta = AjaxCocinero::CambiarStatus();
    echo (json_encode($respuesta));
}
if (isset($_POST["ServirPedido"])) {
    $respuesta = AjaxCocinero::CambiarStatus();
    echo (json_encode($respuesta));
}
