<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $tipo_evento= $_POST['tipo_evento'];

     $sql= $con -> prepare ("SELECT * FROM tipo_e WHERE tipo_evento='$tipo_evento'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("ESTE TIPO DE EVENTO YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="tipo_e.php"</script>';
     }

     else
   
     if ($tipo_evento=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="tipo_e.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO tipo_e(tipo_evento) VALUES('$tipo_evento')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../consultar/read_tipo_e.php"</script>';
     
    }  
    }
    ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro de tipo evento</title>
	<link rel="stylesheet" type="text/css" href="../../../css/registro.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
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
    header('Location: ../consultar/read_tipo_e.php');
}

?>

<div class="formulario">
        <div class="signup-box">
            
            <h1 class="signup-title">REGISTRO DE TIPO DE EVENTO</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                <!--Username -->
                <br>
                <label for="tipo_e">Tipo de evento</label>
                <br>
                <input type="varchar" name="tipo_evento" id="documento" placeholder="Tipo de evento">
                <br>
                <br>
                                
                <input type="submit" name="validar"  value="Registro">
                <input type="hidden" name="MM_insert" value="formreg">
                </form>

        </div> 
    </div>
</body>
</html>