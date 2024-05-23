<?php
include 'plantilla.php';
 
if (isset($_POST['registrar'])){

  $nombre_paquete= $_POST['nombre_paquete'];
  $edad_min = $_POST['edad_min'];
  $edad_max= $_POST['edad_max'];
  $valor= $_POST['valor'];  
                  
  $sql= $con -> prepare ("SELECT * FROM paquetes WHERE nombre_paquete='$nombre_paquete'");
  $sql -> execute();
  $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

  if ($fila){
    echo '<script>alert ("ESTE PAQUETE YA EXISTE ");</script>';
    echo '<script>window.location="paquetes.php"</script>';
  }

  else if ($nombre_paquete=="" || $edad_min=="" || $edad_max=="" || $valor==""){
    echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';  
    echo '<script>window.location="paquetes.php"</script>';
  }
      
  else{
    $insert= $con -> prepare ("INSERT INTO paquetes(nombre_paquete, edad_min, edad_max, valor) VALUES ($nombre_paquete, $edad_min, $edad_max, $valor)");
    $insert -> execute();
    echo '<script> alert ("Registro realizado con exito");</script>';
  }
}

if (isset($_POST['actualizar_btn'])){
  

  $nombre_paquete= $_POST['nombre_paquete'];
  $edad_min = $_POST['edad_min'];
  $edad_max= $_POST['edad_max'];
  $valor= $_POST['valor'];  
                        
  $update= $con -> prepare ("UPDATE paquetes SET nombre_paquete='$nombre_paquete', edad_min='$edad_min', edad_max='$edad_max', valor='$valor' WHERE id_paquetes =1");
  $update -> execute();
  echo '<script> alert ("Registro actualizado exitosamente");</script>';
  echo '<script> window.close(); </script>';
                                        
}
?>
<head>
<title>Paquetes</title>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
<script src="../../../js/jquery.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    </head>
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

              <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">
              

              <dialog class="añadir_cont" id="añadir_cont">
                <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

                <h2 class="modal__title">Registrar paquete</h2> 
          <!-- Multi Columns Form -->

                <form method="post" name="formreg" id="formreg"   class="row g-3"  autocomplete="off"> 

                <div class="col-md-6">

                  <label for="inputEmail5" class="form-label">Nombre Paquete</label>

                  <input  class="form-control" type="text" name="nombre_paquete" pattern="[A-Za-z ]{4,15}" placeholder="Nombre de paquete">
                </div>

                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Edad Minima</label>
                  <input  class="form-control" type="varchar" name="edad_min"  placeholder="Edad minima">
                </div>

                <div class="col-12">
                  <label for="inputAddress5" class="form-label">Edad Maxima</label>
                  <input  class="form-control" type="varchar" name="edad_max" placeholder="Edad maxima">
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
              <?php include "../consultar/con_paquetes.php"; 
            ?>
              
              <!-- Ventana modal de actualizar -->
              <!-- <dialog class="modal_actualizar" id="modal_actualizar">
              
                    <button class="act_cerrar" class="btn modal_close" onclick="closedialog();">X</button>
                    <form autocomplete="off" name="form_actualizar" method="POST">
                    <div class="modal_actualizar-body">
                        
                        <h2 class="modal__title">Actualizar paquete</h2>
                        <br>
                        <label for="nombre_paquete">Nombre Paquete</label>
                            <br>
                            <input type="text" name="nombre_paquete" pattern="[A-Za-z]+" title="(Solo se aceptan letras)" class="form-control" value="<?php //echo $nombre_p_select ?>">
                        <br>
                        <label for="nombre_artistico">Edad Minima</label>
                            <br>
                            <input type="number" name="edad_min" class="form-control" value="<?php //echo $edad_min_select?>">
                        <br>
                        <label for="direccion">Edad Maxima</label>
                        <br>
                        <input type="number" name="edad_max" class="form-control" value="<?php //echo $edad_max_select?>">
                        <br>
                        <label for="telefono">Valor</label>
                        <br>
                        <td><input class="btn" type="number" name="valor" pattern="[0-9]{1,15}" class="form-control" title="Solo se permiten numeros" value="<?php //echo $valor_select ?>">
                        <br>
                        <br>
                        <br>
                        <input type="submit" name="actualizar_btn" value="Registro" class="act_cerrar boton">
                        <input type="hidden" name="MM_insert" value="formreg">
                        
                    </div>
                    </form>
                </dialog> -->
              
                  <?php
                  
                    if (isset($_POST['actualizar'])){
                      

                    }
                   
                ?>


                  
              
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
    

//const act_abrir = document.querySelectorAll('.abrir_act');
//const act_cerrar = document.getElementsByClassName('.act_cerrar');

//sobre todos los elementos seleccionados
$('.abrir_act').click(function(e) {
        e.preventDefault();
        
        var paquete = this.getAttribute('id_paquete');
        //var action = 'identificador';
        
        
        // $.ajax({
        //     URL: 'paquetes.php',
        //     type: 'POST',
        //     async: true,
        //     data: {descripcion:action, codigo_paquete:paquete},

        //     correcto: function(response){
        //         console.log(response)
        //     },
        //     erroneo: function(response){
        //         console.log(response)
        //     }
        // })
        //document.getElementById("output").innerText = paquete;
        
       
    });     



  </script>
  <!-- Vendor JS Files -->
  <script src="../../../js/modal.js"></script>
  <script src="paquetes.js"></script>
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