<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //empieza la consulta
    $sql = $con -> prepare("SELECT * FROM tipo_e WHERE id_tipo_e='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $tipo_evento= $_POST['tipo_evento'];
        
            $insert= $con -> prepare ("UPDATE tipo_e SET tipo_evento='$tipo_evento' WHERE id_tipo_e = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
                
        }
    else if (isset($_POST['eliminar'])){
            $insert= $con -> prepare ("DELETE FROM tipo_e WHERE id_tipo_e= '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro eliminado exitosamente");</script>';
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
<title>Actualizar Tipo de Evento</title>
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

        <h5 class="card-title">Tipos de Evento</h5>
<form autocomplete="off" class="row g-3" name="form_actualizar" method="POST">

    <div class="col-md-6">
        <label for="inputEmail5" class="form-label">Nombre</label>
        <input class="form-control" type="text" name="tipo_evento" id="tipoEventoInput" value="<?php echo htmlspecialchars($fila['tipo_evento']) ?>" placeholder="Nombre del evento">
        <div id="error_tipo_evento" class="invalid-feedback">
            El nombre del evento debe contener solo letras y máximo dos espacios, con un máximo de 20 caracteres.
        </div>
    </div>

    <div class="text-center">
        <input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar">
    </div>

</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tipoEventoInput = document.getElementById('tipoEventoInput');
        var errorTipoEvento = document.getElementById('error_tipo_evento');

        document.forms['form_actualizar'].addEventListener('submit', function(event) {
            var tipoEvento = tipoEventoInput.value.trim();

            // Validar que el tipo de evento contenga solo letras y máximo dos espacios, con un máximo de 20 caracteres
            if (!/^[A-Za-z ]{1,20}$/.test(tipoEvento) || /\s{3,}/.test(tipoEvento)) {
                // Si la validación falla, detenemos el envío del formulario
                event.preventDefault();
                tipoEventoInput.classList.add('is-invalid');
                errorTipoEvento.style.display = 'block';
            } else {
                // Si la validación es exitosa, quitamos cualquier indicación de error
                tipoEventoInput.classList.remove('is-invalid');
                errorTipoEvento.style.display = 'none';
            }
        });
    });
</script>


          </form><!-- End Multi Columns Form -->
        </div>
      </div>
    </div>
</body>
</html>