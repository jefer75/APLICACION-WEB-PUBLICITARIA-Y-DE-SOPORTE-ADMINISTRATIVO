<?php
    session_start();
    require_once ("../../../db/connection.php");
    //include("../../../controller/validar_licencia.php");
    $db = new DataBase();
    $con = $db -> conectar();



    if (isset($_POST['recuperar']))
    {

      $correo=$_POST['email'];

    if ($correo==""){
      echo '<script>alert("Digite el correo")</script>';
    }
    else {
    
     $sql= $con -> prepare ("SELECT * FROM usuarios WHERE correo='$correo'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

    if($fila){
    $digitos ="sakur02ue859y2u389rhdewirh102385y1285013289";
    $longitud= 4;
    $codigo= substr(str_shuffle($digitos), 0, $longitud);

     $insert= $con -> prepare ("UPDATE usuarios SET token='$codigo' Where correo='$correo'");
     $insert -> execute();
     $fila1 = $insert -> fetchAll(PDO::FETCH_ASSOC);

    //codigo de envio de correo
    $paracorreo = "$correo";
    $titulo ="Codigo de verificacion";
    $msj = "Su codigo de verificacion es: '$codigo'";
    $tucorreo="From:aeventos986@gmail.com";

    if(mail($paracorreo, $titulo, $msj, $tucorreo))
    {
      echo '<script> alert ("Su codigo ha sido enviado al correo anteriormente digitado");</script>';
      echo '<script>window.location="reset.php"</script>';
    }
    }
    else{
        echo '<script> alert ("El correo digitado no esta registrado");</script>';
    }
    } 
  }
?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Restablecer</title>
      <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
        
        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="../../../css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="../../../css/style.css" rel="stylesheet">
        <link href="../../../css/recuperar_con.css" rel="stylesheet">

    </head>
    <body>

      <div class="container-xxl bg-white p-0">

      <!-- Navbar Start -->
      <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
      <img src="../../../imagenes/logos/Logo Arlequin Color.png" class="logo">
      <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="../../../index.php" class="nav-item nav-link active">Inicio</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Recreación</a>
                        <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                            <a href="../../../infantil.php" class="dropdown-item">Infantil</a>
                            <a href="../../../adultos.php" class="dropdown-item">Adultos</a>
                        </div>
                    </div>

                    <a href="../../../decoracion.php" class="nav-item nav-link">Decoración</a>
                    <a href="../../../sobre_nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>                    
                    <a href="../../../contact.php" class="nav-item nav-link">Contáctanos</a>
                </div>
          <td>
          <form action="" method="POST">
          <div class="contenido">
          <td><input class="btn btn-primary rounded-pill px-3 d-none d-lg-block" type="submit" value="regresar" name="regresar" id="regresar"></td>
          <!-- <td href="" class="btn btn-primary rounded-pill px-3 d-none d-lg-block"  value="regresar" name="regresar" id="regresar"></>> Regresar<i class="fa fa-arrow-right ms-3"></i></td> -->
      </div>
      </nav>
      <!-- Navbar End -->


      <?php 

      if (isset($_POST['regresar'])){
      header('Location: ../../../index.php');
      }

      ?>


      <div class="container-xxl py-5">
            
                <div class="bg-light rounded">
                  
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5 contenido">
                                <h1 class="mb-4">Digite su Correo</h1>
                                <p>Recupera tu contraseña</p>
                                <form action="../../../controller/inicio.php" method="POST" name="form1">
                                    <div class="row g-3 inputs">
                                      <div class="col-sm-6 user">
                                            <div class="form-floating">

                                                <input type="gmail" class="form-control border-0 gmail" id="correo" name="email"  maxlength="23" placeholder="Correo">
                                                <label for="fecha">Correo</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                        <button type="submit" name="recuperar" class="btn btn-primary w-100 py-3 ingresar">Restablecer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                       
                    
                </div>
            </div>
        </div>

</body>
</html>