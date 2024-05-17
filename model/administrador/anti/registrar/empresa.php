<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $nit= $_POST['nit'];
    $nombre_emp= $_POST['names'];
    $telefono= $_POST['phone'];
    $direccion= $_POST['dir'];

     $sql= $con -> prepare ("SELECT * FROM empresa");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

    if ($nit=="" || $nombre_emp=="" ||  $telefono=="" || $direccion="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="registro_empleados.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO empresa(nit,nombre_emp,telefono,direccion) VALUES('$nit', '$nombre_emp','$telefono','$direccion')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../inicio/admin.html"</script>';
     }
   }
   ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrarse</title>
  <link rel="stylesheet" href="css/empresa.css">
</head>
  <body>

    <section class="form_wrap">

        <section class="cantact_info">
            <section class="info_title">
                <span class="fa fa-user-circle"></span>
                <h2>FORMULARIO DE EMPRESA</h2>
            </section>
            
        </section>

        <form action="" class="form_contact" method="POST">
            <div class="user_info">
                <label for="nit">Nit</label>
                <input type="bigint" id="nit" name="nit">

                <label for="name">Nombre_emp</label>
                <input type="varchar" id="names" name="names">

                <label for="phone">telefono </label>
                <input type="bigint" id="phone" name="phone">

                <label for="dir">Direccion </label>
                <input type="varchar" id="dir" name="dir">

                <div class="form-group">
                  <input type="submit" name="validar" value="Registro" class="boton">
                  <input type="hidden" name="MM_insert" value="formreg">
                </div>
     </div>
        </form>

    </section>
    <script src="js/empresa.js"></script>

</body>
</html>