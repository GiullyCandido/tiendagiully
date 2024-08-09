<?php
$productos = (new ProductosClass())->catalogo_completo();
// Obtener todas las marcas del catálogo completo
$marcas = (new Marca())->catalogo_completo();

?>

<div class="container">
    <div class="row my-5">
        <div class="col-12">
            <h1 class="text-center mb-4 fw-bold titulosSecciones">Agregar un producto nuevo</h1>
            <p class="lead text-center mb-5">Aquí puedes agregar un nuevo producto a nuestra tienda.</p>
            <div class="text-center">
                <a href="index.php?sec=add_marca" class="btn btn-primary btn-lg">Agregar Producto</a>
            </div>
        </div>
    </div>
</div>
