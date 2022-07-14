
function recibirPedidos(id_cliente) {
    let url_pag = "ajax/cocinero.ajax.php";
    var datos = new FormData();
    datos.append("ListarPedidos", "Siiii");
    datos.append("id_cliente", id_cliente);
    $.ajax({
        url: url_pag,
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            tablaPedidos = "";
            cont = 1;
            btn = "";

            respuesta.forEach(element => {
                if (element["status_orden"] == "ordenado") {
                    btn = "<button class='btn btn-info m-1'  onclick='statusPreparar(" + element['idpedididos'] + "," + element['id_clientes'] + ")'><i class='bi bi-arrow-repeat'>Preparando</i></button>";
                }
                if (element["status_orden"] == "preparacion") {
                    btn = "<button class='btn btn-warning m-1'  onclick='statusServido(" + element['idpedididos'] + "," + element['id_clientes'] + ")'><i class='bi bi-arrow-repeat'>Finalizado</i></button>";
                }


                tablaPedidos += "<tr>";
                tablaPedidos += "<input type = 'hidden' name = 'idPedidos[]' value ='" + element['idpedididos'] + "'/>";
                tablaPedidos += "<td>" + cont + "</td>";
                tablaPedidos += "<td>" + element['nombrecob'] + "</td>";
                tablaPedidos += "<td>" + element['cantidad'] + "</td>";
                tablaPedidos += "<td>" + element['ingredientes'] + "</td>";
                tablaPedidos += "<td>" + element['status_orden'] + "</td>";
                tablaPedidos += "<td style='width: 240px'> <div class='btn-group'>";
                tablaPedidos += btn;
                tablaPedidos += "<button class='btn btn-danger m-1' onclick='cancelarPedido(" + element['idpedididos'] + "," + element['id_clientes'] + ")'><i class='bi bi-x-circle'>Cancelar</i></button>";
                tablaPedidos += "</div></td>";
                tablaPedidos += "</tr>";
                cont++;
            });
            console.log(tablaPedidos);
            $("#TablaPedidosCocinero").html(tablaPedidos);
            // $("#alertaError").html('');


        }
    });
}

function cancelarPedido(IDPEDIDO, IDCLIENTE) {
    var datos = new FormData();
    datos.append("CancelarPedido", "Siiii");
    datos.append("IDPEDIDO", IDPEDIDO);
    datos.append("status_orden", "cancelado");
    $.ajax({
        url: "ajax/cocinero.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta == "ok") {
                recibirPedidos(IDCLIENTE);
            }
        }
    });
}

function statusPreparar(IDPEDIDO, IDCLIENTE) {
    var datos = new FormData();
    datos.append("PrepararPedido", "Siiii");
    datos.append("IDPEDIDO", IDPEDIDO);
    datos.append("status_orden", "preparacion");
    $.ajax({
        url: "ajax/cocinero.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta == "ok") {
                recibirPedidos(IDCLIENTE);
            }
        }
    });

}

function statusServido(IDPEDIDO, IDCLIENTE) {
    var datos = new FormData();
    datos.append("ServirPedido", "Siiii");
    datos.append("IDPEDIDO", IDPEDIDO);
    datos.append("status_orden", "servido");
    $.ajax({
        url: "ajax/cocinero.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta == "ok") {
                recibirPedidos(IDCLIENTE);
            }
        }
    });

}