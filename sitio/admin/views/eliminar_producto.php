<?php

$id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_producto <= 0) {
    die("ID de producto inválido.");
}

$conexion = (new Conexion())->getConexion();

try {
    $conexion->beginTransaction();

    // Obtener ID_Img y ID_Descripcion del producto
    $query = "SELECT ID_Img, ID_Descripcion FROM productos WHERE ID_Producto = :id_producto";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id_img = $result['ID_Img'];
        $id_descripcion = $result['ID_Descripcion'];

        // Obtener los IDs de los pedidos relacionados con el producto
        $query = "SELECT DISTINCT dp.ID_pedido 
                  FROM detalles_pedidos dp 
                  JOIN prod_var pv ON dp.ID_prod_var = pv.ID_prod_var 
                  WHERE pv.ID_Producto = :id_producto";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Eliminar de detalles_pedidos (elimina la relación del producto con los pedidos)
        $query = "DELETE FROM detalles_pedidos WHERE ID_prod_var IN (
            SELECT ID_prod_var FROM prod_var WHERE ID_Producto = :id_producto
        )";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si los pedidos ya no tienen detalles y eliminarlos
        foreach ($pedidos as $pedido) {
            $id_pedido = $pedido['ID_pedido'];

            $query = "SELECT COUNT(*) AS count FROM detalles_pedidos WHERE ID_pedido = :id_pedido";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                // Eliminar el pedido si no tiene más detalles
                $query = "DELETE FROM pedidos WHERE ID_pedido = :id_pedido";
                $stmt = $conexion->prepare($query);
                $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                $stmt->execute();
            }
        }

        // Eliminar de prod_var
        $query = "DELETE FROM prod_var WHERE ID_Producto = :id_producto";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();

        // Eliminar de productos
        $query = "DELETE FROM productos WHERE ID_Producto = :id_producto";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();

        // Eliminar de img
        $query = "DELETE FROM img WHERE ID_Img = :id_img";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id_img', $id_img, PDO::PARAM_INT);
        $stmt->execute();

        // Eliminar de descripcion
        $query = "DELETE FROM descripcion WHERE ID_Descripcion = :id_descripcion";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':id_descripcion', $id_descripcion, PDO::PARAM_INT);
        $stmt->execute();

        // No borrar marca porque si elimina una marca que está siendo utilizada en otros productos me rompería todo el código
    } else {
        throw new Exception("Producto no encontrado.");
    }

    $conexion->commit();
    header("Location: index.php?sec=admin_productos");
} catch (Exception $e) {
    $conexion->rollBack();
    echo "Error: " . $e->getMessage();
}
?>

