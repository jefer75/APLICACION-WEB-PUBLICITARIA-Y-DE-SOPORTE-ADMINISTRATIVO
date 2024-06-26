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
  
   $sql = $con -> prepare("SELECT usuarios.cedula, usuarios.nombre, usuarios.celular, usuarios.correo, tipo_user.tipo_user, usuarios.id_estado, estados.estado, empresa.nombre_emp
   FROM usuarios
   INNER JOIN tipo_user ON tipo_user.id_tipo_user = usuarios.id_tipo_user
   INNER JOIN estados ON estados.id_estado = usuarios.id_estado 
   INNER JOIN empresa ON empresa.nit= usuarios.nit 
   WHERE cedula='".$_GET['id']."'");
   $sql->execute();
   $fila = $sql->fetch();

   $cedula = $fila['cedula'];
   $nombre = $fila['nombre'];
   $celular = $fila['celular'];
   $correo = $fila['correo'];
   $tipo_usuario = $fila['tipo_user'];
   $id_estado = $fila['id_estado'];
   $estado = $fila['estado'];
   $empresa = $fila['nombre_emp'];
   
   //declaracion de variables de campos en la tabla

   if (isset($_POST['actualizar'])){

       $estado= $_POST['estado'];
        
            $insert= $con -> prepare ("UPDATE usuarios SET id_estado=$estado WHERE cedula = '".$_GET['id']."'");
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
<title>Actualizar Usuarios</title>
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../../../css/bootstrap.min.css" rel="stylesheet">


</head>

<body onload="centrar();">



<div class="card">

        <div class="card-body">

          <h5 class="card-title">Usuarios</h5>

          <!-- Multi Columns Form -->

          <form autocomplete="off"class="row g-3" name="form_actualizar" method="POST">

          
        <div class="col-4">
            <label for="descripcion" class="form-label">N° Documento</label>
            <input class="form-control" value="<?php echo $cedula; ?>" readonly>
        
        </div>
        
        <div class="col-8">
            <label for="nombreArticulo" class="form-label">Nombre</label>
            <input class="form-control" value="<?php echo $nombre ?>" readonly>
        </div>
        
        <div class="col-6">
            <label for="descripcion" class="form-label">Celular</label>
            <input class="form-control" value="<?php echo $celular?>" readonly>
        </div>
        
        <div class="col-6">
            <label for="descripcion" class="form-label">Correo</label>
            <input class="form-control" value="<?php echo $correo?>" readonly>
        </div>
        
        <div class="col-4">
            <label for="descripcion" class="form-label">Tipo de usuario</label>
            <input class="form-control" value="<?php echo $tipo_usuario ?>" readonly>
        </div>
        
        <div class="col-4">
            <label for="inputTipoArticulo" class="form-label">Estado</label>
            <select class="form-control" name="estado">
                <option value="<?php echo $id_estado ?>"><?php echo $estado ?></option>
                <?php
                    $control = $con-> prepare ("SELECT * FROM estados WHERE id_estado != $id_estado AND estado = 'Activo' or estado='inactivo'");
                    $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                    {
                        echo "<option value='" . $fila['id_estado'] . "'>" . $fila['estado'] . "</option>";
                    }
                ?>
            </select>
        </div>
        
        <div class="col-4">
            <label for="descripcion" class="form-label">Empresa</label>
            <input class="form-control" value="<?php echo $empresa?>" readonly>
        </div>
       
        <div class="text-center">
                        <input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar">
                    </div>
          </form>
        </div>

      </div>



    </div>
    
</body>
</html>