<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $tipo= $_POST['tipo'];

     $sql= $con -> prepare ("SELECT * FROM tipo_articulo");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
   
     if ($tipo=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="articulos.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO tipo_articulo (tipo_articulo) VALUES('$tipo')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../consultar/read_tipo_articulo.php"</script>';
     }  
    }
    ?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tipos de Articulos</title>
	<link rel="stylesheet" type="text/css" href="../../../css/formularios.css">
</head>
<body background="estos-son-lenguajes-programacion-informaticos-experimentados-usan-diario-443165">

<form action="" method="POST">

<td>

    <input type="submit" value="Cerrar_sesión" name="cerrar_sesion" id="cerrar_sesion"/></td>
    <td><input type="submit" value="Regresar" name="regresar" id="regresar"></td>
</tr>
</form>
<?php 

if(isset($_POST['cerrar_sesion']))
{
    session_destroy();

    header('location: ../../../index.html');
}
else if (isset($_POST['regresar'])){
    header('Location: ../consultar/read_tipo_articulo.php');
}

?>


<div class="formulario">
        <div class="signup-box">
            
            <h1 class="signup-title">REGISTRO TIPO DE ARTICULOS</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                <!--Username -->
                <br>
                <label for="nombre_a"></label>
                <br>
                <input type="varchar" name="tipo" id="documento" placeholder="Tipo de Articulo">
                <br><br>
                                
                <input type="submit" name="validar" value="Registro">
                <input type="hidden" name="MM_insert" value="formreg">
                </form>

        </div> 
    </div>
</body>
</html>