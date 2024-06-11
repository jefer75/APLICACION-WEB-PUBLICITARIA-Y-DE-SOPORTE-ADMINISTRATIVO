<?php

require_once("../../../db/connection.php");
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db -> conectar();

    include 'plantilla.php';

    if (isset($_POST['registrar'])){

    $id_actividad= $_POST['id_actividad'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_POST['imagen'];
   


     $sql= $con -> prepare ("SELECT * FROM actividades WHERE id_actividad='$id_actividad'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("ESTE PAQUETE YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="actividades.php"</script>';
     }

     else
   
     if ( $nombre_paquete =="" || $edad_min =="" || $edad_max =="" || $valor =="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="actividades.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO paquetes(nombre_paquete , edad_min , edad_max ,  valor) VALUES('$nombre_paquete', '$edad_min', '$edad_max', '$valor')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="actividades.php"</script>';
     }  
    }
    ?>

<title>actividades</title>

<main id="main" class="main">

<style>
    table img{
        width: 50vh;
    }

</style>

  <div class="pagetitle">
    <h1>actividades</h1>

  </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">
              

              <dialog class="añadir_cont" id="añadir_cont">
                <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

                <h2 class="modal__title">Registrar actividad</h2> 
          <!-- Multi Columns Form -->

                <form method="post" name="formreg" id="formreg"   class="row g-3"  autocomplete="off"> 

              <div class="col-md-6">

                  <label for="inputEmail5" class="form-label">paquete </label>

                  <select class="form-control" name="id_paquetes">
                <option value="<?php echo htmlspecialchars($evento['id_paquetes']); ?>">Seleccione el paquete</option>
                <?php
                $paquetes = $con->query("SELECT * FROM paquetes")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($paquetes as $paquete) {
                    echo "<option value='" . htmlspecialchars($paquete['id_paquetes']) . "'>" . htmlspecialchars($paquete['nombre_paquete']) . "</option>";
                }
                ?>
            </select>
                </div>
               

                <div class="col-md-6">

                  <label for="inputEmail5" class="form-label">nombre </label>

                  <input  class="form-control" type="text" name="Nombre" pattern="[A-Za-z ]{4,15}" placeholder="Nombre actividad ">
                </div>

               

                <div class="co-md-6">
                  <label for="inputEmail5" class="form-label">descripcion</label>
                  <input  class="form-control" type="text" name="descripcion" placeholder=" descripcion del paquete">
                </div>

                <div class="co-md-6">
                  <label for="inputEmail5" class="form-label">imagen</label>
                  <input  class="form-control" type="file" name="imagen" placeholder="subir imagen" required>
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
                  
                  
                    <th>paquete</th>
                    <th>actividades</th>
                    <th>descripcion</th>
                    <th>imagen</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $actividades = $con->prepare("SELECT * FROM actividades");
                       $actividades->execute();
                       $actividades = $actividades->fetchAll(PDO::FETCH_ASSOC);
                       foreach ($actividades as $fila) {
                       
                        $id_actividad = $fila['id_actividad'];
                        $nombre = $fila['nombre'];
                        $descripcion = $fila['descripcion'];
                       
                    ?>
                  <tr>
                    
                  <td><?php echo $id_actividad?></td>
                  <td><?php echo $nombre?></td>
                    <td><?php echo $descripcion?></td>
                    <td> <img src="data:<?php echo $fila['tipos']; ?>;base64,<?php echo base64_encode($fila['datos']); ?>" alt="<?php echo htmlspecialchars($fila['nombre_img']); ?>"></td>
                    

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