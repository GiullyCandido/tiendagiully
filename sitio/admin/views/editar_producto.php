<?php
$id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_producto <= 0) {
    die("ID de producto inválido.");
}

$conexion = (new Conexion())->getConexion();

// Obtener los datos del producto
$query = "SELECT p.ID_Producto, p.Nombre, p.Precio, p.Tipo, m.Nombre AS Nombre_Marca, d.ID_Descripcion, d.Texto_Descripcion, i.Ruta AS Ruta_Imagen, v.Talle, v.Color, pv.Stock
          FROM productos p
          JOIN marca m ON p.ID_Marca = m.ID_Marca
          JOIN descripcion d ON p.ID_Descripcion = d.ID_Descripcion
          JOIN img i ON p.ID_Img = i.ID_Img
          JOIN prod_var pv ON p.ID_Producto = pv.ID_Producto
          JOIN variedad v ON pv.ID_Variedad = v.ID_Variedad
          WHERE p.ID_Producto = :id_producto";

$stmt = $conexion->prepare($query);
$stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
$stmt->execute();
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    die("No se encontró el producto.");
}

// Obtener todas las marcas
$query_marca = "SELECT Nombre FROM marca";
$stmt_marca = $conexion->prepare($query_marca);
$stmt_marca->execute();
$marcas = $stmt_marca->fetchAll(PDO::FETCH_ASSOC);

// Obtener todas las descripciones
$query_descripcion = "SELECT Texto_Descripcion FROM descripcion";
$stmt_descripcion = $conexion->prepare($query_descripcion);
$stmt_descripcion->execute();
$descripciones = $stmt_descripcion->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold">Editar Producto</h1>

    <form action="actions/editar_producto_acc.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_producto" value="<?= htmlspecialchars($producto['ID_Producto'], ENT_QUOTES, 'UTF-8') ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['Nombre'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?= htmlspecialchars($producto['Precio'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="col-md-12 mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="" disabled selected>Seleccionar Tipo</option>
                <option value="bolso" <?= $producto['Tipo'] == 'bolso' ? 'selected' : '' ?>>Bolso</option>
                <option value="ropa" <?= $producto['Tipo'] == 'ropa' ? 'selected' : '' ?>>Ropa</option>
                <option value="zapato" <?= $producto['Tipo'] == 'zapato' ? 'selected' : '' ?>>Zapato</option>
            </select>
        </div>

        <div class="col-md-12 mb-3">
            <label for="talle" class="form-label">Talle</label>
            <select class="form-select" id="talle" name="talle" required>
                <option value="" disabled selected>Seleccionar Talle</option>
                <!-- Opciones dinámicas aquí -->
            </select>
        </div>

        <div class="col-md-12 mb-3">
            <label for="color" class="form-label">Color</label>
            <select class="form-select" id="color" name="color" required>
                <option value="" disabled selected>Seleccionar Color</option>
                <option value="Negro" <?= $producto['Color'] == 'Negro' ? 'selected' : '' ?>>Negro</option>
                <option value="Blanco" <?= $producto['Color'] == 'Blanco' ? 'selected' : '' ?>>Blanco</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="<?= htmlspecialchars($producto['Nombre_Marca'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?= htmlspecialchars($producto['Texto_Descripcion'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
            <img src="../img/<?= htmlspecialchars($producto['Ruta_Imagen'], ENT_QUOTES, 'UTF-8') ?>" alt="Imagen del Producto" class="img-fluid mt-3" style="max-width: 150px;">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?= htmlspecialchars($producto['Stock'], ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipoSelect = document.getElementById('tipo');
        const talleSelect = document.getElementById('talle');

        function actualizarOpcionesTalle() {
            const tipo = tipoSelect.value;
            let opcionesTalle = [];

            if (tipo === 'bolso') {
                opcionesTalle = ['Único'];
            } else if (tipo === 'zapato') {
                opcionesTalle = ['37', '38'];
            } else if (tipo === 'ropa') {
                opcionesTalle = ['M', 'S'];
            }

            // Limpiar opciones actuales
            talleSelect.innerHTML = '<option value="" disabled selected>Seleccionar Talle</option>';

            // Añadir nuevas opciones
            opcionesTalle.forEach(function(talle) {
                const option = document.createElement('option');
                option.value = talle;
                option.textContent = talle;
                if (talle === '<?= htmlspecialchars($producto['Talle'], ENT_QUOTES, 'UTF-8') ?>') {
                    option.selected = true;
                }
                talleSelect.appendChild(option);
            });
        }

        tipoSelect.addEventListener('change', actualizarOpcionesTalle);

        actualizarOpcionesTalle();
    });
</script>
