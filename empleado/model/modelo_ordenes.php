<?php
require("../controlador/conexion.php");


class ModeloOrdenes
{

    static public function getListaCoctelesyBebidas($id)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT * FROM botellasycocteles WHERE id_categoriademenu =:id;");
        $conMySql->bindParam(":id", $id, PDO::PARAM_INT);
        $conMySql->execute();
        return $conMySql->fetchAll();
    }

    static public function getHistorialOrdenesXCliente($id_cliente)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT 
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
    static public function getHistorialDiario($id_usuario)
    {
        $conMySql = Conexion::getConexion()->prepare(" SELECT 
        ped.idpedididos AS idPedido,
        us.id,
        us.usuario,
        cl.nombre as nombreCliente,
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
        clientes AS cl ON ped.id_clientes = cl.idcliente inner join usuarios as us on cl.id_usuario = us.id
            INNER JOIN
        tiposcoctelesytragos AS tcyt ON tcyt.id = ped.id_tiposcoctelesytragos
    inner join mesas as ms on ms.idmesas = cl.id_mesa
    WHERE
        us.id = :id_usuario and DATE(ped.fechayhora) = CURDATE() ORDER BY ped.status_orden ASC,ped.fechayhora ASC;");

        $conMySql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

        $conMySql->execute();
        return $conMySql->fetchAll();
    }

    static public function getMenuCyB()
    {

        $conMySql = Conexion::getConexion()->prepare("SELECT * FROM categoriademenu");
        $conMySql->execute();
        return $conMySql->fetchAll();
    }

    static public function getCliente($idmesa)
    {
        $conMysql = Conexion::getConexion()->prepare("select * from clientes as cli inner join mesas as m on cli.id_mesa = m.idmesas and cli.estado = 'Abierto' and m.estado = 'ocupada'  and m.idmesas = :id_mesas;");
        $conMysql->bindParam(":id_mesas", $idmesa, PDO::PARAM_INT);
        $conMysql->execute();
        return $conMysql->fetch();
    }

    static public function getCuentaTicket($idCliente)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT 
        ped.idpedididos, tcyt.id AS idtCyT, tcyt.nombrecob, ped.cantidad, convert(tcyt.precio,decimal(6,2)) as precio,
        CONVERT( (tcyt.precio * ped.cantidad) , DECIMAL(6,2)) AS Total FROM pedidos AS ped INNER JOIN tiposcoctelesytragos AS tcyt 
        ON ped.id_tiposcoctelesytragos = tcyt.id WHERE ped.id_clientes = :idCliente AND ped.status_orden <> 'cancelado';");

        $conMySql->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);

        $conMySql->execute();
        return $conMySql->fetchAll();
    }
}
