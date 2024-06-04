<?php
include '../plantilla.php';
 
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
    $insert= $con -> prepare ("INSERT INTO paquetes (nombre_paquete, edad_min, edad_max, valor) VALUES ($nombre_paquete, $edad_min, $edad_max, $valor)");
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

<title>Paquetes</title>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Paquetes</h1>

    </div><!-- End Page Title -->

    <section class="section">
    <div class="container">
        <div class="col-sm-12">
            <h2 style="text-align: center;">EDITAR REGISTROS EN MODAL | SOFTCODEPM</h2>
            <br>
            <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregar"> Agregar </button>



            </div>
            <br>
            <br>
            <br>


            <div class="container">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo Articulo</th>
                            <th>Descargar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "../../../../db/connection.php ";
                        $result = mysqli_query($conexion, "SELECT * FROM tipo_articulo");
                        while ($fila = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr>
                                <td><?php echo $fila['id_tipo_art']; ?></td>
                                <td><?php echo $fila['tipo_articulo']; ?></td>
                                
                                <td>
                                    <a href="../includes/download.php?id=<?php echo $fila['id_tipo_art']; ?>" class="btn btn-primary">
                                        <i class="fas fa-download"></i></a>

                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editar<?php echo $fila['id_tipo_art']; ?>">
                                        <i class="fa fa-edit "></i>
                                    </button>

                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#eliminar<?php echo $fila['id_tipo_art']; ?>">
                                        <i class="fa fa-trash "></i>
                                    </button>
                                </td>
                                <?php include "../includes/editar.php"; ?>
                            <?php include "../includes/eliminar.php"; ?>
                            <?php endwhile; ?>
                            </tr>
                    </tbody>
                </table>

            </div>
        </div>

</body>
<style>
    a {
        text-decoration: none;
    }

    .s {
        padding-top: 50px;
        text-align: center;
    }
</style>
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