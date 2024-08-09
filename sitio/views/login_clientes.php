<?php

// Verifico si el usuario está logueado
if (isset($_SESSION['login'])) {
    $nombre_usuario = $_SESSION['login']['usuario'];
    $email = $_SESSION['login']['email'];
    $nombre_completo = $_SESSION['login']['nombre_completo'];
    $id_cliente = $_SESSION['login']['id'];
    
    // Instancio la clase Clientes para obtener los pedidos del cliente
    $clientes = new Clientes();
    $pedidos = $clientes->obtenerPedidosCliente($id_cliente);
    ?>
    <div class="container">
        <div class="my-5">
            <h1 class="display-4 text-center mb-4">Bienvenido(a), <?php echo htmlspecialchars($nombre_usuario); ?>!</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title titulosSecciones">Tus Datos Personales:</h2>
                    <p class="mb-2"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                    <p class="mb-2"><strong>Nombre Completo:</strong> <?php echo htmlspecialchars($nombre_completo); ?></p>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title titulosSecciones">Tus Pedidos:</h2>
                    <?php if (!empty($pedidos)) : ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Fecha del Pedido</th>
                                        <th>Total del Pedido</th>
                                        <th>Productos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pedidos as $pedido) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($pedido['Fecha_Pedido']); ?></td>
                                            <td>$<?php echo htmlspecialchars($pedido['Total_Pedido']); ?>,00</td>
                                            <td>
                                                <ul class="list-unstyled">
                                                    <?php foreach ($pedido['Productos'] as $producto) : ?>
                                                        <li>
                                                            <?php echo htmlspecialchars($producto['Nombre_Producto']); ?> - 
                                                            <?php echo htmlspecialchars($producto['Talle']); ?> - 
                                                            <?php echo htmlspecialchars($producto['Color']); ?> - 
                                                            Cantidad: <?php echo htmlspecialchars($producto['Cantidad']); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <p>No tienes pedidos realizados.</p>
                    <?php endif; ?>
                </div>
            </div>

            <form action="admin/actions/acc_logout_clientes.php" method="post">
                <button type="submit" class="btn btn-danger btn-lg btn-block">Salir de mi cuenta</button>
            </form>
        </div>
    </div>
    <?php
} else {
    // Usuario no está logueado:
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Iniciar sesión</h1>
                        <?php
                        if (isset($_SESSION['alerta'])) {
                            $alerta = $_SESSION['alerta'];
                            echo '<div class="alert alert-' . htmlspecialchars($alerta['tipo']) . '">' . htmlspecialchars($alerta['mensaje']) . '</div>';
                            unset($_SESSION['alerta']); // Limpiar la alerta después de mostrarla
                        }
                        ?>
                        <?= (new Alerta())->get_alertas() ?>
                        <form action="admin/actions/acc_login_clientes.php" method="post">
                            <div class="form-group">
                                <label for="email">Ingresar email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" name="pass" id="pass" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                        </form>
                        <p class="mt-3 text-center">¿No tienes una cuenta? <a href="index.php?sec=registro">Regístrate aquí</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
