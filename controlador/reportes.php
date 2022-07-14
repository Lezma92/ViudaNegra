<?php
require_once("conexion.php");

class ReportesConsulta
{
    static public function tablaIndex($fecha = "")
    {
        if ($fecha == "") {
            $fecha = "CURDATE()";
        }
        $conMysql = Conexion::getConexion()->prepare("SELECT 
        cl.idcliente,
        me.idmesas,
        me.nummesa,
        cl.nombre,
        te.nombreterraza,
        usu.usuario,
        cl.estado,
        COUNT(ped.idpedididos) AS totalPedidos,
        SUM(tcyt.precio) AS totalConsumo
    FROM
        clientes AS cl
            INNER JOIN
        usuarios AS usu ON usu.id = cl.id_usuario
            INNER JOIN
        pedidos AS ped ON cl.idcliente = ped.id_clientes
            INNER JOIN
        mesas AS me ON cl.id_mesa = me.idmesas
            INNER JOIN
        terrazas AS te ON te.idterrazas = me.id_terrazas
            INNER JOIN
        tiposcoctelesytragos AS tcyt ON ped.id_tiposcoctelesytragos = tcyt.id
    WHERE
        DATE(ped.fechayhora) = :fecha
    GROUP BY ped.id_clientes
    ORDER BY cl.estado ASC;");
        $conMysql->bindParam(":fecha", $fecha, PDO::PARAM_STR);
        $conMysql->execute();
        return $conMysql->fetchAll();
    }


    static public function verReporteCliente($id_cliente)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT cl.nombre,
        ped.idpedididos AS idPedido, tcyt.nombrecob, tcyt.precio,
        ped.cantidad, ped.ingredientes, ped.fechayhora, ped.status_orden,
        (ped.cantidad * tcyt.precio) AS TotalCuenta FROM pedidos AS ped
            INNER JOIN clientes AS cl ON ped.id_clientes = cl.idcliente
            INNER JOIN tiposcoctelesytragos AS tcyt ON tcyt.id = ped.id_tiposcoctelesytragos
        WHERE cl.idcliente = :id_cliente order by ped.status_orden ASC, ped.fechayhora ASC;");

        $conMySql->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);

        $conMySql->execute();
        return $conMySql->fetchAll();
    }
}
