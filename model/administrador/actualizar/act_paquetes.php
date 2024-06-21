<?php
session_start();
require_once("../../../db/connection.php");
$db = new Database();
$con = $db->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    // Recuperar y limpiar datos del formulario
    $nombre_paquete = htmlspecialchars($_POST['nombre_paquete']);
    $edad_min = intval($_POST['edad_min']);
    $edad_max = intval($_POST['edad_max']);
    $valor = floatval($_POST['valor']);

    // Validaciones adicionales
    $errors = array();

    // Validación del nombre del paquete
    if (empty($nombre_paquete) || strlen($nombre_paquete) > 30 || !preg_match("/^[a-zA-Z\s]+$/", $nombre_paquete)) {
        $errors['nombre_paquete'] = "El nombre del paquete debe contener solo letras y espacios, con un máximo de 30 caracteres.";
    }

    // Validación de edad mínima
    if ($edad_min < 1 || $edad_min > 100) {
        $errors['edad_min'] = "La edad mínima debe ser un número entre 1 y 100.";
    }

    // Validación de edad máxima
    if ($edad_max < 1 || $edad_max > 100) {
        $errors['edad_max'] = "La edad máxima debe ser un número entre 1 y 100.";
    }

    // Validación de valor
    if ($valor <= 0 || $valor > 99999999999) {
        $errors['valor'] = "El valor debe ser un número positivo y no puede exceder los 11 dígitos.";
    }

    // Si no hay errores, proceder con la actualización
    if (empty($errors)) {
        $update = $con->prepare("UPDATE paquetes SET nombre_paquete=?, edad_min=?, edad_max=?, valor=? WHERE id_paquetes=?");
        $update->execute([$nombre_paquete, $edad_min, $edad_max, $valor, $_GET['id']]);

        echo '<script>alert("Registro actualizado exitosamente");</script>';
        echo '<script>window.close();</script>';
    } else {
        // Si hay errores, mostrarlos y no realizar la actualización
        foreach ($errors as $error) {
            echo '<script>alert("' . $error . '");</script>';
        }
    }
}

// Consulta inicial para obtener los datos del paquete
$sql = $con->prepare("SELECT * FROM paquetes WHERE id_paquetes=?");
$sql->execute([$_GET['id']]);
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
            <form autocomplete="off" class="row g-3" name="form_actualizar" method="POST">
                <div class="col-md-6">
                    <label for="nombre_paquete" class="form-label">Nombre paquete</label>
                    <input name="nombre_paquete" class="form-control <?php echo isset($errors['nombre_paquete']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['nombre_paquete']) ? htmlspecialchars($_POST['nombre_paquete']) : $fila['nombre_paquete']; ?>" id="nombre_paquete">
                    <?php if (isset($errors['nombre_paquete'])) : ?>
                        <div class="invalid-feedback"><?php echo $errors['nombre_paquete']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label for="edad_min" class="form-label">Edad mínima</label>
                    <input type="number" class="form-control <?php echo isset($errors['edad_min']) ? 'is-invalid' : ''; ?>" name="edad_min" value="<?php echo isset($_POST['edad_min']) ? intval($_POST['edad_min']) : $fila['edad_min']; ?>" id="edad_min">
                    <?php if (isset($errors['edad_min'])) : ?>
                        <div class="invalid-feedback"><?php echo $errors['edad_min']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label for="edad_max" class="form-label">Edad máxima</label>
                    <input type="number" class="form-control <?php echo isset($errors['edad_max']) ? 'is-invalid' : ''; ?>" name="edad_max" value="<?php echo isset($_POST['edad_max']) ? intval($_POST['edad_max']) : $fila['edad_max']; ?>" id="edad_max">
                    <?php if (isset($errors['edad_max'])) : ?>
                        <div class="invalid-feedback"><?php echo $errors['edad_max']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="number" class="form-control <?php echo isset($errors['valor']) ? 'is-invalid' : ''; ?>" name="valor" value="<?php echo isset($_POST['valor']) ? floatval($_POST['valor']) : $fila['valor']; ?>" id="valor">
                    <?php if (isset($errors['valor'])) : ?>
                        <div class="invalid-feedback"><?php echo $errors['valor']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="text-center">
                    <input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar">
                    <input class="btn" style="background-color: gray; color: white;" type="submit" name="eliminar" value="Eliminar">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
