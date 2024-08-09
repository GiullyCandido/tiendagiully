
<?php
require_once "class/conexion.php"; 
$conexion = new Conexion();
require_once "funciones/autoload.php";
//variable que guarda el valor de sec
$seccion = isset( $_GET["sec"] ) ? $_GET["sec"] : "home";
 ?>

<?php require "includes/nav.php" ?>
    <?php 
    $seccion = isset($_GET["sec"]) ? $_GET["sec"] : "home";
    //switch:en este caso evalua el valor del parametro sec de la url,
    // guardamos el valor de sec en la variable $seccion 
    //switch va a comparar el valor de $seccion con cada case,
    //cunado el valor del case se coincide con el valor de $seccion
    //se ejecuta el codigo del case, que en nustro caso es un requiere;
    //se va a requerir el archivo que contiene los distintos "fragmentos/secciones" de nuestra pagina
    // Determinar qué archivo incluir según el parametro sec de la url guardado en $seccion.
    switch ($seccion) {
        case 'home':
            require "views/home.php";
            break;
        case 'quienesSomos':
            require "views/quienesSomos.php"; 
            break;
        case 'Bolsos':
            require "views/bolsos.php";
            break;
        case 'Ropa':
            require "views/ropa.php";
            break;
        case 'Zapatos':
            require "views/zapatos.php";
            break;
        case 'id':
            require "views/id.php";
            break;
        case 'giully':
            require "views/giully.php";
            break;
        case 'contacto':
            require "views/contacto.php";
            break;
        case 'carrito':
            require "views/carrito.php";
            break;
        case 'registro':
            require "views/registro_clientes.php";
            break;
        case 'log_in':
            require "views/login_clientes.php";
            break;
        case 'confirmacion_compra':
            require "views/confirmacion_compra.php";
            break;
        default:
            // Si la sección no coincide con ninguna de las anteriores, se carga la página de inicio por defecto
            require "views/home.php";
            break;
    }
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Giully</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
 
</body>
</html>