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
         echo '<script>window.location="empresa.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO empresa(nit,nombre_emp,telefono,direccion) VALUES('$nit', '$nombre_emp','$telefono','$direccion')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../consultar/read_empresa.php"</script>';
     }
   }
   ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrarse</title>
  <link rel="stylesheet" href="../../../css/formularios.css">
</head>
  <body>

  <form action="" method="POST">

<td>
  <td><input   class="r"     type="submit" value="Regresar" name="regresar" id="regresar"></td>
</tr>
</form>
<?php 

if (isset($_POST['regresar'])){
    header('Location: ../consultar/read_empresa.php');
}

?>

<div class="formulario">
        <div class="signup-box">

        <h1 class="signup-title">Registrar Empresa</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 

            <label for="nit"></label>
                <br>
                <input class="cont"     type="bigint" name="nit" placeholder="Digite el Nit">
                <br>

                <label for="nombre_emp"></label>
                <br>
                <input class="cont"     type="varchar" name="nombre_emp" placeholder="Nombre de empresa">
                <br>

                <label for="telefono"></label>
                <br>
                <input class="cont"     type="bigint" name="telefono" placeholder="Digite el telefono">
                <br>

                <label for="direccion"></label>
                <br>
                <input class="cont"     type="varchar" name="direccion" placeholder="Digite la direccion">
                <br>

                <div class="form-group">
                <input class="b"     type="submit" name="validar" value="Registro">
                <input   type="hidden" name="MM_insert" value="formreg">
                </div>
     </div>
     </div>

        </form>

    </section>
    <script src="js/empresa.js"></script>


</body>
</html>