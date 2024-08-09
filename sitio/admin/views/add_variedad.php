<?php
$nuevo_producto = $_SESSION['nuevo_producto'];
$tipo = $nuevo_producto->Tipo;

$opciones_talle = [];
if ($tipo === 'bolso') {
    $opciones_talle = ['Único'];
} elseif ($tipo === 'zapato') {
    $opciones_talle = ['37', '38'];
} elseif ($tipo === 'ropa') {
    $opciones_talle = ['M', 'S'];
}

$opciones_color = ['Negro', 'Blanco'];
?>


<div class="container my-5">
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <h1 class="text-center mb-5 fw-bold">Agregar Tipo</h1>
            <form action="actions/add_variedad_acc.php" method="POST" class="row g-4">
                <div class="col-md-12 mb-3">
                    <label for="Talle" class="form-label">Talle</label>
                    <select class="form-select" id="Talle" name="Talle" required>
                        <option value="" disabled selected>Seleccionar Talle</option>
                        <?php foreach ($opciones_talle as $talle) : ?>
                            <option value="<?= htmlspecialchars($talle, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($talle, ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="Color" class="form-label">Color</label>
                    <select class="form-select" id="Color" name="Color" required>
                        <option value="" disabled selected>Seleccionar Color</option>
                        <?php foreach ($opciones_color as $color) : ?>
                            <option value="<?= htmlspecialchars($color, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($color, ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Agregar Tipo</button>
                </div>
            </form>
        </div>
    </div>
</div>

