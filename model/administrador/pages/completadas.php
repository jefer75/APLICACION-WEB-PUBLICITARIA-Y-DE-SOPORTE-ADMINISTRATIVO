<?php

    include 'plantilla.php';

    ?>

<title>Reservas</title>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Reservas</h1>

  </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Completadas</h5>

              <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">

              <form method="post" action="funciones/com_excel.php">
                            <button type="submit" name="com_excel" class="btn btn-success">
                                <i class="bi bi-download"></i>
                            </button>
                        </form>
              <!-- Table with stripped rows -->
              <table class="table datatable">
  <thead>
    <tr>
        <th>Fecha de Reserva</th>
        <th>Paquete</th>
        <th>Tipo de Evento</th>
        <th>Lugar</th>
        <th>Fecha de Evento</th>
        <th>Hora de Evento</th>
        <th>Cliente</th>
        <th>Detalles</th>
        <th>Animador</th>
        <th>Alquiler</th>
        <th>Factura</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $con_paquetes = $con->prepare("SELECT eventos.id_eventos, eventos.fecha_evento, paquetes.nombre_paquete, tipo_e.tipo_evento, eventos.lugar, eventos.cant_ninos, eventos.f_inicio, eventos.f_fin, eventos.hora_inicio, eventos.hora_fin, eventos.edad_home, eventos.descripcion, usuarios.nombre, estados.estado
        FROM eventos
        INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes
        INNER JOIN tipo_e ON tipo_e.id_tipo_e = eventos.id_tipo_e
        INNER JOIN usuarios ON usuarios.cedula = eventos.cedula
        INNER JOIN estados ON eventos.id_estado = estados.id_estado
        WHERE eventos.id_estado = 8");
        $con_paquetes->execute();
        $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($paquetes as $fila) {

          $id_eventos= $fila['id_eventos'];
          $f_evento = $fila['fecha_evento'];
          $nombre_paquete = $fila['nombre_paquete'];
          $tipo_e = $fila['tipo_evento'];
          $lugar = $fila['lugar'];
          $cant_ninos = $fila['cant_ninos'];
          $f_inicio = $fila['f_inicio'];
          $f_fin = $fila['f_fin'];
          $hora_inicio = $fila['hora_inicio'];
          $hora_fin = $fila['hora_fin'];
          $descripcion = $fila['descripcion'];
          $nombre = $fila['nombre'];
          $estado = $fila['estado'];
          
      ?>
      
      <tr>
        <td><?php echo $fila['fecha_evento'];?></td>
        <td><?php echo $fila['nombre_paquete'];?></td>
        <td><?php echo $fila['tipo_evento'];?></td>
        <td><?php echo $fila['lugar'];?></td>
        <td><?php echo $fila['f_inicio'];?></td>
        <td><?php echo $fila['hora_inicio'];?></td>
        <td><?php echo $fila['nombre'];?></td>

        <td><a href="#" class="boton" onclick="window.open
       ('../actualizar/eventos.php?id=<?php echo $id_eventos ?>','','width= 900,height=655, toolbar=NO');void(null);"><i class="bi bi-info-circle"></i></a></td>
        <td><a href="#" class="boton" onclick="window.open
       ('../detalles/detalle_animador.php?id=<?php echo $id_eventos ?>','','width= 600,height=500, toolbar=NO');void(null);"><i class="bi bi-person"></i></a></td>
        <td><a href="#" class="boton" onclick="window.open
       ('../detalles/detalle_ventas.php?id=<?php echo $id_eventos ?>','','width= 800,height=850, toolbar=NO');void(null);"><i class="bi bi-cash-coin"></i></a></td>
       <td><a href="funciones/factura.php?id=<?php echo $id_eventos; ?>" class="btn btn-success"><i class="bi bi-file-earmark-pdf"></i></a></td>
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