<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $nombre_paquete= $_POST['nombre_paquete'];
    $edad_min= $_POST['edad_min'];
    $edad_max= $_POST['edad_max'];
    $valor= $_POST['valor'];

     $sql= $con -> prepare ("SELECT * FROM paquetes WHERE id_paquetes='$id_paquetes'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("ESTE PAQUETE YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="paquetes.php"</script>';
     }

     else
   
     if ($nombre_paquete=="" || $edad_min=="" || $edad_max=="" || $valor=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="paquetes.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO paquetes(nombre_paquete, edad_min, edad_max, valor) VALUES('$nombre_paquete', '$edad_min', '$edad_max', '$valor')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../consultar/read_paquetes.php"</script>';
     }  
    }
    ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro de Paquete</title>
	<link rel="stylesheet" type="text/css" href="../../../css/registro.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
</head>
<body background="estos-son-lenguajes-programacion-informaticos-experimentados-usan-diario-443165">

<form action="" method="POST">

<td>

    <td><input type="submit" value="Regresar" name="regresar" id="regresar"></td>
</tr>
</form>
<?php 

if (isset($_POST['regresar'])){
    header('Location: ../inicio/paquetes.php');
}

?>

<div class="formulario">
        <div class="signup-box">
            
            <h1 class="signup-title">REGISTRO PAQUETE</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                <!--Username -->
                <br>
                <label for="nombre_paquete">Nombre Paquete</label>
                <br>
                <input type="varchar" name="nombre_paquete"  placeholder="Nombre paquete">
                <br>
                <label for="nombre_artistico">Edad Minima</label>
                <br>
                <input type="varchar" name="edad_min"  placeholder="Edad_min">
                <br>
                <label for="direccion">Edad_maxima</label>
                <br>
                <input type="varchar" name="edad_max" placeholder="Edad_max">
                <br>
                <label for="telefono">valor</label>
                <br>
                <input type="int" name="valor" pattern="[0-9]{1,15}" title="Solo se permiten numeros" placeholder="valor">
                <br>
            
                <br>
                <br>
                <input type="submit" name="validar" value="Registro">
                <input type="hidden" name="MM_insert" value="formreg">
                </form>

        </div> 
    </div>
</body>
</html>