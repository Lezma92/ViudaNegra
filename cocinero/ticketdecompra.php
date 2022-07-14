<?php
include("../fpdf/fpdf.php");
require("controller/controlador_ordenes.php");
class ticketVenta
{
    static public function generarTicket()
    {
        $id_cliente = 0;
        $usuario = "";
        $accion="";
        
        if (isset($_POST["id_cliente_finalizar"])) {
            $accion = $_POST["accionReporte_finalizar"];
            $id_cliente = $_POST["id_cliente_finalizar"];
            $usuario = $_POST["name_user_finalizar"];
        }
        if (isset($_POST["id_cliente"])) {
            $id_cliente = $_POST["id_cliente"];
            $usuario = $_POST["name_user"];
            $accion = $_POST["accionReporte"];
        }

        $datosTicket = ControladorOrdenes::crearTicket($id_cliente);

        date_default_timezone_set('America/Mexico_City');
        $DateAndTime = date("d-m-Y H:i:s");
        $ticket = new FPDF($orientation = 'P', $unit = 'mm', array(45, 200));
        $ticket->AddPage();
        $ticket->SetFont('Arial', 'B', 8);    //Letra Arial, negrita (Bold), tam. 20
        $textypos = 5;
        $ticket->setY(2);
        $ticket->setX(2);
        $ticket->Cell(40, $textypos, "La Viuda Negra", 0, 1, 'C');
        $ticket->SetFont('Arial', '', 6);    //Letra Arial, negrita (Bold), tam. 20
        $ticket->Cell(25, 3, "Calle Vicente Guerrero 40", 0, 1, 'C');
        $ticket->Cell(25, 3, "Col. Centro", 0, 1, 'C');
        $ticket->SetFont('Arial', '', 5);    //Letra Arial, negrita (Bold), tam. 20
        $ticket->setX(2);
        $ticket->Cell(5, 3, utf8_decode("Atendió: " . $usuario), 0, 0, 'L');
        $ticket->Cell(35, 3, utf8_decode("Hr:" . $DateAndTime), 0, 0, 'R');
        $ticket->SetFont('Arial', '', 5);    //Letra Arial, negrita (Bold), tam. 20
        $textypos += 6;
        $ticket->setX(2);
        $ticket->Cell(5, $textypos, utf8_decode("-------------------------------------------------------------------"), 'C');
        $textypos += 6;
        $ticket->setX(2);
        $ticket->Cell(5, $textypos, 'CANT.  ARTICULO       PRECIO               TOTAL');
        $total = 0;
        $off = $textypos + 6;


        foreach ($datosTicket as $key => $value) {
            $ticket->setX(2);
            $ticket->Cell(5, $off, $value["cantidad"]);
            $ticket->setX(6);
            $ticket->Cell(35, $off,  utf8_decode(strtoupper(substr($value["nombrecob"], 0, 12))));
            $ticket->setX(20);
            $ticket->Cell(11, $off,  "$" . number_format($value["precio"], 2, ".", ","), 0, 0, "R");
            $ticket->setX(32);
            $ticket->Cell(11, $off,  "$ " . number_format($value["cantidad"] * $value["precio"], 2, ".", ","), 0, 0, "R");

            $total += $value["cantidad"] * $value["precio"];
            $off += 6;
        }
        $textypos = $off + 6;

        $ticket->setX(2);
        $ticket->Cell(5, $textypos, "TOTAL: ");
        $ticket->setX(38);
        $ticket->Cell(5, $textypos, "$ " . number_format($total, 2, ".", ","), 0, 0, "R");

        $ticket->setX(2);
        $ticket->Cell(5, $textypos + 6, 'GRACIAS POR TU COMPRA ');

        $ticket->Output("ticket" . ".pdf", $accion);
        

    }
}
if (isset($_POST["imprimirTicket"]) || isset($_POST["CrearTicket"])) {
    ticketVenta::generarTicket();
}
