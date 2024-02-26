<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>interfaz cliente</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
    <link rel="stylesheet" href="../../css/cliente.css">
</head>

<body>

    <header>
        <form action="" method="POST">
        
        <td>
        
            <input type="submit" value="Cerrar_sesión" name="cerrar_sesion" id="cerrar_sesion"> 
        </td>
        
        </tr>
        </form>
        <?php 
        
        if(isset($_POST['cerrar_sesion']))
        {
            session_destroy();
        
        
            header('location:../../index.html');
        }
        
        ?>
        
            
            <h1>Bienvenido</h1>
            </header>

    <div class="container">
    <div class="image-container">
            <img src="../../imagenes\img45.jpg" >
            <div class="image-description">
                <p>Animacion infantil</p>
            </div>
    </div>
    <div class="image-container">
            <img src="../../img/baby shower.png" >
            <div class="image-description">
                <p>Animacion para adultos</p>
            </div>
    </div>
    <div class="image-container">
            <img src="../../imagenes\img53.jpg" >
            <div class="image-description">
                <p>Decoracion</p>
            </div>
    </div>
    </div>
  </body>

<!-- <body>
    <center><h1>elija la opcion que necesita</h1></center>
    <br>
    <br>
    <div class="imagen" >
        
        <a href=""><img src="../../imagenes\img45.jpg" ></a>
      
        </div>
        <div class="imagen" >
            
            <a href=""><img src="../../imagenes\img2.jpg" ></a>
            </div>
            
            <div class="imagen" >
                
                <a href=""><img src="../../imagenes\img6.jpg" ></a>
                </div>

      
    <div class="infantil"></div>
    <div class="infantil"> <h2>opcion para adultos</h2></div>
    <div class="infantil"><h2>opcion de decoracion</h2></div>
     
   
</body> -->
</html>
