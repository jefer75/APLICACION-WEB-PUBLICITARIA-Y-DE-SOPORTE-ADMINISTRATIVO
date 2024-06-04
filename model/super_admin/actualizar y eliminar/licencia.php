<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //empieza la consulta
    $sql = $con -> prepare("SELECT * FROM licencia WHERE id_licencia='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();
    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $id_licencia = $_POST['id_licencia'];
        $licencia = $_POST['licencia'];
        $nit = $_POST['nit'];
        $fecha_ini = $_POST['fecha_ini'];
        $fecha_fin = $_POST['fecha_fin'];
        $id_estado = $_POST['id_estado'];

            $insert= $con -> prepare ("UPDATE licencia SET Nit='$nit', fecha_fin='$fecha_fin', id_estado='$id_estado' WHERE id_licencia = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
                
        }

        if (isset($_POST['eliminar'])){
    
                $insert= $con -> prepare ("DELETE FROM licencia WHERE id_licencia = '".$_GET['id']."'");
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
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forms / Layouts - NiceAdmin Bootstrap Template</title>
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
  <link href="../..7..//css/style.css" rel="stylesheet">

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
            <form autocomplete="off" name="form_actualizar" method="POST">

                <tr>
                    <td>id_licencia</td>
                    <td><input type="int"   class="form-control"  name="id_licencia" value="<?php echo $fila['id_licencia'] ?>" readonly></td>                 
                </tr>

                
                <tr>
                    <td>Licencia</td>
                    <td><input type="varchar"  class="form-control"  name="licencia" value="<?php echo $fila['licencia'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>Nit</td>
                    <td><input type="varchar"  class="form-control"  name="nit" value="<?php echo $fila['nit'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>Fecha de inicio</td>
                    <td><input type="int"  class="form-control"  name="fecha_ini" value="<?php echo $fila['fecha_ini'] ?>" readonly></td>                 
                </tr>

                

                <tr>
                    <td>Fecha fin</td>
                    <td><input type="date"   class="form-control" name="fecha_fin" value="<?php echo $fila['fecha_fin'] ?>"></td>                 
                </tr>

                
                <tr>
                    <td>Estado</td>
                    <td>
                    <select  class="form-control" name="id_estado">
                    <option value ="<?php echo $fila['id_estado'] ?>">Seleccione Estado de licencia</option>
                    <?php
                        $control = $con -> prepare ("SELECT * from estados where id_estado <= 2");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_estado'] . ">"
                        . $fila['estado'] . "</option>";
                    } 
                    ?>                    
                    </select>
                    </td>                
                </tr>
               <br>
               <br> 
               
                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"  style="background-color: blue; color: white; border: none; padding: 8px 16px; border-radius: 5px;"></td>
                    <td><input type="submit" name="eliminar" value="eliminar" style="background-color: grey; color: white; border: none; padding: 8px 16px; border-radius: 5px;"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>