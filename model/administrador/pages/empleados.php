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
              <h5 class="card-title">Empleados</h5>

              <a href="registrar.php" class="añadir">Añadir</a>

              <form method="post" action="funciones/empl_excel.php">
                            <button type="submit" name="empl_excel" class="btn btn-success">
                                <i class="bi bi-download"></i>
                            </button>
                        </form>
              <!-- Table with stripped rows -->
              <table class="table datatable">
              <thead>
                  <tr>
                  <th><b>Cedula</b></th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>estado</th>
                    <th>Editar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $con_paquetes = $con->prepare("SELECT 
                      usuarios.cedula, usuarios.nombre, usuarios.celular, usuarios.correo, estados.estado
                      FROM usuarios
                      INNER JOIN estados ON estados.id_estado = usuarios.id_estado WHERE id_tipo_user = 3");
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
                    ('../actualizar/usuarios.php?id=<?php echo $cedula ?>','','width= 600,height=490, toolbar=NO');void(null);"><i class="bi bi-pencil-square"></i></a></td>

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