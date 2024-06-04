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
    $id_estado= 1;
    $nit= $_POST['nit']; 

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
         echo '<script>window.location="usuarios.php"</script>';
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
	<title>Regitrarse</title>
	<link rel="stylesheet" href="../../../css/registro_users.css">
</head>
<body background="estos-son-lenguajes-programacion-informaticos-experimentados-usan-diario-443165">
    

    

<section class="forms-section">
  <h1 class="section-title">Registrarse</h1>
  <div class="forms">
    <div class="form-wrapper is-active">
      <button type="button" class="switcher switcher-login">
        Usuarios
        <span class="underline"></span>
      </button>
      <form class="form form-login" method="POST" action="">
        <fieldset>
        <div class="formulario" id="usuarios">
        <div class="signup-box">
            
            <h1 class="signup-title">REGISTRO USUARIO</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                <!--Username -->
                <div class="input-block">
                    <label for="login-email">Documento</label>
                    <input type="int" name="cedula" id="documento" pattern="[0-9]{1,15}" title="Solo se permiten numeros" >
                </div>

                <div class="input-block">
                    <label for="login-email">Nombre</label>
                    <input type="varhcar" name="nombre" id="nombres" pattern="[a-zA-Z]{1,40}" title="Solo se permiten letras" >
                </div>

                <div class="input-block">
                    <label for="login-email">Correo</label>
                    <input type="email" name="correo" id="correo" ">
                </div>

                <div class="input-block">
                    <label for="login-email">Telefono</label>
                    <input type="int" name="celular" id="telefono" pattern="[0-9]{1,15}" title="Solo se permiten numeros" >
                </div>
                <!--Contraseña -->
                <div class="input-block">
                    <label for="login-email">Contraseña</label>
                    <input type="password" name="contrasena">
                </div>
                
                <div class="input-block">
                  <br>
                <select name="tipo_user">
                    <option value ="">Seleccione Tipo Usuario</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from tipo_user Where id_tipo_user > 1");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_tipo_user'] . ">"
                        . $fila['tipo_user'] . "</option>";
                    } 
                    ?>
                </select>
                  

                <br>
                
                <select name="nit">
                  
                    <?php
                        $control = $con -> prepare ("SELECT * from empresa where nit=123456789");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['nit'] . ">"
                        . $fila['nombre_emp'] . "</option>";
                    } 
                    ?>
                </select>                           
                      
                <input type="submit" name="validar" value="Registro">
                <input type="hidden" name="MM_insert" value="formreg">
                <br>
                <a href="../inicio/login.php">Iniciar Sesion</a>
                </form>

        </div> 
    </div>
        </fieldset>
      </form>
    </div>

  <?php 
    
     if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg_"))
    {

     $nit= $_POST['nit'];
     $nombre_emp= $_POST['nombre_emp'];
     $telefono= $_POST['telefono'];
     $direccion= $_POST['direccion'];

      $sql= $con -> prepare ("SELECT * FROM empresa WHERE nit='$nit'");
      $sql -> execute();
      $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
 
      if ($fila){
         echo '<script>alert ("ESTA EMPRESA YA EXISTE");</script>';
         echo '<script>window.location="registro_users.php"</script>';
      }

     if ($nit=="" || $nombre_emp=="" ||  $telefono=="" || $direccion="")
       {
          echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
          echo '<script>window.location="registro_users.php"</script>';
       }
      
       else{

         $insertSQL = $con->prepare("INSERT INTO empresa(nit,nombre_emp,telefono,direccion) VALUES('$nit', '$nombre_emp','$telefono','$direccion')");
         $insertSQL -> execute();
         echo '<script> alert("REGISTRO EXITOSO");</script>';
         echo '<script>window.location="registro_users.php"</script>';
      }
    }
    
    ?>


    <div class="form-wrapper" id="empresas">
      <button type="button" class="switcher switcher-signup">
        Empresas
        <span class="underline"></span>
      </button>

      <form class="form form-signup" method="post" name="formreg_" id="formreg_" class="signup-form"  autocomplete="off">

        <fieldset>
        <h1 class="signup-title">REGISTRO EMPRESA</h1>
          <div class="input-block">
            <label for="signup-email">Nit</label>
            <input id="signup-email" type="bigint" name="nit"required>
          </div>
          <div class="input-block">
            <label for="signup-password">Nombre de empresa</label>
            <input id="signup-password" type="varchar" name="nombre_emp" required>
          </div>
          <div class="input-block">
            <label for="signup-password-confirm">Telefono</label>
            <input id="signup-password-confirm" type="bigint" name="telefono" required>
          </div>
          <div class="input-block">
            <label for="signup-email">Direccion</label>
            <input id="signup-email" type="varchar" name="direccion" required>
          </div>
          <input type="submit" name="validar" value="Registro">
        <input type="hidden" name="MM_insert" value="formreg_">
        <br>
        <a href="../inicio/login.php">Iniciar Sesion</a>
        </fieldset>
        
      </form>
      
    </div>
  </div>
</section>
<script src="../../../js/registro_users.js"></script>
</body>
</html>