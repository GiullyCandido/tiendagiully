<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Agregar una Imagen del producto</h1>
        <div class="row mb-5 d-flex align-items-center">
            <form class="row g-3" action="actions/add_img_acc.php" method="POST" enctype="multipart/form-data">
                <div class="col-md-12 mb-3">
                    <label for="Ruta" class="form-label">Imagen del Producto</label>
                    <input type="file" class="form-control" id="Ruta" name="Ruta" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Cargar</button>
            </form>
        </div>
    </div>
</div>
