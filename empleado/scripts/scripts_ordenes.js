$(document).ready(function () {
    $("#historialOrdenes").prop('hidden', false);
});
$("#tablaOrdenes").on('click', '.deleteBtn', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
    return false;
});


$("#cerrarCuenta").on("click", function (event) {
    let url_pag = "ajax/ordenes.ajax.php";
    id_cliente = $("#id_cliente_finalizar").val();
    var datos = new FormData();
    console.log(id_cliente);
    datos.append("FinalizarCuenta", id_cliente);
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
            // console.table(respuesta);
            spans = "";
            cont = 1;
            TotalNeto = 0;

            respuesta.forEach(function (element) {
                nombre = "";
                if (element["nombrecob"].length < 20) {
                    nombre = element["nombrecob"];
                    while (nombre.length < 20) {
                        nombre += " *";
                    }
                } else {
                    nombre = element["nombrecob"].substr(0, 19);
                }

                // spans += "<li>" + cont + ".- " + nombre + "<span>" + element["precio"] + "</span> <span>" + element["cantidad"] + "</span> <span>" + element["Total"] + "</span></li>";
                spans += "<li class='d-flex justify-content-between align-items-center'style='wiht: 20px'>"
                spans += nombre;
                spans += "<span class='badge-primary badge-pill'>" + element["cantidad"] + "</span>";
                spans += "<span class='badge-primary badge-pill'>$" + element["precio"] + "</span>";
                spans += "<span class='badge-primary badge-pill'>$" + element["Total"] + "</span>";
                spans += "</li>";
                cont++;
                TotalNeto = TotalNeto + parseFloat(element["Total"]);
            });
            console.log(TotalNeto);
            $("#llenarCuenta").html(spans);
            $("#totalPagar").html("<h4 class='text-danger'>Total a pagar: $" + TotalNeto + "</h4>");
        }
    })
});

$("#btnFinalizarCuenta").on("click", function (event) {
    event.preventDefault();
    var datosFinalizar = new FormData($('#formularioFinalizar')[0]);
    let url_pag = "ajax/ordenes.ajax.php";
    let mensaje = "Cuenta terminada con exito";
    let url_cargar = "index.php";
    AjaxSetencia(url_pag, datosFinalizar, mensaje, "", "pagina", url_cargar);
});

$('#tipoCoctel_editar').change(function () {
    document.getElementById("tipos_tragos").options.length = 0;
    $("#botonoeTiposCyB").html("");
    $("#panelEnviar").prop('hidden', true);
    $("#alertaError").html('');
    $("#cantidad").val("1");
    $("#descripcion").val("");


    id_menu = $(this).val();
    console.log(id_menu);
    let url_pag = "ajax/ordenes.ajax.php";

    var datos = new FormData();
    datos.append("id_menu_ver", id_menu);
    $.ajax({
        url: url_pag,
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            document.getElementById("tipos_tragos").innerHTML += '<option value=""  disabled selected><--seleccionar--></option>';
            respuesta.forEach(function (element) {
                document.getElementById("tipos_tragos").innerHTML += "<option value='" + element["id"] + "'>" + element["nombre"] + "</option>";

            });
        }
    })
});

function eliminarOrden(id_pedidos) {
    Swal.fire({
        title: '¿Estás seguro que deseas eliminar el pedido seleccionado?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'aceptar!'
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("EnviANDO");
            id_cliente = $("#id_cliente").val();
            idmesa = $("#idmesa").val();
            var datos = new FormData();
            let url_pag = "ajax/ordenes.ajax.php";
            let mensaje = "Pedido eliminado correctamente";
            let url_cargar = "ordenes.php?mesa=" + idmesa + "&cliente=" + id_cliente;
            datos.append("EliminarOrden", id_pedidos);
            datos.append("id_pedidos", id_pedidos);

            AjaxSetencia(url_pag, datos, mensaje, "", "pagina", url_cargar);
        }
    })

}

$('#tipos_tragos').change(function () {
    id_tyt = $(this).val();
    console.log(id_tyt);
    $("#panelEnviar").prop('hidden', true);
    $("#alertaError").html('');

    $("#cantidad").val("1");
    $("#descripcion").val("");

    let url_pag = "ajax/ordenes.ajax.php";

    var datos = new FormData();
    datos.append("ver_tiposTyB", id_tyt);
    $.ajax({
        url: url_pag,
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // $("#TablaTiposCyB").html(output);
            console.log(respuesta);
            tabla = "";
            cont = 0;
            vista = "";
            respuesta.forEach(element => {
                vista += "<div class='col p-2'>";
                vista += "<button type='button' class='btn btn-warning btn-lg' onclick = 'activarPanelEnviar(" + element['id'] + ',"' + element['nombrecob'] + '",' + element['precio'] + ");'>";
                vista += element['nombrecob'];
                vista += "</button></div>";
            });
            // console.log(vista);
            $("#botonoeTiposCyB").html(vista);
        }
    })
});

$("#enviarOrden").on("click", function (event) {
    event.preventDefault();

    var datosOrdenes = new FormData($('#formularioOrdenes')[0]);
    console.log("EnviANDO");
    id_cliente = $("#id_cliente").val();
    idmesa = $("#idmesa").val();

    let url_pag = "ajax/ordenes.ajax.php";
    let mensaje = "Pedido realizado con exito";
    let url_cargar = "ordenes.php?mesa=" + idmesa + "&cliente=" + id_cliente;
    AjaxSetencia(url_pag, datosOrdenes, mensaje, "", "pagina", url_cargar);

});
$("#cambiar_form_ordenar").on("click", function (event) {
    event.preventDefault();
    $("#historialOrdenes").prop('hidden', true);
    $("#vistaPricipal").prop('hidden', false);
});
$("#verHistorial").on("click", function (event) {
    event.preventDefault();
    $("#vistaPricipal").prop('hidden', true);
    $("#historialOrdenes").prop('hidden', false);


});

function activarPanelEnviar(id, nombre, precio) {
    $("#panelEnviar").prop('hidden', false);
    $("#id_tipo_cyb").val(id);
    $("#cantidad").val("1");
    $("#descripcion").val("");
    $("#alertaError").html('');

    $("#etq_nombre_cyb").val(nombre);
    $("#etq_precio_cyb").val(precio);

}
function agregarOrden() {
    id_tipo_cyb = $("#id_tipo_cyb").val();
    cantidad = $("#cantidad").val();
    descripcion = $("#descripcion").val();

    if (descripcion == "") {
        descripcion = "c/todo";
    }
    let url_pag = "ajax/ordenes.ajax.php";

    if (cantidad != 0) {
        var datos = new FormData();
        datos.append("id_tipo_cyb", id_tipo_cyb);
        $.ajax({
            url: url_pag,
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
                tabla = "<tr>";

                respuesta.forEach(element => {

                    tabla += "<input type = 'hidden' name = 'idTipoCyB[]' value ='" + element['id'] + "'/>";
                    tabla += "<input type = 'hidden' name = 'numOrden[]' value ='" + cantidad + "'/>";
                    tabla += "<input type = 'hidden' name = 'descripcion[]' value ='" + descripcion + "'/>";
                    tabla += "<td>" + element['nombrecob'] + "</td>";
                    tabla += "<td>" + element['precio'] + "</td>";
                    tabla += "<td>" + cantidad + "</td>";
                    tabla += "<td>" + descripcion + "</td>";
                    tabla += "<td>" + (cantidad * parseInt(element['precio'])) + "</td>";
                    tabla += "<td><button class='btn btn-danger deleteBtn'>X</button></td>";

                });
                tabla += "</tr>";

                console.log(tabla);
                $("#tablaOrdenes").append(tabla);
                $("#alertaError").html('');


            }
        });
    } else {
        $("#alertaError").html('<div class="alert alert-danger m-2" role="alert">Es necesario ingresar una cantidad</div>');
    }


}

function AjaxSetencia(url_pag, datos, mensaje, div_cambiar, cambio, url_cargar) {
    $.ajax({
        url: url_pag,
        dataType: "json",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {

            console.log(res);
            if (res == 'ok') {
                Swal.fire({
                    type: "success",
                    icon: 'success',
                    title: mensaje,
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function (result) {
                    if (result.value) {
                        if (cambio == "Div") {
                            $(div_cambiar).load(url_cargar);
                        } if (cambio == "pagina") {
                            window.location = url_cargar;
                        }

                    }
                });

            } else if (res == "1062") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href>Why do I have this issue?</a>'
                })

            }
        }
    });

}