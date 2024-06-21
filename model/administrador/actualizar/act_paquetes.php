



<?php
       session_start();
       require_once("../../../db/connection.php");
       // include("../../../controller/validarSesion.php");
       $db = new Database();
       $con = $db -> conectar();

   //empieza la consulta
   $sql = $con -> prepare("SELECT * FROM paquetes WHERE id_paquetes='".$_GET['id']."'");
   $sql -> execute();
   $fila = $sql -> fetch ();

   //declaracion de variables de campos en la tabla

   if (isset($_POST['actualizar'])){

    $nombre_paquete = $_POST['nombre_paquete'];
    $edad_min = $_POST['edad_min'];
    $edad_max = $_POST['edad_max'];
    $valor= $_POST['valor'];

       
           $insert= $con -> prepare ("UPDATE paquetes SET  nombre_paquete='$nombre_paquete', edad_min='$edad_min', edad_max='$edad_max', valor='$valor' WHERE id_paquetes = '".$_GET['id']."'");
           $insert -> execute();
           echo '<script> alert ("Registro actualizado exitosamente");</script>';
           echo '<script> window.close(); </script>';
               
       }

        ?>


<!DOCTYPE html>
<html lang="en">
    <script>
        function centrar() {
            iz=(screen.width-document.body.clientWidth) / 2;
            de=(screen.height-document.body.clientHeight) / 3;
            moveTo(iz,de);
        }
    </script>
<head>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Paquetes</title>
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../../css/tablaedi.css" rel="stylesheet">

</head>

<body onload="centrar();">
  <div class="card">
        <div class="card-body">

          <h5 class="card-title">paquetes</h5>
          <form autocomplete="off"class="row g-3" name="form_actualizar" method="POST">
          <div class="col-md-6">
    <label for="nombre_paquete" class="form-label">Nombre paquete</label>
    <input name="nombre_paquete" class="form-control" value="<?php echo $fila['nombre_paquete'] ?>" id="nombre_paquete">
    <div id="error_nombre_paquete" class="invalid-feedback" style="display: none;">
        El nombre del paquete debe contener solo letras y espacios, con un máximo de 30 caracteres.
    </div>
</div>

<script>
    var nombrePaqueteInput = document.getElementById('nombre_paquete');
    var errorNombrePaquete = document.getElementById('error_nombre_paquete');

    nombrePaqueteInput.addEventListener('input', function() {
        var nombrePaquete = nombrePaqueteInput.value.trim();

        // Expresión regular para validar solo letras y espacios
        var regex = /^[a-zA-Z\s]+$/;

        if (regex.test(nombrePaquete) && nombrePaquete.length <= 30) {
            nombrePaqueteInput.classList.remove('is-invalid');
            errorNombrePaquete.style.display = 'none';
        } else {
            nombrePaqueteInput.classList.add('is-invalid');
            errorNombrePaquete.style.display = 'block';
        }
    });
</script>


<div class="col-12">
    <label for="edad_min" class="form-label">Edad mínima</label>
    <input type="number" class="form-control" name="edad_min" value="<?php echo $fila['edad_min']?>" id="edad_min">
    <div id="error_edad_min" class="invalid-feedback" style="display: none;">
        La edad mínima debe ser un número entre 1 y 100.
    </div>
</div>

<script>
    var edadMinInput = document.getElementById('edad_min');
    var errorEdadMin = document.getElementById('error_edad_min');

    edadMinInput.addEventListener('input', function() {
        var edadMin = parseInt(edadMinInput.value.trim());

        if (!isNaN(edadMin) && edadMin >= 1 && edadMin <= 100) {
            edadMinInput.classList.remove('is-invalid');
            errorEdadMin.style.display = 'none';
        } else {
            edadMinInput.classList.add('is-invalid');
            errorEdadMin.style.display = 'block';
        }
    });
</script>

<div class="col-12">
    <label for="edad_max" class="form-label">Edad máxima</label>
    <input type="number" class="form-control" name="edad_max" value="<?php echo $fila['edad_max'] ?>" id="edad_max">
    <div id="error_edad_max" class="invalid-feedback" style="display: none;">
        La edad máxima debe ser un número entre 1 y 100.
    </div>
</div>

<script>
    var edadMaxInput = document.getElementById('edad_max');
    var errorEdadMax = document.getElementById('error_edad_max');

    edadMaxInput.addEventListener('input', function() {
        var edadMax = parseInt(edadMaxInput.value.trim());

        if (!isNaN(edadMax) && edadMax >= 1 && edadMax <= 100) {
            edadMaxInput.classList.remove('is-invalid');
            errorEdadMax.style.display = 'none';
        } else {
            edadMaxInput.classList.add('is-invalid');
            errorEdadMax.style.display = 'block';
        }
    });
</script>

<div class="col-12">
    <label for="valor" class="form-label">Valor</label>
    <input type="number" class="form-control" name="valor" value="<?php echo $fila['valor'] ?>" id="valor">
    <div id="error_valor" class="invalid-feedback" style="display: none;">
        El valor debe ser un número y no puede exceder los 11 dígitos.
    </div>
</div>

<script>
    var valorInput = document.getElementById('valor');
    var errorValor = document.getElementById('error_valor');

    valorInput.addEventListener('input', function() {
        var valor = valorInput.value.trim();

        // Expresión regular para validar solo números
        var regex = /^\d{1,11}$/;

        if (regex.test(valor)) {
            valorInput.classList.remove('is-invalid');
            errorValor.style.display = 'none';
        } else {
            valorInput.classList.add('is-invalid');
            errorValor.style.display = 'block';
        }
    });
</script>

          <div class="text-center">
            <tr>
              <td><input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar"></td>
              <td><input class="btn" style="background-color: gray; color: white;" type="submit" name="eliminar" value="Eliminar"></td>
          </tr>
        </div>

          </form><!-- End Multi Columns Form -->
        </div>
      </div>
    </div>
</body>
</html>