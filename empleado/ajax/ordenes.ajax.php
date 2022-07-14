<?php

require("../../controlador/conexion.php");

class AjaxOrdenes
{
    static public function llenarSelectTipo()
    {
        $respuesta =  AjaxOrdenes::getListaCoctelesyBebidas($_POST["id_menu_ver"]);
        echo (json_encode($respuesta));
    }

    static public function llenarBotones()
    {
        $respuesta = AjaxOrdenes::getTiposCyB($_POST["ver_tiposTyB"]);
        echo (json_encode($respuesta));
    }
    static public function llenarTabla()
    {
        $respuesta = AjaxOrdenes::getInfoTCyB($_POST["id_tipo_cyb"]);
        echo (json_encode($respuesta));
    }
    static public function verCuentaCorta()
    {
        $respuesta = AjaxOrdenes::getCuentaCorta($_POST["id_cliente"]);
        echo (json_encode($respuesta));
    }
    static public function actualizarStatus()
    {
        $respuesta = AjaxOrdenes::setEstadoMesa($_POST["id_mesa_finalizar"], "vacia");
        if ($respuesta == "ok") {
            $respuesta = AjaxOrdenes::setEstadoPedidos($_POST["id_cliente_finalizar"], "finalizado");
            if ($respuesta == "ok") {
                $respuesta = AjaxOrdenes::setEstadoCliente($_POST["id_cliente_finalizar"], "Finalizado");
                if ($respuesta == "ok") {
                    echo (json_encode($respuesta));
                }
            }
        }
    }
    static public function registrarOrdenes()
    {
        $cantidad = count($_POST["numOrden"]);
        $idTipoCyB = count($_POST["idTipoCyB"]);
        $cant_descripcion = count($_POST["descripcion"]);
        $contador = 0;
        if ($cantidad == $idTipoCyB && $cantidad == $cant_descripcion) {
            for ($cnt = 0; $cnt < $cantidad; $cnt++) {
                $datos = array(
                    "id_clientes" => $_POST["id_cliente"],
                    "id_tiposcoctelesytragos" => $_POST["idTipoCyB"][$cnt],
                    "cantidad" => $_POST["numOrden"][$cnt],
                    "ingredientes" => $_POST["descripcion"][$cnt],
                );
                $respu =  AjaxOrdenes::insertOrdenes($datos);
                if ($respu == "ok") {
                    $contador += 1;
                }
            }

            if ($contador == $cantidad) {
                echo (json_encode("ok"));
            }
        }
    }
    static public function deleteOrden()
    {
        $respuesta = AjaxOrdenes::eliminarOrden($_POST["id_pedidos"]);
        echo (json_encode($respuesta));
    }
    static public function insertOrdenes($datos)
    {
        //INSERT INTO `pedidos`(`idpedididos`, `id_clientes`, `id_tiposcoctelesytragos`, `cantidad`, `ingredientes`, `fechayhora`) 
        $conMySql = Conexion::getConexion()->prepare("INSERT INTO pedidos VALUES(NULL,:id_clientes,:id_tiposcoctelesytragos,:cantidad,:ingredientes,current_timestamp(),'ordenado');");
        $conMySql->bindParam(":id_clientes", $datos["id_clientes"], PDO::PARAM_INT);
        $conMySql->bindParam(":id_tiposcoctelesytragos", $datos["id_tiposcoctelesytragos"], PDO::PARAM_INT);
        $conMySql->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $conMySql->bindParam(":ingredientes", $datos["ingredientes"], PDO::PARAM_STR);

        if ($conMySql->execute()) {
            return "ok";
        } else {
            return $conMySql->errorInfo();
        }
    }
    static public function eliminarOrden($idpedididos)
    {
        $conMySql = Conexion::getConexion()->prepare("DELETE FROM pedidos WHERE idpedididos = :idpedididos");
        $conMySql->bindParam(":idpedididos", $idpedididos, PDO::PARAM_INT);
        if ($conMySql->execute()) {
            return "ok";
        } else {
            return $conMySql->errorInfo();
        }
    }

    static public function setEstadoMesa($idMesa, $estado)
    {

        $conMySql = Conexion::getConexion()->prepare("UPDATE mesas SET estado = :estado WHERE idmesas = :idMesas");

        $conMySql->bindParam(":idMesas", $idMesa, PDO::PARAM_STR);
        $conMySql->bindParam(":estado", $estado, PDO::PARAM_STR);

        if ($conMySql->execute()) {
            return "ok";
        } else {
            return $conMySql->errorInfo();
        }
    }

    static public function setEstadoPedidos($id_clientes, $status_orden)
    {
        //UPDATE `pedidos` `=[value-5],`fechayhora`=[value-6],`status_orden`=[value-7] WHERE 1

        $conMySql = Conexion::getConexion()->prepare("UPDATE pedidos SET status_orden=:status_orden WHERE id_clientes = :id_clientes AND status_orden <> 'cancelado';");
        $conMySql->bindParam(":id_clientes", $id_clientes, PDO::PARAM_INT);
        $conMySql->bindParam(":status_orden", $status_orden, PDO::PARAM_STR);
        if ($conMySql->execute()) {
            return "ok";
        } else {
            return $conMySql->errorInfo();
        }
    }
    static public function setEstadoCliente($id_clientes, $status_orden)
    {
        //UPDATE `clientes` SET `idcliente`=[value-1],`id_usuario`=[value-2],`id_mesa`=[value-3],`nombre`=[value-4],`estado`=[value-5], WHERE 1
        $conMySql = Conexion::getConexion()->prepare("UPDATE clientes SET estado=:estado WHERE idcliente = :id_clientes;");
        $conMySql->bindParam(":id_clientes", $id_clientes, PDO::PARAM_INT);
        $conMySql->bindParam(":estado", $status_orden, PDO::PARAM_STR);
        if ($conMySql->execute()) {
            return "ok";
        } else {
            return $conMySql->errorInfo();
        }
    }
    static public function getListaCoctelesyBebidas($id)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT * FROM botellasycocteles WHERE id_categoriademenu =:id;");
        $conMySql->bindParam(":id", $id, PDO::PARAM_INT);
        $conMySql->execute();
        return $conMySql->fetchAll();
    }
    static public function getCuentaCorta($idCliente)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT 
        ped.idpedididos, tcyt.id AS idtCyT, tcyt.nombrecob, ped.cantidad, convert(tcyt.precio,decimal(6,2)) as precio,
        CONVERT( (tcyt.precio * ped.cantidad) , DECIMAL(6,2)) AS Total FROM pedidos AS ped INNER JOIN tiposcoctelesytragos AS tcyt 
        ON ped.id_tiposcoctelesytragos = tcyt.id WHERE ped.id_clientes = :idCliente AND ped.status_orden <> 'cancelado';");

        $conMySql->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);

        $conMySql->execute();
        return $conMySql->fetchAll();
    }

    static public function getTiposCyB($id)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT 
        tcyt.id,
        tcyt.nombrecob,
        tcyt.ingredientes,
        tcyt.precio,
        tcyt.descripcion,
        btyc.nombre
    FROM
        tiposcoctelesytragos AS tcyt
            INNER JOIN
        botellasycocteles AS btyc ON tcyt.id_botellasycocteles = btyc.id
    WHERE
    tcyt.id_botellasycocteles = :id;");
        $conMySql->bindParam(":id", $id, PDO::PARAM_INT);
        $conMySql->execute();
        return $conMySql->fetchAll();
    }
    static public function getInfoTCyB($id)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT 
        tcyt.id,
        tcyt.nombrecob,
        tcyt.ingredientes,
        tcyt.precio,
        tcyt.descripcion,
        btyc.nombre
    FROM
        tiposcoctelesytragos AS tcyt
            INNER JOIN
        botellasycocteles AS btyc ON tcyt.id_botellasycocteles = btyc.id
    WHERE
    tcyt.id = :id;");
        $conMySql->bindParam(":id", $id, PDO::PARAM_INT);
        $conMySql->execute();
        return $conMySql->fetchAll();
    }
}


if (isset($_POST["id_menu_ver"])) {
    AjaxOrdenes::llenarSelectTipo();
}

if (isset($_POST["ver_tiposTyB"])) {
    AjaxOrdenes::llenarBotones();
}
if (isset($_POST["id_tipo_cyb"])) {
    AjaxOrdenes::llenarTabla();
}
if (isset($_POST["id_cliente"]) && isset($_POST["idTipoCyB"])) {
    AjaxOrdenes::registrarOrdenes();
}
if (isset($_POST["FinalizarCuenta"])) {
    AjaxOrdenes::verCuentaCorta();
}

if (isset($_POST["id_cliente_finalizar"])) {
    AjaxOrdenes::actualizarStatus();
}
if (isset($_POST["EliminarOrden"])) {
    AjaxOrdenes::deleteOrden();
}
