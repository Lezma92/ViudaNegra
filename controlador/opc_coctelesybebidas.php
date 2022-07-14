<?php

require("conexion.php");


class OperacionesCoctelesyBebidas
{

    static public function getCategoriasCoctelesyBebidas()
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT * FROM categoriademenu");
        $conMySql->execute();
        return $conMySql->fetchAll();
    }
    static public function getIDDatosCategoria($id)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT * FROM categoriademenu WHERE id =:id;");
        $conMySql->bindParam(":id", $id, PDO::PARAM_INT);
        $conMySql->execute();
        return $conMySql->fetch();
    }
    static public function getCoctelesyBebidas($id)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT * FROM botellasycocteles WHERE id_categoriademenu =:id;");
        $conMySql->bindParam(":id", $id, PDO::PARAM_INT);
        $conMySql->execute();
        return $conMySql->fetchAll();
    }
    static public function getTiposCoctelesyBebidas($id)
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
        id_botellasycocteles = :id;");
        $conMySql->bindParam(":id", $id, PDO::PARAM_INT);
        $conMySql->execute();
        return $conMySql->fetchAll();
    }

    static public function AgregarCategoriasCoctelesyBebidas($datos)
    {
        $conMySql = Conexion::getConexion()->prepare("INSERT INTO categoriademenu VALUES (NULL,:nombremenu,:url_imagen);");
        $conMySql->bindParam(":nombremenu", $datos["nomCa"], PDO::PARAM_STR);
        $conMySql->bindParam(":url_imagen", $datos["img_ilustra"], PDO::PARAM_STR);
        if ($conMySql->execute()) {
            return "ok";
        }
    }

    static public function AgregarTiposCoctelesyBebidas($datos)

    {
        //INSERT INTO `tiposcoctelesytragos`(`id`, `id_botellasycocteles`, `nombrecob`, `ingredientes`, `precio`, `descripcion`) 
        $conMySql = Conexion::getConexion()->prepare("INSERT INTO tiposcoctelesytragos VALUES (NULL,:id_botellasycocteles,:nombrecob,:ingredientes,:precio,:descripcion);");
        $conMySql->bindParam(":id_botellasycocteles", $datos["id_botellasycocteles"], PDO::PARAM_INT);
        $conMySql->bindParam(":nombrecob", $datos["nombrecob"], PDO::PARAM_STR);
        $conMySql->bindParam(":ingredientes", $datos["ingredientes"], PDO::PARAM_STR);
        $conMySql->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $conMySql->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        if ($conMySql->execute()) {
            return "ok";
        } else {
            return $conMySql->errorInfo();
        }
    }
    static public function agregarTipo($datos)
    {
        $conMySql = Conexion::getConexion()->prepare("INSERT INTO botellasycocteles VALUES(NULL,:id_categoriademenu,:nombre,:estadocontrol,CURRENT_TIMESTAMP())");
        $conMySql->bindParam(":id_categoriademenu", $datos["id_categoriademenu"], PDO::PARAM_INT);
        $conMySql->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $conMySql->bindParam(":estadocontrol", $datos["estadocontrol"], PDO::PARAM_STR);
        if ($conMySql->execute()) {
            return "ok";
        }
    }
    static public function eliminarCategoria($tabla, $campo, $valor)
    {

        $conMySql = Conexion::getConexion()->prepare("DELETE FROM $tabla WHERE $campo = :valor");
        $conMySql->bindParam(":valor", $valor, PDO::PARAM_INT);
        if ($conMySql->execute()) {
            return "ok";
        }
    }

    static public function getDatosTiposCoctelesyBeb($id)
    {
        $conMySql = Conexion::getConexion()->prepare("SELECT * FROM tiposcoctelesytragos WHERE id = :id");
        $conMySql->bindParam(":id", $id, PDO::PARAM_INT);
        $conMySql->execute();
        return $conMySql->fetch();
    }
    public static function actualizarDatosTiposCoctelesyBebidas($datos)
    {
        //UPDATE `tiposcoctelesytragos` SET `id`=[value-1],`id_botellasycocteles`=[value-2],`nombrecob`=[value-3],`ingredientes`=[value-4],`precio`=[value-5],`descripcion`=[value-6] WHERE 1
        $conMySql = Conexion::getConexion()->prepare("UPDATE tiposcoctelesytragos SET id_botellasycocteles=:id_botellasycocteles,nombrecob =:nombrecob , ingredientes = :ingredientes, precio= :precio,descripcion = :descripcion WHERE id = :id");
        $conMySql->bindParam(":id", $datos["idTipos"], PDO::PARAM_INT);
        $conMySql->bindParam(":id_botellasycocteles", $datos["id_botellasycocteles"], PDO::PARAM_INT);
        $conMySql->bindParam(":nombrecob", $datos["nombrecob"], PDO::PARAM_STR);
        $conMySql->bindParam(":ingredientes", $datos["ingredientes"], PDO::PARAM_STR);
        $conMySql->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $conMySql->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        if ($conMySql->execute()) {
            return "ok";
        } else {
            return $conMySql->errorInfo();
        }
    }
}
