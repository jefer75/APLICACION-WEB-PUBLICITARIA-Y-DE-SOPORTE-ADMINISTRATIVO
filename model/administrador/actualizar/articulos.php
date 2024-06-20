<?php
       session_start();
       require_once("../../../db/connection.php");
       // include("../../../controller/validarSesion.php");
       $db = new Database();
       $con = $db -> conectar();

   //empieza la consulta
  
   $sql = $con -> prepare("SELECT articulos.id_articulo, articulos.id_tipo_art, tipo_articulo.tipo_articulo, articulos.id_estado,  estados.estado, articulos.nombre_A, articulos.descripcion, articulos.cantidad, articulos.valor
   FROM articulos
   INNER JOIN tipo_articulo ON tipo_articulo.id_tipo_art = articulos.id_tipo_art
   INNER JOIN estados ON estados.id_estado = articulos.id_estado WHERE id_articulo='".$_GET['id']."'");
   $sql->execute();
   $fila = $sql->fetchAll(PDO::FETCH_ASSOC);
   foreach ($fila as $fila) {
 //  foreach ($fila as $fila) {
   $id_tipo_art = $fila['id_tipo_art'];
   $tipo_art = $fila['tipo_articulo'];
   $id_estado = $fila['id_estado'];
   $estado = $fila['estado'];
   $cantidad = $fila['cantidad'];

   //declaracion de variables de campos en la tabla

   if (isset($_POST['actualizar'])){

    

       $id_tipo_art= $_POST['id_tipo_art'];
       $nombre_A = $_POST['nombre_A'];
       $id_estado= $_POST['id_estado'];
       $descripcion= $_POST['descripcion'];
       $suma = $_POST['suma'];
       $valor= $_POST['valor'];

      if ($valor <= 0) {  
        echo '<script>alert("CANTIDAD Y VALOR DEBEN SER MAYORES A 0");</script>';
      }
       else {
        
        $cantidad_total = $suma + $cantidad;
        
           $insert= $con -> prepare ("UPDATE articulos SET  nombre_A='$nombre_A', id_estado='$id_estado', descripcion='$descripcion', id_tipo_art='$id_tipo_art' , cantidad='$cantidad_total', valor='$valor' WHERE id_articulo = '".$_GET['id']."'");
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
<title>Articulos</title>
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

          <h5 class="card-title">Articulos</h5>

          <!-- Multi Columns Form -->

          <form autocomplete="off"class="row g-3" name="form_actualizar" method="POST">

          
            <div class="col-md-6">

              <label for="inputEmail5" class="form-label">Nombre Articulo</label>

              <input  name="nombre_A"  class="form-control" value="<?php echo $fila['nombre_A'] ?>" >    

            </div>

            

            <div class="col-6">

              <label for="inputAddress2" class="form-label">Descripcion</label>
              <input type="varchar" class="form-control"  name="descripcion" value="<?php echo $fila['descripcion']?>" >

            </div>
            
            <div class="col-6">

              <label for="inputAddress2" class="form-label">Cantidad Actual</label>
              <input type="number" class="form-control"  readonly value="<?php echo $fila['cantidad'] ?>" min="1">

            </div>
            <div class="col-6">

              <label for="inputAddress2" class="form-label">Añadir Compra</label>
              <input type="number" class="form-control"  name="suma" placeholder="Cantidad añadida" min="1">

            </div>
            <div class="col-6">

              <label for="inputAddress2" class="form-label">Valor</label>
              <input type="number"  class="form-control" name="valor" value="<?php echo $fila['valor'] ?>" min="1"></td>      
            </div>

            <div class="col-md-6">
                                <label for="inputTipoArticulo" class="form-label">Estado</label>
                                <select class="form-control" name="id_estado">
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

            <div class="col-md-6">
                                <label for="inputTipoArticulo" class="form-label">Tipo Articulos</label>
                                <select class="form-control" name="id_tipo_art">
                                <option value="<?php echo $id_tipo_art ?>"><?php echo $tipo_art ?></option>
                                    <?php
                                    $control = $con-> prepare ("SELECT * FROM tipo_articulo WHERE id_tipo_art != $id_tipo_art ");
                                    $control -> execute();
                                    while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                                    {
                                        echo "<option value='" . $fila['id_tipo_art'] . "'>" . $fila['tipo_articulo'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

            <div class="text-center">

            <tr>

            <td><input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar"></td>

            </tr>

            </div>


            <?php
                                  }

        ?>
          </form><!-- End Multi Columns Form -->



        </div>

      </div>



    </div>
    
</body>
</html>