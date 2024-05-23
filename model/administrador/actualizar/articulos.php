<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $nombre_A = $_POST['nombre_A'];
        $id_tipo_art= $_POST['id_tipo_art'];
        $id_estado = $_POST['id_estado'];
        $descripcion= $_POST['descripcion'];
        $cantidad= $_POST['cantidad'];
        $valor = $_POST['valor'];
        
            $insert= $con -> prepare ("UPDATE articulos SET nombre_A='$nombre_A', id_tipo_art=$id_tipo_art, id_estado=$id_estado, descripcion='$descripcion', cantidad=$cantidad, valor=$valor WHERE id_articulo = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
                
        }

        else if (isset($_POST['eliminar'])){
            
                $insert= $con -> prepare ("DELETE FROM articulos WHERE id_articulo = '".$_GET['id']."'");
                $insert -> execute();
                echo '<script> alert ("Registro actualizado exitosamente");</script>';
                echo '<script> window.close(); </script>';
                    
            }

            //empieza la consulta
    $sql = $con -> prepare("SELECT 
    articulos.id_articulo, articulos.nombre_A,
    articulos.descripcion, articulos.cantidad,
    articulos.valor,  articulos.id_tipo_art,
    tipo_articulo.tipo_articulo,
    articulos.id_estado, estados.estado
    FROM articulos
    INNER JOIN tipo_articulo ON tipo_articulo.id_tipo_art = articulos.id_tipo_art
    INNER JOIN estados ON estados.id_estado = articulos.id_estado WHERE id_articulo='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql->fetchAll(PDO::FETCH_ASSOC);

    foreach ($fila as $fila){
        $nombre_A = $fila['nombre_A'];
        $id_tipo_art= $fila['id_tipo_art'];
        $tipo_articulo= $fila['tipo_articulo'];
        $id_estado = $fila['id_estado'];
        $estado = $fila['estado'];
        $descripcion= $fila['descripcion'];
        $cantidad= $fila['cantidad'];
        $valor = $fila['valor'];
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paquetes</title>
    
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">

<!-- Google Web Fonts -->

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
<!-- Icon Font Stylesheet -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<!-- Libraries Stylesheet -->

<link href="lib/animate/animate.min.css" rel="stylesheet">

<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<!-- Customized Bootstrap Stylesheet -->

<link href="../../../css/bootstrap.min.css" rel="stylesheet">
<!-- Template Stylesheet -->

<link href="../../../css/tablaedi.css" rel="stylesheet">
</head>
<body onload="centrar();">
<div class="card">
<div class="card-body">
          <h5 class="card-title">Articulos</h5>
          <form  class="row g-3"autocomplete="off" name="form_actualizar" method="POST">

            <div class="col-md-12">
              <label for="inputName5" class="form-label">identificador</label>
              <input class="form-control"  name="id_articulo" value="<?php echo $fila['id_articulo']?>" readonly>
             
            </div>

            <div class="col-md-6">
              <label for="inputEmail5" class="form-label">Nombre de articulo</label>
              <input class="form-control" pattern="[A-Za-z/s ]{4,15}" type="text" name="nombre_A" value="<?php echo $nombre_A?>" required>
            </div>

            <div class="col-md-6">
              <label for="inputPassword5" class="form-label">Tipo de articulo</label>
              <select name="id_tipo_art" class="form-control">
                    <option value="<?php echo $id_tipo_art?>"><?php echo $tipo_articulo?></option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from tipo_articulo where id_tipo_art != $id_tipo_art");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_tipo_art'] . ">"
                        . $fila['tipo_articulo'] . "</option>";
                    } 
                    ?>
                </select>
            </div>

            <div class="col-12">
              <label for="inputAddress5" class="form-label">Estado</label>
              <select name="id_estado" class="form-control" >
                    <option value="<?php echo $id_estado?>"><?php echo $estado?></option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from estados Where id_estado > 2");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_estado'] . ">"
                        . $fila['estado'] . "</option>";
                    } 
                    ?>
                </select>
              
            </div>

            <div class="col-12">
              <label for="inputAddress2" class="form-label">descripcion</label>
              <input class="form-control" type="text" name="descripcion" value="<?php echo $descripcion ?>" >
            </div>

            <div class="col-12">
              <label for="inputAddress2" class="form-label">Cantidad</label>
              <input class="form-control" type="number" name="cantidad" value="<?php echo $cantidad ?>" >
            </div>

            <div class="col-12">
              <label for="inputAddress2" class="form-label">Alquiler</label>
              <input class="form-control" type="number" name="valor" value="<?php echo $valor ?>" >
            </div>

            <div class="text-center">
            <tr>
            <td><input class="btn" style="background-color: #2c8ac9; color: white;" type="submit" name="actualizar" value="Actualizar"></td>
            <td><input class="btn" style="background-color: gray; color: white;" type="submit" name="eliminar" value="Eliminar"></td>
            </tr>
            </div>

          </form>
        </div>
      </div>
    </div>
    
</body>
</html>