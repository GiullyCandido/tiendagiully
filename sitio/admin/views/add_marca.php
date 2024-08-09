<?php 
    $marcas = (new Marca())->catalogo_completo();
?>

<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Agregar Marca</h1>
        <form id="formulario_marca" class="row g-3" action="actions/add_marca_acc.php" method="POST">
            <div class="col-md-6 mb-3">
                <label for="ID_Marca" class="form-label">Marca Existente</label>
                <select class="form-select" id="ID_Marca" name="ID_Marca" >
                    <option value="">Seleccionar Marca</option>
                    <?php foreach ($marcas as $marca) { ?>
                        <option value="<?= $marca->getIDMarca() ?>"><?= $marca->getNombre() ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="Nombre" class="form-label">Agregar Nueva Marca</label>
                <input type="text" class="form-control" id="Nombre" name="Nombre">
            </div>
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('formulario_marca');
        var idMarcaSelect = document.getElementById('ID_Marca');
        var nombreInput = document.getElementById('Nombre');

        form.addEventListener('submit', function (event) {
            // Verifico si ambos campos están llenos
            if (idMarcaSelect.value !== '' && nombreInput.value !== '') {
                alert('Por favor, selecciona una marca existente o ingresa una nueva marca, pero no ambas.');
                event.preventDefault(); // Evita que se envíe el formulario
            }
            if (idMarcaSelect.value == '' && nombreInput.value == '') {
                alert('Por favor, selecciona una marca existente o ingresa una nueva marca.');
                event.preventDefault(); // Evita que se envíe el formulario
            }
            
        });
    });
</script>



