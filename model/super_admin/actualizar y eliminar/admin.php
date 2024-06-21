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
    $sql = $con -> prepare("SELECT * FROM usuarios WHERE cedula='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $cedula= $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $celular= $_POST['celular'];
        $correo = $_POST['correo'];
        $id_tipo_user= 1;
        $estado=$_POST['estado'];
        $nit=$_POST['nit'];
        
        $encriptado = password_hash($contrasena, PASSWORD_DEFAULT,array("pass"=>12));

            $insert= $con -> prepare ("UPDATE usuarios SET nombre='$nombre', celular=$celular, correo='$correo' WHERE cedula = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';   
        }

        else if (isset($_POST['eliminar'])){
            
                $insert= $con -> prepare ("DELETE FROM usuarios WHERE cedula = '".$_GET['id']."'");
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
    
        <table class="center">
            <form autocomplete="off" name="form_actualizar" method="POST">
                <tr>
                    <td>Cedula</td>
                    <td><input name="cedula" class="form-control" value="<?php echo $fila['cedula'] ?>" readonly></td>
                </tr>

                <tr>
                    <td>Nombre</td>
                    <td><input name="nombre" class="form-control" value="<?php echo $fila['nombre'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Celular</td>
                    <td><input type="celular" class="form-control" name="celular" value="<?php echo $fila['celular'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Correo</td>
                    <td><input type="correo" class="form-control" name="correo" value="<?php echo $fila['correo'] ?>" ></td>                 
                </tr>

                <tr>
                <td>
                <select class="form-control" name="nit">
                        <option value="">Seleccione Estado</option>
                        <?php
                        $control = $con->prepare("SELECT * FROM estados");
                        $control->execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $fila['id_estado'] . "'>"
                                . $fila['estado'] . "</option>";
                        }
                        ?>
                    </select>  
                    </td>              
                </tr>
                <tr>
                <td style="margin-top: 10px;"><input type="submit" style="background-color: blue; color: white; border: none; padding: 8px 16px; border-radius: 5px;" name="actualizar" value="Actualizar"></td>
                <td style="margin-top: 10px;"><input type="submit" style="background-color: grey; color: white; border: none; padding: 8px 16px; border-radius: 5px;" name="eliminar" value="Eliminar"></td>

                </tr>
            </form>
        </table>
    


</body>
</html>