<?php
  include "plantilla.php";

  
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

                  <form class="row g-3 needs-validation" action="prueba.php" name="formreg" id="formreg" method="POST">
                    
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
                      <label for="yourEmail" class="form-label">Direccion</label>
                      <input type="text" name="lugar" class="form-control" pattern="[A-Za-z/s ]{10,30}" title="Solo se aceptan letras, minimo 10 caracteres" placeholder="Digite la direccion del evento">
                      <div class="invalid-feedback">Lugar</div>
                    </div>

                    <div class="col-md-6">
                      <label for="yourPassword" class="form-label">Cantidad de niños</label>
                      <input type="number" name="cantidad" min="1" max="500"  class="form-control" placeholder="(Aproximada)">
                      <div class="invalid-feedback">Ingresa la cantidad de niños</div>
                    </div>

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
                      <label for="yourPassword" class="form-label">Edad del Homenageado</label>
                      <input type="number" name="cantidad" min="1" max="120"  class="form-control" >
                      <div class="invalid-feedback">Ingresa la cantidad de niños</div>
                    </div>
                    <div class="col-md-6">
                      <label for="yourUsername" class="form-label">Descripcion</label>
                      <div class="input-group has-validation">
                        <input type="text" name="descripcion" class="form-control" placeholder="Fecha de inicio" >
                        <div class="invalid-feedback">Ingresa tu email</div>
                      </div>
                    </div>

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