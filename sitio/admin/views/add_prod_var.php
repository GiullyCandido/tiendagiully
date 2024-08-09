<div class="row my-5">
    <div class="col-md-8 col-lg-6 mx-auto">
        <h1 class="text-center mb-5 fw-bold">Agregar Stock del Producto</h1>
        <form class="row g-4" action="actions/add_prod_var_acc.php" method="POST">
            <div class="col-md-12 mb-3">
                <label for="Stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="Stock" name="Stock" placeholder="Stock del producto" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Agregar Stock</button>
            </div>
        </form>
    </div>
</div>
