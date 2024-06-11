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
      echo '<script>window.location="codiS.php"</script>';
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
    <body >


   
                   
          <td>
          <form action="" method="POST">
          <div class="contenido">
         
      </div>
      </nav>
      <!-- Navbar End -->


      <?php 

      if (isset($_POST['regresar'])){
      header('Location: ../../../index.php');
      }

      ?>


<div class="container-xxl py-5" >

            
                <div class="bg-light rounded" >
                  
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" >
                            <div class="h-100 d-flex flex-column justify-content-center p-5 contenido">
                            <h1 style="font-family: 'Arial Rounded MT Bold', sans-serif;">Digite su Correo</h1>

                               
                                <form action="../../../controller/inicio.php" method="POST" name="form1">
                                    <div class="row g-3 inputs">
                                    <div class="col-sm-6 user">
                                    <div class="form-floating">
    <input type="email" class="form-control border-0 gmail" id="correo" name="email" placeholder="Correo">
    <label for="correo">Correo</label>
</div>

<script>
    // Función para validar correo electrónico
    function validarCorreo() {
        var correoInput = document.getElementById('correo').value;
        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/; // Expresión regular para validar el formato del correo

        // Verificar si el correo cumple con la expresión regular y si tiene máximo 30 caracteres
        if (!regex.test(correoInput) || correoInput.length > 30) {
            alert("Por favor ingresa un correo válido que contenga '@' y '.' y que tenga un máximo de 30 caracteres.");
            return false;
        }
        return true;
    }

    // Agregar evento de escucha para validar correo al perder el foco
    document.getElementById('correo').addEventListener('blur', validarCorreo);
</script>

                                    </div>

                                        
                                        <div class="col-12">
                                        <button type="submit" name="recuperar" class="btn btn-primary w-100 py-3 ingresar" style="background-color: blue; color: white; border: 1px solid white;">Ingresar</button>


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