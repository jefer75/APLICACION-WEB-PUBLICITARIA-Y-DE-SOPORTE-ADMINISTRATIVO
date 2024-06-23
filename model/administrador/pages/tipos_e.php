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

                        <form method="post" action="funciones/tipo_excel.php">
                            <button type="submit" name="tipo_excel" class="btn btn-success">
                                <i class="bi bi-download"></i>Descargar reporte
                            </button>
                        </form>
              

              <dialog class="añadir_cont" id="añadir_cont">
                <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

                <h2 class="modal__title">Registrar Tipos de Evento</h2>

<!-- Multi Columns Form -->
<form method="post" name="formreg" id="formreg" class="row g-3" autocomplete="off">

    <div class="col-md-12">
        <label for="inputEmail5" class="form-label">Nombre del Tipo</label>
        <input class="form-control" type="text" name="tipo_e" id="tipoInput" placeholder="Tipo">
        <div id="error_tipo" class="invalid-feedback">
            El nombre del tipo debe contener solo letras y máximo dos espacios, con un máximo de 20 caracteres.
        </div>
    </div>
    <div class="text-center">
                  <tr>
                  <input type="submit" name="registrar" value="Registro" class="btn btn-primary modal_close">
                  </tr>
                </div>
   
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('formreg');
        var tipoInput = document.getElementById('tipoInput');
        var errorTipo = document.getElementById('error_tipo');

        form.addEventListener('submit', function(event) {
            var tipo = tipoInput.value.trim();

            // Validar que el tipo contenga solo letras y máximo dos espacios, con un máximo de 20 caracteres
            if (!/^[A-Za-z ]{1,20}$/.test(tipo) || /\s{3,}/.test(tipo)) {
                // Si la validación falla, detenemos el envío del formulario
                event.preventDefault();
                tipoInput.classList.add('is-invalid');
                errorTipo.style.display = 'block';
            } else {
                // Si la validación es exitosa, quitamos cualquier indicación de error
                tipoInput.classList.remove('is-invalid');
                errorTipo.style.display = 'none';
            }
        });
    });
</script>

                
                

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
                    <td><a href="#" class="boton" onclick="window.open
                    ('../actualizar/tipo_e.php?id=<?php echo $fila['id_tipo_e'] ?>','',' width= 500,height=300, toolbar=NO');void(null);"><i class="bi bi-pencil-square"></i></a>
                    <td><a href="" class="boton" onclick="window.open
                    ('../detalles/detalle_tipo_e.php?id=<?php echo $fila['id_tipo_e'] ?>','',' width= 600,height=600,toolbar=NO');void(null);"><i class="bi bi-info-circle"></i></a>

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