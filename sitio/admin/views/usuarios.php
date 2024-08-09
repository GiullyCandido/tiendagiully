<?php
    // Obtener datos de los clientes y usuarios
    $clientes = (new Clientes())->obtenerDatosClientes();
    $usuarios = (new Usuario())->obtenerDatosUsuarios();

    // Combinar los datos
    $datos = array_merge($clientes, $usuarios);

?>

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold titulosSecciones">Administrar Usuarios y Clientes</h1>

    <!-- Mostrar mensaje de éxito si existe uno en la URL -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success text-center">
            <?= htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <div class="row mb-5">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Rol</th>
                    <th>Email</th>
                    <th>Nombre de Usuario</th>
                    <th>Nombre Completo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $dato): ?>
                    <tr>
                        <td><?= htmlspecialchars($dato['Tipo'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($dato['rol'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($dato['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($dato['nombre_usuario'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($dato['nombre_completo'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
