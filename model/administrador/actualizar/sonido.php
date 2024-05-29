<?php

require_once("../../../db/connection.php");
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db -> conectar();

    include 'plantilla.php';

    
  
    if (isset($_POST["registrar"])){

    $id_tipo_art = $_POST['id_tipo_art'];
    $nombre_A = $_POST['nombre_A'];
    $id_estado = $_POST['id_estado'];
    $descripcion = $_POST['descripcion']; 
    $cantidad = $_POST['cantidad'];
    $valor= $_POST['valor'];


     $sql= $con -> prepare ("SELECT * FROM articulos WHERE nombre_A='$nombre_A'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("ESTE PAQUETE YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="sonido.php"</script>';
     }

     else
   
     if ( $id_tipo_art =="" || $nombre_A =="" || $id_estado =="" ||  $descripcion =="" ||  $cantidad =="" || $valor =="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="sonido.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO articulos(nombre_A, id_tipo_art, id_estado, descripcion, cantidad, valor) VALUES('$nombre_A', '$id_tipo_art', '$id_estado', '$descripcion', '$cantidad', '$valor')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="sonido.php"</script>';
     }  
    }
    ?>

<title>articulos</title>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Sonido</h1>

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

                <h2 class="modal__title">Registrar articulo</h2> 
          <!-- Multi Columns Form -->

                <form method="post" name="formreg" id="formreg"   class="row g-3"  autocomplete="off"> 

               <div class="col-md-6">

                  <label for="inputEmail5" class="form-label">tipo articulo</label>

                  <br>
            <select class="form-control" name="id_articulos">
                <option value="<?php echo htmlspecialchars($evento['id_tipo_art']); ?>">Seleccione el tipo de articulo</option>
                <?php
                $paquetes = $con->query("SELECT * FROM tipo_articulo")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($paquetes as $paquete) {
                    echo "<option value='" . htmlspecialchars($paquete['id_tipo_art']) . "'>" . htmlspecialchars($paquete['tipo_articulo']) . "</option>";
                }
                ?>
            </select>
                </div>
               

                <div class="col-md-6">

                  <label for="inputEmail5" class="form-label">Nombre articulo</label>

                  <input  class="form-control" type="text" name="nombre_A" pattern="[A-Za-z ]{4,15}" placeholder="Nombre de articulo">
                </div>

                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">estado</label>
                  <br>
            <select class="form-control" name="id_estado">
                <option value="<?php echo htmlspecialchars($evento['id_estado']); ?>">Seleccione el estado</option>
                <?php
                $paquetes = $con->query("SELECT * FROM estados")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($paquetes as $paquete) {
                    echo "<option value='" . htmlspecialchars($paquete['id_estado']) . "'>" . htmlspecialchars($paquete['estado']) . "</option>";
                }
                ?>
                </div>

                <div class="co-md-6">
                  <label for="inputEmail5" class="form-label">descripcion</label>
                  <input  class="form-control" type="text" name="descripcion" placeholder="descripcion">
                </div>

                <div class="col-12">
                  <label for="inputAddress5" class="form-label">cantidad</label>
                  <input  class="form-control" type="varchar" name="cantidad" placeholder="cantidad">
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
                  
                  <th>tipo articulo</th>
                    <th>Nombre</th>
                    <th>estado</th>
                    <th>descripcion</th>
                    <th>cantidad</th>
                    <th>valor</th>
                    <th>Actualizar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $con_paquetes = $con->prepare("SELECT articulos.id_articulo,tipo_articulo.id_tipo_art, tipo_articulo.tipo_articulo, estados.estado , articulos.nombre_A, articulos.descripcion,  articulos.cantidad,  articulos.valor
                        FROM articulos INNER JOIN tipo_articulo ON tipo_articulo.id_tipo_art = articulos.id_tipo_art INNER JOIN estados ON estados.id_estado = articulos.id_estado where articulos.id_tipo_art= 1");
                      $con_paquetes->execute();
                      $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($paquetes as $fila) {
                       
                        $id_tipo_art = $fila['tipo_articulo'];
                        $nombre_A = $fila['nombre_A'];
                        $id_estado = $fila['estado'];
                        $descripcion = $fila['descripcion'];
                        $cantidad = $fila['cantidad'];
                        $valor = $fila['valor'];
                        
                    ?>
                  <tr>
                    
                  <td><?php echo $id_tipo_art?></td>
                    <td><?php echo $nombre_A?></td>
                    <td><?php echo $id_estado?></td>
                    <td><?php echo $descripcion?></td>
                    <td><?php echo $cantidad?></td>
                    <td><?php echo $valor?></td>
                    <td><a href="" class="boton" onclick="window.open
                    ('../actualizar/articulos.php?id=<?php echo $fila['id_articulo'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Click Aqui</a>

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