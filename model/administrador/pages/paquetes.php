<?php
include 'plantilla.php';
?>

<title>Paquetes</title>

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

              <a href="" class="añadir">Añadir</a>

              <section class="modal ">
                   <div class="modal__container">
                    
                   <a href="paquetes.php" class="btn" style="background-color: green; color: white;" id="cerrar">X</a>
                    <h2 class="modal__title">Registrar paquete</h2> 
          <!-- Multi Columns Form -->

          <form method="post" name="formreg" id="formreg"   class="row g-3"  autocomplete="off"> 

            <div class="col-md-6">

              <label for="inputEmail5" class="form-label">Nombre Paquete</label>

              <input  class="form-control" type="varchar" name="nombre_paquete"  placeholder="Nombre paquete">
            </div>

            <div class="col-md-6">

              <label for="inputPassword5" class="form-label">Edad Minima</label>

              <input  class="form-control" type="varchar" name="edad_min"  placeholder="Edad_min">

            </div>

            <div class="col-12">

              <label for="inputAddress5" class="form-label">Edad Maxima</label>

              <input  class="form-control" type="varchar" name="edad_max" placeholder="Edad_max">

            </div>

            <div class="col-12">

              <label for="inputAddress2" class="form-label">Valor</label>

              <input   class="form-control" type="int" name="valor" pattern="[0-9]{1,15}" title="Solo se permiten numeros" placeholder="valor">

            </div>
            <div class="text-center">

            <tr>
            <input type="submit" name="validar" value="Registro" class="btn btn-primary">




            </tr>

              <!-- <button type="submit" class="btn btn-primary">Submit</button>

 

              <button type="reset" class="btn btn-secondary">Reset</button> -->

            </div>

           </section>

              <!-- Table with stripped rows -->
              <form method="POST" action="">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th><b>ID</b></th>
                    <th>Nombre</th>
                    <th>Edad minima</th>
                    <th>Edad maxima</th>
                    <th>Valor</th>
                    <th>Actualizar</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php                   
                    $con_paquetes = $con->prepare("SELECT * FROM paquetes");
                    $con_paquetes->execute();
                    $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($paquetes as $fila) {
                      $id = $fila['id_paquetes'];
                      $nombrep = $fila['nombre_paquete'];
                      $edad_min = $fila['edad_min'];
                      $edad_max = $fila['edad_max'];
                      $valor = $fila['valor'];
                  ?>
                  <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $nombrep ?></td>
                    <td><?php echo $edad_min ?></td>
                    <td><?php echo $edad_max ?></td>
                    <td><?php echo $valor ?></td>
                    <td>
                      <input type="submit" class="abrir_act" id_paquete ="<?php echo $id ?>" value="Actualizar" name="Actualizar">
                    </td>
                  </tr>
                    <?php
                      }
                    ?>
                </tbody>
              </table>
              </form>
              <!-- Ventana modal de actualizar -->
              <dialog class="modal_actualizar" id="modal_actualizar">
              <form autocomplete="off" name="form_actualizar" method="POST">
                <div class="modal_actualizar-body">
                  
                <?php                    
                    $id_paquete = "<p id='output'></p>";
                    echo $id_paquete;
                    $con_paquetes = $con->prepare("SELECT * FROM paquetes where id_paquetes= 2");
                    $con_paquetes->execute();
                    $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($paquetes as $fila) {
                      $id = $fila['id_paquetes'];
                      $nombre_p_select= $fila['nombre_paquete'];
                      $edad_min_select = $fila['edad_min'];
                      $edad_max_select= $fila['edad_max'];
                      $valor_select= $fila['valor'];  
                    }
                ?>

                  <h2 class="modal__title">Actualizar paquete</h2>
                  <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off">
                    <br>
                    <label for="nombre_paquete">Nombre Paquete</label>
                    <br>
                    <input type="text" name="nombre_paquete" pattern="[A-Za-z]+" title="(Solo se aceptan letras)" class="form_inputs" value="<?php echo $nombre_p_select ?>">
                    <br>
                    <label for="nombre_artistico">Edad Minima</label>
                        <br>
                        <input type="number" name="edad_min" class="form_inputs" value="<?php echo $edad_min_select?>">
                        <br>
                        <label for="direccion">Edad Maxima</label>
                        <br>
                        <input type="number" name="edad_max" class="form_inputs" value="<?php echo $edad_max_select?>">
                        <br>
                        <label for="telefono">Valor</label>
                        <br>
                        <td><input class="btn" style="background-color: gray; color: white;"
                        type="number" name="valor" pattern="[0-9]{1,15}" class="btn" title="Solo se permiten numeros" value="<?php echo $valor_select ?>">
                        <br>
                        <br>
                        <br>
                        <input type="submit" name="actualizar" value="Registro" class="modal__close1">
                        <input type="hidden" name="MM_insert" value="formreg">
                        <input type="submit" name="cerrar" value="Cerrar" onclick="cerrarModal();" id="cerrar_act" class="cerrar_act btn btn-secondary">  
                      </div>
                      
                      <?php
                              // if (isset($_POST['actualizar'])){

                              //   $nombre_paquete= $_POST['nombre_paquete'];
                              //   $edad_min = $_POST['edad_min'];
                              //   $edad_max= $_POST['edad_max'];
                              //   $valor= $_POST['valor'];  
                        
                              //       $insert= $con -> prepare ("UPDATE paquetes SET nombre_paquete='$nombre_paquete', edad_min='$edad_min', edad_max='$edad_max', valor='$valor' WHERE id_paquetes = $id_paquete");
                              //       $insert -> execute();
                              //       echo '<script> alert ("Registro actualizado exitosamente");</script>';
                              //       echo '<script> window.close(); </script>';
                                        
                              //   }
                                                        
                              ?>
                    </form>
              </dialog>
              
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

  <script>
    
      
        


  </script>
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