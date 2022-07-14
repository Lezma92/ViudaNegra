try {
    let Tiposcoctelesybebidas = document.getElementById("formTiposCoctelesyTragos");
    Tiposcoctelesybebidas.addEventListener("submit", e => {

        e.preventDefault();
        var DatosUsuarios = new FormData($('#formTiposCoctelesyTragos')[0]);
        id_categoria = $("#id_botellasycocteles").val();
        console.log("id menu " + id_categoria);

        $.ajax({
            url: "../controlador/ajax_tiposcoctelesybebidas.php",
            method: "POST",
            data: DatosUsuarios,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                console.log(res);
                if (res == '"ok"') {
                    Swal.fire({
                        type: "success",
                        icon: 'success',
                        title: "Se agrego nuevo registro",
                        showConfirmButton: true,
                        confirmButtonText: "Listo"
                    }).then(function (result) {
                        if (result.value) {
                            Tiposcoctelesybebidas.reset();
                            $("#ModalTiposCoctelesyTragos").modal('hide');//ocultamos el modal
                            $("#tabla_lista_productos").load("../integraciones/tabla_lista_productos.php?categoria=" + id_categoria);
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
    });

    let TiposcoctelesybebidasUpdate = document.getElementById("formTiposCoctelesyTragosEditar");
    TiposcoctelesybebidasUpdate.addEventListener("submit", e => {
        id_categoria = $("#id_botellasycocteles_ed").val();
        console.log("id menu " + id_categoria);

        e.preventDefault();
        var DatosUsuarios = new FormData($('#formTiposCoctelesyTragosEditar')[0]);
        $.ajax({
            url: "../controlador/ajax_tiposcoctelesybebidas.php",
            method: "POST",
            data: DatosUsuarios,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                console.log(res);
                if (res == '"ok"') {
                    Swal.fire({
                        type: "success",
                        icon: 'success',
                        title: "Datos actualizados correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Listo"
                    }).then(function (result) {
                        if (result.value) {
                            TiposcoctelesybebidasUpdate.reset();
                            $("#ModalTiposCoctelesyTragosEditar").modal('hide');//ocultamos el modal
                            $("#tabla_lista_productos").load("../integraciones/tabla_lista_productos.php?categoria=" + id_categoria);
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
    });


    let formCoctelesyTragos = document.getElementById("formCoctelesyTragos");
    formCoctelesyTragos.addEventListener("submit", e => {

        e.preventDefault();
        var DatosUsuarios = new FormData($('#formCoctelesyTragos')[0]);
        id_categoria = $("#id_tiposycocteles").val();
        console.log("id menu " + id_categoria);

        $.ajax({
            url: "../controlador/ajax_tiposcoctelesybebidas.php",
            method: "POST",
            data: DatosUsuarios,
            cache: false,
            contentType: false,
            processData: false,
            success: function (res) {
                console.log(res);
                if (res == '"ok"') {
                    Swal.fire({
                        type: "success",
                        icon: 'success',
                        title: "El registro se realizó correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Listo"
                    }).then(function (result) {
                        if (result.value) {
                            formCoctelesyTragos.reset();
                            $("#formTiposCoctelesyTragos").modal('hide');//ocultamos el modal
                            location.reload();

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
    });
} catch (error) {
    console.log(error);

}


function llenarTablaTipos(id_categoria) {
    $("#tabla_lista_productos").load("../integraciones/tabla_lista_productos.php?categoria=" + id_categoria);
}



function eliminarTipo(id_tipo, nombreTipo, id_categoria) {
    Swal.fire({
        title: 'Está seguro que desea eliminar ' + nombreTipo + '?',
        text: "Si acepta esta opción se eliminarán todos los registros de la base de datos",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'aceptar!'
    }).then((result) => {
        if (result.isConfirmed) {
            let url_pag = "../controlador/ajax_tiposcoctelesybebidas.php";
            let mensaje = "¡Se eliminó correctamente!";

            let datosEnviar = new FormData();
            datosEnviar.append("EliminarTipos", "Parametros");
            datosEnviar.append("id_tipo", id_tipo);
            console.log(id_tipo);
            let url_cargar = "../integraciones/tabla_lista_productos.php?categoria=" + id_categoria;
            AjaxSetencia(url_pag, datosEnviar, mensaje, "#tabla_lista_productos", "Div", url_cargar);
        }
    })
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

function datosTragos(id_tipos_coctelesybebidas) {
    var datos = new FormData();
    datos.append("getDatos", "DatosModificar");
    datos.append("id_tipos_coctelesybebidas", id_tipos_coctelesybebidas);
    console.log("Viendo Información de " + id_tipos_coctelesybebidas);
    $.ajax({

        url: "../controlador/ajax_tiposcoctelesybebidas.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            $("#txtNombreTipo_editar").val(respuesta["nombrecob"]);
            $("#txt_ingredientes_editar").val(respuesta["ingredientes"]);
            $("#txt_precio_editar").val(respuesta["precio"]);
            $("#txt_descripcion_editar").val(respuesta["descripcion"]);
            $("#tipoCoctel_editar").val(respuesta["id_botellasycocteles"]);
            $("#id_tipos_tragoCocteles").val(respuesta["id"]);
        }

    });
}