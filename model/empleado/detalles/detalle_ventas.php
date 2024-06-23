<?php
session_start();
require_once("../../../db/connection.php");
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db -> conectar();
    $id_evento = $_GET['id'];

    $con_evento = $con->prepare("SELECT * FROM eventos WHERE id_eventos= $id_evento");
    $con_evento->execute();
    $fila = $con_evento->fetch();

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
<title>Alquiler de articulos</title>
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

                <h5 class="card-title">Articulos Alquilados</h5>
                <table class="table datatable">
                <thead>
                  <tr>
                    <th>Articulo</th>
                    <th>Cantidad Alquilada</th>
                    <th>Valor Neto</th>
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
                      $id_articulo=$fila['id_articulo'];
                    ?>
                  <tr>
                    
                  <td><?php echo $fila['nombre_A']?></td>
                  <td><?php echo $fila['cantidad']?></td>
                  <td><?php echo $fila['valor_neto']?></td>
                  <td>
                    <form method="POST">
                        <input type="hidden" name="seleccionado" value="<?php echo $id_articulo?>" >                        
                      
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