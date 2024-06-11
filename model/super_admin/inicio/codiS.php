<?php
session_start();
require_once "../../../db/connection.php";

// Conexión a la base de datos
$db = new Database();
$con = $db->conectar();

// Verificar si se ha enviado el formulario de recuperación
if (isset($_POST['recuperar'])) {
    $codigo = $_POST['codigo'];

    // Consulta para verificar el código en la base de datos
    $sql = $con->prepare("SELECT * FROM usuarios WHERE token='$codigo'");
    $sql->execute();
    $fila = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Si se encuentra el código, redirige a la página de administrador
    if ($fila) {
        echo '<script>alert("Su código ha sido verificado correctamente");</script>';
        echo '<script>window.location="admin.php"</script>';
    } else {
        // Si el código no coincide, muestra una alerta y redirige a la página de inicio de sesión
        echo '<script>alert("El código digitado no coincide con el código enviado");</script>';
        echo '<script>window.location="logins.php"</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
  <title>Recuperar Contraseña</title>
  <!-- Agrega tus estilos CSS y otras bibliotecas aquí -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../../../css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../css/style.css" rel="stylesheet">
  <link href="../../../css/recuperar_con.css" rel="stylesheet">
</head>
<body>
<div class="container-xxl py-5">
  <div class="bg-light rounded">
    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
      <div class="h-100 d-flex flex-column justify-content-center p-5 contenido">
        <form action="" method="POST" name="form1">
        <h1 style="font-family: 'Arial Rounded MT Bold', sans-serif;">Ingresa Codigo</h1>

          <div class="row g-3 inputs">
            <div class="col-sm-6 user">
            <div class="form-floating">
    <input class="form-control border-0 gmail" name="codigo" id="c" type="text" placeholder="Código">
    <label for="c">Código</label>
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
