<?php
require("model/modelo_ordenes.php");
class ControladorOrdenes
{

    static public function verHistorialDiario()
    {
        return ModeloOrdenes::getHistorial();
    }
}
