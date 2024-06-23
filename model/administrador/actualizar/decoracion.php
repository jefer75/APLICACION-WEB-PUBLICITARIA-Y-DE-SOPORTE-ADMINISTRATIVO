<?php
       session_start();
       require_once("../../../db/connection.php");
       // include("../../../controller/validarSesion.php");
       $db = new Database();
       $con = $db -> conectar();

   //empieza la consulta
   $sql = $con -> prepare("SELECT * FROM decoracion WHERE id_imagen='".$_GET['id']."'");
   $sql -> execute();
   $fila = $sql -> fetch ();

   $id_imagen=$fila['id_imagen'];
   $descripcion=$fila['descripcion'];
   $direccion_antigua=$fila['imagen'];
   //declaracion de variables de campos en la tabla

   if (isset($_POST['actualizar'])){

    $descripcion = $_POST['descripcion'];
    
    $imagen=$_FILES['imagen']['tmp_name'];
    $nombre=$_FILES['imagen']['name'];
    $formato=strtolower(pathinfo($nombre,PATHINFO_EXTENSION));
    $peso=$_FILES['imagen']['size'];
    $carpeta="../../../imagenes/registradas/decoracion/";

    if ($imagen!="") {
      
      if ($formato=="jpg" || $formato=="jpeg" || $formato=="png") {
      
        try {
          unlink($direccion_antigua);
        } catch (\Throwable $th) {
          //throw $th;
        }

        $direccion=$carpeta.$id_imagen.".".$formato;

        $insert= $con -> prepare ("UPDATE decoracion SET  descripcion='$descripcion', imagen='$direccion' WHERE id_imagen = $id_imagen");
        $insert -> execute();
        echo '<script> alert ("Registro actualizado exitosamente");</script>';
        echo '<script> window.close(); </script>';
   
        if (move_uploaded_file($imagen,$direccion)) {
          echo '<script>alert ("La imagen ha sido guardad exitosamente");</script>';
          echo '<script>window.close()</script>';
        } else {
          echo '<script>alert ("Error al guardar la imagen en el almacenamiento");</script>';
        }

       } else {
           echo '<script>alert ("El formato del archivo no corresponde");</script>';
       }

    } else {
      $insert= $con -> prepare ("UPDATE decoracion SET  descripcion='$descripcion' WHERE id_imagen = $id_imagen");
        $insert -> execute();
        echo '<script> alert ("Registro actualizado exitosamente");</script>';
        echo '<script> window.close(); </script>';
    }
  
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
<title>Actualizar Decoracion</title>
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../../css/tablas.css" rel="stylesheet">

</head>

<body onload="centrar();">

<div class="card">
<div class="card-body">
  
<h5 class="card-title">actualizar</h5>
            <?php
                       $actividades = $con->prepare("SELECT * FROM decoracion WHERE id_imagen = $id_imagen");
                       $actividades->execute();
                       $actividades = $actividades->fetchAll(PDO::FETCH_ASSOC);
                       foreach ($actividades as $_GET) {
                       
                       
                        $descripcion = $fila['descripcion'];
                        $imagen = $fila['imagen'];
                    ?>

               <div class="img">
               <img class="imagenes_tablas" src="../../../model/administrador/pages/<?php echo $imagen?>">
               </div>
               <div class="bottom-text">
               </div>
            </div>
            <?php
              }
            ?>
        <form autocomplete="off"class="row g-3" enctype="multipart/form-data"  name="form_actualizar" method="POST">
        <div class="col-md-6">
            <div class="col-8">
            <label for="inputEmail5" class="form-label">Descripcion</label>
            <input  class="form-control" type="text" name="descripcion" value="<?php echo $fila['descripcion']?>" placeholder="Descripcion del paquete">
        </div>

        <div class="col-8">
            <label for="inputEmail5" class="form-label">Imagen</label>
            <input  class="form-control" type="file" name="imagen">
            </div>
            <br>
        </div>
        <div class="text-center">
            <tr>
              <td><input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar"></td>
            </tr>
        </div>

          </form><!-- End Multi Columns Form -->
        </div>
      </div>
    </div>
</body>
</html>