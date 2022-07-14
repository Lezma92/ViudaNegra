<?php
require("model/modelo_mesero.php");

class ControladorMesero
{
    static public function terrazas()
    {
        return ModeloMesero::getTerrazas();
    }
    static public function terrazaXID($id)
    {
        return ModeloMesero::getTerrazas($id);
    }

    static public function mesas($id_measas)
    {
        return ModeloMesero::getMesas($id_measas);
    }
    static public function verDatosClientes($id_measas){
        return ModeloMesero::getDatosClientes($id_measas);

    }
    static public function setDatosClientes()
    {
        if (isset($_POST["txt_nombre_cliente"])) {
            $datosCliente = array(
                "ID_USUARIO" => $_POST["id_usuario"],
                "ID_MESA" => $_POST["id_mesa"],
                "nombre" => $_POST["txt_nombre_cliente"]
            );
            $resp = ModeloMesero::registrarCliente($datosCliente);
            if ($resp == "ok") {
                $resp = ModeloMesero::actualizarEstadoMesa($_POST["id_mesa"], "ocupada");
            }
            return $resp;
            // echo (json_encode($_POST["txt_nombre_cliente"]."idu".$_POST["id_usuario"]."idm".$_POST["id_mesa"]));
        }
    }
}
