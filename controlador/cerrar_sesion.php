<?php
session_name("sesion_viudanegra");
session_start();
session_unset();
session_destroy();
header('location:../index.php');

?>