<?php
require("conexion.php");


class funcionesReportes
{

    static public function tablaIndex1($fecha = "")
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
}

if (isset($_POST["tablaIndex"])) {
    $fecha=$_POST["fechaReporte"];
    $resp = funcionesReportes::tablaIndex1($fecha);
    echo (json_encode($resp));
}
