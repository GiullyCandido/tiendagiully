<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h1 class="card-title text-center">Iniciar sesión</h1>
                    <?= (new Alerta())->get_alertas() ?>
                    <form action="actions/acc_aut_login.php" method="post">
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
