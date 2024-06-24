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

    $fecha_inicio=$fila['f_inicio'];
    $estado=$fila['id_estado'];

    include '../funciones/reg_animador.php';
   //empieza la consulta


    if (isset($_POST['eliminar'])){
           
      $animador = $_POST['animador_eli'];
     
          $insert= $con -> prepare ("DELETE FROM detalle_animador WHERE id_eventos = $id_evento AND cedula = $animador");
          $insert -> execute();
          echo '<script> alert ("Se elimino el animador de este evento");</script>';
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

            <h5 class="card-title">Animadores disponibles</h5>

            <form method="POST">

                <div class="col-12">
                <label for="animdaor" class="form-label">Seleccione el Animador</label>
                    <select class="form-control" name="animador">
                        <option value="">Seleccione</option>
                        <?php
                            $control = $con-> prepare ("SELECT * FROM usuarios WHERE id_tipo_user = 3 AND id_estado = 1");
                            $control -> execute();
                            while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                            {
                                echo "<option value='" . $fila['cedula'] . "'>" . $fila['nombre'] . "</option>";
                            }
                        ?>    
                    </select>
                </div>
                <br>
                <div class="text-center">
                  <?php
                  if ($estado==6) {
                    echo'<input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="registro" value="Asignar">';
                  }
                  ?>
                </div>
            </form>
            <!-- segunda tabla donde muestra el paquete y las actividades perrtenecientes a ese paquete -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Actividades</th>
                    <th>Eliminar</th>
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
                  <td>
                    <form method="POST">
                      <input type="hidden" name="animador_eli" value="<?php echo $id_animador ?>" >
                      <?php
                       if ($estado==6) {
                        echo '<button type="submit" class="btn" name="eliminar" style="background-color: #2c8ac9; color: white;">
                        <i class="bi bi-trash"></i>
                        </button>';
                       }
                        ?>
                      </form>
                    </td>
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