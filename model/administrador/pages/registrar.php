<?php
  include "plantilla.php";

   if (isset($_POST['registrar']))
   {
    $cedula= $_POST['cedula'];
    $nombre= $_POST['nombre'];
    $celular= $_POST['celular'];
    $contrasena= $_POST['contrasena'];
    $correo= $_POST['correo'];
    $tipo_user= $_POST['tipo_user'];
    $id_estado= $_POST['id_estado'];
   

     $sql= $con -> prepare ("SELECT * FROM usuarios WHERE cedula='$cedula' or correo = '$correo'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("DOCUMENTO YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="registrar.php"</script>';
     }

     else
   
    // Validación rápida de campos vacíos
    if (empty($cedula) || empty($nombre) || empty($celular) || empty($contrasena) || empty($correo) || empty($tipo_user) || empty($id_estado)) {
        echo '<script>alert("EXISTEN DATOS VACIOS");</script>';
        echo '<script>window.location="registrar.php"</script>';
    } else {
        // Consulta para verificar si el documento o correo ya existe
        $sql = $con->prepare("SELECT * FROM usuarios WHERE cedula = :cedula OR correo = :correo");
        $sql->execute(array(':cedula' => $cedula, ':correo' => $correo));
        $fila = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($fila) {
            echo '<script>alert("DOCUMENTO O CORREO YA EXISTE");</script>';
            echo '<script>window.location="registrar.php"</script>';
        } else {
            // Hash de la contraseña
            $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT, array("cost" => 12));

            // Inserción de datos en la base de datos
            $insertSQL = $con->prepare("INSERT INTO usuarios (cedula, nombre, celular, contrasena, correo, id_tipo_user, id_estado, nit) 
                                       VALUES (:cedula, :nombre, :celular, :contrasena, :correo, :tipo_user, :id_estado, 123456789)");
            $insertSQL->execute(array(
                ':cedula' => $cedula,
                ':nombre' => $nombre,
                ':celular' => $celular,
                ':contrasena' => $pass_cifrado,
                ':correo' => $correo,
                ':tipo_user' => $tipo_user,
                ':id_estado' => $id_estado
            ));

            echo '<script>alert("REGISTRO EXITOSO");</script>';
            echo '<script>window.location="registrar.php"</script>';
        }
    }
}
?>

<!-- Aquí comienza el código HTML -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <!-- Tus estilos y scripts adicionales -->
</head>
<body>

<main id="main" class="main">
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Crear cuenta</h5>
                                <p class="text-center small">Ingresa los datos</p>
                            </div>
                            <form class="row g-3 needs-validation" name="formreg" id="formreg" method="POST" novalidate>
                                <div class="col-6">
                                    <label for="cedula" class="form-label">Cédula</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" required>
                                    <div class="invalid-feedback">Ingresa tu cédula (solo números entre 8 y 10).</div>
                                </div>

                                <div class="col-6">
                                    <label for="nombre" class="form-label">Nombre completo</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre" required>
                                    <div class="invalid-feedback">Ingresa tu nombre, solo letras.</div>
                                </div>

                                <div class="col-6">
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="text" name="celular" class="form-control" id="celular" required>
                                    <div class="invalid-feedback">Ingresa tu teléfono (de 8 a 10 dígitos).</div>
                                </div>

                                <div class="col-6">
                                    <label for="correo" class="form-label">Correo electrónico</label>
                                    <input type="email" name="correo" class="form-control" id="correo" required>
                                    <div class="invalid-feedback">Ingresa un correo electrónico válido.</div>
                                </div>

                                <div class="col-6">
                                    <select class="col-6 form-control" name="tipo_user" required>
                                        <option value="">Seleccione Tipo Usuario</option>
                                        <?php
                                        $control = $con->prepare("SELECT * from tipo_user WHERE id_tipo_user = 2 OR id_tipo_user = 3");
                                        $control->execute();
                                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value=" . $fila['id_tipo_user'] . ">" . $fila['tipo_user'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <select class="form-control" name="id_estado" required>
                                        <option value="">Seleccione el estado</option>
                                        <?php
                                        $control = $con->prepare("SELECT * from estados where id_estado <= 2");
                                        $control->execute();
                                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<option value=" . $fila['id_estado'] . ">" . $fila['estado'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="contrasena" class="form-label">Contraseña</label>
                                    <input type="password" name="contrasena" class="form-control" id="contrasena" required>
                                    <div class="invalid-feedback">Ingresa tu contraseña (entre 8 y 11 caracteres).</div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">Estoy de acuerdo con los <a href="#">Términos y condiciones</a></label>
                                        <div class="invalid-feedback">Debes estar de acuerdo para continuar.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input class="btn btn-primary w-100" type="submit" name="registrar" value="Registrar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<!-- Tus scripts adicionales -->
<script>
    // Validación de los campos del formulario antes de enviarlo
    document.getElementById('formreg').addEventListener('submit', function(event) {
        var cedulaInput = document.getElementById('cedula');
        var nombreInput = document.getElementById('nombre');
        var celularInput = document.getElementById('celular');
        var correoInput = document.getElementById('correo');
        var contrasenaInput = document.getElementById('contrasena');
        var acceptTermsInput = document.getElementById('acceptTerms');

        var cedulaValue = cedulaInput.value.trim();
        var nombreValue = nombreInput.value.trim();
        var celularValue = celularInput.value.trim();
        var correoValue = correoInput.value.trim();
        var contrasenaValue = contrasenaInput.value.trim();

        var isValid = true;

        // Validación de cédula (8 a 10 dígitos numéricos)
        if (!/^\d{8,10}$/.test(cedulaValue)) {
            alert("Ingresa tu cédula (solo números entre 8 y 10).");
            isValid = false;
        }

        // Validación de nombre (solo letras y espacios)
        if (!/^[A-Za-z\s]{1,20}$/.test(nombreValue)) {
            alert("Ingresa tu nombre, solo letras.");
            isValid = false;
        }

        // Validación de celular (8 a 10 dígitos numéricos)
        if (!/^\d{8,10}$/.test(celularValue)) {
            alert("Ingresa tu teléfono (de 8 a 10 dígitos).");
            isValid = false;
        }

        // Validación de correo electrónico
        if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(correoValue)) {
            alert("Ingresa un correo electrónico válido.");
            isValid = false;
        }

        // Validación de contraseña (8 a 11 caracteres)
        if (contrasenaValue.length < 8 || contrasenaValue.length > 11) {
            alert("Ingresa tu contraseña (entre 8 y 11 caracteres).");
            isValid = false;
        }

        // Validación de aceptar términos y condiciones
        if (!acceptTermsInput.checked) {
            alert("Debes estar de acuerdo con los términos y condiciones para continuar.");
            isValid = false;
        }

        // Evitar que se envíe el formulario si no es válido
        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
        }
    });
</script>

</body>
</html>