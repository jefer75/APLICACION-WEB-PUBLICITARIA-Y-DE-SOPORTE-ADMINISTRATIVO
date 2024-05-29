<?php
include 'plantilla.php';
 
if (isset($_POST['registrar'])){

  $nombre_paquete= $_POST['nombre_paquete'];
  $edad_min = $_POST['minima'];
  $edad_max= $_POST['maxima'];
  $valor= $_POST['alquiler'];  
                  
  $sql= $con -> prepare ("SELECT * FROM paquetes WHERE nombre_paquete='$nombre_paquete'");
  $sql -> execute();
  $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

  if ($fila){
    echo '<script>alert ("ESTE PAQUETE YA EXISTE ");</script>';
  }

  else if ($nombre_paquete=="" || $edad_min=="" || $edad_max=="" || $valor==""){
    echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';  
  }
      
  else{
    $insert= $con -> prepare ("INSERT INTO paquetes(nombre_paquete, edad_min, edad_max, valor) VALUES ('$nombre_paquete', $edad_min, $edad_max, '$valor')");
    $insert -> execute();
    echo '<script> alert ("Registro realizado con exito");</script>';
    echo '<script>window.location="paquetes.php"</script>';
  }
}

?>
<head>
<title>Paquetes</title>

</head>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Paquetes</h1>
  
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Paquetes</h5>

              <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">
              
              <dialog class="añadir_cont" id="añadir_cont">
                <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

                <h2 class="modal__title">Registrar paquete</h2> 
          <!-- Multi Columns Form -->

                <form method="post" name="formreg" id="formreg" class="row g-3"  autocomplete="off"> 

                <div class="col-md-6">

                  <label for="inputEmail5" class="form-label">Nombre Paquete</label>

                  <input  class="form-control" type="text" name="nombre_paquete" pattern="[A-Za-z/s]{4,15}" title="Solo se aceptan letras" placeholder="Nombre de paquete" required>
                </div>

                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Edad Minima</label>
                  <input  class="form-control" type="text" pattern="[0-9]{1,3}" title="Solo se aceptan numeros, minimo 1" name="minima"  placeholder="Edad minima" required>
                </div>

                <div class="col-12">
                  <label for="inputAddress5" class="form-label">Edad Maxima</label>
                  <input  class="form-control" type="text" pattern="[0-9]{1,3}" title="Solo se aceptan numeros, minimo 1" name="maxima" placeholder="Edad maxima" required>
                </div>

                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Valor</label>
                  <input class="form-control" type="text" name="alquiler" pattern="[0-9]{4,10}" title="Solo se permiten numeros, minimo 4 digitos" placeholder="valor" required>
                </div>
                <div class="text-center">
                  <tr>
                  <input type="submit" name="registrar" value="Registro" class="btn btn-primary modal_close">
                  </tr>
                </div>

            </dialog>

              
              <?php include "../consultar/con_paquetes.php"; 
            ?>             
                  <?php
                  
                    if (isset($_POST['actualizar'])){
                      
                    }
                   
                ?>                  
              
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
  <script src="paquetes.js"></script>
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