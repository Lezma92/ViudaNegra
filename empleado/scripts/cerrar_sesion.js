function cerrarSesion() {
    Swal.fire({
        title: '¿Está seguro que desea cerrar la sesión actual?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'aceptar!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "controller/cerrar_sesion.php";
        }
    })
}