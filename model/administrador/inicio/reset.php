<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


if (isset($_POST['verificar']))
    { 
        $codigo=$_POST['codigo'];

        $sql= $con -> prepare ("SELECT * FROM usuarios WHERE token='$codigo'");
        $sql -> execute();
        $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

      if ($fila) {
      echo '<script> alert ("Su codigo ha sido verificado correctamente");</script>';
      echo '<script>window.location="recuperacion2.php"</script>';
      }
      else{
        echo '<script> alert ("El codigo digitado no coincide con el codigo enviado");</script>';
        echo '<script>window.location="reset.php"</script>';
      }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer Contraseña</title>
  <link rel="stylesheet" href="../../../css/recuperar_con.css">

</head>
<body>
  <div class="container">
    <div class="col-lg-6 login-form">
      <img class="image-logo" src="https://cdn-icons-png.flaticon.com/512/6375/6375816.png" />
      <br>
      <br>
      <br>
      <h1>Restablecer Password</h1>
    
      <div class="input-form password-toggle">
        <br>
       <form class="col-3" method="post">
        <input class="effect-1" name= "codigo" id="c" type="varchar" placeholder="codigo">


        <!-- <input class="effect-1" name= "email" id="c" type="hidden" placeholder="email" value="<?php //echo $email;?>">
        <input class="effect-1" name= "token" id="c" type="hidden" placeholder="email" value="<?php //echo $token;?>">
         -->
        
        
        
       
      </div>
      <br>
      <input type="submit" name="verificar" value="verificar">
      <input type="hidden" name="MM_insert" value="formreg">
      
      
      <br>
     
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


</body>
</html>