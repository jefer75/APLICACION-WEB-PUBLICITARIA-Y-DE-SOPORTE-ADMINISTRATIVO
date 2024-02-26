<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $id_articulo= $_POST['id_articulo'];
    $cantidad= $_POST['cantidad'];
    $valor= $_POST['valor'];
    $fecha_c= $_POST['fecha_c'];
    $cedula= $_POST['cedula'];
    $descripcion= $_POST['descripcion'];
   
     if ($id_articulo=="" || $cantidad=="" || $valor=="" || $fecha_c=="" || $cedula=="" || $descripcion=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="registro_compras.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO compras(id_articulo,cantidad,valor, fecha_c,cedula,descripcion) VALUES('$id_articulo', '$cantidad', '$valor', '$fecha_c', '$cedula', '$descripcion')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../../../login.html"</script>';
     }  
    }
    ?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>formulario</title>
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
    header('Location: ../inicio/index.php');
}

?>

<div class="formulario">
        <div class="signup-box">
            
            <h1 class="signup-title">REGISTRO COMPRAS</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                <!--Username -->
                <br>
                <select name="id_articulo">
                    <option value ="">Seleccione el articulo</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from articulos");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_articulo'] . ">"
                        . $fila['nombre_A'] . "</option>";
                    } 
                    ?>
                </select>
                <br>
                <label for="cantidad">Cantidad</label>
                <br>
                <input type="int" name="cantidad" id="documento"placeholder="Cantidad">
                <br>
                <label for="valor">Valor</label>
                <br>
                <input type="bigint" name="valor" id="nombres" placeholder="Valor">
                <br>
                <label for="fecha_c">Fecha de compra</label>
                <br>
                <input type="date" name="fecha_c" id="nombres"  placeholder="Fecha de la compra">
                <br>
                <label for="cedula">Comprador</label>
                <br>
                <br>
                <select name="cedula">
                    <option value ="">Seleccion el comprador</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from usuarios");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['cedula'] . ">"
                        . $fila['nombre'] . "</option>";
                    } 
                    ?>
                </select>
                <!--Password -->
                <label for="descripccion">Descricion</label>
                <br>
                <input type="varchar" name="descripcion" placeholder="Contraseña">
                <br>
                <br>
                <br>
                

                <br><br>
                <a href="registro_articulos.php">Registrar un nuevo articulo</a>
                <input type="submit" name="validar" value="Registro">
                <input type="hidden" name="MM_insert" value="formreg">
                </form>

        </div> 
    </div>
</body>
</html>