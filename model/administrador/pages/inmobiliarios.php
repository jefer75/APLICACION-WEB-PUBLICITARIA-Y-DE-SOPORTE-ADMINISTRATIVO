<?php
include 'plantilla.php';
include '../funciones/reg_articulos.php';
?>
  

<title>Articulos</title>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Inmobiliarios</h1>

  </div><!-- End Page Title -->

  <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">

                        <form method="post" action="funciones/inm_excel.php">
                            <button type="submit" name="inm_excel" class="btn btn-success">
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
                                <label for="inputNombreArticulo" class="form-label">Nombre articulo</label>
                                <input class="form-control" type="text" name="nombre_A" pattern="[A-Za-z ]{4,15}" placeholder="Nombre de articulo">
                            </div>
                         
                            <div class="col-md-6">
                                <label for="inputDescripcion" class="form-label">Descripción</label>
                                <input class="form-control" type="text" name="descripcion" placeholder="Descripción">
                            </div>
                            <div class="col-6">
                                <label for="inputCantidad" class="form-label">Cantidad</label>
                                <input class="form-control" type="number" name="cantidad" placeholder="Cantidad" min="1">
                            </div>
                            <div class="col-6">
                                <label for="inputValor" class="form-label">Valor</label>
                                <input class="form-control" type="number" name="valor" pattern="[0-9]{1,15}" title="Solo se permiten números" placeholder="Valor" min="1">
                            </div>
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
                    <th>Codigo de barras</th>
                    <th>Editar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                       $con_fila = $con->prepare("SELECT articulos.id_articulo,tipo_articulo.id_tipo_art, tipo_articulo.tipo_articulo, estados.estado , articulos.nombre_A, articulos.descripcion,  articulos.cantidad,  articulos.valor, articulos.barcode
                        FROM articulos INNER JOIN tipo_articulo ON tipo_articulo.id_tipo_art = articulos.id_tipo_art INNER JOIN estados ON estados.id_estado = articulos.id_estado where articulos.id_tipo_art= 4");
                      $con_fila->execute();
                      $fila = $con_fila->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($fila as $fila) {
                        ?>
                        <tr>
                            <td><?php echo $fila['tipo_articulo']; ?></td>
                            <td><?php echo $fila['nombre_A']; ?></td>
                            <td><?php echo $fila['estado']; ?></td>
                            <td><?php echo $fila['descripcion']; ?></td>
                            <td><?php echo $fila['cantidad']; ?></td>
                            <td><?php echo $fila['valor']; ?></td>
                            <td>
                                <img src="<?php echo $fila['barcode']?>">
</td>
                            <td>
                                <a href="#" class="boton" onclick="window.open('../actualizar/articulos.php?id=<?php echo $fila['id_articulo']; ?>','','width=800,height=750,toolbar=NO');void(null);">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
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