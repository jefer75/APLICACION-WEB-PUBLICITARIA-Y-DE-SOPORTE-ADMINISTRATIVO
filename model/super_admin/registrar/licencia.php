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
        echo '<script>window.location="../inicio/admin.php"</script>';
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
    <td><input   class="r"     type="submit" value="Regresar" name="regresar" id="regresar"></td>
</tr>
</form>
<?php 

if (isset($_POST['regresar'])){
    header('Location: ../inicio/admin.php');
}

?>

<div class="formulario">
        <div class="signup-box">
            
            <h1 class="signup-title">Registrar Licencia</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                <!--Username -->
                
                
                <br>
                <label for="licencia"></label>
                <br>
                <input class="cont"     type="int" name="licencia" value="<?php echo $licencia ?>" readonly>
                <br>
                <select class="cont" name="nit">
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

                <label  for="fecha_ini"></label>
                <br>
                <input class="cont" type="date" name="fecha_ini" id="fecha_ini"  value="<?php echo $fecha_ini ?>" readonly>
                <br>
                <label for="fecha_fin"></label>
                <br>
                <input class="cont"     type="date" name="fecha_fin" id="fecha_fin">
                <br>

                <label for="id_estado"></label>
                <br>
                <select class="cont"  name="id_estado">
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

                <input class="b"     type="submit" name="validar" value="Registro">
                <input   type="hidden" name="MM_insert" value="formreg">
                </form>

        </div> 
    </div>
</body>
</html>