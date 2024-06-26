<?php
       session_start();
       require_once("../../../db/connection.php");
       // include("../../../controller/validarSesion.php");
       $db = new Database();
       $con = $db -> conectar();

       $cedula = $_SESSION['cedula'];
       if (!isset($cedula)){
         //include("../../../controller/validar_licencia.php");
         echo '<script>alert("No has iniciado sesion");</script>';
         header("Location: ../../administrador/inicio/login.php");
         }

  $act = $_GET['id'];

   //empieza la consulta
   $sql = $con -> prepare("SELECT * FROM detalle_paquete WHERE id_paquetes = $act");
   $sql -> execute();
   $fila = $sql -> fetch ();

   //declaracion de variables de campos en la tabla
   if (isset($_POST['registro'])){

    $id_actividad = $_POST['id_actividad'];
   
     if ( $id_actividad =="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
      }
      
      else {
        $sql= $con -> prepare ("SELECT * FROM detalle_paquete 
        WHERE id_paquetes = $act AND id_actividad = $id_actividad");
        $sql -> execute();
        $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
  
        if ($fila){

          echo '<script>alert ("La actividad ya esta asignada a este paquete");</script>';

      }
      else{
        $insertSQL = $con->prepare("INSERT INTO detalle_paquete(id_actividad, id_paquetes ) VALUES('$id_actividad', '$act')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        

      }
     }  
    }


    else if (isset($_POST['eliminar'])){
           
      $id_actividades = $_POST['valor'];
     
          $insert= $con -> prepare ("DELETE FROM detalle_paquete WHERE id_paquetes = $act AND id_actividad = $id_actividades");
          $insert -> execute();
          echo '<script> alert ("se elimino la actividad");</script>';
      }
    

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
<title>Asignar Actividades</title>
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

              <!-- segunda tabla donde muestra el paquete y las actividades perrtenecientes a ese paquete -->
              <table class="table datatable">
                <thead>
                  <tr>
                  
                  
                    
                    <th>Actividades</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $con_paquetes = $con->prepare("SELECT actividades.nombre, actividades.id_actividad 
                       FROM detalle_paquete  
                       INNER JOIN actividades  on 
                       actividades.id_actividad = detalle_paquete.id_actividad  
                       WHERE id_paquetes = $act ORDER BY id_actividad");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {
                       
                        $id_actividades = $fila['id_actividad'];
                        $nombre = $fila['nombre'];
                       
                        
                    ?>
                  <tr>
                    
                  <td><?php echo $nombre?></td>
                  
                  </tr>
                 
         
                  </tr>
                    <?php
                      }
                    ?>
                  
                 
                  
                </tbody>
              </table>


        </div>

      </div>



    </div>
    
</body>
</html>