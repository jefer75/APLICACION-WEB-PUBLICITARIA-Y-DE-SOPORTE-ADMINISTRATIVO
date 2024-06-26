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
         header("Location: ../../administrador/inicio/login.php");
         }

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
<title>Asignar animador</title>
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
            <!-- segunda tabla donde muestra el paquete y las actividades perrtenecientes a ese paquete -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Animadores</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $con_paquetes = $con->prepare("SELECT usuarios.nombre, detalle_animador.cedula 
                       FROM detalle_animador  
                       INNER JOIN usuarios on usuarios.cedula = detalle_animador.cedula  
                       WHERE id_eventos = $id_evento ORDER BY usuarios.nombre");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {
                       
                        $id_animador = $fila['cedula'];
                        $animadores = $fila['nombre'];
                       
                        
                    ?>
                  <tr>
                    
                  <td><?php echo $animadores?></td>
                 
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