<?php
$productos = (new ProductosClass())->catalogo_completo();
?>

<div id="carouselExampleIndicators" class="carousel carousel-dark slide carousel-fade mb-3" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="3000">
            <img src="./img/fotoCarrucel1.jpg" class="d-block w-100" alt="Producto de la tienda Giully">
        </div>
        <div class="carousel-item" data-bs-interval="3000">
            <img src="./img/fotoCarrucel2.jpg" class="d-block w-100" alt="Producto de la tienda Giully">
        </div>
        <div class="carousel-item" data-bs-interval="3000">
            <img src="./img/fotoCarrucel3.jpg" class="d-block w-100" alt="Producto de la tienda Giully">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div class="container-fluid">
    <div class="row">
        <?php foreach ($productos as $producto) { ?>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-secondary h-100">
                    <div class="img-container mb-3" style="width: 100%; height: 400px; overflow: hidden;">
                        <img class="img-fluid" src="img/<?= htmlspecialchars($producto->getIDImg()) ?>" alt="<?= htmlspecialchars($producto->getNombre()) ?>" style="width: 100%; height: 100%; object-fit: cover;" />
                    </div>
                    <div class="card-body">
                        <h3 class="fs-6 m-0 fw-bold"><?= $producto->getIDMarca() ?></h3>
                        <h2 class="card-title fs-4"><?= $producto->getNombre() ?></h2>
                        <p class="card-text fs-6">$<?= htmlspecialchars($producto->getPrecio()) ?></p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="index.php?sec=id&id=<?= htmlspecialchars($producto->getIDProducto()) ?>" class="btn btn-secondary w-100 fw-bold">Ver Detalles</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

