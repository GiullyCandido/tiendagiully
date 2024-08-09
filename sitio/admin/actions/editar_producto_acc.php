<?php
session_start();
require_once '../../class/conexion.php';

$conexion = (new Conexion())->getConexion();

$id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : 0;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$talle = isset($_POST['talle']) ? $_POST['talle'] : '';
$color = isset($_POST['color']) ? $_POST['color'] : '';
$marca = isset($_POST['marca']) ? $_POST['marca'] : '';
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
$stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;

// Validación de datos
if ($id_producto <= 0 || empty($nombre) || $precio <= 0 || empty($tipo) || empty($marca) || empty($descripcion) || empty($talle) || empty($color)) {
    $_SESSION['mensaje'] = 'Datos de producto inválidos.';
    header('Location: ../admin_productos.php');
    exit();
}

// Obtener la ID de la marca en la tabla productos
$query_marca_id = "SELECT ID_Marca FROM productos WHERE ID_Producto = :id_producto";
$stmt_marca_id = $conexion->prepare($query_marca_id);
$stmt_marca_id->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
$stmt_marca_id->execute();
$marca_id = $stmt_marca_id->fetchColumn();

// Actualizar el Nombre de la tabla marca    
$query_update_marca = "UPDATE marca SET Nombre = :nombre WHERE ID_Marca = :id_marca";
$stmt_update_marca = $conexion->prepare($query_update_marca);
$stmt_update_marca->bindParam(':nombre', $marca, PDO::PARAM_STR);
$stmt_update_marca->bindParam(':id_marca', $marca_id, PDO::PARAM_INT);
$stmt_update_marca->execute();

// Obtener la ID de la descripción
$query_descripcion_id = "SELECT ID_Descripcion FROM productos WHERE ID_Producto = :id_producto";
$stmt_descripcion_id = $conexion->prepare($query_descripcion_id);
$stmt_descripcion_id->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
$stmt_descripcion_id->execute();
$descripcion_id = $stmt_descripcion_id->fetchColumn();

// Actualizar la descripción
$query_update_descripcion = "UPDATE descripcion SET Texto_Descripcion = :descripcion WHERE ID_Descripcion = :descripcion_id";
$stmt_update_descripcion = $conexion->prepare($query_update_descripcion);
$stmt_update_descripcion->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
$stmt_update_descripcion->bindParam(':descripcion_id', $descripcion_id, PDO::PARAM_INT);
$stmt_update_descripcion->execute();

// Actualizar los datos del producto
$query_update_producto = "UPDATE productos SET Nombre = :nombre, Precio = :precio, Tipo = :tipo, ID_Marca = :marca_id, ID_Descripcion = :descripcion_id WHERE ID_Producto = :id_producto";
$stmt_update_producto = $conexion->prepare($query_update_producto);
$stmt_update_producto->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$stmt_update_producto->bindParam(':precio', $precio, PDO::PARAM_STR);
$stmt_update_producto->bindParam(':tipo', $tipo, PDO::PARAM_STR);
$stmt_update_producto->bindParam(':marca_id', $marca_id, PDO::PARAM_INT);
$stmt_update_producto->bindParam(':descripcion_id', $descripcion_id, PDO::PARAM_INT);
$stmt_update_producto->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
$stmt_update_producto->execute();

// Definir el mapeo de combinaciones a ID_Variedad
$variedades = [
    'Único' => ['Negro' => 1, 'Blanco' => 2],
    '38' => ['Negro' => 3, 'Blanco' => 4],
    '37' => ['Negro' => 5, 'Blanco' => 6],
    'M' => ['Negro' => 7, 'Blanco' => 8],
    'S' => ['Negro' => 9, 'Blanco' => 10],
];

// Obtener ID_Variedad correspondiente
if (isset($variedades[$talle][$color])) {
    $id_variedad = $variedades[$talle][$color];

    // Actualizar el stock y ID_Variedad en prod_var
    $query_update_prod_var = "UPDATE prod_var SET Stock = :stock, ID_Variedad = :id_variedad WHERE ID_Producto = :id_producto";
    $stmt_update_prod_var = $conexion->prepare($query_update_prod_var);
    $stmt_update_prod_var->bindParam(':stock', $stock, PDO::PARAM_INT);
    $stmt_update_prod_var->bindParam(':id_variedad', $id_variedad, PDO::PARAM_INT);
    $stmt_update_prod_var->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
    $stmt_update_prod_var->execute();
} else {
    $_SESSION['mensaje'] = 'Combinación de talle y color inválida.';
    header('Location: ../admin_productos.php');
    exit();
}

// Lógica para actualizar la imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $directorio_imagenes = "../../img/";
    $archivo_imagen = basename($_FILES['imagen']['name']);
    $ruta_imagen = $directorio_imagenes . $archivo_imagen;

    // Mover la imagen al directorio correspondiente
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
        // Actualizar la URL de la imagen en la base de datos
        $query_img = "UPDATE img i
                      JOIN productos p ON i.ID_Img = p.ID_Img
                      SET i.Ruta = :ruta, i.Alt_img = :alt
                      WHERE p.ID_Producto = :id_producto";
        $stmt_img = $conexion->prepare($query_img);
        $stmt_img->bindParam(':ruta', $archivo_imagen); // Solo se guarda el nombre del archivo, no la ruta completa
        $stmt_img->bindParam(':alt', $nombre);
        $stmt_img->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt_img->execute();
    } else {
        echo "Error al subir la imagen.";
    }
}

$_SESSION['mensaje'] = 'Producto editado exitosamente.';
header('Location: ../index.php?sec=admin_productos&success=2');
exit();
