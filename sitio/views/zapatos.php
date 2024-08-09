<?php
// Obtengo el producto Deseado
$tipoDeProducto = 'zapato';
// Creo una instancia de ProductosClass
$productosPorTipo = (new ProductosClass())->catalogo_x_tipoDeproducto($tipoDeProducto);
?>

<h1 class="text-center my-5 titulosSecciones"><?= strtoupper($tipoDeProducto) ?>S</h1>

<div class="container-fluid">
    <div class="row">
        <?php foreach ($productosPorTipo as $producto) { ?>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-secondary h-100">
                    <div class="img-container mb-3" style="width: 100%; height: 400px; overflow: hidden;">
                        <img class="img-fluid" src="img/<?= htmlspecialchars($producto->getIDImg()) ?>" alt="<?= htmlspecialchars($producto->getNombre()) ?>" style="width: 100%; height: 100%; object-fit: cover;" />
                    </div>
                    <div class="card-body">
                        <h3 class="fs-6 m-0 fw-bold"><?= $producto->getIDMarca() ?></h3>
                        <h2 class="card-title fs-4"><?= $producto->getNombre() ?></h2>
                        <p class="card-text fs-6"><?= htmlspecialchars($producto->getIDDescripcion()) ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">$<?= htmlspecialchars($producto->getPrecio()) ?></li>
                    </ul>
                    <div class="card-footer text-center">
                        <a href="index.php?sec=id&id=<?= htmlspecialchars($producto->getIDProducto()) ?>" class="btn btn-secondary w-100 fw-bold">Ver Detalles</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>