<?php

include 'plantilla.php';
?>



  <title>Usuarios-Administradores</title>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Usuarios</h1>
      
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Administradores</h5>

              <a href="../registrar/paquetes.php" class="añadir">Añadir</a>

              <section class="modal ">
                <div class="modal__container">
                    
                    <a href="#" class="modal__close" id="cerrar">X</a>
                    <h2 class="modal__title">Registrar paquete</h2>
                    <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                        <br>
                        <label for="nombre_paquete">Nombre Paquete</label>
                        <br>
                        <input type="text" name="nombre_paquete" pattern="[A-Za-z]+" title="(Solo se aceptan letras)" class="form_inputs" placeholder="Nombre paquete">
                        <br>
                        <label for="nombre_artistico">Edad Minima</label>
                        <br>
                        <input type="number" name="edad_min" class="form_inputs" placeholder="Edad minima">
                        <br>
                        <label for="direccion">Edad Maxima</label>
                        <br>
                        <input type="number" name="edad_max" class="form_inputs" placeholder="Edad maxima">
                        <br>
                        <label for="telefono">Valor</label>
                        <br>
                        <input type="number" name="valor" pattern="[0-9]{1,15}" class="form_inputs" title="Solo se permiten numeros" placeholder="Precio">
                        <br>
                        <br>
                        <br>
                        <input type="submit" name="validar" value="Registro" class="modal__close">
                        <input type="hidden" name="MM_insert" value="formreg">
                        </form>
                  </div>
              </section>

              <!-- Table with stripped rows -->
              <table class="table datatable">
              <thead>
                  <tr>
                  <th><b>Cedula</b></th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>estado</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $con_paquetes = $con->prepare("SELECT 
                      usuarios.cedula, usuarios.nombre, usuarios.celular, usuarios.correo, estados.estado
                      FROM usuarios
                      INNER JOIN estados ON estados.id_estado = usuarios.id_estado WHERE id_tipo_user = 1");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {
                        $cedula = $fila['cedula'];
                        $nombre = $fila['nombre'];
                        $celular = $fila['celular'];
                        $correo = $fila['correo'];
                        $estado = $fila['estado'];
                    ?>
                  <tr>
                    <td><?php echo $cedula?></td>
                    <td><?php echo $nombre?></td>
                    <td><?php echo $celular?></td>
                    <td><?php echo $correo?></td>
                    <td><?php echo $estado?></td>
                    <td><a href="" class="boton" onclick="window.open
                    ('../update/articulos.php?id=<?php echo $cedula ?>','','width= 600,height=500, toolbar=NO');void(null);"><i class="bi bi-arrow-counterclockwise"></i>Actualizar</a></td>

                  </tr>
                    <?php
                      }
                    ?>
                  
                 
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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