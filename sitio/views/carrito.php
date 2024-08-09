<?php
$miCarrito = new Carrito();
$items = $miCarrito->get_carrito();
?>

<h1 class="text-center fs-2 my-5 titulosSecciones">Carrito de Compras</h1>
<div class="container my-4">
    <?= (new Alerta())->get_alertas() ?>
    <?php if (count($items)) { ?>
        <form action="admin/actions/actualizar_carrito_acc.php" method="POST">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" width="25%">Foto</th>
                        <th scope="col" width="25%">Descripción del producto</th>
                        <th scope="col" width="8%">Color</th>
                        <th scope="col" width="8%">Talle</th>
                        <th scope="col" width="8%">Cantidad</th>
                        <th class="text-end" scope="col" width="8%">Precio Unitario</th>
                        <th class="text-end" scope="col" width="8%">Subtotal</th>
                        <th class="text-end" scope="col" width="8%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $id => $item) { ?>
                        <tr>
                            <td><img src="img/<?= $item["imagen"] ?>" alt="Imagen ilustrativa <?= $item["nombre"] ?>" class="img-fluid rounded shadow-sm"></td>
                            <td class="align-middle">
                                <h2 class="h5"><?= $item['nombre'] ?></h2>
                                <p class="m-0"><?= $item['descripcion'] ?></p>
                                <p class="m-0 text-muted">Marca: <?= $item['marca'] ?></p>
                            </td>
                            <td class="align-middle"><?= $item['color'] ?></td>
                            <td class="align-middle"><?= $item['talle'] ?></td>
                            <td class="align-middle">
                                <label for="c_<?= $id ?>" class="form-label">Cantidad</label>
                                <input type="number" id="c_<?= $id ?>" value="<?= $item["cantidad"] ?>" name="c[<?= $id ?>]" class="form-control">
                            </td>
                            <td class="text-end align-middle">
                                <span class="h5">$<?= $item['precio'] ?></span>
                            </td>
                            <td class="text-end align-middle">
                                <span class="h5">$<?= $item['precio'] * $item["cantidad"] ?>.00</span>
                            </td>
                            <td class="text-end align-middle">
                                <a href="admin/actions/eliminar_item_acc.php?id=<?= $id ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-warning">Actualizar cantidades</button>
                <a class="btn btn-success" href="index.php">Seguir comprando</a>
                <a class="btn btn-danger" href="admin/actions/vaciar_carrito_acc.php">Vaciar Carrito</a>
            </div>
        </form>
        <form action="admin/actions/finalizar_compra_acc.php" method="POST">
            <button type="submit" class="btn btn-secondary">Finalizar Compra</button>
        </form>
    <?php } else { ?>
        <h2 class="text-center mb-5 text-danger">Su carrito está vacío</h2>
        <div class="d-flex justify-content-center">
            <a class="btn btn-success" href="index.php">Seguir comprando</a>
        </div>
    <?php } ?>
</div>
