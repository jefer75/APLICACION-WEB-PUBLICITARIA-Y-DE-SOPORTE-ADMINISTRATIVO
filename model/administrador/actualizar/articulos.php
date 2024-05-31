



<?php
       session_start();
       require_once("../../../db/connection.php");
       // include("../../../controller/validarSesion.php");
       $db = new Database();
       $con = $db -> conectar();

   //empieza la consulta
   $sql = $con -> prepare("SELECT * FROM articulos WHERE id_articulo='".$_GET['id']."'");
   $sql -> execute();
   $fila = $sql -> fetch ();

   //declaracion de variables de campos en la tabla

   if (isset($_POST['actualizar'])){

       $id_tipo_art= $_POST['id_tipo_art'];
       $nombre_A = $_POST['nombre_A'];
       $id_estado= $_POST['id_estado'];
       $descripcion= $_POST['descripcion'];
       $cantidad = $_POST['cantidad'];
       $valor= $_POST['valor'];
       
           $insert= $con -> prepare ("UPDATE articulos SET  nombre_A='$nombre_A', id_estado='$id_estado', descripcion='$descripcion', id_tipo_art='$id_tipo_art' , cantidad='$cantidad', valor='$valor' WHERE id_articulo = '".$_GET['id']."'");
           $insert -> execute();
           echo '<script> alert ("Registro actualizado exitosamente");</script>';
           echo '<script> window.close(); </script>';
               
       }

       else if (isset($_POST['eliminar'])){
          
      
           $id_tipo_art= $_POST['id_tipo_art'];
           $nombre_A = $_POST['nombre_A'];
           $id_estado= $_POST['id_estado'];
           $descripcion= $_POST['descripcion'];
           $cantidad = $_POST['cantidad'];
           $valor= $_POST['valor'];
       
               $insert= $con -> prepare ("DELETE FROM articulos WHERE id_articulo = '".$_GET['id']."'");
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

          <h5 class="card-title">Ventas</h5>



          <!-- Multi Columns Form -->

          <form autocomplete="off"class="row g-3" name="form_actualizar" method="POST">



            

            <div class="col-md-6">

              <label for="inputEmail5" class="form-label">Nombre Articulo</label>

              <input  name="nombre_A"  class="form-control" value="<?php echo $fila['nombre_A'] ?>" >    

            </div>

            <div class="col-md-6">

            <label  class="form-label" for="id_estado">estado</label>
            <br>
            <select class="cont" name="id_estado">
                    <option value ="<?php echo $fila['id_estado'] ?>"><?php echo $fila['estado'] ?></option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from estados");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_estado'] . ">"
                        . $fila['estado'] . "</option>";
                    } 
                    ?>
                </select>

            </div>

             <div class="col-md-6">

             <label  class="form-label" for="id_tipo_art">tipo articulo</label>
            <br>
            <select class="cont" name="id_tipo_art">
                <option value="<?php echo htmlspecialchars($evento['id_tipo_art']); ?>">Seleccione el tipo de articulo</option>
                <?php
                $paquetes = $con->query("SELECT * FROM tipo_articulo")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($paquetes as $paquete) {
                    echo "<option value='" . htmlspecialchars($paquete['id_tipo_art']) . "'>" . htmlspecialchars($paquete['tipo_articulo']) . "</option>";
                }
                ?>
            </select>
            </div>

           

            <div class="col-12">

              <label for="inputAddress2" class="form-label">Descripcion</label>
              <input type="varchar" class="form-control"  name="descripcion" value="<?php echo $fila['descripcion']?>" >

            </div>
            
            <div class="col-12">

              <label for="inputAddress2" class="form-label">Cantidad</label>
              <input type="number" class="form-control"  name="cantidad" value="<?php echo $fila['cantidad'] ?>">

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