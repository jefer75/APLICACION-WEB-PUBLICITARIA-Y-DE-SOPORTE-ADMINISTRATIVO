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

     // Validación de campos vacíos
     if (empty($id_tipo_art) || empty($nombre_A) || empty($id_estado) || empty($descripcion) || empty($cantidad) || empty($valor)) {
      echo '<script>alert("EXISTEN DATOS VACIOS");</script>';
      echo '<script>window.location="complementos.php"</script>';
  } else if ($cantidad <= 0 || $valor <= 0) {  
      echo '<script>alert("CANTIDAD Y VALOR DEBEN SER MAYORES A 0");</script>';
      echo '<script>window.location="complementos.php.php"</script>';
  } else {
      $sql = $con->prepare("SELECT * FROM articulos WHERE nombre_A = :nombre_A");
      $sql->bindParam(':nombre_A', $nombre_A);
      $sql->execute();
      $fila = $sql->fetch(PDO::FETCH_ASSOC);
  
      if ($fila) {
          echo '<script>alert("ESTE ARTICULO YA EXISTE //CAMBIELO//");</script>';
          echo '<script>window.location="complementos.php"</script>';
      } else {
          $insertSQL = $con->prepare("INSERT INTO articulos (nombre_A, id_tipo_art, id_estado, descripcion, cantidad, valor) VALUES (:nombre_A, :id_tipo_art, :id_estado, :descripcion, :cantidad, :valor)");
          $insertSQL->bindParam(':nombre_A', $nombre_A);
          $insertSQL->bindParam(':id_tipo_art', $id_tipo_art);
          $insertSQL->bindParam(':id_estado', $id_estado);
          $insertSQL->bindParam(':descripcion', $descripcion);
          $insertSQL->bindParam(':cantidad', $cantidad);
          $insertSQL->bindParam(':valor', $valor);
          $insertSQL->execute();
  
          echo '<script>alert("REGISTRO EXITOSO");</script>';
          echo '<script>window.location="complementos.php"</script>';
      }
    }
      }
      ?>
  

<title>Articulos</title>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Complementos</h1>

  </div><!-- End Page Title -->

  <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">

                        <form method="post" action="funciones/com_excel.php">
                            <button type="submit" name="com_excel" class="btn btn-success">
                                <i class="bi bi-download"></i>
                            </button>
                        </form>

                        <dialog class="añadir_cont" id="añadir_cont">
                        <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>
                        <h2 class="modal__title">Registrar artículo</h2>
                        <form method="post" name="formreg" id="formreg" class="row g-3" autocomplete="off">
                            <div class="col-md-6">
                                <label for="inputTipoArticulo" class="form-label">Tipo Articulos</label>
                                <select class="form-control" name="id_tipo_art">
                                    <option value="">Seleccione el tipo de articulo</option>
                                    <?php
                                    $control = $con-> prepare ("SELECT * FROM tipo_articulo");
                                    $control -> execute();
                                    while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                                    {
                                        echo "<option value='" . $fila['id_tipo_art'] . "'>" . $fila['tipo_articulo'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
    <label for="inputNombreArticulo" class="form-label">Nombre artículo</label>
    <input class="form-control" type="text" id="nombreArticuloInput" name="nombre_A" placeholder="Nombre de artículo (entre 4 y 15 caracteres)" required>
</div>

<div class="col-md-6">
    <label for="inputDescripcion" class="form-label">Descripción</label>
    <input class="form-control" type="text" id="descripcionInput" name="descripcion" placeholder="Descripción">
</div>

<div class="col-12">
    <label for="inputCantidad" class="form-label">Cantidad</label>
    <input class="form-control" type="text" id="cantidadInput" name="cantidad" placeholder="Cantidad" required>
</div>

<div class="col-12">
    <label for="inputValor" class="form-label">Valor</label>
    <input class="form-control" type="text" id="valorInput" name="valor" placeholder="Valor (máximo 8 dígitos)" required>
</div>

<script>
    // Obtener referencia a los elementos de entrada
    var nombreArticuloInput = document.getElementById('nombreArticuloInput');
    var descripcionInput = document.getElementById('descripcionInput');
    var cantidadInput = document.getElementById('cantidadInput');
    var valorInput = document.getElementById('valorInput');

    // Validación para el nombre del artículo
    nombreArticuloInput.addEventListener('input', function() {
        var nombreArticuloValue = nombreArticuloInput.value.trim();
        if (/^[A-Za-z\s]{4,20}$/.test(nombreArticuloValue)) {
            nombreArticuloInput.setCustomValidity('');
        } else {
            nombreArticuloInput.setCustomValidity('Por favor, ingrese solo letras y espacios, con una longitud entre 4 y 20 caracteres.');
        }
    });

    // Validación para la descripción
    descripcionInput.addEventListener('input', function() {
        var descripcionValue = descripcionInput.value.trim();
        // Puedes ajustar la expresión regular según los caracteres que desees permitir en la descripción
        if (/^[A-Za-z0-9.,\s]{1,50}$/.test(descripcionValue)) {
            descripcionInput.setCustomValidity('');
        } else {
            descripcionInput.setCustomValidity('Por favor, ingrese letras, números, puntos, comas y espacios, con un máximo de 50 caracteres.');
        }
    });

    // Validación para la cantidad
    cantidadInput.addEventListener('input', function() {
        var cantidadValue = cantidadInput.value.trim();
        if (/^\d{1,3}$/.test(cantidadValue) && parseInt(cantidadValue, 10) > 0) {
            cantidadInput.setCustomValidity('');
        } else {
            cantidadInput.setCustomValidity('Por favor, ingrese solo números.');
        }
    });

    // Validación para el valor
    valorInput.addEventListener('input', function() {
        var valorValue = valorInput.value.trim();
        if (/^\d{1,8}$/.test(valorValue) && parseInt(valorValue, 10) >= 0) {
            valorInput.setCustomValidity('');
        } else {
            valorInput.setCustomValidity('Por favor, ingrese solo números un máximo ocho dígitos.');
        }
    });
</script>

                            <div class="text-center">
                                <input type="submit" name="registrar" value="Registro" class="btn btn-primary modal_close">
                            </div>
                        </form>
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
                        FROM articulos INNER JOIN tipo_articulo ON tipo_articulo.id_tipo_art = articulos.id_tipo_art INNER JOIN estados ON estados.id_estado = articulos.id_estado where articulos.id_tipo_art= 3");
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
                    <td>
                    <a href="#" class="boton" onclick="window.open('../actualizar/articulos.php?id=<?php echo $fila['id_articulo']; ?>','','width=800,height=750,toolbar=NO');void(null);">
                      <i class="bi bi-arrow-clockwise"></i>
                    </a>

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