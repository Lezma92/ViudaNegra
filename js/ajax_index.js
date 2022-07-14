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
    $("#informacionReportes").load("../integraciones/tabla_reportes.php?fecha="+fechaReporte);
}