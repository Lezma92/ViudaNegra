$(document).ready(function () {
    recibirPedidos();
});




$("#btnActualizarTabla").on("click", function () {
    recibirPedidos();
});

function recibirPedidos() {
    let url_pag = "ajax/cocinero.ajax.php";
    var datos = new FormData();
    datos.append("pedidos", "Siiii");
    $.ajax({
        url: url_pag,
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            disCard = "";
            cont = 1;
            respuesta.forEach(element => {
                disCard += "<div class='card col-md-3 p-0 m-1 text-center border-danger'> ";
                disCard += "<div class='card-header p-1 border-warning bg-danger text-white'>";
                disCard += "<h5><strong>" + element['nummesa'] + "</strong></h5>";
                disCard += "</div>";
                disCard += "<div class='card-body'>";
                disCard += "<p class='p-0 m-0 text-danger'><strong>Cliente: </strong></p>";
                disCard += "<p>" + element['nombre'] + "</p>";
                disCard += "<p class='p-0 m-0 text-danger'><strong>Cantidad de pedidos: </strong></p>";
                disCard += "<p>" + element['CantPedidos'] + "</p>";
                disCard += "<button type='button' class='btn btn-danger' onclick='verListaPedidos(" + element['idcliente'] + ");'><i class='bi bi-eye'> Ver pedidos</i></button>";
                disCard += "</div>";
                disCard += "</div>";
            });
            if (disCard == "") {
                disCard="<p class='text-center text-danger'>No se encontraron pedidos pendientes, para estar seguro preciona el boton 'Actualizar'</p>"
            }
            console.log(disCard);
            $("#cardPendientes").html(disCard);
            // $("#alertaError").html('');


        }
    });
}

function verListaPedidos(id_cliente) {
    window.location = "lista_pedidos.php?cliente=" + id_cliente;
}