<?php
    include 'plantilla.php';

    
  
    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $nombre_paquete= $_POST['nombre_paquete'];
    $edad_min= $_POST['edad_min'];
    $edad_max= $_POST['edad_max'];
    $valor= $_POST['valor'];

     $sql= $con -> prepare ("SELECT * FROM paquetes WHERE nombre_paquete='$nombre_paquete'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("ESTE PAQUETE YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="paquetes.php"</script>';
     }

     else
   
     if ($nombre_paquete=="" || $edad_min=="" || $edad_max=="" || $valor=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="paquetes.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO paquetes(nombre_paquete, edad_min, edad_max, valor) VALUES('$nombre_paquete', '$edad_min', '$edad_max', '$valor')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="paquetes.php"</script>';
     }  
    }
    ?>

  <title>Articulos-sonido</title>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Articulos</h1>
      
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Sonido</h5>

              <a href="" class="añadir">Añadir</a>

              <section class="modal">
                <div class="modal__container">
                    
                    <a href="#" class="modal__close" id="cerrar">X</a>
                    <h2 class="modal__title">Registrar Articulo</h2>
                    <form method="post" name="formreg" id="formreg" class="signup-form" autocomplete="off"> 
                      <!--Username -->
                      <br>
                      <label for="nombre_a">Nombre de articulo</label>
                      <br>
                      <input type="varchar" name="nombre_a" id="documento" class="form_inputs" placeholder="Nombre de articulo">
                      <br>
                      <label for="cantidad">Cantidad</label>
                      <br>
                      <input type="number" name="cantidad" id="nombres" class="form_inputs" placeholder="Cantidad de articulo">
                      <br>
                      <select class="cont" name="tipo_user">
                          <option value ="">Seleccione Tipo de articulo</option>
                          
                          <?php
                              $control = $con -> prepare ("SELECT * from tipo_articulo");
                              $control -> execute();
                          while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                          {
                              echo "<option value=" . $fila['id_tipo_art'] . ">"
                              . $fila['tipo_articulo'] . "</option>";
                          } 
                          ?>
                      </select>
                                      
                      <br>
                      <label for="cantidad">Descripcion</label>
                      <br>
                      <input type="varchar" name="cantidad" class="form_inputs" id="nombres" placeholder="Cantidad de articulo">
                      <br>
                      <label for="cantidad">Valor</label>
                      <br>
                      <input type="number" name="cantidad" id="nombres" class="form_inputs" placeholder="Cantidad de articulo">

                      <input type="submit" name="validar" value="Registro">
                      <input type="hidden" name="MM_insert" value="formreg">
                    </form>
                  </div>
              </section>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                  <th><b>ID</b></th>
                    <th>Nombre</th>
                    <th>descripcion</th>
                    <th>cantidad</th>
                    <th>valor</th>
                    <th>estado</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $con_paquetes = $con->prepare("SELECT 
                      articulos.id_articulo, articulos.nombre_A,
                      articulos.descripcion, articulos.cantidad,
                      articulos.valor, tipo_articulo.tipo_articulo,
                      estados.estado
                      FROM articulos
                      INNER JOIN tipo_articulo ON tipo_articulo.id_tipo_art = articulos.id_tipo_art
                      INNER JOIN estados ON estados.id_estado = articulos.id_estado WHERE articulos.id_tipo_art = 1");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {
                        $id_articulo = $fila['id_articulo'];
                        $nombre_A = $fila['nombre_A'];
                        $id_tipo_art = $fila['tipo_articulo'];
                        $id_estado = $fila['estado'];
                        $descripcion = $fila['descripcion'];
                        $cantidad = $fila['cantidad'];
                        $valor = $fila['valor'];
                        
                    ?>
                  <tr>
                    <td><?php echo $id_articulo?></td>
                    <td><?php echo $nombre_A?></td>
                    <td><?php echo $descripcion?></td>
                    <td><?php echo $cantidad?></td>
                    <td><?php echo $valor?></td>
                    <td><?php echo $id_estado?></td>
                    <td><a href="" class="boton" onclick="window.open
                    ('../update/articulos.php?id=<?php echo $id_articulo ?>','','width= 600,height=500, toolbar=NO');void(null);"><i class="bi bi-arrow-counterclockwise"></i>Actualizar</a></td>

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