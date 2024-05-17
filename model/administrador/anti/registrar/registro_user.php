<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $cedula= $_POST['cedula'];
    $nombre= $_POST['nombre'];
    $celular= $_POST['celular'];
    $contrasena= $_POST['contrasena'];
    $correo= $_POST['correo'];
    $tipo_user= $_POST['tipo_user'];
    $id_estado= $_POST['id_estado'];
    $nit= 123456789; 

     $sql= $con -> prepare ("SELECT * FROM usuarios WHERE cedula='$cedula'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("DOCUMENTO YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="registro_user.php"</script>';
     }

     else
   
     if ($cedula=="" || $nombre=="" || $correo=="" || $celular=="" || $contrasena=="" || $tipo_user=="" || $id_estado=="" || $nit=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="registro_user.php"</script>';
      }
      
      else{

        $pass_cifrado = password_hash($contrasena,PASSWORD_DEFAULT, array("pass"=>12));
        
        $insertSQL = $con->prepare("INSERT INTO usuarios(cedula, nombre, celular, contrasena, correo, id_tipo_user, id_estado, nit) VALUES('$cedula', '$nombre', '$celular', '$pass_cifrado', '$correo', '$tipo_user', '$id_estado', '$nit')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../../../index.html"</script>';
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
    header('Location: ../inicio/login.php');
}

?>

<div class="formulario">
        <div class="signup-box">
            
            <h1 class="signup-title">REGISTRO USUARIO</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                <!--Username -->
                <br>
                <label for="cedula"></label>
                <br>
                <input class="cont"     type="int" name="cedula" id="documento" pattern="[0-9]{1,15}" title="Solo se permiten numeros" placeholder="Digite Documento">
                <br>
                <label  for="nombre"></label>
                <br>
                <input class="cont"     type="text" name="nombre" id="nombres" pattern="[a-zA-Z]{1,40}" title="Solo se permiten letras" placeholder="Digite Nombre">
                <br>
                <label for="correo"></label>
                <br>
                <input class="cont"     type="email" name="correo" id="correo" placeholder="Digite Correo">
                <br>
                <label for="celular"></label>
                <br>
                <input class="cont"     type="int" name="celular" id="telefono" pattern="[0-9]{1,15}" title="Solo se permiten numeros" placeholder="Digite Telefono">
                <br>
                <!--Password -->
                <label for="contrasena"></label>
                <br>
                <input class="cont"    type="password" name="contrasena" placeholder="Contraseña">
                <br>
                <label for="tipo_user"></label>
                <br>
                <select class="cont" name="tipo_user">
                    <option value ="">Seleccione Tipo Usuario</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from tipo_user WHERE id_tipo_user = 2");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_tipo_user'] . ">"
                        . $fila['tipo_user'] . "</option>";
                    } 
                    ?>
                </select>

                <br>
                <label for="tipo_user"></label>
                <br>
                <select class="cont"  name="id_estado">
                    <option  value ="">Seleccione el estado</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from estados where id_estado = 1");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_estado'] . ">"
                        . $fila['estado'] . "</option>";
                    } 
                    ?>
                </select>

                <br>
                <label  for="nit"></label>
                <br>

                <?php   
             
             $query = $con -> prepare("SELECT * FROM empresa where nit=123456789");
             $query -> execute ();
             $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

             foreach ($resultados as $fila1){
       ?>
       
       <input class="cont" type="varchar" name="nombre_emp" value="<?php echo $fila1['nombre_emp']?>" readonly>
           

           <?php
                  }
            ?>
                <br>

                <input class="b"     type="submit" name="validar" value="Registro">
                <input   type="hidden" name="MM_insert" value="formreg">
                </form>

        </div> 
    </div>
</body>
</html>