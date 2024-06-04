<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $digitos ="sakur02ue859y2u389rhdewirh102385y1285013289";
    $longitud= 20;
    $licencia= substr(str_shuffle($digitos), 0, $longitud);

date_default_timezone_set("America/Mexico_City");
$fecha_ini = date('Y-m-d');
$fecha_fin = date("Y-m-d",strtotime($fecha_ini." + 1 year"));

   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    
    $licencia= $_POST['licencia'];
    $nit= $_POST['nit'];
    $fecha_ini= $_POST['fecha_ini'];
    $fecha_fin= $_POST['fecha_fin'];
    $id_estado= $_POST['id_estado'];

     $sql= $con -> prepare ("SELECT * FROM licencia WHERE licencia='$licencia'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("DOCUMENTO YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="licencia.php"</script>';
     }

     else
   
     if ($licencia=="" || $nit=="" ||$fecha_ini=="" || $fecha_fin=="" || $id_estado=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="licencia.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO licencia(licencia, nit, fecha_ini, fecha_fin, id_estado) VALUES('$licencia', '$nit', '$fecha_ini', '$fecha_fin', '$id_estado')");
        $insertSQL -> execute();

        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../consultar/read_licencia.php"</script>';
     }  
    }
    ?>

<!DOCTYPE html>
<html>

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
<body style="background-color: white;">

<form action="" method="POST">



<td>
<td><input type="submit" value="Regresar" name="regresar" id="regresar" style="background-color: blue; color: white; border: none; padding: 5px 10px; border-radius: 15px; text-decoration: none; margin-top: 20px; margin-left: 10px;"></td>

</tr>
</form>
<?php 

if (isset($_POST['regresar'])){
    header('Location: ../consultar/read_licencia.php');
}

?>
<h2 class="card-title" style="font-family: 'Arial Rounded MT Bold', sans-serif; text-align: center; margin-top: 20px;">Registrar Licencia</h2>
<div class="col-lg-6" style="margin-top: 20px; margin-left: auto; margin-right: auto;">
<div class="container" style="text-align: center;">
<div class="card">
  <div class="card-body">
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                <!--Username -->
                
                
                <br>
                <label  class="form-label"for="licencia"></label>
                <br>
                <input class="form-control"    type="int" name="licencia" value="<?php echo $licencia ?>" readonly>
                <br>
                <select class="form-control" name="nit">
                    <option value ="">Seleccione Empresa</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from empresa");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['nit'] . ">"
                        . $fila['nombre_emp'] . "</option>";
                    } 
                    ?>
                </select>

                <label  class="form-label"  for="fecha_ini"></label>
                <br>
                <input class="form-control" type="date" name="fecha_ini" id="fecha_ini"  value="<?php echo $fecha_ini ?>" readonly>
                <br>
                <label  class="form-label" for="fecha_fin"></label>
                <br>
                <inputclass="form-control"     type="date" name="fecha_fin" id="fecha_fin">
                <br>

                <label  class="form-label" for="id_estado"></label>
                <br>
                <select class="form-control" name="id_estado">
                    <option  value ="">Seleccione el estado</option>
                    
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

                <br>
                
                <br>

                <input   type="submit" name="validar" value="Registro" style="background-color: blue; color: white; border: none; padding: 8px 16px; border-radius: 5px;">
                <input   type="hidden" name="MM_insert" value="formreg">
                </form>

        </div> 
    </div>
</body>
</html>