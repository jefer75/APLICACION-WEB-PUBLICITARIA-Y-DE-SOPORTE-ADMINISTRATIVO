



<?php
       session_start();
       require_once("../../../db/connection.php");
       // include("../../../controller/validarSesion.php");
       $db = new Database();
       $con = $db -> conectar();

   //empieza la consulta
   $sql = $con -> prepare("SELECT * FROM paquetes WHERE id_paquetes='".$_GET['id']."'");
   $sql -> execute();
   $fila = $sql -> fetch ();

   //declaracion de variables de campos en la tabla

   if (isset($_POST['actualizar'])){

    $nombre_paquete = $_POST['nombre_paquete'];
    $edad_min = $_POST['edad_min'];
    $edad_max = $_POST['edad_max'];
    $valor= $_POST['valor'];

       
           $insert= $con -> prepare ("UPDATE paquetes SET  nombre_paquete='$nombre_paquete', edad_min='$edad_min', edad_max='$edad_max', valor='$valor' WHERE id_paquetes = '".$_GET['id']."'");
           $insert -> execute();
           echo '<script> alert ("Registro actualizado exitosamente");</script>';
           echo '<script> window.close(); </script>';
               
       }

       else if (isset($_POST['eliminar'])){
          
        $nombre_paquete = $_POST['nombre_paquete'];
        $edad_min = $_POST['edad_min'];
        $edad_max = $_POST['edad_max'];
        $valor= $_POST['valor'];
    
       
               $insert= $con -> prepare ("DELETE FROM paquetes WHERE id_paquetes = '".$_GET['id']."'");
               $insert -> execute();
               echo '<script> alert ("Registro actualizado exitosamente");</script>';
               echo '<script> window.close(); </script>';
                   
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

          <h5 class="card-title">paquetes</h5>



          <!-- Multi Columns Form -->

          <form autocomplete="off"class="row g-3" name="form_actualizar" method="POST">



            

            <div class="col-md-6">

              <label for="inputEmail5" class="form-label">Nombre paquete</label>

              <input  name="nombre_paquete"  class="form-control" value="<?php echo $fila['nombre_paquete'] ?>" >    

            </div>


            <div class="col-12">

              <label for="inputAddress2" class="form-label">edad minima</label>
              <input type="number"" class="form-control"  name="edad_min" value="<?php echo $fila['edad_min']?>" >

            </div>
            
            <div class="col-12">

              <label for="inputAddress2" class="form-label">edad maxima</label>
              <input type="number"class="form-control"  name="edad_max" value="<?php echo $fila['edad_max'] ?>">

            </div>
            <div class="col-12">

              <label for="inputAddress2" class="form-label">Valor</label>
              <input type="number"  class="form-control" name="valor" value="<?php echo $fila['valor'] ?>"></td>      
            </div>

           

           

         

            <div class="text-center">

            <tr>

            <td><input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" class="btn" style="background-color: gray; color: white;" name="eliminar" value="Eliminar"></td>




            </tr>

              <!-- <button type="submit" class="btn btn-primary">Submit</button>

 

              <button type="reset" class="btn btn-secondary">Reset</button> -->

            </div>

          </form><!-- End Multi Columns Form -->



        </div>

      </div>



    </div>
    
</body>
</html>