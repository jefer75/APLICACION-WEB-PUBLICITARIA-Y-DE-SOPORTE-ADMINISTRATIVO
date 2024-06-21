<?php
require_once "../../../db/connection.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ELITECH</title>
  <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/unicode-15/bw/512px/1f9d1-1f4bb.png">
  <link rel="stylesheet" href="../css/conf.css">
  <!-- Agrega tus estilos CSS y otras bibliotecas aquí -->
 
</head>
<body>
<header class="header">
    <nav class="navbar">
      <h2 class="logo"><a href="#">ELITECH JYDT</a></h2>
      <div class="buttons">
        <a href="logins.php" class="signup">Regresar</a>
      </div>
    </nav>
  </header>

<div class="container_mayor">

  <div class="container">
    <div class="contenido-interior">
      <div class="h-100 d-flex flex-column justify-content-center p-5 contenido">
        <form method="POST" action="../../../controller/inicioS.php" name="form1">
        <h1 style="font-family: 'Arial Rounded MT Bold', sans-serif;">Ingresa Codigo</h1>

          <div class="row g-3 inputs">
            <div class="col-sm-6 user">
            <div class="form-floating">
    <input class="form-control" name="cedula" id="cedula" type="number" placeholder="Cedula">
    <input class="form-control border-0 gmail" name="codigo" id="c" type="password" placeholder="Código">
</div>

<script>
    // Obtenemos el input de código
    var codigoInput = document.getElementById('c');

    // Agregamos un event listener para el evento 'input'
    codigoInput.addEventListener('input', function() {
        // Obtenemos el valor actual del input
        var valor = this.value;

        // Removemos cualquier carácter que no sea letra o número
        valor = valor.replace(/[^a-zA-Z0-9]/g, '');

        // Limitamos el valor a 4 caracteres
        valor = valor.slice(0, 4);

        // Actualizamos el valor del input
        this.value = valor;
    });
</script>
            </div>
            <div class="col-12">
            <button type="submit" name="recuperar" class="btn btn-primary w-100 py-3 ingresar" style="background-color: blue; border-color: white;">Ingresar</button>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>