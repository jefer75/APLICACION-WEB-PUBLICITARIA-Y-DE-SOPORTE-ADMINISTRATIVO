<?php
   
   include 'plantilla.php';
       
   ?>
    
    <title>Paquetes</title>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Primera Comunión</h1>

  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"></h5>

            <a href="" class="añadir">Añadir</a>
            <head>
    <style>
        .modal__container {
            margin: auto;
            width: 90%;
            max-width: 600px;
            max-height: 130%; /* Ajusta este valor según sea necesario */
            background-color: #fff;
            border-radius: 6px;
            padding: 2em 2em;
            display: grid;
            gap: 1em;
            place-items: center;
            grid-auto-columns: 100%;
            transform: var(--transform);
            transition: var(--transition);
        }
    </style>
</head>
   
<section class="modal ">
                   <div class="modal__container">
                    
                   <a href="paquetes.php" class="btn" style="background-color: green; color: white;" id="cerrar">X</a>
                    <h2 class="modal__title">Registrar paquete</h2> 
          <!-- Multi Columns Form -->

          <form method="post" name="formreg" id="formreg"   class="row g-3"  autocomplete="off"> 


            <div class="col-md-6">

              <label for="inputPassword5" class="form-label">Lugar</label>
              <input type="varchar" name="lugar" id="lugar" class="form-control" placeholder="lugar">
            </div>

            <div class="col-12">

              <label for="inputAddress5" class="form-label">Cantidad de Niños</label>
              <input type="number" name="cant_ninos" id="cant_ninos" class="form-control" placeholder="cantidad de niños">
             </div>
             
             <div class="col-12">
             <label for="inputAddress5" class="form-label">Hora de Inicio</label>
              <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" placeholder="hora inicio"> 
             </div>
             


            <div class="col-12">

              <label for="inputAddress2" class="form-label">Contacto</label>
              <input type="varchar" name="contacto" class="form-control" id="contacto" placeholder="contacto">
            <div class="text-center">
            <div class="col-12">
            <label for="inputAddress5" class="form-label">Fecha de Inicio</label>
            <input type="date" name="f_inicio" class="form-control" id="f_inicio" placeholder="fecha del evento">
            </div>

            <div class="col-12">

<label for="inputAddress5" class="form-label">Descripcion</label>
<input type="varchar" name="descripcion" class="form-control" id="descripcion" placeholder="descripcion">
</div>

            
            

            <tr>
            <input type="submit" name="validar" value="Registro" class="btn btn-primary">
            <input type="hidden" name="MM_insert" value="formreg">




            </tr>

              <!-- <button type="submit" class="btn btn-primary">Submit</button>

 

              <button type="reset" class="btn btn-secondary">Reset</button> -->

            </div>

           </section>

<!-- Table with stripped rows -->
<table class="table datatable">
  <thead>
    <tr>
    <th><b>paquetes</b></th>
      <th>lugar</th>
      <th>cantidad de niños</th>
      <th>hora inicio</th>
      <th>contacto</th>
      <th>fecha de evento</th>
      <th>descripcion</th>
      <th>valor</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
        $con_paquetes = $con->prepare("SELECT eventos.id_eventos, paquetes.nombre_paquete, tipo_e.tipo_evento , eventos.lugar, eventos.cant_ninos,  eventos.f_inicio,  eventos.f_fin,  eventos.hora_inicio,  eventos.hora_fin,  eventos.descripcion,  eventos.contacto
        ,factura.valor_total FROM eventos INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes INNER JOIN tipo_e ON tipo_e.id_tipo_e = eventos.id_tipo_e INNER JOIN factura ON factura.valor_total  WHERE eventos.id_tipo_e = 5");
        $con_paquetes->execute();
        $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($paquetes as $fila) {

          $nombre_paquete = $fila['nombre_paquete'];
          $lugar = $fila['lugar'];
          $cant_ninos = $fila['cant_ninos'];
          $hora_inicio = $fila['hora_inicio'];
          $contacto = $fila['contacto'];
          $f_inicio = $fila['f_inicio'];
          $descripcion = $fila['descripcion'];
          $valor_total = $fila['valor_total'];
          
      ?>
      
    <tr>
    <td><?php echo $nombre_paquete?></td>
      <td><?php echo $lugar?></td>
      <td><?php echo $cant_ninos?></td>
      <td><?php echo $hora_inicio?></td>
      <td><?php echo $contacto?></td>
      <td><?php echo $f_inicio?></td>
      <td><?php echo $descripcion?></td>
      <td><?php echo $valor_total?></td>
      <td><a href="" class="boton" onclick="window.open
         ('../update/eventos.php?id=<?php echo $fila['id_eventos'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Click Aqui</a>

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