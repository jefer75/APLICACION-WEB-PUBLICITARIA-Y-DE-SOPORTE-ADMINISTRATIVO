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
        $fecha_actual=date('Y-m-d');
        $id_eventos= $_GET['id'];
        

    //empieza la consulta
        $con_paquetes = $con->prepare("SELECT eventos.id_eventos, eventos.fecha_evento, paquetes.id_paquetes, paquetes.nombre_paquete, paquetes.valor, eventos.id_tipo_e, tipo_e.tipo_evento, eventos.lugar, eventos.cant_ninos, eventos.f_inicio, eventos.f_fin, eventos.hora_inicio, eventos.hora_fin, eventos.edad_home, eventos.descripcion, eventos.cedula, usuarios.nombre, eventos.id_estado, estados.estado
        FROM eventos
        INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes
        INNER JOIN tipo_e ON tipo_e.id_tipo_e = eventos.id_tipo_e
        INNER JOIN usuarios ON usuarios.cedula = eventos.cedula
        INNER JOIN estados ON eventos.id_estado = estados.id_estado
        WHERE id_eventos= $id_eventos");
        $con_paquetes->execute();
        $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($paquetes as $fila) {

          $f_evento = $fila['fecha_evento'];
          $id_paquete = $fila['id_paquetes'];
          $nombre_paquete = $fila['nombre_paquete'];
          $precio = $fila['valor'];
          $id_tipo_e = $fila['id_tipo_e'];
          $tipo_e = $fila['tipo_evento'];
          $lugar = $fila['lugar'];
          $cant_ninos = $fila['cant_ninos'];
          $f_inicio = $fila['f_inicio'];
          $f_fin = $fila['f_fin'];
          $hora_inicio = $fila['hora_inicio'];
          $hora_fin = $fila['hora_fin'];
          $edad_home = $fila['edad_home'];
          $descripcion = $fila['descripcion'];
          $cedula = $fila['cedula'];
          $nombre = $fila['nombre'];
          $id_estado = $fila['id_estado'];
          $estado = $fila['estado'];
        }
    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $id_paquetes= $_POST['paquete'];
        $id_tipo_e= $_POST['tipo_evento'];
        $lugar= $_POST['lugar'];
        $cant_ninos= $_POST['cantidad'];
        $f_inicio= $_POST['fecha_inicio'];
        $f_fin= $_POST['fecha_fin'];
        $hora_inicio= $_POST['hora_inicio']; 
        $hora_fin= $_POST['hora_fin'];
        $edad_home= $_POST['edad_home'];
        $cliente= $_POST['cliente'];
        $descripcion= $_POST['descripcion'];
        $estado= $_POST['estado'];


        
        $insert= $con -> prepare ("UPDATE eventos SET id_paquetes='$id_paquetes', id_tipo_e=$id_tipo_e, lugar='$lugar', cant_ninos='$cant_ninos', f_inicio='$f_inicio', f_fin='$f_fin', hora_inicio='$hora_inicio', hora_fin='$hora_fin', edad_home='$edad_home', cedula='$cliente', descripcion='$descripcion', id_estado='$estado' WHERE id_eventos = $id_eventos");
        $insert -> execute();
        
        $art_alquilados= $con -> prepare("SELECT SUM(detalle_factura.valor_neto) AS valor_articulos
                                    FROM detalle_factura WHERE id_evento = $id_eventos");
        $art_alquilados->execute();
        $fila = $art_alquilados -> fetch();
        

        if ($fila) {
          $valor=$fila['valor_articulos'];
          
          $valor_total=$precio + $valor;

          $insert= $con -> prepare ("INSERT INTO factura (fecha, id_eventos, valor_total) VALUES ('$fecha_actual', $id_eventos, $valor_total)");
          $insert -> execute();
          
          if($estado==8){

            $insert= $con -> prepare ("INSERT INTO factura (fecha, id_eventos, valor_total) VALUES ('$fecha_actual', $id_eventos, $valor_total)");
          $insert -> execute();
          }
        }
        else {
          if($estado==8){
  
            $insert= $con -> prepare ("INSERT INTO factura (fecha, id_eventos, valor_total) VALUES ('$fecha_actual', $id_eventos, $precio)");
          $insert -> execute();
          }
        }
        

            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>'; 
        }

        else if (isset($_POST['eliminar'])){
            
                $insert= $con -> prepare ("DELETE FROM eventos WHERE id_eventos = '".$_GET['id']."'");
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
<title>Actualizar Reserva</title>
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
          <h5 class="card-title">Reserva # <?php echo $id_eventos?></h5>
          <form autocomplete="off"class="row g-3" name="form_actualizar" method="POST">
 
            <div class="col-4">
                <label for="inputAddress2" class="form-label">Fecha de Evento</label>
                <input type="date" class="form-control" readonly value="<?php echo $fila['fecha_evento']?>" >
            </div>

            <div class="col-4">
                <label for="inputEmail5" class="form-label">Paquete (Paquete - Precio)</label>
                <select class="form-control" name="paquete">
                    <option value="<?php echo $id_paquete?>"><?php echo $nombre_paquete?></option>
                    <?php
                        $control = $con-> prepare ("SELECT * FROM paquetes");
                        $control -> execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                        {
                            echo "<option value='" . $fila['id_paquetes'] . "'>" 
                            . $fila['nombre_paquete'] . ". ". "- $" .number_format($fila['valor'])."</option>";
                        }
                    ?>
                </select>   
            </div>

            <div class="col-4">
                <label for="inputEmail5" class="form-label">Tipo de Evento</label>
                <select class="form-control" name="tipo_evento">
                    <option value="<?php echo $id_tipo_e?>"><?php echo $tipo_e?></option>
                    <?php
                        $control = $con-> prepare ("SELECT * FROM tipo_e");
                        $control -> execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                        {
                            echo "<option value='" . $fila['id_tipo_e'] . "'>" 
                            . $fila['tipo_evento'] . "</option>";
                        }
                    ?>
                </select>   
            </div>
            
            <div class="col-4">
              <label for="inputAddress2" class="form-label">Fecha de Inicio</label>
              <input type="date"  class="form-control" name="fecha_inicio" value="<?php echo $f_inicio ?>"></td>      
            </div>
            
            <div class="col-4">
              <label for="inputAddress2" class="form-label">Fecha Fin</label>
              <input type="date"  class="form-control" name="fecha_fin" value="<?php echo $f_fin ?>"></td>      
            </div>

            <div class="col-4">
              <label for="inputAddress2" class="form-label">Hora de Inicio</label>
              <input type="time"  class="form-control" name="hora_inicio" value="<?php echo $hora_inicio ?>"></td>      
            </div>

            <div class="col-8">
              <label for="inputAddress2" class="form-label">Direccion (Direccion/barrio/ciudad)</label>
              <input type="text" class="form-control"  name="lugar" value="<?php echo $lugar?>" >

            </div>

            <div class="col-4">
              <label for="inputAddress2" class="form-label">Hora de Fin</label>
              <input type="time"  class="form-control" name="hora_fin" value="<?php echo $hora_fin ?>"></td>      
            </div>

            <div class="col-4">
              <label for="inputAddress2" class="form-label">Cliente</label>
              <select class="form-control" name="cliente">
                    <option value="<?php echo $cedula?>"><?php echo $nombre?></option>
                    <?php
                        $control = $con-> prepare ("SELECT * FROM usuarios Where id_tipo_user = 2");
                        $control -> execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                        {
                            echo "<option value='" . $fila['cedula'] . "'>" 
                            . $fila['nombre'] . "</option>";
                        }
                    ?>
                </select>    
            </div>

            <div class="col-4">
                <label for="inputAddress2" class="form-label">Cantidad de niños</label>
                <input type="number"class="form-control"  name="cantidad" value="<?php echo $cant_ninos?>">
            </div>

            <div class="col-4">
              <label for="inputAddress2" class="form-label">Estado</label>
              <select class="form-control" name="estado">
                    <option value="<?php echo $id_estado ?>"><?php echo $estado?></option>
                    <?php
                        $control = $con-> prepare ("SELECT * FROM estados Where id_estado != $id_estado AND id_estado = 6 or id_estado = 9 or id_estado=8");
                        $control -> execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                        {
                            echo "<option value='" . $fila['id_estado'] . "'>" 
                            . $fila['estado'] . "</option>";
                        }
                    ?>
                </select>    
            </div>

            <div class="col-4">
              <label for="inputAddress2" class="form-label">Edad del Homenageado</label>
              <input type="number"  class="form-control" name="edad_home" value="<?php echo $edad_home ?>"></td>      
            </div>
            
            <div class="col-8">
              <label for="inputAddress2" class="form-label">Descripcion</label>
              <input type="text"  class="form-control" name="descripcion" value="<?php echo $descripcion ?>"></td>      
            </div>
            
            <?php 
                if ($id_estado==6) {
            
                echo'<div class="text-center">
                        <input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar">
                    </div>';
                }
                
            ?>
          
          </form><!-- End Multi Columns Form -->
        </div>
      </div>
    </div>
</body>
</html>