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
    $f_fin = $_POST['f_fin'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $edad = $_POST['edad'];
    $descripcion = $_POST['descripcion'];
    $estado = 6;
    
     if ($paquete=="" || $tipo_e=="" || $cliente=="" || $lugar=="" || $cant_ninos==""|| $f_inicio=="" || $f_fin==""|| $hora_inicio=="" || $hora_fin==""|| $descripcion=="")
     {
        echo '<script>alert ("Por favor llene todos los campos");</script>';
        echo '<script>window.location="registro_venta.php"</script>';
     }   
     else{
        
        $insertSQL = $con->prepare("INSERT INTO `eventos`(`fecha_evento`, `id_paquetes`, `id_tipo_e`, `lugar`, `cant_ninos`, `f_inicio`, `f_fin`, `hora_inicio`, `hora_fin`, edad_home, `descripcion`, `cedula`, `id_estado`) VALUES ('$fecha_actual', $paquete, $tipo_e, '$lugar', $cant_ninos, '$f_inicio', '$f_fin', '$hora_inicio', '$hora_fin', '$edad', '$descripcion', $cliente, $estado)");
          $insertSQL -> execute();
          echo '<script>alert ("Reserva Registrada Exitosamente");</script>';
          echo '<script>window.location="pendientes.php"</script>';
         }  
}
    ?>

  <title>Registro de reserva</title>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <main id="main" class="main">
    <div class="container">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Registrar reserva</h5>
                    <p class="text-center small">Ingresa los datos</p>
                  </div>

                  <form class="row g-3 needs-validation" name="formreg" id="formreg" method="POST">
                    
                    <div class="col-md-4">
                        <label class="form-label">Seleccione el tipo de evento</label>
                        <select class="form-control" name="tipo_evento">
                          <option value ="">Seleccione</option>
                        
                        <?php
                            $control = $con -> prepare ("SELECT * from tipo_e");
                            $control -> execute();
                            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                            {
                                echo "<option value=" . $fila['id_tipo_e'] . ">"
                                . $fila['tipo_evento'] . "</option>";
                            } 
                        ?>
                        </select>
                    </div>
                    
                      <div class="col-md-4">
                        <label class="form-label">Seleccione el paquete</label>
                        <select class="form-control" name="paquete">
                        <option value="">Seleccione el Paquete</option>
                          <?php
                            $control = $con-> prepare ("SELECT * FROM paquetes");
                            $control -> execute();
                            while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                            {
                              echo "<option value='" . $fila['id_paquetes'] . "'>"
                              . $fila['nombre_paquete'] . "</option>";
                            }
                          ?>
                      </select>
                    </div>

                    <div class="col-md-4">
                        <label for="yourUsername" class="form-label">Seleccione el cliente</label>
                        <select class="form-control" name="cliente" id="clienteSelect">
                            <option value="">Seleccione</option>
                            <?php
                            $control = $con->prepare("SELECT * FROM usuarios");
                            $control->execute();
                            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $fila['cedula'] . "'>" 
                                . $fila['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
    <label for="yourEmail" class="form-label">Dirección</label>
    <input type="text" name="lugar" id="lugar" class="form-control" placeholder="Digite la dirección del evento" required>
    <div id="error_lugar" class="invalid-feedback">
        La dirección debe contener entre 10 y 40 caracteres y solo letras, espacios, '/' y '#'.
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var lugarInput = document.getElementById('lugar');
        var errorLugar = document.getElementById('error_lugar');

        lugarInput.addEventListener('input', function() {
            var lugar = lugarInput.value.trim();

            if (/^[A-Za-z\s/#]{10,40}$/.test(lugar)) {
                lugarInput.classList.remove('is-invalid');
                errorLugar.style.display = 'none';
            } else {
                lugarInput.classList.add('is-invalid');
                errorLugar.style.display = 'block';
            }
        });
    });
</script>


<div class="col-md-6">
    <label for="yourPassword" class="form-label">Cantidad de niños</label>
    <input type="number" name="cantidad" id="cantidad" min="1" max="1000" class="form-control" placeholder="Ingrese la cantidad de niños (Aproximada)" required>
    <div id="error_cantidad" class="invalid-feedback">
        Ingresa una cantidad válida entre 1 y 1000.
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var cantidadInput = document.getElementById('cantidad');
        var errorCantidad = document.getElementById('error_cantidad');

        cantidadInput.addEventListener('input', function() {
            var cantidad = cantidadInput.value.trim();

            if (isValidNumber(cantidad) && cantidad >= 1 && cantidad <= 1000) {
                cantidadInput.classList.remove('is-invalid');
                errorCantidad.style.display = 'none';
            } else {
                cantidadInput.classList.add('is-invalid');
                errorCantidad.style.display = 'block';
            }
        });

        function isValidNumber(value) {
            return /^\d+$/.test(value);
        }
    });
</script>


                    <div class="col-md-6">
                      <label for="yourUsername" class="form-label">Fecha de inicio del evento</label>
                      <div class="input-group has-validation">
                        <input type="date" name="f_inicio" class="form-control" placeholder="Fecha de inicio" >
                        <div class="invalid-feedback">Ingresa la fecha inicio del evento</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="yourUsername" class="form-label">Fecha de fin del evento</label>
                      <div class="input-group has-validation">
                        <input type="date" name="f_fin" class="form-control" placeholder="Fecha de fin" >
                        <div class="invalid-feedback">Ingresa tu email</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="yourUsername" class="form-label">Hora de inicio del evento</label>
                      <div class="input-group has-validation">
                        <input type="time" name="hora_inicio" class="form-control" >
                        <div class="invalid-feedback">Ingresa tu email</div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="yourUsername" class="form-label">Hora de fin del evento</label>
                      <div class="input-group has-validation">
                        <input type="time" name="hora_fin" class="form-control" placeholder="Hora de fin" >
                        <div class="invalid-feedback">Ingresa tu email</div>
                      </div>
                    </div>
                    <div class="col-md-6">
    <label for="edadHomenajeado" class="form-label">Edad del Homenajeado</label>
    <input type="number" name="edad" id="edad" min="1" max="130" class="form-control" placeholder="Edad del homenajeado" required>
    <div id="error_edad" class="invalid-feedback">
        Ingresa una edad válida entre 1 y 130.
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var edadInput = document.getElementById('edad');
        var errorEdad = document.getElementById('error_edad');

        edadInput.addEventListener('input', function() {
            var edad = edadInput.value.trim();

            if (isValidNumber(edad) && edad >= 1 && edad <= 130) {
                edadInput.classList.remove('is-invalid');
                errorEdad.style.display = 'none';
            } else {
                edadInput.classList.add('is-invalid');
                errorEdad.style.display = 'block';
            }
        });

        function isValidNumber(value) {
            return /^\d+$/.test(value);
        }
    });
</script>

<div class="col-md-6">
    <label for="descripcion" class="form-label">Descripción</label>
    <div class="input-group has-validation">
        <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" maxlength="80" required>
        <div id="error_descripcion" class="invalid-feedback">
            Ingresa una descripción válida (máximo 80 caracteres).
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var descripcionInput = document.getElementById('descripcion');
        var errorDescripcion = document.getElementById('error_descripcion');

        descripcionInput.addEventListener('input', function() {
            var descripcion = descripcionInput.value.trim();

            if (/^[A-Za-z0-9.,\s]{0,80}$/.test(descripcion)) {
                descripcionInput.classList.remove('is-invalid');
                errorDescripcion.style.display = 'none';
            } else {
                descripcionInput.classList.add('is-invalid');
                errorDescripcion.style.display = 'block';
            }
        });
    });
</script>


                    <div class="col-12">
                      <div class="form-check">

                        <input class="form-check-input" name="terminos" type="checkbox" id="acceptTerms" required>
                        
                        <label class="form-check-label" for="acceptTerms">Estoy de acuerdo con los <a href="contrato.html" target="_blank">Terminos y condiciones</a></label>

                        <div class="invalid-feedback">Debes estar de acuerdo para continuar</div>
                      </div>
                    </div>
                    
            <div class="col-12">
                <td><input class="btn btn-primary w-100"  type="submit" name="registrar" value="registrar"></td>
            </div>
        
        </form>

        <dialog class="añadir_cont" id="añadir_cont">
            <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

            <h1>Terminos y condiciones</h1>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae unde ut suscipit nisi soluta, obcaecati illo a dolorum laboriosam aut pariatur ad, totam ipsam consequatur officiis dolor minima, fugit sit!</p>
            
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, dolorum omnis. Rem minus sequi, optio, tempora mollitia in dolorum et aperiam architecto perspiciatis molestiae eius. Exercitationem autem earum consectetur nobis.</p>

            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit, cum. Amet odio autem officiis suscipit consectetur? Aut impedit, iste totam voluptatum quisquam aliquam? Debitis tempore ab ipsa pariatur tenetur adipisci.

        </dialog>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Diseñada por<a href="https://bootstrapmade.com/">Elitech JYD</a>
              </div>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- librerias para select que permite escribir -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clienteSelect').select2({
                placeholder: 'Seleccione el cliente',
                allowClear: true
            });
        });
    </script>

  <!-- Vendor JS Files -->
  <script src="../../../js/modal.js"></script>
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>