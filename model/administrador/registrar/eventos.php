<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $id_paquetes= $_POST['id_paquetes'];
    $id_tipo_e= $_POST['id_tipo_e'];
    $lugar= $_POST['lugar'];
    $cant_ninos= $_POST['cant_ninos'];
    $f_inicio= $_POST['f_inicio'];
    $f_fin= $_POST['f_fin'];
    $hora_inicio= $_POST['hora_inicio']; 
    $hora_fin= $_POST['hora_fin'];
    $contacto= $_POST['contacto'];

     $sql= $con -> prepare ("SELECT * FROM eventos");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($id_tipo_e==""||  $id_paquetes=="" || $lugar=="" || $cant_ninos=="" || $f_inicio=="" || $f_fin=="" || $hora_inicio=="" || $hora_fin=="" || $contacto=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="eventos.php"</script>';
      }
      
      else{

        $pass_cifrado = password_hash($contrasena,PASSWORD_DEFAULT, array("pass"=>12));
        
        $insertSQL = $con->prepare("INSERT INTO eventos(fecha_evento, id_paquetes, lugar, cant_ninos, f_inicio, f_fin, hora_inicio, hora_fin, contacto) VALUES(NOW(), $id_paquetes, '$lugar', $cant_ninos, '$f_inicio', '$f_fin', '$hora_inicio', '$hora_fin', $contacto)");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../consultar/read_eventos.php"</script>';
     }  
    }
    ?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registrar Evento</title>
	<link rel="stylesheet" type="text/css" href="../../../css/formularios.css">
</head>
<body background="estos-son-lenguajes-programacion-informaticos-experimentados-usan-diario-443165">

<form action="" method="POST">

<td>

    <input  class="c"    type="submit" value="Cerrar_sesión" name="cerrar_sesion" id="cerrar_sesion"/></td>
    <td><input   class="r"     type="submit" value="Regresar" name="regresar" id="regresar"></td>
</tr>
</form>
<?php 

if(isset($_POST['cerrar_sesion']))
{
    session_destroy();

    header('location: ../../../index.html');
}
else if (isset($_POST['regresar'])){
    header('Location: ../consultar/read_eventos.php');
}

?>

<div class="formulario">
        <div class="signup-box">
            
            <h1 class="signup-title">REGISTRO EVENTO</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                <!--Username -->
                <br>
                <select class="cont" name="id_paquetes">
                    <option value ="">Seleccione el paquete</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from paquetes");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_paquetes'] . ">"
                        . $fila['nombre_paquete'] . "</option>";
                    } 
                    ?>
                </select>
                <br>
                <select class="cont" name="id_tipo_e">
                    <option value ="">Seleccione Tipo de Evento</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from tipo_e");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_tipo_e'] . ">"
                        . $fila['tipo_evento'] . "</option>";
                    } 
                    ?>
                </select>
                <br>
                <label  for="lugar"></label>
                <br>
                <input class="cont"     type="varchar" name="lugar" id="lugar" pattern="[a-zA-Z]{1,40}" title="Solo se permiten letras" placeholder="Digite Lugar del evento">
                <br>
                <label for="cant_ninos"></label>
                <br>
                <input class="cont"     type="int" name="cant_ninos" id="cant_ninos" placeholder="Digite la cantidad de niños">
                <br>
                <p>Fecha de inicio</p>
                <label for="f_inicio"></label>
                <br>
                <input class="cont"     type="date" name="f_inicio" id="f_inicio" >
                <br>
                <p>Fecha de fin</p>
                <label for="f_fin"></label>
                <br>
                <input class="cont"    type="date" name="f_fin">
                <br>
                <p>Hora de fin</p>
                <label for="hora_inicio"></label>
                <br>
                <input class="cont"     type="time" name="hora_inicio" id="hora_inicio" >
                <br>
                <!--Password -->
                <p>Hora de inicio</p>
                <label for="hora_fin"></label>
                <br>
                <input class="cont"    type="time" name="hora_fin">
                <br>
                <label for="contacto"></label>
                <br>
                <input class="cont" type="int" name="contacto" placeholder="Numero de contacto">
                <br>

                <input class="b"     type="submit" name="validar" value="Registro">
                <input   type="hidden" name="MM_insert" value="formreg">
                </form>

        </div> 
    </div>
</body>
</html>