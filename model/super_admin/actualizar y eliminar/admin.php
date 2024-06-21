<?php
session_start();
require_once("../../../db/connection.php");
$db = new Database();
$con = $db->conectar();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['cedula'])) {
    header("Location: ../inicio/logins.php");
    exit;
}

// Obtener datos del usuario para mostrar en el formulario
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Consulta para obtener los datos del usuario
    $sql = $con->prepare("SELECT * FROM usuarios WHERE cedula=:id_usuario");
    $sql->bindParam(':id_usuario', $id_usuario);
    $sql->execute();
    $fila = $sql->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontraron datos
    if (!$fila) {
        echo '<script>alert("Usuario no encontrado");</script>';
        echo '<script>window.close();</script>';
    }
}

// Procesar el formulario de actualización o eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['actualizar'])) {
        $nombre = $_POST['nombre'];
        $celular = $_POST['celular'];
        $correo = $_POST['correo'];
        $id_estado = $_POST['id_estado']; // Aquí deberías obtener el valor del estado correctamente

        // Actualizar los datos del usuario
        $sql = $con->prepare("UPDATE usuarios SET nombre=:nombre, celular=:celular, correo=:correo, id_estado=:id_estado WHERE cedula=:id_usuario");
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':celular', $celular);
        $sql->bindParam(':correo', $correo);
        $sql->bindParam(':id_estado', $id_estado);
        $sql->bindParam(':id_usuario', $id_usuario);

        if ($sql->execute()) {
            echo '<script>alert("Registro actualizado exitosamente");</script>';
            echo '<script>window.close();</script>';
        } else {
            echo '<script>alert("Error al actualizar el registro");</script>';
            echo '<script>window.close();</script>';
        }
    }

    if (isset($_POST['eliminar'])) {
        // Eliminar el usuario
        $sql = $con->prepare("DELETE FROM usuarios WHERE cedula=:id_usuario");
        $sql->bindParam(':id_usuario', $id_usuario);

        if ($sql->execute()) {
            echo '<script>alert("Registro eliminado exitosamente");</script>';
            echo '<script>window.close();</script>';
        } else {
            echo '<script>alert("Error al eliminar el registro");</script>';
            echo '<script>window.close();</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Administrador</title>
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
</head>
<body onload="centrar();" style="background-color: white;">

<div class="col-lg-6" style="margin-top: 20px; margin-left: auto; margin-right: auto;">
<div class="container" style="text-align: center;">
<div class="card">
  <div class="card-body">
    
        <table class="center">
            <form autocomplete="off" name="form_actualizar" method="POST">
                <tr>
                    <td>Cedula</td>
                    <td><input name="cedula" class="form-control" value="<?php echo $fila['cedula'] ?>" readonly></td>
                </tr>

                <tr>
                    <td>Nombre</td>
                    <td><input name="nombre" class="form-control" value="<?php echo $fila['nombre'] ?>"></td>                 
                </tr>

                <tr>
                    <td>Celular</td>
                    <td><input type="celular" class="form-control" name="celular" value="<?php echo $fila['celular'] ?>"></td>                 
                </tr>

                <tr>
                    <td>Correo</td>
                    <td><input type="correo" class="form-control" name="correo" value="<?php echo $fila['correo'] ?>"></td>                 
                </tr>

                <tr>
                    <td>Estado</td>
                    <td>
                        <select class="form-control" name="id_estado">
                            <option value="">Seleccione Estado</option>
                            <?php
                            $sql_estados = $con->prepare("SELECT * FROM estados");
                            $sql_estados->execute();
                            while ($fila_estado = $sql_estados->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($fila['id_estado'] == $fila_estado['id_estado']) ? 'selected' : '';
                                echo "<option value='" . $fila_estado['id_estado'] . "' $selected>"
                                    . $fila_estado['estado'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>              
                </tr>
                
                <tr>
                    <td><input type="submit" style="background-color: blue; color: white; border: none; padding: 8px 16px; border-radius: 5px;" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" style="background-color: grey; color: white; border: none; padding: 8px 16px; border-radius: 5px;" name="eliminar" value="Eliminar"></td>
                </tr>
            </form>
        </table>
    
</body>
</html>
