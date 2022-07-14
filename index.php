<?php

session_name("sesion_viudanegra");
session_start();
require_once("controlador/inicio_sesion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/Logo_a.png" type="image/x-icon">
    <title>La Viuda Negra || LogIn</title>
    <!-- Styles CSS -->

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
</head>

<body>
    <div class="modal-dialog text-center">
        <div class="col-sm-10 main">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <img src="img/logo1.png" alt="UserExample">
                </div>
                <form action="" method="POST" id="formlg" class="form-group col-12">
                    <div class="form-group">
                        <input type="text" name="userform" id="userform" class="form-control" placeholder="Usuario / User" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="passform" id="passform" class="form-control" placeholder="Contraseña / Password" required>
                    </div>


                    <div class="form-group">
                        <button type="submit" name="btn_iniciar" class="form-control btn btn-success" id="btnform">iniciar sesión</button>
                    </div>
                </form>
            </div>
            <?php
            cargarSesion::iniciarSesion();
            ?>
        </div>
    </div>




    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>