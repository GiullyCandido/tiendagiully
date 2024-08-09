<?php
// Obtener los pedidos
$clientes = new Clientes();
$pedidos = $clientes->obtenerPedidos();
?>

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold titulosSecciones">Administrar Pedidos</h1>

    <div class="row mb-5">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre del Cliente</th>
                    <th>Email del Cliente</th>
                    <th>Fecha del Pedido</th>
                    <th>Precio Total del Pedido</th>
                    <th>Productos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= htmlspecialchars($pedido['Nombre_Cliente'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($pedido['Email_Cliente'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($pedido['Fecha_Pedido'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>$<?= htmlspecialchars($pedido['Total_Pedido'], ENT_QUOTES, 'UTF-8') ?>,00</td>
                        <td>
                            <?php foreach ($pedido['Productos'] as $producto): ?>
                                <?= htmlspecialchars($producto['Nombre_Producto'], ENT_QUOTES, 'UTF-8') ?> - 
                                <?= htmlspecialchars($producto['Color'], ENT_QUOTES, 'UTF-8') ?>, 
                                <?= htmlspecialchars($producto['Talle'], ENT_QUOTES, 'UTF-8') ?> - 
                                Cantidad: <?= htmlspecialchars($producto['Cantidad'], ENT_QUOTES, 'UTF-8') ?><br>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
