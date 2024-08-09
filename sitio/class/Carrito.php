<?php
class Carrito {
    /* Agregar un item */
    public function agregar_item(int $productoID, int $cantidad, $color = '', $talle = '') {
        $item = (new ProductosClass())->catalogo_x_id($productoID);
        if ($item) {

            // Obtener el id_prod_var correspondiente a la variedad seleccionada (color y talle)
            $id_prod_var = $this->obtenerIdProdVar($productoID, $color, $talle);

            // Verificar si se encontró id_prod_var
            if (!$id_prod_var) {
                // Manejar el caso de error, por ejemplo, no se encontró la variedad deseada
                // Puedes lanzar una excepción o agregar una alerta al usuario
                return;
            }

            $key = $productoID . '_' . $color . '_' . $talle;
            if (isset($_SESSION['carrito'][$key])) {
                // Si el producto ya existe en el carrito, incremento la cantidad
                $_SESSION['carrito'][$key]['cantidad'] += $cantidad;
            } else {
                // Si el producto no existe, agrego como nuevo item
                $_SESSION['carrito'][$key] = [
                    "nombre" => $item->getNombre(),
                    "imagen" => $item->getIDImg(),
                    "precio" => $item->getPrecio(),
                    "cantidad" => $cantidad,
                    "descripcion" => $item->getIDDescripcion(),
                    "marca" => $item->getIDMarca(),
                    "color" => $color,
                    "talle" => $talle,
                    "id_prod_var" => $id_prod_var 
                ];
            }
        }
    }

    private function obtenerIdProdVar($productoID, $color, $talle) {
        try {
            $conexion = new Conexion();
            $db = $conexion->getConexion();
            $query = "
                SELECT pv.ID_prod_var
                FROM prod_var pv
                JOIN variedad v ON pv.ID_Variedad = v.ID_Variedad
                WHERE pv.ID_Producto = :id_producto
                AND v.Color = :color
                AND v.Talle = :talle
            ";

            $PDOStatement = $db->prepare($query);
            $PDOStatement->bindParam(':id_producto', $productoID, PDO::PARAM_INT);
            $PDOStatement->bindParam(':color', $color, PDO::PARAM_STR);
            $PDOStatement->bindParam(':talle', $talle, PDO::PARAM_STR);
            $PDOStatement->execute();

            $id_prod_var = $PDOStatement->fetchColumn();  // Obtener solo el valor de ID_prod_var

            return $id_prod_var;
        } catch (PDOException $e) {
            // Manejar errores de PDO
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    /* Eliminar un item */
    public function eliminar_item_carrito($key) {
        if (isset($_SESSION["carrito"][$key])) {
            unset($_SESSION["carrito"][$key]);
        }
    }

    /* Devolver el carrito completo */
    public function get_carrito(): array {
        if (isset($_SESSION["carrito"])) {
            return $_SESSION["carrito"];
        }
        return [];
    }

    /* Actualizar cantidades */
    public function actualizar_carrito(array $cantidades) {
        foreach ($cantidades as $key => $cantidad) {
            if (isset($_SESSION["carrito"][$key])) {
                $_SESSION["carrito"][$key]["cantidad"] = $cantidad;
            }
        }
    }

    /* Vaciar el carrito */
    public function vaciar_carrito() {
        $_SESSION["carrito"] = [];
    }

    public function finalizar_compra($id_cliente) {
        // Verificar si el id_cliente es válido y si el usuario está logueado
        if (empty($id_cliente)) {
            (new Alerta())->add_alerta("Para realizar tu compra debes estar logueado a tu cuenta. Por favor inicia sesión.", "warning");
            header("Location: ../../index.php?sec=log_in");
            exit;
        }

        // Insertar el pedido y sus detalles solo si el usuario está logueado
        try {
            $conexion = (new Conexion())->getConexion();
            $conexion->beginTransaction(); // Iniciar transacción

            // Calcular el total del pedido basándose en los artículos del carrito
            $total_pedido = 0;
            foreach ($_SESSION['carrito'] as $item) {
                $total_pedido += $item['cantidad'] * $item['precio'];
            }

            // Insertar el pedido en la tabla pedidos
            $query_pedido = "INSERT INTO pedidos (id_cliente, fecha, total) VALUES (:id_cliente, NOW(), :total)";
            $stmt_pedido = $conexion->prepare($query_pedido);
            $stmt_pedido->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $stmt_pedido->bindParam(':total', $total_pedido, PDO::PARAM_STR);
            $stmt_pedido->execute();

            // Obtener el id_pedido generado
            $id_pedido = $conexion->lastInsertId();

            if ($id_pedido) {
                // Iterar sobre los productos en el carrito y guardar los detalles en detalles_pedidos
                foreach ($_SESSION['carrito'] as $item) {
                    $query_detalle = "INSERT INTO detalles_pedidos (id_pedido, id_prod_var, cantidad, precio) VALUES (:id_pedido, :id_prod_var, :cantidad, :precio)";
                    $stmt_detalle = $conexion->prepare($query_detalle);
                    $stmt_detalle->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                    $stmt_detalle->bindParam(':id_prod_var', $item['id_prod_var'], PDO::PARAM_INT);
                    $stmt_detalle->bindParam(':cantidad', $item['cantidad'], PDO::PARAM_INT);
                    $stmt_detalle->bindParam(':precio', $item['precio'], PDO::PARAM_STR);
                    $stmt_detalle->execute();
                }

                // Commit de la transacción si todo fue exitoso
                $conexion->commit();

                // Vaciar el carrito después de finalizar la compra
                $this->vaciar_carrito();

                // Agregar una alerta de éxito en la sesión
                $_SESSION['alerta'] = ["mensaje" => "Compra realizada con éxito.", "tipo" => "success"];

                // Redirigir a alguna página de confirmación
                header("Location: ../../index.php?sec=confirmacion_compra"); 
                exit;
            } else {
                // Rollback si hubo algún error al insertar el pedido
                $conexion->rollback();
                (new Alerta())->add_alerta("Error al procesar la compra. Por favor inténtalo nuevamente.", "danger");
                header("Location: ../../index.php");
                exit;
            }
        } catch (PDOException $e) {
            // Manejar errores de PDO
            echo "Error en la transacción: " . $e->getMessage();
            exit;
        }
    }
}
    
    

?>