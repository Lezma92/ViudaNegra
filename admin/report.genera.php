<?php



include("../fpdf/fpdf.php"); // Incluímos la clase fpdf.php para poder utilizar sus métodos para generar nuestro pdf
require("../controlador/ajax_reportes.php");
date_default_timezone_set('America/Lima'); //Configuramos el horario de acuerdo a la ubicación del servidor
class reportes
{
    static public function getCabeceraReporte($ticket)
    {
        $ticket->Image('../img/logo1.png', 12, 12, 25); //Insertamos el logo si es en PNG su calidad o formato debe estar entre PNG 8/PNG 24

        $ancho = 190;
        $ticket->SetFont('Arial', 'B', 6);
        $ticket->SetY(12); //Mencionamos que el curso en la posición Y empezará a los 12 puntos para escribir el Usuario:
        $ticket->Cell($ancho, 10, 'La Viuda Negra', 0, 0, 'R');
        $ticket->SetY(15);
        $ticket->Cell($ancho, 10, 'Fecha: ' . date('d/m/Y'), 0, 0, 'R');
        $ticket->SetY(18);
        $ticket->Cell($ancho, 10, 'Hora: ' . date('H:i:s'), 0, 0, 'R');
    }

    static public function TitulosReporte($ticket, $y, $yy)
    {
        $ticket->SetFont('helvetica', 'B', 20); //Asignar la fuente, el estilo de la fuente (negrita) y el tamaño de la fuente
        $ticket->SetXY(0, $y + $yy); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
        $ticket->Cell(220, 10, "Reporte General", 0, 1, 'C');

        $ticket->SetFont('courier', 'U', 15); //Asignar la fuente, el estilo de la fuente (subrayado) y el tamaño de la fuente
        $y = $ticket->GetY();
        $ticket->SetXY(0, $y); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
        $ticket->Cell(220, 10, "Lista de ventas", 0, 1, 'C');
    }
    static function getCuerpoReporte($ticket, $datos)
    {

        $ticket->SetFont('arial', '', 8); //Asignar la fuente, el estilo de la fuente (subrayado) y el tamaño de la fuente
        $y = $ticket->GetY() + 5;
        $ticket->SetXY(10, $y);
        $ticket->MultiCell(12, 4, utf8_decode("#"), 1, 'C'); //Utilizamos el utf8_decode para evitar código basura o ilegible
        $ticket->SetXY(22, $y); //El resultado 22 es la suma de la posición 10 y el tamaño del MultiCell de 12.
        $ticket->MultiCell(48, 4, utf8_decode("Cliente"), 1, 'C');
        $ticket->SetXY(70, $y);
        $ticket->MultiCell(20, 4, utf8_decode("Terrraza"), 1, 'C');
        $ticket->SetXY(90, $y);
        $ticket->MultiCell(15, 4, utf8_decode("Mesa"), 1, 'C');
        $ticket->SetXY(105, $y);
        $ticket->MultiCell(20, 4, utf8_decode("Atendió"), 1, 'C');
        $ticket->SetXY(125, $y);
        $ticket->MultiCell(20, 4, utf8_decode("Status"), 1, 'C');
        $ticket->SetXY(145, $y);
        $ticket->MultiCell(20, 4, utf8_decode("Tot, Pedidos"), 1, 'C');
        $ticket->SetXY(165, $y);
        $ticket->MultiCell(30, 4, utf8_decode("Tot. Consumo($)"), 1, 'C');

        $n = 1;

        foreach ($datos as $key => $value) {
            $y = $ticket->GetY();
            $ticket->SetXY(10, $y);
            $ticket->MultiCell(12, 4, $n, 1, 'C');
            $ticket->SetXY(22, $y);
            $ticket->MultiCell(48, 4, utf8_decode($value["nombre"]), 1, 'C');
            $ticket->SetXY(70, $y);
            $ticket->MultiCell(20, 4, utf8_decode($value["nombreterraza"]), 1, 'C');
            $ticket->SetXY(90, $y);
            $ticket->MultiCell(15, 4, utf8_decode($value["nummesa"]), 1, 'C');
            $ticket->SetXY(105, $y);
            $ticket->MultiCell(20, 4, utf8_decode($value["usuario"]), 1, 'C');
            $ticket->SetXY(125, $y);
            $ticket->MultiCell(20, 4, utf8_decode($value["estado"]), 1, 'C');
            $ticket->SetXY(145, $y);
            $ticket->MultiCell(20, 4, utf8_decode($value["totalPedidos"]), 1, 'C');
            $ticket->SetXY(165, $y);
            $ticket->MultiCell(30, 4, utf8_decode("$".$value["totalConsumo"]), 1, 'C');
            $n++;
        }

    }

    static public function getFootter($ticket)
    {
        $ticket->SetY(-32);
        $ticket->SetFont('Arial', 'I', 8);
        $ticket->Cell(0, 10, utf8_decode('Página ') . $ticket->PageNo() . '/{nb}', 0, 0, 'C');

        $ticket->SetX(0);
        $ticket->Cell(205, 10, utf8_decode('Creado por el administrador'), 0, 0, 'R');
    }

    static public function crearReporte($fecha)
    {
        $ticket = new FPDF($orientation = 'P', $unit = 'mm');
        $datos = funcionesReportes::tablaIndex1($fecha);
        $ticket->AddPage();

        reportes::getCabeceraReporte($ticket);


        $yy = 5; //Variable auxiliar para desplazarse 5 puntos del borde superior hacia abajo en la coordenada de las Y para evitar que el título este al nivel de la cabecera.
        $y = $ticket->GetY();
        $x = 12;

        reportes::TitulosReporte($ticket, $y, $yy);
        reportes::getCuerpoReporte($ticket, $datos);
        reportes::getFootter($ticket);
        $ticket->Output("reporte-".$fecha. ".pdf", "I");
    }
}

$fecha = $_POST["fechaActual"];
reportes::crearReporte($fecha);
