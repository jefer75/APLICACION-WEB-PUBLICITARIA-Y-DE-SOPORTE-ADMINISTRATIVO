<?php
       session_start();
       require_once("../../../db/connection.php");
       // include("../../../controller/validarSesion.php");
       $db = new Database();
       $con = $db -> conectar();

   //empieza la consulta
   $sql = $con -> prepare("SELECT eventos.id_eventos, eventos.fecha_evento, eventos.fecha_evento, eventos.id_paquetes, paquetes.nombre_paquete, eventos.id_tipo_e, tipo_e.tipo_evento, eventos.lugar, eventos.cant_ninos, eventos.f_inicio, eventos.f_fin, eventos.hora_inicio, eventos.hora_fin, eventos.descripcion, eventos.cedula, usuarios.nombre, factura.valor_total, estados.estado 
        FROM eventos 
        INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes 
        INNER JOIN tipo_e ON tipo_e.id_tipo_e = eventos.id_tipo_e 
        INNER JOIN usuarios ON usuarios.cedula = eventos.cedula 
        INNER JOIN factura ON factura.id_eventos = eventos.id_eventos 
        INNER JOIN estados ON estados.id_estado = eventos.id_estado 
        WHERE eventos.id_eventos='".$_GET['id']."'");
   $sql -> execute();
   $eventos = $sql->fetchAll(PDO::FETCH_ASSOC);
   foreach ($eventos as $fila) {

    $id_eventos= $fila['id_eventos'];
    $f_evento = $fila['fecha_evento'];
    $id_paquete = $fila['id_paquetes'];
    $nombre_paquete = $fila['nombre_paquete'];
    $id_tipo_evento = $fila['id_tipo_e'];
    $tipo_evento = $fila['tipo_evento'];
    $lugar = $fila['lugar'];
    $cant_ninos = $fila['cant_ninos'];
    $f_inicio = $fila['f_inicio'];
    $f_fin = $fila['f_fin'];
    $hora_inicio = $fila['hora_inicio'];
    $hora_fin = $fila['hora_fin'];
    $descripcion = $fila['descripcion'];
    $nombre = $fila['nombre'];
    $valor_total = $fila['valor_total'];
    $estado = $fila['estado'];
    
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

          <h5 class="card-title">Actividades disponibles</h5>

          <!-- Multi Columns Form -->

          <form autocomplete="off"class="row g-3" name="form_actualizar" method="POST">

          <select class="form-control" name="cedula">
                    <option value ="<?php echo $cedula ?>"><?php echo $nombre ?></option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from usuarios");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['cedula'] . ">"
                        . $fila['nombre'] . "</option>";
                    } 
                    ?>
            </select>
          
            <select class="form-control" name="cedula">
                    <option value ="<?php echo $id_paquetes ?>"><?php echo $nombre_paquete ?></option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from paquetes");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_paquetes'] . ">"
                        . $fila['nombre_paquete'] . "</option>";
                    } 
                    ?>
                </select>
            
            <select class="form-control" name="cedula">
                    <option value ="<?php echo $id_tipo_evento ?>"><?php echo $tipo_evento ?></option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from tipo_e WHERE id_tipo_e != $id_tipo_evento");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_tipo_e'] . ">"
                        . $fila['tipo_evento'] . "</option>";
                    } 
                    ?>
                </select>

            <div class="col-md-6">

            <label for="inputEmail5" class="form-label">Fecha de reserva</label>

            <input class="form-control" value="<?php echo $f_evento ?>" >    

            </div>

            <div class="col-md-6">

            <label for="inputEmail5" class="form-label">Lugar</label>

            <input  name="nombre_paquete"  class="form-control" value="<?php echo $fila['lugar'] ?>" >    

            </div>

            <div class="col-md-6">

            <label for="inputEmail5" class="form-label">Lugar</label>

            <input  name="nombre_paquete"  class="form-control" value="<?php echo $fila['lugar'] ?>" >    

            </div>

            <div class="col-md-6">

            <label for="inputEmail5" class="form-label">Cantidad de niños</label>

            <input  name="nombre_paquete"  class="form-control" value="<?php echo $fila['cant_ninos'] ?>" >    

            </div>

            <div class="col-md-6">

            <label for="inputEmail5" class="form-label">Fecha de inicio</label>

            <input  name="nombre_paquete"  class="form-control" value="<?php echo $fila['f_inicio'] ?>" >    

            </div>

            <div class="col-md-6">

            <label for="inputEmail5" class="form-label">Fecha de fin</label>

            <input  name="nombre_paquete"  class="form-control" value="<?php echo $fila['f_fin'] ?>" >    

            </div>

            <div class="col-md-6">

            <label for="inputEmail5" class="form-label">Hora de inicio</label>

            <input  name="nombre_paquete"  class="form-control" value="<?php echo $fila['lugar'] ?>" >    

            </div>
        


            <div class="text-center">

            </div>

          </form><!-- End Multi Columns Form -->



        </div>

      </div>
    
</body>
</html>