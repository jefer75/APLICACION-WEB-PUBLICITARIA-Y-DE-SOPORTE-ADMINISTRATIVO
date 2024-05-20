<?php
   
   include 'plantilla.php';
       
    
  
    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
          
          $lugar = $_POST['lugar'];
          $id_paquetes = $_POST['id_paquetes'];
          $cant_ninos = $_POST['cant_ninos'];
          $hora_inicio = $_POST['hora_inicio'];
          $hora_fin = $_POST['hora_fin'];
          $contacto = $_POST['contacto'];
          $fecha_evento = $_POST['fecha_evento'];
          $f_inicio = $_POST['f_inicio'];
          $f_fin = $_POST['f_fin'];
          $descripcion = $_POST['descripcion'];
          

   
     if (  $lugar=="" || $cant_ninos==""  || $contacto=="" || $fecha_evento=="" || $descripcion=="" || $id_paquetes==""|| $hora_inicio==""|| $hora_fin==""|| $f_inicio==""|| $f_fin=="" )
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="cumple.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO `eventos`( `lugar`, `cant_ninos`, `hora_inicio`, `contacto`, `fecha_evento`, `descripcion`, `id_paquetes`,  `hora_fin`, `f_inicio`, `f_fin`) VALUES( '$lugar', '$cant_ninos', '$hora_inicio', '$contacto', '$fecha_evento', '$descripcion', '$id_paquetes',  '$hora_fin', '$f_inicio', '$f_fin')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="luces.php"</script>';
     }  
    }
    ?>



  <title>Articulos</title>
  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>ventas</h1>
      
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">matrimonio</h5>

              <a href="" class="añadir">Añadir</a>

<section class="modal ">
  <div class="modal__container">
      
      <a href="#" class="modal__close" id="cerrar">X</a>
      <h2 class="modal__title">Registrar paquete</h2>
      <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
        <!--Username -->
        <br>
        <br>
        <select class="cont" name="id_tipo_art">
            <option value ="">Seleccione Tipo de paquete</option>
            
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
     <br>        
     <label for="id_paquetes">paquete</label>
        <br>
        <input type="number" name="id_paquetes" id="id_paquetes" class="form_inputs" placeholder="paquete">
        <br>   
        <br>
        <label for="lugar">lugar</label>
        <br>
        <input type="varchar" name="lugar" id="lugar" class="form_inputs" placeholder="lugar">
        <br>
        <label for="cant_ninos">cantidad niños</label>
        <br>
        <input type="number" name="cant_ninos" id="cant_ninos" class="form_inputs" placeholder="cantidad de niños">
        <br>
        <label for="contacto">contacto</label>
        <br>
        <input type="varchar" name="contacto" class="form_inputs" id="contacto" placeholder="contacto">
        <br>
        <label for="fecha_evento">fecha de evento</label>
        <br>
        <input type="date" name="fecha_evento" class="form_inputs" id="fecha_evento" placeholder="fecha del evento">
        <br>
        <label for="f_inicio">fecha de inicio</label>
        <br>
        <input type="date" name="f_inicio" class="form_inputs" id="f_inicio" placeholder="fecha del evento">
        <br>
        <label for="f_fin">fecha de fin</label>
        <br>
        <input type="date" name="f_fin" class="form_inputs" id="f_fin" placeholder="fecha del evento">
        <br>
        <label for="hora_inicio">hora inicio</label>
        <br>
        <input type="time" name="hora_inicio" id="hora_inicio" class="form_inputs" placeholder="hora inicio">               
        <br>
        <label for="hora_fin">hora fin</label>
        <br>
        <input type="time" name="hora_fin" class="form_inputs" id="hora_fin" placeholder="fecha del evento">
        <br>
        <label for="descripcion">descripcion</label>
        <br>
        <input type="varchar" name="descripcion" class="form_inputs" id="descripcion" placeholder="descripcion">
        <br>


        <input type="submit" name="validar" value="Registro">
        <input type="hidden" name="MM_insert" value="formreg">
      </form>
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
        ,factura.valor_total FROM eventos INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes INNER JOIN tipo_e ON tipo_e.id_tipo_e = eventos.id_tipo_e INNER JOIN factura ON factura.valor_total  WHERE eventos.id_tipo_e = 4");
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
       ('../actualizar y eliminar/articulos.php?id=<?php echo $id_articulo ?>','','width= 600,height=500, toolbar=NO');void(null);"><i class="bi bi-arrow-counterclockwise"></i></a></td>

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