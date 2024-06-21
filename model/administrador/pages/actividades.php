<?php
    include 'plantilla.php';
    include '../funciones/reg_actividades.php';
?>

<title>actividades</title>

<main id="main" class="main">

<style>
    table img{
        width: 35vh;
    }

</style>

  <div class="pagetitle">
    <h1>Actividades</h1>

  </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">

              <form method="post" action="funciones/act_excel.php">
                            <button type="submit" name="act_excel" class="btn btn-success">
                                <i class="bi bi-download"></i>
                            </button>
                        </form>
              

              <dialog class="añadir_cont" id="añadir_cont">
                <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

                <h2 class="modal__title">Registrar actividad</h2> 
          <!-- Multi Columns Form -->

                <form method="post" name="formreg" action="../funciones/reg_actividades.php"  class="row g-3"  autocomplete="off" enctype="multipart/form-data">
                <div class="col-md-6">
            <label for="inputEmail5" class="form-label">Nombre</label>
            <input class="form-control" type="text" name="nombre" id="nombreInput" placeholder="Nombre actividad">
            <div id="error_nombre" class="invalid-feedback">
                El nombre debe contener entre 1 y 20 letras y máximo dos espacios.
            </div>
        </div>
   


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var nombreInput = document.getElementById('nombreInput');
        var errorNombre = document.getElementById('error_nombre');

        nombreInput.addEventListener('input', function() {
            var nombre = nombreInput.value.trim();

            // Expresión regular para validar nombre (letras y máximo dos espacios)
            var regex = /^[A-Za-z]+(?:\s[A-Za-z]+){0,2}$/;

            if (regex.test(nombre) && nombre.length >= 1 && nombre.length <= 20) {
                nombreInput.classList.remove('is-invalid');
                errorNombre.style.display = 'none';
            } else {
                nombreInput.classList.add('is-invalid');
                errorNombre.style.display = 'block';
            }
        });
    });
</script>

               

<div class="col-md-6">
            <label for="inputEmail5" class="form-label">Descripción</label>
            <input class="form-control" type="text" name="descripcion" id="descripcionInput" placeholder="Descripción del paquete">
            <div id="error_descripcion" class="invalid-feedback">
                La descripción no puede exceder los 80 caracteres ni contener más de un espacio.
            </div>
        </div>
   


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var descripcionInput = document.getElementById('descripcionInput');
        var errorDescripcion = document.getElementById('error_descripcion');

        descripcionInput.addEventListener('input', function() {
            var descripcion = descripcionInput.value.trim();

            // Validar que la descripción tenga hasta 80 caracteres y máximo un espacio
            if (descripcion.length <= 80 && !/\s{2,}/.test(descripcion)) {
                descripcionInput.classList.remove('is-invalid');
                errorDescripcion.style.display = 'none';
            } else {
                descripcionInput.classList.add('is-invalid');
                errorDescripcion.style.display = 'block';
            }
        });
    });
</script>
                <div class="co-md-6">
                  <label for="inputEmail5" class="form-label">Imagen</label>
                  <input  class="form-control" type="file" name="imagen" placeholder="subir imagen" >
                </div>
                
                <div class="text-center">
                  <tr>
                  <input type="submit" name="registrar" value="Registro" class="btn btn-primary modal_close">
                  </tr>
                </div>
              </form>
            </dialog>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                  
                    <th>Actividades</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
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
                    
                  <td><?php echo $nombre?></td>
                    <td><?php echo $descripcion?></td>
                    <td> <img src="<?php echo $fila['imagen']?>"></td>
                    
                    <td>
                      <a href="#" class="boton" onclick="window.open('../actualizar/actividades.php?id=<?php echo $id_actividad ?>','','width=500,height=450,toolbar=NO');void(null);">
                      <i class="bi bi-pencil"></i>
                      </a>
                    </td>
                    <td>    
                      <a href="#" class="btn btn-warning" onclick="window.open ('../eliminar/eli_actividades.php?id=<?php echo $id_actividad ?>','','width= 450,height=350, toolbar=NO');void(null);"><i class="bi bi-trash"></i></a>
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