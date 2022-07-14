function cambiarContenedor(id_terraza) {
    $("#VistaEmpleado").load("mesas.php?id_terraza=" + id_terraza);

}


function enviarDatosFormulario(id_mesa) {
    $("#id_mesa").val(id_mesa);
}
function pasarOrden(id_mesa,id_cliente) {
    window.location = "ordenes.php?mesa=" + id_mesa + "&cliente=" + id_cliente;
}

$("#guardarCliente").on("click", function (event) {
    event.preventDefault();
    var datos_cliente = new FormData($('#formularioCliente')[0]);
    let url_pag = "ajax/clientes.ajax.php";
    let mensaje = "¡Cliente agregado correctamente!";
    let url_cargar = "ordenes.php";
    AjaxSetencia(url_pag, datos_cliente, mensaje, "", "pagina", url_cargar);

});


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


            if (res == 'ok' || res["nombre"] != "") {
                Swal.fire({
                    type: "success",
                    icon: 'success',
                    title: mensaje,
                    showConfirmButton: true,
                    confirmButtonText: "Listo"

                }).then(function (result) {
                    if (result.value) {
                        if (cambio == "Div") {
                            $(div_cambiar).load(url_cargar);
                        } if (cambio == "pagina") {
                            window.location = url_cargar;
                        }
                        if (res["nombre"] != "") {
                            window.location = url_cargar + "?mesa=" + res["id_mesa"] + "&cliente=" + res["idcliente"];
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
