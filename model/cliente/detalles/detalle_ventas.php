<?php
       session_start();
       require_once("../../../db/connection.php");
       // include("../../../controller/validarSesion.php");
       $db = new Database();
       $con = $db -> conectar();
       $id_evento = $_GET['id'];

   if (isset($_POST['registro'])){

    $articulo = $_POST['articulo'];
    $cantidad = $_POST['cantidad'];       
   
     if ( $articulo =="" || $cantidad =="")
      {
         echo '<script>alert ("Por favor llene todos los campos");</script>';
      }
      
      else {
        $sql= $con -> prepare ("SELECT * FROM articulos WHERE id_articulo = $articulo");
        $sql -> execute();
        $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
        foreach ($fila as $fila) {
        $nombre_arti = $fila['nombre_A'];
        $alquiler = $fila['valor'];
        $disponible = $fila['cantidad'];
        }
        $valor_neto = $cantidad * $alquiler;
  
        if ($cantidad <= $disponible){

        $sql= $con -> prepare ("SELECT * FROM detalle_factura 
        WHERE id_articulo = $articulo AND id_evento = $id_evento");
        $sql -> execute();
        $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

        if ($fila){

            $insertSQL = $con->prepare("UPDATE detalle_factura SET cantidad=$cantidad, valor_neto=$valor_neto WHERE id_articulo = $articulo AND id_evento = $id_evento");
            $insertSQL -> execute();
            echo '<script>alert ("El articulo se ha actualizado");</script>';
            
            $cantidad_actual = $disponible - $cantidad;

            $insertSQL = $con->prepare("UPDATE articulos SET cantidad=$cantidad_actual WHERE id_articulo = $articulo");
            $insertSQL -> execute();
        }
        else{
        
        $insertSQL = $con->prepare("INSERT INTO detalle_factura(id_evento, id_articulo, cantidad, valor_neto) VALUES($id_evento, $articulo, $cantidad, $valor_neto)");
        $insertSQL -> execute();
        echo '<script> alert("Articulo reservado con exito");</script>';

        $cantidad_actual = $disponible - $cantidad;

        $insertSQL = $con->prepare("UPDATE articulos SET cantidad = $cantidad_actual WHERE id_articulo = $articulo");
        $insertSQL -> execute();
        }
      }
      else{
        echo '<script> alert("Has intentado reservar demasiados '. $nombre_arti.'");</script>';
      }
     }  
    }
    include 'C:/xampp/htdocs/APLICACION-WEB/model/cliente/eliminar/eli_articulo_venta.php';

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

<main id="main" class="main">

<div class="container">

        <div class="card-body">

          <h5 class="card-title">Articulos disponibles</h5>

          <table class="table datatable">
                <thead>
                  <tr>
                  
                    <th>Articulo</th>
                    <th>Cantidad Disponible</th>
                    <th>Valor Alquiler</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $con_paquetes = $con->prepare("SELECT * FROM articulos Where id_estado=1
                       ORDER BY id_articulo");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {
                       
                        $nombre_arti = $fila['nombre_A'];
                        $cant_inventario = $fila['cantidad'];
                        $alquiler = $fila['valor'];
                        
                    ?>
                  <tr>
                        <td><?php echo $nombre_arti?></td>
                        <td><?php echo $cant_inventario?></td>
                        <td><?php echo $alquiler?></td>
                  </tr>
                  <?php
                      }
                    ?>
                </tbody>
              </table>

              <h5 class="card-title">Alquilar Articulo</h5>
              <form method="POST">
                <div class="container">
                    <div class="card-body">
                        
                <div class="col-md-4">
                    <label class="form-label">Seleccione el Articulo</label>
                    <select class="form-control" name="articulo">
                    <option value="">Seleccione </option>
                    <?php
                        $control = $con-> prepare ("SELECT * FROM articulos Where id_estado=1");
                        $control -> execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                        {
                        echo "<option value='" . $fila['id_articulo'] . "'>"
                        . $fila['nombre_A'] . "</option>";
                        }
                    ?>
                </select>
                </div>

                <div class="col-md-4">
                <label for="yourUsername" class="form-label">Cantidad</label>
                <div class="input-group has-validation">
                    <input type="text" name="cantidad" class="form-control" placeholder="Cantidad para alquilar" >
                    <div class="invalid-feedback">Solo se aceptan numeros</div>
                </div>
                </div>       
                <?php 
                  $con_evento = $con->prepare("SELECT * FROM eventos WHERE id_eventos= '".$_GET['id']."'");
                  $con_evento->execute();
                  $fila = $con_evento->fetch();
                  
                  if ($fila['id_estado']==6) {
                  echo'<div class="text-center">
                            <tr>
                                <td><input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="registro" value="registrar"></td>
                            </tr>';
                  }
                
            ?>
                            
                           
                </div>
                </div> 
                </form>

                <h5 class="card-title">Articulos Alquilados</h5>
                <table class="table datatable">
                <thead>
                  <tr>
                    <th>Articulo</th>
                    <th>Cantidad Alquilada</th>
                    <th>Valor Neto</th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $con_paquetes = $con->prepare("SELECT detalle_factura.id_detalle_eve, detalle_factura.id_articulo, articulos.nombre_A, detalle_factura.cantidad, detalle_factura.valor_neto 
                       FROM detalle_factura 
                       INNER JOIN articulos ON articulos.id_articulo=detalle_factura.id_articulo
                       WHERE detalle_factura.id_evento = '$id_evento' ");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {                       
                        
                    ?>
                  <tr>
                    
                  <td><?php echo $fila['nombre_A']?></td>
                  <td><?php echo $fila['cantidad']?></td>
                  <td><?php echo $fila['valor_neto']?></td>
                  <td>
                    <form method="POST">
                        <input type="hidden" name="cantidad" value="<?php echo $fila['cantidad'] ?>" >
                        <input type="hidden" name="articulo_select" value="<?php echo $fila['id_articulo'] ?>" >

                        <?php 
                  $con_evento = $con->prepare("SELECT * FROM eventos WHERE id_eventos= '".$_GET['id']."'");
                  $con_evento->execute();
                  $fila = $con_evento->fetch();
                  
                  if ($fila['id_estado']==6) {
                  echo'<button type="submit" class="btn" name="eliminar" style="background-color: #2c8ac9; color: white;">
                        <i class="bi bi-trash"></i>
                        </button>';
                  }
                
            ?>

                        
                      
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
    </main>
</body>
</html>