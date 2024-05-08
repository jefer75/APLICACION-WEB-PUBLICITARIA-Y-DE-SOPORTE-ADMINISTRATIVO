<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $nombre_a= $_POST['nombre_a'];
    $cantidad= $_POST['cantidad'];

     $sql= $con -> prepare ("SELECT * FROM articulos WHERE nombre_A='$nombre_a'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("ESTE RECREADOR YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="articulos.php"</script>';
     }

     else
   
     if ($nombre_a=="" || $cantidad=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="articulos.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO articulos(nombre_A, cantidad) VALUES('$nombre_a', '$cantidad')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../consultar/read_articulos.php"</script>';
     }  
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro de Empleados</title>
	<link rel="stylesheet" type="text/css" href="../../../css/formularios.css">
</head>
<body background="estos-son-lenguajes-programacion-informaticos-experimentados-usan-diario-443165">

<form action="" method="POST">

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
    header('Location: ../consultar/read_articulos.php');
}
else if (isset($_POST['tipos'])){
    header('Location: ../consultar/read_articulos.php');
}

?>


<div class="formulario">
        <div class="signup-box">
            
            <h1 class="signup-title">REGISTRO ARTICULOS</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                <!--Username -->
                <br>
                <label for="nombre_a">Nombre de articulo</label>
                <br>
                <input type="varchar" name="nombre_a" id="documento" placeholder="Nombre de articulo">
                <br>
                <label for="cantidad">Cantidad</label>
                <br>
                <input type="varchar" name="cantidad" id="nombres" placeholder="Cantidad de articulo">
                <br>
                <select class="cont" name="tipo_user">
                    <option value ="">Seleccione Tipo de articulo</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from tipo_art");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_tipo_art'] . ">"
                        . $fila['tipo_articulo'] . "</option>";
                    } 
                    ?>
                </select>
                                
                <input type="submit" name="validar" value="Registro">
                <input type="hidden" name="MM_insert" value="formreg">
                </form>

        </div> 
    </div>
</body>
</html>