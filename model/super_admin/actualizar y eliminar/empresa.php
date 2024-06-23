<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    // Verificar si el usuario ha iniciado sesión
$cedula = $_SESSION['cedula'];
if (!isset($_SESSION['cedula'])) {
    header("Location: ../inicio/logins.php");
    exit;
}

    //empieza la consulta
    $sql = $con -> prepare("SELECT * FROM empresa WHERE nit='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();
    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $nit = $_POST['nit'];
        $nombre_emp = $_POST['nombre_emp'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

            $insert= $con -> prepare ("UPDATE empresa SET nombre_emp='$nombre_emp', telefono='$telefono', direccion='$direccion' WHERE nit = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
                
        }
        

        else if (isset($_POST['eliminar'])){

            $nit = $_POST['nit'];
            $nombre_emp = $_POST['nombre_emp'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
    
                $insert= $con -> prepare ("DELETE FROM empresa WHERE nit = '".$_GET['id']."'");
                $insert -> execute();
                echo '<script> alert ("Registro actualizado exitosamente");</script>';
                echo '<script> window.close(); </script>';
                    
            }
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Empresa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../../css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Updated: Apr 20 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<body onload="centrar();" style="background-color: white;">

<div class="col-lg-6" style="margin-top: 20px; margin-left: auto; margin-right: auto;">
    <div class="container" style="text-align: center;">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" name="form_actualizar" method="POST" onsubmit="return validarFormulario()">
                    <table class="center">
                        <tr>
                            <td>Nombre de empresa</td>
                            <td><input type="text" class="form-control" name="nombre_emp" id="nombre_emp" value="<?php echo htmlspecialchars($fila['nombre_emp']) ?>"></td>
                        </tr>
                        <tr>
                            <td>Teléfono</td>
                            <td><input type="tel" class="form-control" name="telefono" id="telefono" value="<?php echo htmlspecialchars($fila['telefono']) ?>"></td>
                        </tr>
                        <tr>
                            <td>Dirección</td>
                            <td><input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo htmlspecialchars($fila['direccion']) ?>"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" style="background-color: blue; color: white; border: none; padding: 8px 16px; border-radius: 5px;" name="actualizar" value="Actualizar"></td>
                            <td><input type="submit" style="background-color: grey; color: white; border: none; padding: 8px 16px; border-radius: 5px;" name="eliminar" value="Eliminar"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function centrar() {
        var iz = (screen.width - document.body.clientWidth) / 2;
        var de = (screen.height - document.body.clientHeight) / 3;
        moveTo(iz, de);
    }

    function validarFormulario() {
        var nombreEmpInput = document.getElementById('nombre_emp');
        var telefonoInput = document.getElementById('telefono');
        var direccionInput = document.getElementById('direccion');

        var nombreEmpValue = nombreEmpInput.value.trim();
        var telefonoValue = telefonoInput.value.trim();
        var direccionValue = direccionInput.value.trim();

        // Validación de nombre de empresa
        if (!/^[a-zA-Z\s]{1,30}$/.test(nombreEmpValue)) {
            alert('El nombre de la empresa debe contener solo letras y dos espacios como máximo, con un máximo de 30 caracteres.');
            return false;
        }

        // Validación de teléfono
        if (!/^\d{10}$/.test(telefonoValue)) {
            alert('El teléfono debe contener exactamente 10 dígitos numéricos.');
            return false;
        }

        // Validación de dirección
        if (direccionValue.length > 30) {
            alert('La dirección debe tener un máximo de 30 caracteres.');
            return false;
        }

        // Si todas las validaciones pasan, se permite el envío del formulario
        return true;
    }
</script>

</body>
</html>
