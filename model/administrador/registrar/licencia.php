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
        
    $nit= $_POST['nit'];
    $id_estado= 1;

    $sql= $con -> prepare ("SELECT * FROM licencia");
    $sql -> execute();
    $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
  
    if ($licencia=="" || $nit=="" || $fecha_ini=="" || $fecha_fin=="" || $id_estado=="")
     {
        echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
        echo '<script>window.location="registro_user.php"</script>';
     }
     
     else{
       
       $insertSQL = $con->prepare ("INSERT INTO `licencia`(`licencia`, `nit`, `fecha_ini`, `fecha_fin`, `id_estado`) VALUES ($licencia, $nit, '$fecha_ini', '$fecha_fin', '$id_estado')");
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LICENCIA</title>
  <link rel="stylesheet" href="../../../css/lic.css">
</head>
<body>

<header>
   <td>
    <form action="" method="POST">
   <div class="contenido">

<td><input type="submit" value="regresar" name="regresar" id="regresar"></td>
</div>
</form>

</tr>
</form>
<?php 

if (isset($_POST['regresar'])){
header('Location: ../../../index.html');
}

?>
    </header>

  <div class="login-box">

<form method="POST" name="form1" id="form1" action="../../../controller/inicio.php" autocomplete="off" class="registration"> 
    <h2>LICENCIA ARLEQUIN</h2>

        <div class="user-box">
        <h3>Numero de licencia</h3>
        <input type="varchar" id="licencia" name="licencia" value="<?php echo $licencia ?>" readonly>
        </div>
      
      <div class="form-group">   
        <h3>Empresa</h3>
          <select name="nit">
                    <option value ="">Seleccione la empresa</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from empresa Where nit=123456789");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['nit'] . ">"
                        . $fila['nombre_emp'] . "</option>";
                    }  
                    ?>
            </select>
      </div>
      
      <div class="user-box">
        <h3>Fecha Inicio:</h3>
        <input type="varchar" id="licencia" name="fecha_fin" value="<?php echo $fecha_ini ?>" readonly>
        </div>

        <div class="user-box">
        <h3>Fecha Fin:</h3>
        <input type="varchar" id="licencia" name="fecha_fin" value="<?php echo $fecha_fin ?>" readonly>
        </div>

      <button type="submit" name="inicio" value="validar" class="ingresar">Registrar</button>
              
                
                <a href="../registrar/registro_users.php" class="enlaces" id="adquirir">Registrar empresa</a>
            
          </form>
  </div>
</body>
</html>