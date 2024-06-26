<?php
  include "plantilla.php";

  if (isset($_POST['registrar'])){
            
    $terminos = $_POST['terminos'];
    
    $fecha_actual=date('Y-m-d');
    $tipo_e = $_POST['tipo_evento'];
    $paquete = $_POST['paquete'];
    $cliente = $_POST['cliente'];
    $lugar = $_POST['lugar'];
    $cant_ninos = $_POST['cantidad'];
    $f_inicio = $_POST['f_inicio'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $edad = $_POST['edad'];
    $descripcion = $_POST['descripcion'];
    $estado = 6;
    $f_fin=$f_inicio;

     if ($paquete=="" || $tipo_e=="" || $lugar=="" || $cant_ninos==""|| $f_inicio=="" || $hora_inicio=="" || $hora_fin==""|| $descripcion=="")
     {
        echo '<script>alert ("Por favor llene todos los campos");</script>';
        echo '<script>window.location="registro_venta.php"</script>';
     }   
     else{
        
        $insertSQL = $con->prepare("INSERT INTO `eventos`(`fecha_evento`, `id_paquetes`, `id_tipo_e`, `lugar`, `cant_ninos`, `f_inicio`, `f_fin`, `hora_inicio`, `hora_fin`, edad_home, `descripcion`, `cedula`, `id_estado`) VALUES ('$fecha_actual', $paquete, $tipo_e, '$lugar', $cant_ninos, '$f_inicio', '$f_fin', '$hora_inicio', '$hora_fin', '$edad', '$descripcion', $cedula, $estado)");
          $insertSQL -> execute();
          echo '<script>alert ("Reserva Registrada Exitosamente");</script>';
          echo '<script>window.location="index.php"</script>';
         }  
}
    ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invalid-feedback {
            display: none; /* Ocultar inicialmente los mensajes de error */
        }
    </style>
</head>

<body>

    <main id="main" class="main">
        <div class="container">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Registrar reserva</h5>
                        <p class="text-center small">Ingresa los datos</p>
                    </div>

                    <form class="row g-3 needs-validation" name="formreg" id="formreg" method="POST" onsubmit="return validarFormulario()">
                        <div class="col-md-4">
                            <label class="form-label">Seleccione el tipo de evento</label>
                            <select class="form-control" name="tipo_evento" required>
                                <option value="">Seleccione</option>
                                <?php
                                $control = $con->prepare("SELECT * from tipo_e");
                                $control->execute();
                                while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=" . $fila['id_tipo_e'] . ">" . $fila['tipo_evento'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Seleccione el paquete (Paquete - Precio)</label>
                            <select class="form-control" name="paquete" required>
                                <option value="">Seleccione el Paquete</option>
                                <?php
                                $control = $con->prepare("SELECT * FROM paquetes");
                                $control->execute();
                                while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $fila['id_paquetes'] . "'>" . $fila['nombre_paquete'] . ". - $" . number_format($fila['valor']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="lugar" class="form-label">Dirección</label>
                            <input type="text" name="lugar" id="lugar" class="form-control" placeholder="Digite la dirección del evento" required>
                            <div id="error_lugar" class="invalid-feedback">
                                La dirección debe tener máximo 30 caracteres.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="cantidad" class="form-label">Cantidad de niños</label>
                            <input type="number" name="cantidad" id="cantidad" min="1" max="1000" class="form-control" placeholder="Ingrese la cantidad de niños (Aproximada)" required>
                            <div id="error_cantidad" class="invalid-feedback">
                                Ingresa una cantidad válida entre 1 y 1000.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="f_inicio" class="form-label">Fecha de inicio del evento</label>
                            <input type="date" name="f_inicio" id="f_inicio" class="form-control" required>
                            <div class="invalid-feedback">Ingresa la fecha de inicio del evento.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="hora_inicio" class="form-label">Hora de inicio del evento</label>
                            <input type="time" id="hora_inicio" name="hora_inicio" class="form-control" required>
                            <div id="error_hora_inicio" class="invalid-feedback">Selecciona una hora entre las 7:00 AM y las 10:00 PM</div>
                        </div>

                        <div class="col-md-6">
                            <label for="hora_fin" class="form-label">Hora de fin del evento</label>
                            <input type="time" id="hora_fin" name="hora_fin" class="form-control">
                            <div class="invalid-feedback">Ingresa la hora de fin del evento.</div>
                        </div>

                        <div class="col-md-6">
                            <label for="edad" class="form-label">Edad del Homenajeado</label>
                            <input type="number" name="edad" id="edad" min="1" max="130" class="form-control" placeholder="Edad del homenajeado" required>
                            <div id="error_edad" class="invalid-feedback">
                                Ingresa una edad válida entre 1 y 130.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" maxlength="80" required>
                            <div id="error_descripcion" class="invalid-feedback">
                                Ingresa una descripción válida (máximo 80 caracteres).
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terminos" id="acceptTerms" required>
                                <label class="form-check-label" for="acceptTerms">Estoy de acuerdo con los <a href="contrato.html" target="_blank">Términos y condiciones</a></label>
                                <div class="invalid-feedback">Debes estar de acuerdo para continuar</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <input class="btn btn-primary w-100" type="submit" name="registrar" value="Registrar">
                        </div>

                    </form>

                    <dialog class="añadir_cont" id="añadir_cont">
                        <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>
                        <h1>Términos y condiciones</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae unde ut suscipit nisi soluta, obcaecati illo a dolorum laboriosam aut pariatur ad, totam ipsam consequatur officiis dolor minima, fugit sit!</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, dolorum omnis. Rem minus sequi, optio, tempora mollitia in dolorum et aperiam architecto perspiciatis molestiae eius. Exercitationem autem earum consectetur nobis.</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit, cum. Amet odio autem officiis suscipit consectetur? Aut impedit, iste totam voluptatum quisquam aliquam? Debitis tempore ab ipsa pariatur tenetur adipisci.</p>
                    </dialog>
                </div>
            </div>

            <div class="credits">
                Diseñada por <a href="https://bootstrapmade.com/">Elitech JYD</a>
            </div>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Librerías para select que permite escribir -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Scripts propios -->
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });

        // Validación personalizada para la hora de inicio
        function validarHoraInicio() {
            var horaInicio = document.getElementById('hora_inicio').value;
            var horaInicioParts = horaInicio.split(':');
            var horaInicioInt = parseInt(horaInicioParts[0]);

            if (horaInicioInt < 7 || horaInicioInt > 22) {
                document.getElementById('error_hora_inicio').style.display = 'block';
                return false;
            } else {
                document.getElementById('error_hora_inicio').style.display = 'none';
                return true;
            }
        }

        // Validación de todos los campos antes de enviar el formulario
        function validarFormulario() {
            var isValid = true;

            // Validación de hora de inicio
            isValid = validarHoraInicio() && isValid;

            // Validación de la descripción
            var descripcion = document.getElementById('descripcion').value;
            if (descripcion.length > 80) {
                document.getElementById('error_descripcion').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('error_descripcion').style.display = 'none';
            }

            // Validación de la cantidad de niños
            var cantidad = document.getElementById('cantidad').value;
            if (cantidad < 1 || cantidad > 1000) {
                document.getElementById('error_cantidad').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('error_cantidad').style.display = 'none';
            }

            // Validación de la edad
            var edad = document.getElementById('edad').value;
            if (edad < 1 || edad > 130) {
                document.getElementById('error_edad').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('error_edad').style.display = 'none';
            }

            // Validación de la dirección
            var lugar = document.getElementById('lugar').value;
            if (lugar.length > 30) {
                document.getElementById('error_lugar').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('error_lugar').style.display = 'none';
            }

            return isValid;
        }
    </script>
</body>

</html>
