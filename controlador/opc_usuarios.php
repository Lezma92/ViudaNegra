<?php
require_once("conexion.php");


class ControladorSesiones
{


    static public function getDatosUsuarios()
    {
        $conMysql = Conexion::getConexion()->prepare("SELECT 
    us_da.id AS id_datos, us.id AS id_usuario, us.usuario, us_da.nombre,
    us_da.apellidos, us_da.num_tel, us_da.correo, us.tipo_usu, us.ult_fecha_conexion 
    FROM usuarios_datos AS us_da INNER JOIN usuarios AS us ON us_da.id = us.id_datos_usuario;");
        $conMysql->execute();
        return $conMysql->fetchAll();
    }

    static public function insertUsuarios($datos)
    {
        $conMysql = Conexion::getConexion()->prepare("INSERT INTO usuarios_datos VALUES (NULL, :nombre,:apellidos,:num_tel,:correo);");
        $conMysql->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $conMysql->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $conMysql->bindParam(":num_tel", $datos["num_tel"], PDO::PARAM_STR);
        $conMysql->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        if ($conMysql->execute()) {
            $conMysql = Conexion::getConexion()->prepare("INSERT INTO usuarios VALUES (NULL,(SELECT id from usuarios_datos where nombre = :nom and apellidos = :app and correo = :correo), :usuario, :passw, :nivel_user,current_timestamp());");
            $conMysql->bindParam(":nom", $datos["nombre"], PDO::PARAM_STR);
            $conMysql->bindParam(":app", $datos["apellidos"], PDO::PARAM_STR);
            $conMysql->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
            $conMysql->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $conMysql->bindParam(":passw", $datos["password"], PDO::PARAM_STR);
            $conMysql->bindParam(":nivel_user", $datos["nivel_usu"], PDO::PARAM_STR);
            if ($conMysql->execute()) {
                return "Listo";
            }
        }
    }

    static public function modificarDatosUsuarios($datos)
    {
        //UPDATE `usuarios_datos` SET `id`=[value-1],`nombre`=[value-2],`apellidos`=[value-3],`num_tel`=[value-4],`correo`=[value-5] WHERE 1

        $conMysql = Conexion::getConexion()->prepare("UPDATE usuarios_datos SET nombre = :nombre, apellidos = :apellidos, num_tel =:num_tel, correo = :correo WHERE id = :id");
        $conMysql->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $conMysql->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $conMysql->bindParam(":num_tel", $datos["num_tel"], PDO::PARAM_STR);
        $conMysql->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $conMysql->bindParam(":id", $datos["id_usuarios"], PDO::PARAM_INT);

        if ($conMysql->execute()) {
            //UPDATE `usuarios` SET `usuario`=[value-3],`passw`=[value-4],`tipo_usu`=[value-5],`ult_fecha_conexion`=[value-6] WHERE 1

            $conMysql = Conexion::getConexion()->prepare("UPDATE usuarios SET usuario = :usuario, passw = :passw, tipo_usu = :tipo_usu WHERE id_datos_usuario = :ID_DATOS");
            $conMysql->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $conMysql->bindParam(":passw", $datos["password"], PDO::PARAM_STR);
            $conMysql->bindParam(":tipo_usu", $datos["nivel_usu"], PDO::PARAM_STR);
            $conMysql->bindParam(":ID_DATOS", $datos["id_usuarios"], PDO::PARAM_INT);

            if ($conMysql->execute()) {
                return "ok";
            }
        }
    }

    static public function eliminarDatos($tabla, $campo, $val)
    {
        $conMysql = Conexion::getConexion()->prepare("DELETE FROM $tabla WHERE $campo = :valor");

        $conMysql->bindParam(":valor", $val, PDO::PARAM_INT);
        if ($conMysql->execute()) {
            return "ok";
        }
    }

    static public function getDatosUsuarioModificar($id_usuario)
    {
        $conMysql = Conexion::getConexion()->prepare("SELECT 
        usu.id AS id_usuarios, us_dat.id AS id_datos, usu.usuario,  usu.tipo_usu, us_dat.nombre, us_dat.apellidos, us_dat.num_tel,
        us_dat.correo FROM usuarios AS usu, usuarios_datos AS us_dat WHERE usu.id_datos_usuario = us_dat.id AND us_dat.id = :id_usuario;");
        $conMysql->bindParam("id_usuario", $id_usuario, PDO::PARAM_INT);
        $conMysql->execute();
        return $conMysql->fetch();
    }
}
