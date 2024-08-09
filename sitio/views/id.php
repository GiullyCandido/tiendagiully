<?php
// Obtener el ID del producto desde la URL
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
$error = isset($_GET["error"]) ? $_GET["error"] : '';

// Obtener el producto específico basado en el ID
$producto = (new ProductosClass())->catalogo_x_id($id);

if ($producto === null) {
    // Si el producto no se encuentra, mostrar un mensaje
    echo '<p>Producto no encontrado.</p>';
    exit;
}

// Obtener variedades del producto (colores y talles)
$variedades = $producto->obtenerVariedades();
$colores = array_unique(array_column($variedades, 'Color'));
$talles = array_unique(array_column($variedades, 'Talle'));
?>

<?php if ($error === 'no_stock') { ?>
    <div class="alert alert-danger" role="alert">
        No hay stock de esta variedad de producto.
    </div>
<?php } ?>

<div class="container my-5">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-6 m-auto">
            <div class="card mb-3 border-secondary h-100">
                <img class="card-img-top" src="img/<?= $producto->getIDImg() ?>" alt="<?= $producto->getNombre() ?>">
                <div class="card-body">
                    <h3 class="fs-6 m-0 fw-bold"><?= $producto->getIDMarca() ?></h3>
                    <h2 class="card-title"><?= $producto->getNombre() ?></h2>
                    <p class="card-text"><?= $producto->getIDDescripcion() ?></p>

                    <!-- Select para colores -->
                    <div class="color-picker">
                        <label for="selectColor" class="form-label">Color:</label>
                        <select id="selectColor" name="color" class="form-select">
                            <?php foreach ($colores as $color) { ?>
                                <option value="<?= htmlspecialchars($color) ?>"><?= htmlspecialchars($color) ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Select para talles -->
                    <div class="talle-picker mt-3">
                        <label for="selectTalle" class="form-label">Talle:</label>
                        <select id="selectTalle" name="talle" class="form-select">
                            <?php foreach ($talles as $talle) { ?>
                                <option value="<?= htmlspecialchars($talle) ?>"><?= htmlspecialchars($talle) ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">$<?= $producto->getPrecio() ?> (dolares)</li>
                </ul>
                <div class="card-body">
                    <a href="index.php?sec=home" class="btn btn-secondary w-100 fw-bold">VOLVER A INICIO</a>
                    <!-- BOTÓN PARA AÑADIR AL CARRITO -->
                    <a id="addToCartBtn" href="#" class="btn btn-primary w-100 mt-2 fw-bold">AÑADIR AL CARRITO</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('addToCartBtn').addEventListener('click', function (e) {
        e.preventDefault();
        var color = document.getElementById('selectColor').value;
        var talle = document.getElementById('selectTalle').value;
        var productoID = <?= $producto->getIDProducto() ?>;
        var url = 'admin/actions/add_item_acc.php?id=' + productoID + '&color=' + encodeURIComponent(color) + '&talle=' + encodeURIComponent(talle);
        window.location.href = url;
    });
</script>


