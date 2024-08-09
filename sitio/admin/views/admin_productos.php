<?php
$conexion = (new Conexion())->getConexion();
// Obtener todos los productos
$query = "SELECT p.ID_Producto, p.Nombre, p.Precio, p.Tipo, m.Nombre AS Marca, d.Texto_Descripcion, i.Ruta AS Ruta_Imagen, v.Talle, v.Color, pv.Stock 
          FROM productos p
          JOIN marca m ON p.ID_Marca = m.ID_Marca
          JOIN descripcion d ON p.ID_Descripcion = d.ID_Descripcion
          JOIN img i ON p.ID_Img = i.ID_Img
          JOIN prod_var pv ON p.ID_Producto = pv.ID_Producto
          JOIN variedad v ON pv.ID_Variedad = v.ID_Variedad
          ORDER BY p.ID_Producto DESC";

$stmt = $conexion->prepare($query);
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifico si se debe mostrar el mensaje de éxito
if (isset($_GET['success']) && $_GET['success'] == '1') {
    echo '<script>alert("Producto agregado exitosamente.");</script>';
}
if (isset($_GET['success']) && $_GET['success'] == '2') {
    echo '<script>alert("Producto editado exitosamente.");</script>';
}

?>
<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold titulosSecciones">Administrar Productos</h1>

    <!-- Mostrar mensaje de éxito si existe uno en la URL -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success text-center">
            <?= htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <div class="row mb-5">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Talle</th>
                    <th>Color</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) : ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['ID_Producto'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($producto['Nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($producto['Precio'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($producto['Tipo'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($producto['Marca'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($producto['Texto_Descripcion'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><img src="../img/<?= htmlspecialchars($producto['Ruta_Imagen'], ENT_QUOTES, 'UTF-8') ?>" alt="Imagen del Producto" class="img-fluid" style="max-width: 150px;"></td>
                        <td><?= htmlspecialchars($producto['Talle'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($producto['Color'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($producto['Stock'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <a href="index.php?sec=editar_producto&id=<?= htmlspecialchars($producto['ID_Producto'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="index.php?sec=eliminar_producto&id=<?= htmlspecialchars($producto['ID_Producto'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto? Tenga en cuenta que también se eliminarán los pedidos que contengan este producto.')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
