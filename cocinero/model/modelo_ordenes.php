<?php
require("../controlador/conexion.php");


class ModeloOrdenes
{
   
    static public function getHistorial()
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT 
        ped.idpedididos AS idPedido,
        us.id,
        us.usuario,
        te.nombreterraza,
        cl.nombre AS nombreCliente,
        ms.idmesas,
        ms.nummesa,
        tcyt.nombrecob,
        tcyt.precio,
        ped.cantidad,
        ped.ingredientes,
        ped.fechayhora,
        ped.status_orden,
        (ped.cantidad * tcyt.precio) AS TotalCuenta
    FROM
        pedidos AS ped
            INNER JOIN
        clientes AS cl ON ped.id_clientes = cl.idcliente
            INNER JOIN
        usuarios AS us ON cl.id_usuario = us.id
            INNER JOIN
        tiposcoctelesytragos AS tcyt ON tcyt.id = ped.id_tiposcoctelesytragos
            INNER JOIN
        mesas AS ms ON ms.idmesas = cl.id_mesa inner join terrazas as te on te.idterrazas = ms.id_terrazas
    WHERE
        DATE(ped.fechayhora) = CURDATE()
            AND ped.status_orden <> 'preparacion'
            AND ped.status_orden <> 'ordenado'
    ORDER BY ped.fechayhora DESC;");

        $conMySql->execute();
        return $conMySql->fetchAll();
    }

}
