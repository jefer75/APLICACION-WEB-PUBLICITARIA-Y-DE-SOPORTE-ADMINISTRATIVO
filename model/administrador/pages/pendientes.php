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

<title>Reservas</title>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Reservas</h1>

  </div><!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pendientes</h5>

              <td><a href="funciones/factura.php?id_eventos=<?php echo $id_eventos ?>" class="boton"><i class="bi bi-file-earmark-pdf"></i></a></td>

              <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">
              

              <dialog class="añadir_cont" id="añadir_cont">
                <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

                <h2 class="modal__title">Registrar paquetes</h2> 
          <!-- Multi Columns Form -->

          <form method="post" name="formreg" id="formreg" class="row g-3" autocomplete="off">
        <!--Username -->
                        <br>
                        <select class="form-control" name="id_tipo_art">
                            <option value ="">Seleccione el tipo de evento</option>
                            
                            <?php
                                $control = $con -> prepare ("SELECT * from tipo_e");
                                $control -> execute();
                            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                            {
                                echo "<option value=" . $fila['id_tipo_e'] . ">"
                                . $fila['tipo_evento'] . "</option>";
                            } 
                            ?>
                        </select>
     <br>        
     <label for="id_paquetes">paquete</label>
        <br>
        <input type="number" name="id_paquetes" id="id_paquetes" class="form_inputs" placeholder="paquete">
        <br>   
        <br>
        <label for="lugar">lugar</label>
        <br>
        <input type="varchar" name="lugar" id="lugar" class="form-control" placeholder="lugar">
        <br>
        <label for="cant_ninos">cantidad niños</label>
        <br>
        <input type="number" name="cant_ninos" id="cant_ninos" class="form-control" placeholder="cantidad de niños">
        <br>
        <label for="contacto">contacto</label>
        <br>
        <input type="varchar" name="contacto" class="form-control" id="contacto" placeholder="contacto">
        <br>
        <label for="fecha_evento">fecha de evento</label>
        <br>
        <input type="date" name="fecha_evento" class="form-control" id="fecha_evento" placeholder="fecha del evento">
        <br>
        <label for="f_inicio">fecha de inicio</label>
        <br>
        <input type="date" name="f_inicio" class="form-control" id="f_inicio" placeholder="fecha del evento">
        <br>
        <label for="f_fin">fecha de fin</label>
        <br>
        <input type="date" name="f_fin" class="form-control" id="f_fin" placeholder="fecha del evento">
        <br>
        <label for="hora_inicio">hora inicio</label>
        <br>
        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" placeholder="hora inicio">               
        <br>
        <label for="hora_fin">hora fin</label>
        <br>
        <input type="time" name="hora_fin" class="form-control" id="hora_fin" placeholder="fecha del evento">
        <br>
        <label for="descripcion">descripcion</label>
        <br>
        <input type="varchar" name="descripcion" class="form-control" id="descripcion" placeholder="descripcion">
        <br>
        <div class="text-center">
            <input type="submit" name="registrar" value="Registro" class="btn btn-primary modal_close">
        </div>
    </form>
            </dialog>

              <!-- Table with stripped rows -->
              <table class="table datatable">
  <thead>
    <tr>
        <th>F. Reserva</th>
        <th>Paquete</th>
        <th>T. Evento</th>
        <th>Lugar</th>
        <th>C. Niños</th>
        <th>F. Inicio</th>
        <th>F. Fin</th>
        <th>H. Inicio</th>
        <th>H. Fin</th>
        <th>descripcion</th>
        <th>Cliente</th>
        <th>Total</th>
        <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $con_paquetes = $con->prepare("SELECT eventos.id_eventos, eventos.fecha_evento, eventos.fecha_evento, paquetes.nombre_paquete, tipo_e.tipo_evento, eventos.lugar, eventos.cant_ninos, eventos.f_inicio, eventos.f_fin, eventos.hora_inicio, eventos.hora_fin, eventos.descripcion, usuarios.nombre, factura.valor_total, estados.estado 
        FROM eventos 
        INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes 
        INNER JOIN tipo_e ON tipo_e.id_tipo_e = eventos.id_tipo_e 
        INNER JOIN usuarios ON usuarios.cedula = eventos.cedula 
        INNER JOIN factura ON factura.id_eventos = eventos.id_eventos 
        INNER JOIN estados ON estados.id_estado = eventos.id_estado 
        WHERE eventos.id_estado = 6;");
        $con_paquetes->execute();
        $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($paquetes as $fila) {

          $id_eventos= $fila['id_eventos'];
          $f_evento = $fila['fecha_evento'];
          $nombre_paquete = $fila['nombre_paquete'];
          $tipo_e = $fila['tipo_evento'];
          $lugar = $fila['lugar'];
          $cant_ninos = $fila['cant_ninos'];
          $f_inicio = $fila['f_inicio'];
          $f_fin = $fila['f_fin'];
          $hora_inicio = $fila['hora_inicio'];
          $hora_fin = $fila['hora_fin'];
          $descripcion = $fila['descripcion'];
          $nombre = $fila['nombre'];
          $valor_total = $fila['valor_total'];
          $estado = $fila['estado'];
          
      ?>
      
    <tr>
        <td><?php echo $f_evento?></td>
        <td><?php echo $nombre_paquete?></td>
        <td><?php echo $tipo_e?></td>
        <td><?php echo $lugar?></td>
        <td><?php echo $cant_ninos?></td>
        <td><?php echo $f_inicio?></td>
        <td><?php echo $f_fin?></td>
        <td><?php echo $hora_inicio?></td>
        <td><?php echo $hora_fin?></td>
        <td><?php echo $descripcion?></td>
        <td><?php echo $nombre?></td>
        <td><?php echo $valor_total?></td>
        <td><?php echo $estado?></td>
        <td><a href="" class="boton" onclick="window.open
       ('../actualizar/eventos.php?id=<?php echo $id_eventos ?>','','width= 600,height=500, toolbar=NO');void(null);"><i class="bi bi-arrow-counterclockwise"></i></a></td>
        <td><a href="" class="boton" onclick="window.open
       ('../detalles/detalle_ventas.php?id=<?php echo $id_eventos ?>','','width= 600,height=500, toolbar=NO');void(null);"><i class="bi bi-arrow-counterclockwise"></i></a></td>
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