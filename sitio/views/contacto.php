<?php
require_once 'form/procesar_formulario.php';
?>

<div class="container mt-5 col-sm-12 col-lg-6">
    <form action="form/procesar_formulario.php"" method="POST" class="m-auto p-2 w-75">
    <h2 class="tituloContacto">Formulario de Contacto</h2>
      <div class="form-group">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="tel" class="form-control" id="telefono" name="telefono" required>
      </div>
      <div class="form-group">
        <label for="mensaje">Mensaje:</label>
        <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn btn-secondary mt-3">Enviar</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

