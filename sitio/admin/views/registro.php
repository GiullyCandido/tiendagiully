<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h1 class="card-title text-center">Registrarse</h1>
                    <?= (new Alerta())->get_alertas() ?>
                    <form action="actions/acc_registro.php" method="post">
                        <div class="form-group">
                            <label for="email">Ingresar email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre_usuario">Nombre de usuario</label>
                            <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre_completo">Nombre completo</label>
                            <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" name="pass" id="pass" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
