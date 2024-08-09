<div class="row my-5">
    <div class="col-md-8 col-lg-6 mx-auto">
        <h1 class="text-center mb-5 fw-bold">Información del Producto</h1>
        <form class="row g-4" action="actions/add_productos_acc.php" method="POST">
            <div class="col-md-12 mb-3">
                <label for="Nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre del producto" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="Precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="Precio" name="Precio" step="0.01" placeholder="Precio del producto" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="Tipo" class="form-label">Tipo</label>
                <select class="form-select" id="Tipo" name="Tipo" required>
                    <option value="" disabled selected>Seleccionar Tipo</option>
                    <option value="bolso">Bolso</option>
                    <option value="ropa">Ropa</option>
                    <option value="zapato">Zapato</option>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Agregar Producto</button>
            </div>
        </form>
    </div>
</div>

