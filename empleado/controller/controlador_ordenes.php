<?php
require("model/modelo_ordenes.php");
class ControladorOrdenes
{
    static public function llenarCoctelesYBebidas($id_menu)
    {
        return ModeloOrdenes::getListaCoctelesyBebidas($id_menu);
    }
    static public function llenarHistorialOrdenesXCliente($id_cliente)
    {
        return ModeloOrdenes::getHistorialOrdenesXCliente($id_cliente);
    }

    static public function verHistorialDiario($id_usuario)
    {
        return ModeloOrdenes::getHistorialDiario($id_usuario);
    }
    static public function llenarComboMenuCyB(){
        return ModeloOrdenes::getMenuCyB();
    }
    static public function datos_Cliente($idmesa){
        return ModeloOrdenes::getCliente($idmesa);
    }
    static public function crearTicket($id_cliente)
    {
        $respuesta = ModeloOrdenes::getCuentaTicket($id_cliente);
        return $respuesta;
    }
    
}
