
try {
    $("#GuardarCategoria").on("click", function (event) {
        event.preventDefault();
        var datosCategorias = new FormData($('#formularioCategoria')[0]);
        let url_pag = "../controlador/ajax_coctelesybebidas.php";
        let mensaje = "Nueva categoria registrada con exito";
        let url_cargar = "productos.php";
        AjaxSetencia(url_pag, datosCategorias, mensaje, "", "pagina", url_cargar);
    });

} catch (error) {
    console.log(error);
}




function explorar(parametro, nombre) {
    window.location = "lista.php?categoria=" + parametro + "&nombrec=" + nombre;
}

function eliminarCategoria(id_categoria, nombreCategoria) {
    Swal.fire({
        title: '¿Desea eliminar la categoria ' + nombreCategoria + '?',
        text: "Si acepta esta opción se eliminarán todos los registros de la base de datos",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'aceptar!'
    }).then((result) => {
        if (result.isConfirmed) {
            let url_pag = "../controlador/ajax_coctelesybebidas.php";
            let mensaje = "¡Se eliminó correctamente!";

            let datosEnviar = new FormData();
            datosEnviar.append("EliminarCategorias", "Parametros");
            datosEnviar.append("id_categoria", id_categoria);
            console.log(id_categoria);
            let url_cargar = "productos.php";
            //LigaAjax(url_pag, datos, mensaje, div_cambiar, cambio, url_cargar)
            AjaxSetencia(url_pag, datosEnviar, mensaje, "", "pagina", url_cargar);
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