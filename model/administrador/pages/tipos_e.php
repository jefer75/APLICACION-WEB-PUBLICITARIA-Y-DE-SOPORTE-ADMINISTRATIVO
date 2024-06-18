<?php

require_once("../../../db/connection.php");
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db -> conectar();

    include 'plantilla.php';

    if (isset($_POST["registrar"])){

    $tipo = $_POST['tipo_e'];


     $sql= $con -> prepare ("SELECT * FROM tipo_e WHERE tipo_evento='$tipo'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("ESTE PAQUETE YA EXISTE //CAMBIELO//");</script>';
     }

     else
   
     if ( $tipo =="")
      {
         echo '<script>alert ("Por favor llene toso los campos");</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO tipo_e(tipo_evento) VALUES('$tipo')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="tipos_e.php"</script>';
     }  
    }
    ?>

<title>Tipos de eventos</title>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Tipos de evento</h1>

  </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Disponibles</h5>

              <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">
              

              <dialog class="añadir_cont" id="añadir_cont">
                <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

                <h2 class="modal__title">Registrar Tipos de Evento</h2> 
          <!-- Multi Columns Form -->

                <form method="post" name="formreg" id="formreg"   class="row g-3"  autocomplete="off"> 

              
               

                <div class="col-md-12">

                  <label for="inputEmail5" class="form-label">Nombre del Tipo</label>

                  <input  class="form-control" type="text" name="tipo_e" pattern="[A-Za-z ]{4,15}" placeholder="Tipo">
                </div>
                
                <div class="text-center">
                  <tr>
                  <input type="submit" name="registrar" value="Registro" class="btn btn-primary modal_close">
                  </tr>
                </div>

            </dialog>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                  
                  
                    <th>Tipo de evento</th>
                    <th>Actualizar</th>
                    <th>Detalles</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $con_paquetes = $con->prepare("SELECT * FROM tipo_e");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {
                       
                        $tipo_evento = $fila['tipo_evento'];
                        
                    ?>
                  <tr>
                    
                  <td><?php echo $tipo_evento?></td>
                    <td><a href="" class="boton" onclick="window.open
                    ('../actualizar/tipo_e.php?id=<?php echo $fila['id_tipo_e'] ?>','',' width= 500,height=300, toolbar=NO');void(null);">Click Aqui</a>
                    <td><a href="" class="boton" onclick="window.open
                    ('../detalles/detalle_tipo_e.php?id=<?php echo $fila['id_tipo_e'] ?>','',' width= 600,height=600,toolbar=NO');void(null);">detalles</a>

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