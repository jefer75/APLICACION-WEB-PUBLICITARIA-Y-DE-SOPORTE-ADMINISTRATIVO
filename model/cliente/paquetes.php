<?php
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
                       
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Nombre del paquete</th>
                                        <th>Edad mínima</th>
                                        <th>Edad máxima</th>
                                        <th>Valor</th>
                                        <th>Detalles</th>
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
                                        $valor = $fila['valor'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nombre_paquete ?></td>
                                        <td><?php echo $edad_min ?></td>
                                        <td><?php echo $edad_max ?></td>
                                        <td><?php echo $valor ?></td>
                                        <td>
                                            <a href="" class="boton"
                                                onclick="window.open('detalles/detalle_paquetes.php?id=<?php echo $fila['id_paquetes'] ?>','','width=600,height=400,toolbar=NO');return false;">
                                                <i class="bi bi-info-circle"></i>
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
  <script src="../administrador/pages/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../administrador/pages/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../administrador/pages/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../administrador/pages/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../administrador/pages/assets/vendor/quill/quill.js"></script>
  <script src="../administrador/pages/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../administrador/pages/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../administrador/pages/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../administrador/pages/assets/js/main.js"></script>

</body>

</html>