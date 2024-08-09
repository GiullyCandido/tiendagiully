<?php
require_once "../../funciones/autoload.php";
$autenticacion = new Autenticacion();
$autenticacion->log_out();
// Redirigir a la página de inicio de sesión o a la página principal
header("Location: ../../index.php?sec=log_in");
exit;
?>


