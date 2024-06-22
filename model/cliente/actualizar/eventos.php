<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

        $id_eventos= $_GET['id'];

    //empieza la consulta
        $con_paquetes = $con->prepare("SELECT eventos.id_eventos, eventos.fecha_evento, paquetes.id_paquetes, paquetes.nombre_paquete, eventos.id_tipo_e, tipo_e.tipo_evento, eventos.lugar, eventos.cant_ninos, eventos.f_inicio, eventos.f_fin, eventos.hora_inicio, eventos.hora_fin, eventos.edad_home, eventos.descripcion, eventos.cedula, usuarios.nombre, eventos.id_estado, estados.estado
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
            <h5 class="card-title">Reserva # <?php echo $id_eventos?></h5>
            <form autocomplete="off" class="row g-3" name="form_actualizar" method="POST" onsubmit="return validarFormulario();">

                <div class="col-4">
                    <label for="inputAddress2" class="form-label">Fecha de Evento</label>
                    <input type="date" class="form-control" readonly value="<?php echo $fila['fecha_evento']?>" >
                </div>

                <div class="col-4">
                    <label for="inputEmail5" class="form-label">Paquete</label>
                    <select class="form-control" name="paquete" required>
                        <option value="<?php echo $id_paquete?>"><?php echo $nombre_paquete?></option>
                        <?php
                        $control = $con->prepare("SELECT * FROM paquetes");
                        $control->execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $fila['id_paquetes'] . "'>" . $fila['nombre_paquete'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-4">
                    <label for="inputEmail5" class="form-label">Tipo de Evento</label>
                    <select class="form-control" name="tipo_evento" required>
                        <option value="<?php echo $id_tipo_e?>"><?php echo $tipo_e?></option>
                        <?php
                        $control = $con->prepare("SELECT * FROM tipo_e");
                        $control->execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $fila['id_tipo_e'] . "'>" . $fila['tipo_evento'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-4">
                    <label for="inputAddress2" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $f_inicio ?>" required>
                </div>

                <div class="col-4">
                    <label for="inputAddress2" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" name="fecha_fin" value="<?php echo $f_fin ?>" required>
                </div>

                <div class="col-4">
                    <label for="inputAddress2" class="form-label">Hora de Inicio</label>
                    <input type="time" class="form-control" name="hora_inicio" value="<?php echo $hora_inicio ?>" required>
                </div>

                <div class="col-8">
                    <label for="inputAddress2" class="form-label">Dirección (Dirección/barrio/ciudad)</label>
                    <input type="text" class="form-control" name="lugar" value="<?php echo $lugar ?>" maxlength="30" required>
                </div>

                <div class="col-4">
                    <label for="inputAddress2" class="form-label">Hora de Fin</label>
                    <input type="time" class="form-control" name="hora_fin" value="<?php echo $hora_fin ?>" required>
                </div>

                <div class="col-4">
                    <label for="inputAddress2" class="form-label">Cliente</label>
                    <select class="form-control" name="cliente" required>
                        <option value="<?php echo $cedula?>"><?php echo $nombre?></option>
                        <?php
                        $control = $con->prepare("SELECT * FROM usuarios WHERE id_tipo_user = 2");
                        $control->execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $fila['cedula'] . "'>" . $fila['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-4">
                    <label for="inputAddress2" class="form-label">Cantidad de niños</label>
                    <input type="number" class="form-control" name="cantidad" value="<?php echo $cant_ninos ?>" min="1" max="1000" required>
                </div>

                <div class="col-4">
                    <label for="inputAddress2" class="form-label">Estado</label>
                    <select class="form-control" name="estado" required>
                        <option value="<?php echo $id_estado ?>"><?php echo $estado ?></option>
                        <?php
                        $control = $con->prepare("SELECT * FROM estados WHERE id_estado != $id_estado AND (id_estado = 6 OR id_estado = 9)");
                        $control->execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $fila['id_estado'] . "'>" . $fila['estado'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-4">
                    <label for="inputAddress2" class="form-label">Edad del Homenajeado</label>
                    <input type="number" class="form-control" name="edad_home" value="<?php echo $edad_home ?>" min="1" max="130" required>
                </div>

                <div class="col-8">
                    <label for="inputAddress2" class="form-label">Descripción</label>
                    <input type="text" class="form-control" name="descripcion" value="<?php echo $descripcion ?>" maxlength="80" required>
                </div>

                <?php if ($id_estado == 6) { ?>
                    <div class="text-center">
                        <input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar">
                    </div>
                <?php } ?>

            </form><!-- End Multi Columns Form -->
        </div>
    </div>

    <script>
        function centrar() {
            iz = (screen.width - document.body.clientWidth) / 2;
            de = (screen.height - document.body.clientHeight) / 3;
            moveTo(iz, de);
        }

        function validarFormulario() {
            var fechaInicio = document.forms["form_actualizar"]["fecha_inicio"].value;
            var fechaFin = document.forms["form_actualizar"]["fecha_fin"].value;
            var horaInicio = document.forms["form_actualizar"]["hora_inicio"].value;
            var horaFin = document.forms["form_actualizar"]["hora_fin"].value;

            // Validación de fechas y horas
            if (fechaInicio > fechaFin) {
                alert("La fecha de inicio no puede ser posterior a la fecha de fin.");
                return false;
            }
            if (fechaInicio == fechaFin && horaInicio >= horaFin) {
                alert("La hora de inicio no puede ser posterior o igual a la hora de fin en el mismo día.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
