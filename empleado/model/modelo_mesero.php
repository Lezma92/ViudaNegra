<?php
require("../controlador/conexion.php");

class ModeloMesero
{
    static public function getTerrazas($id_terrazas = "todas")
    {
        if ($id_terrazas == "todas") {
            $conMysql = Conexion::getConexion()->prepare("SELECT * FROM terrazas");
            $conMysql->execute();
            return $conMysql->fetchAll();
        } else {
            $conMysql = Conexion::getConexion()->prepare("SELECT * FROM terrazas where idterrazas = :id_terrazas");
            $conMysql->bindParam(":id_terrazas", $id_terrazas, PDO::PARAM_INT);

            $conMysql->execute();
            return $conMysql->fetch();
        }
    }

    static public function getMesas($id_terrazas)
    {
        $conMysql = Conexion::getConexion()->prepare("SELECT * FROM mesas WHERE id_terrazas = :id_terrazas");
        $conMysql->bindParam(":id_terrazas", $id_terrazas, PDO::PARAM_INT);
        $conMysql->execute();
        return $conMysql->fetchAll();
    }

    static public function registrarCliente($datosCliente)
    {
        //INSERT INTO `clientes`(`idcliente`, `id_usuario`, `id_mesa`, `nombre`, `fecha_hora_registro`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])

        $conMysql = Conexion::getConexion()->prepare("INSERT INTO clientes VALUES(null,
        :id_usuario,:id_mesa,:nombre,CURRENT_TIMESTAMP());");

        $conMysql->bindParam(":id_usuario", $datosCliente["ID_USUARIO"], PDO::PARAM_INT);
        $conMysql->bindParam(":id_mesa", $datosCliente["ID_MESA"], PDO::PARAM_INT);
        $conMysql->bindParam(":nombre", $datosCliente["nombre"], PDO::PARAM_STR);
        if ($conMysql->execute()) {
            return "ok";
        } else {
            return $conMysql->errorInfo();
        }
    }

    static public function getDatosClientes($idmesa)
    {
        $conMysql = Conexion::getConexion()->prepare("select * from clientes as cli inner join mesas as m on cli.id_mesa = m.idmesas and cli.estado = 'Abierto' and m.estado = 'ocupada'  and m.idmesas = :id_mesas;");
        $conMysql->bindParam(":id_mesas", $idmesa, PDO::PARAM_INT);
        $conMysql->execute();
        return $conMysql->fetch();
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
