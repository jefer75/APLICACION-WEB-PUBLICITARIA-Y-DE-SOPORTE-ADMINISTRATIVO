<?php

require_once("../../../db/connection.php");
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db -> conectar();

    include 'plantilla.php';

    if (isset($_POST["registrar"])){

    $nombre_paquete = $_POST['nombre_paquete'];
    $edad_min = $_POST['edad_min'];
    $edad_max = $_POST['edad_max'];
    $valor= $_POST['valor'];


     $sql= $con -> prepare ("SELECT * FROM paquetes WHERE nombre_paquete='$nombre_paquete'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("ESTE PAQUETE YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="paquetes.php"</script>';
     }

     else
   
     if ( $nombre_paquete =="" || $edad_min =="" || $edad_max =="" || $valor =="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="paquetes.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO paquetes(nombre_paquete , edad_min , edad_max ,  valor) VALUES('$nombre_paquete', '$edad_min', '$edad_max', '$valor')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="paquetes.php"</script>';
     }  
    }
    ?>

<title>paquetes</title>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Paquetes</h1>

  </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          <div class="card-body">
                        <h5 class="card-title"></h5>
                        <a type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();"> 
                        <i class="bi bi-plus-circle"></i>
                        </a>
                          
                        <form method="post" action="funciones/paque_excel.php">
                            <button type="submit" name="paque_excel" class="btn btn-success">
                                <i class="bi bi-download"></i>
                            </button>
                        </form>
              

              <dialog class="añadir_cont" id="añadir_cont">
                <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

                <h2 class="modal__title">Registrar paquetes</h2> 
          <!-- Multi Columns Form -->

                <form method="post" name="formreg" id="formreg"   class="row g-3"  autocomplete="off"> 

              
               

                <div class="col-md-6">

                  <label for="inputEmail5" class="form-label">Nombre paquete</label>

                  <input  class="form-control" type="text" name="nombre_paquete" pattern="[A-Za-z ]{4,15}" placeholder="Nombre de paquete">
                </div>

               

                <div class="co-md-6">
                  <label for="inputEmail5" class="form-label">edad minima</label>
                  <input  class="form-control" type="text" name="edad_min" placeholder="edad minima">
                </div>

                <div class="col-12">
                  <label for="inputAddress5" class="form-label">edad maxima</label>
                  <input  class="form-control" type="varchar" name="edad_max" placeholder="edad maxima">
                </div>

                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Valor</label>
                  <input class="form-control" type="int" name="valor" pattern="[0-9]{1,15}" title="Solo se permiten numeros" placeholder="valor">
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
                  
                  
                    <th>Nombre del paquete</th>
                    <th>edad minima</th>
                    <th>edad maxima</th>
                    <th>valor</th>
                    <th>Actualizar</th>
                    <th>detalles</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $con_paquetes = $con->prepare("SELECT * FROM paquetes");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {
                       
                        $nombre_paquete = $fila['nombre_paquete'];
                        $edad_min = $fila['edad_min'];
                        $edad_max = $fila['edad_max'];
                        $valor= $fila['valor'];
                        
                    ?>
                  <tr>
                    
                  <td><?php echo $nombre_paquete?></td>
                    <td><?php echo $edad_min?></td>
                    <td><?php echo $edad_max?></td>
                    <td><?php echo $valor?></td>
                    <td><a href="" class="boton" onclick="window.open
                    ('../actualizar/act_paquetes.php?id=<?php echo $fila['id_paquetes'] ?>','','width= 600,height=500, toolbar=NO');void(null);">
                     <i class="bi bi-pencil-square"></i>
                    </a>
                    <td>
                      <a href="" class="boton" onclick="window.open
                    ('../detalles/detalle_paquetes.php?id=<?php echo $fila['id_paquetes'] ?>','','width= 600,height=500, toolbar=NO');void(null);">detalles</a>

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