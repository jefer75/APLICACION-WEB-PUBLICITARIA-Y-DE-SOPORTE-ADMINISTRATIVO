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
    <title>ELITECH</title>
    <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/unicode-15/bw/512px/1f9d1-1f4bb.png">
    <link rel="stylesheet" href="../css/conf.css">

    </head>
    <body >
    <header class="header">
    <nav class="navbar">
      <h2 class="logo"><a href="#">ELITECH JYDT</a></h2>
      <div class="buttons">
        <a href="../index.php" class="signup">Regresar</a>
      </div>
    </nav>
  </header>

  <div class="container_mayor">

  
                <form action="" method="POST">
                <div class="contenido">   
            </div>
            <!-- Navbar End -->
            <?php 
            if (isset($_POST['regresar'])){
            header('Location:../index.php');
            }
            ?>
        <div class="container" >
            <div class="contenido-interior" >
                <h1 style="font-family: 'Arial Rounded MT Bold', sans-serif;">Digite su Correo</h1>
                    <form action="../../../controller/inicio.php" method="POST" name="form1">
                         <div class="row g-3 inputs">
                            <div class="col-sm-6 user">
                                <div class="form-floating">
        <input type="email" class="form-control border-0 gmail" id="correo" name="email" placeholder="Correo">
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
        <br>
        <div class="col-12">
        <button type="submit" name="recuperar" class="btn btn-primary w-100 py-3 ingresar" style="background-color: blue; color: white; border: 1px solid white;">Ingresar</button>

        </div>
            </div>
                </form>
                    </div>
                        </div>
                          </div>
                          </div>

        </body>
        </html>