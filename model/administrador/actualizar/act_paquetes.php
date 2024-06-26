<?php
session_start();
require_once("../../../db/connection.php");
$db = new Database();
$con = $db->conectar();

$cedula = $_SESSION['cedula'];
       if (!isset($cedula)){
         //include("../../../controller/validar_licencia.php");
         echo '<script>alert("No has iniciado sesion");</script>';
         header("Location: ../inicio/login.php");
         }

$id_paquete=$_GET['id'];

if (isset($_POST['registrar'])) {
    // Recuperar y limpiar datos del formulario
    $nombre_paquete = $_POST['nombre_paquete'];
    $edad_min = $_POST['edad_min'];
    $edad_max = $_POST['edad_max'];
    $valor = $_POST['valor'];

    if ($nombre_paquete != "" && $edad_min!="" && $edad_max != "" && $valor!="") {

        $update = $con->prepare("UPDATE paquetes SET nombre_paquete='$nombre_paquete', edad_min=$edad_min, edad_max=$edad_max, valor=$valor WHERE id_paquetes= $id_paquete");
        $update->execute();

        echo '<script>alert("Registro actualizado exitosamente");</script>';
        echo '<script>window.close();</script>';
    }
}

// Consulta inicial para obtener los datos del paquete
$sql = $con->prepare("SELECT * FROM paquetes WHERE id_paquetes=$id_paquete");
$sql->execute();
$fila = $sql->fetch();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualizar Paquete</title>
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

<script>
    function centrar() {
        iz = (screen.width - document.body.clientWidth) / 2;
        de = (screen.height - document.body.clientHeight) / 3;
        moveTo(iz, de);
    }
</script>

<style>
    .invalid-feedback {
        display: none;
        color: red;
    }

    .is-invalid {
        border-color: red !important;
    }
</style>

</head>

<body onload="centrar();">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Actualizar Paquete</h5>

            <form method="post" name="formreg" id="formreg" class="row g-3" autocomplete="off"
                                    onsubmit="return validarFormulario();">

                                    <div class="col-md-6">
                                        <label for="nombre_paquete" class="form-label">Nombre paquete</label>
                                        <input class="form-control" type="text" id="nombre_paquete"
                                            name="nombre_paquete" value="<?php echo $fila['nombre_paquete'];?>">
                                        <div id="error_nombre_paquete" class="invalid-feedback"
                                            style="display: none;">
                                            El nombre del paquete debe contener solo letras y dos espacios como
                                            máximo, con un máximo de 20 caracteres.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="edad_min" class="form-label">Edad mínima</label>
                                        <input class="form-control" type="number"  id="edad_min" name="edad_min"
                                        value="<?php echo $fila['edad_min'];?>">
                                        <div id="error_edad_min" class="invalid-feedback" style="display: none;">
                                            La edad mínima debe ser un número entre 1 y 20.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="edad_max" class="form-label">Edad máxima</label>
                                        <input class="form-control" type="number" id="edad_max" name="edad_max"
                                        value="<?php echo $fila['edad_max'];?>">
                                        <div id="error_edad_max" class="invalid-feedback" style="display: none;">
                                            La edad máxima debe ser un número entre 5 y 100.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="valor" class="form-label">Valor</label>
                                        <input class="form-control" type="number"  id="valor" name="valor"
                                        value="<?php echo $fila['valor'];?>">
                                        <div id="error_valor" class="invalid-feedback" style="display: none;">
                                            Solo se aceptan numeros (mayor a 50.000)
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <input type="submit" name="registrar" style="background-color: #2c8ac9; color: white;" value="Registro"
                                            class="btn btn-primary">
                                    </div>

                                </form>
        </div>
    </div>
    <script src="../../validaciones/validar_paquetes.js"></script>
</body>
</html>
