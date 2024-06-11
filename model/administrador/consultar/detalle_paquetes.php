



<?php
       session_start();
       require_once("../../../db/connection.php");
       // include("../../../controller/validarSesion.php");
       $db = new Database();
       $con = $db -> conectar();

   //empieza la consulta
   $sql = $con -> prepare("SELECT * FROM detalles WHERE id_detalles='".$_GET['id']."'");
   $sql -> execute();
   $fila = $sql -> fetch ();

   //declaracion de variables de campos en la tabla



        ?>


<!DOCTYPE html>
<html lang="en">
    <script>
        function centrar() {
            iz=(screen.width-document.body.clientWidth) / 2;
            de=(screen.height-document.body.clientHeight) / 3;
            moveTo(iz,de);
        }
    </script>
<head>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Paquetes</title>
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../../css/tablaedi.css" rel="stylesheet">

</head>

<body onload="centrar();">



<div class="card">

        <div class="card-body">

          <h5 class="card-title">Actividades disponibles</h5>



          <!-- Multi Columns Form -->

          <form autocomplete="off"class="row g-3" name="form_actualizar" method="POST">



            

            <div class="col-md-6">

<br>
              <form action="procesar_seleccion.php" method="post">

              <?php
                       $actividades = $con->prepare("SELECT * FROM actividades");
                      $actividades->execute();
                      $actividades = $actividades->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($actividades as $fila) {
                       
                        $nombre = $fila['nombre'];
                       
                        
                    ?>
              <label for="opcion3">
                <p><?php  echo $nombre?></p>
              <?php
             
                      }
                    ?>  

             
             
             <br>
             
   
</form>

            </div>


         
            <br>
        
            <div class="text-center">

            </div>

          </form><!-- End Multi Columns Form -->



        </div>

      </div>



    </div>
    
</body>
</html>