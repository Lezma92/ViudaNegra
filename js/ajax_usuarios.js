$("#tabla_usuarios").load("../integraciones/tabla_usuadmin.php");

let formularioUsuario = document.getElementById("formUsuarios");



formularioUsuario.addEventListener("submit", e => {
    e.preventDefault();
    var DatosUsuarios = new FormData($('#formUsuarios')[0]);
    $.ajax({
        url: "../controlador/ajax_usuarios.php",
        method: "POST",
        data: DatosUsuarios,
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            console.log(res);
            if (res == '"Listo"') {
                Swal.fire({
                    type: "success",
                    icon: 'success',
                    title: "Usuario registrado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Listo"
                }).then(function (result) {
                    if (result.value) {
                        formularioUsuario.reset();
                        $("#exampleModal").modal('hide');//ocultamos el modal
                        $("#tabla_usuarios").load("../integraciones/tabla_usuadmin.php");
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
})

function modificarDatosUsuarios() {
    var DatosUsuarios = new FormData($('#formModificarUsuarios')[0]);
    let url_pag = "../controlador/ajax_usuarios.php";
    let mensaje = "¡Datos modificados correctamente!";
    let url_cargar = "usuarios.php";
    AjaxSetencia(url_pag, DatosUsuarios, mensaje, "", "pagina", url_cargar);
}

function eliminarUsuarios(id_usuario, usuario) {
    Swal.fire({
        title: '¿Desea eliminar el usuario' + usuario + '?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'aceptar!'
    }).then((result) => {
        if (result.isConfirmed) {
            let url_pag = "../controlador/ajax_usuarios.php";
            let mensaje = "¡Se eliminó correctamente!";

            let datos_liga = new FormData();
            datos_liga.append("EiliminarUsuario", "Parametros");
            datos_liga.append("id_usuario", id_usuario);
            console.log(id_usuario);
            let url_cargar = "usuarios.php";
            //LigaAjax(url_pag, datos, mensaje, div_cambiar, cambio, url_cargar)
            AjaxSetencia(url_pag, datos_liga, mensaje, "", "pagina", url_cargar);
        }
    })
}

function getDatosModificar(idUsuario) {
    var datos = new FormData();
    datos.append("getDatos", "DatosModificar");
    datos.append("idUsuario", idUsuario);

    console.log("Viendo Información de " + idUsuario);
    $.ajax({

        url: "../controlador/ajax_usuarios.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            $("#id_usuarios").val(respuesta["id_datos"]);
            $("#edt_nom").val(respuesta["nombre"]);
            $("#edt_app").val(respuesta["apellidos"]);
            $("#edt_tel").val(respuesta["num_tel"]);
            $("#edt_usuario").val(respuesta["usuario"]);
            $("#edt_correo").val(respuesta["correo"]);
            $("#edt_nivel_usuario").val(respuesta["tipo_usu"]);
        }

    });
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