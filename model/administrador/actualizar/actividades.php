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

   //empieza la consulta
   $sql = $con -> prepare("SELECT * FROM actividades WHERE id_actividad='".$_GET['id']."'");
   $sql -> execute();
   $fila = $sql -> fetch ();

   $id_actividad=$fila['id_actividad'];
   $direccion_antigua=$fila['imagen'];
   //declaracion de variables de campos en la tabla

   if (isset($_POST['actualizar'])){

    $nombre_act = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    
    $imagen=$_FILES['imagen']['tmp_name'];
    $nombre=$_FILES['imagen']['name'];
    $formato=strtolower(pathinfo($nombre,PATHINFO_EXTENSION));
    $peso=$_FILES['imagen']['size'];
    $carpeta="../../../imagenes/registradas/actividades/";

    
    if ($imagen!="") {
      
      if ($formato=="jpg" || $formato=="jpeg" || $formato=="png") {
      
        try {
          unlink($direccion_antigua);
        } catch (\Throwable $th) {
          //throw $th;
        }

        $direccion=$carpeta.$id_actividad.".".$formato;

        $insert= $con -> prepare ("UPDATE actividades SET nombre='$nombre_act', descripcion='$descripcion', imagen='$direccion' WHERE id_actividad = $id_actividad");
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
      $insert= $con -> prepare ("UPDATE actividades SET nombre='$nombre_act', descripcion='$descripcion' WHERE id_actividad = $id_actividad");
        $insert -> execute();
        echo '<script> alert ("Registro actualizado exitosamente");</script>';
        echo '<script> window.close(); </script>';
    }
  
  }
        ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Actividad</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/tablaedi.css" rel="stylesheet">
    <script>
        function centrar() {
            var iz = (screen.width - document.body.clientWidth) / 2;
            var de = (screen.height - document.body.clientHeight) / 3;
            moveTo(iz, de);
        }
    </script>
</head>
<body onload="centrar();">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Actualizar Actividad</h5>
            <form autocomplete="off" class="row g-3" enctype="multipart/form-data" name="form_actualizar" method="POST" onsubmit="return validarFormulario()">
    <div class="col-md-6">
        <label for="nombreInput" class="form-label">Nombre</label>
        <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($fila['nombre']); ?>" placeholder="Nombre de actividad">
        <div id="error_nombre" class="invalid-feedback" style="display: none;">
            El nombre debe contener entre 1 y 20 letras.
        </div>
    </div>

    <div class="col-md-6">
        <label for="descripcionInput" class="form-label">Descripción</label>
        <input class="form-control" type="text" name="descripcion" id="descripcionInput" value="<?php echo htmlspecialchars($fila['descripcion']); ?>" placeholder="Descripción del paquete">
        <div id="error_descripcion" class="invalid-feedback" style="display: none;">
            La descripción debe tener entre 10 y 80 caracteres y no puede contener más de un espacio consecutivo.
        </div>
    </div>

    <div class="col-md-6">
        <label for="imagenInput" class="form-label">Imagen</label>
        <input class="form-control" type="file" name="imagen">
    </div>

    <div class="text-center">
        <input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar">
    </div>
</form>
        </div>
    </div>

    <script src="../../validaciones/validar_actividades.js"></script>
</body>
</html>
