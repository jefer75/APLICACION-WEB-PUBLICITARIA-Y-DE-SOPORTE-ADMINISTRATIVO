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
         header("Location: ../inicio/login.php");
         }

  $id_tipo = $_GET['id'];

   //empieza la consulta
   $sql = $con -> prepare("SELECT * FROM detalle_paquete WHERE id_detalles = $id_tipo");
   $sql -> execute();
   $fila = $sql -> fetch ();

   //declaracion de variables de campos en la tabla
   if (isset($_POST['registro'])){

    $paquete = $_POST['paquete'];
   
     if ( $paquete =="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
      }
      
      else {
        $sql= $con -> prepare ("SELECT * FROM detalle_tipo_e
        WHERE id_tipo_e = $id_tipo AND id_paquetes = $paquete");
        $sql -> execute();
        $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
  
        if ($fila){

          echo '<script>alert ("El paquete ya esta asignado para este tipo de evento");</script>';

      }
      else{
        $insertSQL = $con->prepare("INSERT INTO detalle_tipo_e(id_tipo_e, id_paquetes ) VALUES('$id_tipo', '$paquete')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        

      }
     }  
    }


    else if (isset($_POST['eliminar'])){
          
      
      $paquete_eliminar = $_POST['valor'];
     
      
  
          $insert= $con -> prepare ("DELETE FROM detalle_tipo_e WHERE id_tipo_e = $id_tipo AND id_paquetes = $paquete_eliminar");
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
<title>Asignar Paquetes</title>
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



          <!-- primera tabla de registro   -->

          <table class="table datatable">
                <thead>
                  <tr>
                  
                  
                    <th>Tipo de evento</th>
                    <th>Paquete</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $con_paquetes = $con->prepare("SELECT * FROM tipo_e WHERE id_tipo_e=$id_tipo");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {
                       
                        $nombre = $fila['tipo_evento'];
                       
                        
                    ?>
                  <tr>
                    
                  <td><?php echo $nombre?></td>
                  <div class="col-12">
                    <form method="POST">

                      <td><select class="form-control" name="paquete">
                        <option value="">Seleccione el Paquete</option>
                      <?php
                                    $control = $con-> prepare ("SELECT * FROM paquetes");
                                    $control -> execute();
                                    while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                                    {
                                      echo "<option value='" . $fila['id_paquetes'] . "'>" . $fila['nombre_paquete'] . "</option>";
                                      }
                                      ?>
                                  </select></td>
                                </div>
                                
                                <div class="text-center">
                                  <tr>
                                    <td><input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="registro" value="registrar"></td>
                                 
                                   
                          </form>
        </div>
        
                  
                  </tr>
                    <?php
                      }
                    ?>
                  
                 
                  
                </tbody>
              </table>





              <!-- segunda tabla donde muestra el paquete y las actividades perrtenecientes a ese paquete -->
              <table class="table datatable">
                <thead>
                  <tr>
                  
                  
                    
                    <th>Paquete</th>
                    <th>Eliminar</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                        $con_paquetes = $con->prepare("SELECT detalle_tipo_e.id_paquetes, paquetes.nombre_paquete 
                        FROM detalle_tipo_e 
                        INNER JOIN paquetes ON paquetes.id_paquetes = detalle_tipo_e.id_paquetes 
                        WHERE id_tipo_e = $id_tipo
                        ORDER BY id_paquetes");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {
                       
                        $id_paquetes = $fila['id_paquetes'];
                        $nombre = $fila['nombre_paquete'];
                       
                        
                    ?>
                  <tr>
                    
                  <td><?php echo $nombre?></td>
                  <td>
                    <form method="POST">
                      <input type="hidden" name="valor" value="<?php echo $id_paquetes ?>" >
                        <button type="submit" class="btn" name="eliminar" style="background-color: #2c8ac9; color: white;">
                        <i class="bi bi-trash"></i>
                        </button>
                      
                      </form>
                    </td>
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