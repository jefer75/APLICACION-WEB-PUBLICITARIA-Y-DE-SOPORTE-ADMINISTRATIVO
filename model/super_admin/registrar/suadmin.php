<?php

session_start();
require_once("../../../db/connection.php");
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db->conectar();
// Verificar si el usuario ha iniciado sesión
if (isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "formreg") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nombre_comp = $nombre . " " . $apellido;
    $cedula = $_POST['cedula'];
    $celular = $_POST['celular'];
    $contrasena = $_POST['contrasena'];
    $correo = $_POST['correo'];
    $tipo_user= 4;
    $id_estado = 1;

    $sql = $con->prepare("SELECT * FROM usuarios WHERE cedula=:cedula");
    $sql->bindParam(':cedula', $cedula);
    $sql->execute();
    $fila = $sql->fetch(PDO::FETCH_ASSOC);

    if ($fila) {
        die("Ya existe un usuario con ese documento. Por favor, utilice otro.");
        echo '<script>window.location="../supera.php";</script>';
    }

    $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT);

    $insertSQL = $con->prepare("INSERT INTO usuarios(cedula, nombre, celular, contrasena, correo, id_tipo_user, id_estado) 
                               VALUES(:cedula, :nombre_comp, :celular, :pass_cifrado, :correo, :tipo_user, :id_estado)");
    $insertSQL->bindParam(':cedula', $cedula);
    $insertSQL->bindParam(':nombre_comp', $nombre_comp);
    $insertSQL->bindParam(':celular', $celular);
    $insertSQL->bindParam(':pass_cifrado', $pass_cifrado);
    $insertSQL->bindParam(':correo', $correo);
    $insertSQL->bindParam(':tipo_user', $tipo_user);
    $insertSQL->bindParam(':id_estado', $id_estado);
    $insertSQL->execute();

    echo '<script> alert ("Registro exitoso");</script>';
    echo '<script>window.location="../supera.php";</script>';
}
?>

    <script>
        function validarFormulario() {
            var nombres = document.getElementById('nombres').value.trim();
            var apellidos = document.getElementById('apellidos').value.trim();
            var documento = document.getElementById('documento').value.trim();
            var telefono = document.getElementById('telefono').value.trim();
            var correo = document.getElementById('correo').value.trim();
            var contrasena = document.getElementById('contrasena').value.trim();

            // Validación de nombres y apellidos (solo letras y espacios, máximo 30 caracteres)
            if (!/^[a-zA-Z\s]{1,30}$/.test(nombres) || !/^[a-zA-Z\s]{1,30}$/.test(apellidos)) {
                alert('Los nombres y apellidos deben contener solo letras y espacios, con un máximo de 30 caracteres cada uno.');
                return false;
            }

            // Validación de documento (solo números, mínimo 8 y máximo 10 caracteres)
            if (!/^\d{8,10}$/.test(documento)) {
                alert('El número de documento debe contener solo números y tener entre 8 y 10 caracteres.');
                return false;
            }

            // Validación de teléfono (solo números, exactamente 10 caracteres)
            if (!/^\d{10}$/.test(telefono)) {
                alert('El teléfono debe contener exactamente 10 dígitos numéricos.');
                return false;
            }

            // Validación de correo electrónico (formato de correo válido)
            if (!/\S+@\S+\.\S+/.test(correo)) {
                alert('El correo electrónico no tiene un formato válido.');
                return false;
            }

            // Validación de contraseña (mínimo 8 y máximo 11 caracteres)
            if (contrasena.length < 8 || contrasena.length > 11) {
                alert('La contraseña debe tener entre 8 y 11 caracteres.');
                return false;
            }

            return true; // Si todas las validaciones pasan, se envía el formulario
        }
    </script>
</body>
</html>
