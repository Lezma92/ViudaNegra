$(document).ready(function () {


    const fecha = new Date();
    console.log(fecha);
    mes = fecha.getMonth();
    dia = fecha.getUTCDate();
    anio = fecha.getFullYear();
    console.log("cargando");
    fechaReporte = anio + "-" + (mes + 1) + "-" + dia;
    console.log(fechaReporte);
    
    cargarReporteTabla(fechaReporte);
    
});

$("#fechaActual").on("change", function (event) {
    seleccionFecha = $("#fechaActual").val();
    cargarReporteTabla(seleccionFecha);
    console.log(seleccionFecha);
});


function cargarReporteTabla(fechaReporte) {
    let url_pag = "../controlador/ajax_reportes.php";
    var datos = new FormData();
    datos.append("tablaIndex", "LlenarTabla");
    datos.append("fechaReporte", fechaReporte);
    $.ajax({
        url: url_pag,
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            tablaIndex = "";
            // tableHead = '<thead class="thead-dark"><tr><th>#</th>' 
            //     +'<th>Cliente</th><th>Terraza</th><th>Mesa</th><th>Atendió</th><th>Estado</th>' 
            //     +'<th>Tot. Pedidos</th><th>($) Consumo Total</th><th>acciones</th> </tr></thead><tbody>';

            cont = 1;
            //tablaIndex += tableHead;
            respuesta.forEach(element => {

                tablaIndex += "<tr>";
                tablaIndex += "<td>" + cont + "</td>";
                tablaIndex += "<td>" + element['nombre'] + "</td>";
                tablaIndex += "<td>" + element['nombreterraza'] + "</td>";
                tablaIndex += "<td>" + element['nummesa'] + "</td>";
                tablaIndex += "<td>" + element['usuario'] + "</td>";
                tablaIndex += "<td>" + element['estado'] + "</td>";
                tablaIndex += "<td>" + element['totalPedidos'] + "</td>";
                tablaIndex += "<td>$" + element['totalConsumo'] + "</td>";
                tablaIndex += "<td style='width: 240px'> <div class='btn-group'>";
                tablaIndex += "<button class='btn btn-info m-1'><i class='bi bi-file-earmark-arrow-down'></i></button>";
                tablaIndex += "<a class='btn btn-warning m-1' href='historial.php?cliente=" + element['idcliente'] + "'><i class='bi bi-arrow-repeat'>Historial</i></a>";
                tablaIndex += "</div></td>";
                tablaIndex += "</tr>";
                cont++;
            });

    
            $("#llenar").html(tablaIndex);
            

        }
    });

}