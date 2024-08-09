<?php

// Requiere la conexión y el autoload
require_once "../class/conexion.php";
$conexion = new Conexion();
require_once "../funciones/autoload.php";

// Obtener la sección y el id si está presente
$seccion = isset($_GET["sec"]) ? $_GET["sec"] : "paneladmin";
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

// Verificar si el usuario está autenticado
if (!isset($_SESSION['login']) && $seccion != 'login' && $seccion != 'registro') {
    // Si no está autenticado y no está en las páginas de login o registro, redirigir a la página de login
    header("Location: index.php?sec=login");
    exit; // Asegúrate de salir después de la redirección
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Giully</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?sec=home"><h1 class="fs-4">Giully</h1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?sec=admin_productos">Administración Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?sec=admin_add_producto">Agregar un nuevo producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?sec=pedidos">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?sec=usuarios">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="actions/auth_logout.php">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        switch ($seccion) {
            case 'paneladmin':
                require "views/paneladmin.php";
                break;
            case 'admin_productos':
                require "views/admin_productos.php";
                break;
            case 'add_productos':
                require "views/add_productos.php";
                break;
            case 'add_descripcion':
                require "views/add_descripcion.php";
                break;
            case 'admin_add_producto':
                require "views/admin_add_producto.php";
                break;
            case 'add_marca':
                require "views/add_marca.php";
                break;
            case 'add_img':
                require "views/add_img.php";
                break;
            case 'add_variedad':
                require "views/add_variedad.php";
                break;   
            case 'add_prod_var':
                require "views/add_prod_var.php";
                break;
            case 'eliminar_producto':
                require "views/eliminar_producto.php";
                break;       
            case 'editar_producto':
                if ($id > 0) {
                    $_GET['id'] = $id;  //pasar el id al archivo de vista
                    require "views/editar_producto.php";
                } else {
                    echo "<p class='text-danger'>ID de producto no válido.</p>";
                }
                break;     
            case 'login':
                require "views/login.php";
                break;
            case 'acc_aut_login':
                require "views/acc_aut_login.php";
                break;
            case 'acc_registro':
                require "views/acc_registro.php";
                break;   
            case 'auth_logout':
                require "views/auth_logout.php";
                break;
            case 'registro':
                require "views/registro.php";
                break;
            case 'pedidos':
                require "views/pedidos.php";
                break;
            case 'usuarios':
                require "views/usuarios.php";
                break;
            default:
                require "views/paneladmin.php"; // Agregar error de sección no válida
                break;
        }
        ?>
    </div>

</body>
</html>
