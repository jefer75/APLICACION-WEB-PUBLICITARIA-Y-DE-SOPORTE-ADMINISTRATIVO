<?php
  include "plantilla.php";

   if (isset($_POST['registrar']))
   {
    $cedula= $_POST['cedula'];
    $nombre= $_POST['nombre'];
    $celular= $_POST['celular'];
    $contrasena= $_POST['contrasena'];
    $correo= $_POST['correo'];
    $tipo_user= $_POST['tipo_user'];
    $id_estado= $_POST['id_estado'];
   

     $sql= $con -> prepare ("SELECT * FROM usuarios WHERE cedula='$cedula' or correo = '$correo'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("DOCUMENTO YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="registrar.php"</script>';
     }

     else
   
     if ($cedula=="" || $nombre=="" || $correo=="" || $celular=="" || $contrasena=="" || $tipo_user=="" || $id_estado=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="registrar.php"</script>';
      }
      
      else{

        $pass_cifrado = password_hash($contrasena,PASSWORD_DEFAULT, array("pass"=>12));
        
        $insertSQL = $con->prepare("INSERT INTO usuarios(cedula, nombre, celular, contrasena , correo, id_tipo_user, id_estado, nit) VALUES('$cedula', '$nombre', '$celular', '$pass_cifrado', '$correo', '$tipo_user', '$id_estado', 123456789)");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="registrar.php"</script>';
     }  
    }
    ?>

  <title>Registro-Persona</title>

  <main id="main" class="main">
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Crear cuenta</h5>
                    <p class="text-center small">Ingresa tus datos</p>
                  </div>

                  <form class="row g-3 needs-validation" name="formreg" id="formreg" method="POST">
                    <div class="col-12">
                      <label for="yourName" class="form-label">Cedula</label>
                      <input type="text" pattern="[0-9]{7,12}" title="La cedula solo puede tener numeros y como minimo 7 caracteres" name="cedula" class="form-control" id="cedula" required>
                      <div class="invalid-feedback">Ingresa tu cedula</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Nombre completo</label>
                      <input type="text" name="nombre" class="form-control" id="nombre" pattern="[A-Za-z/s ]{10,30}" title="Solo se aceptan letras, minimo 10 caracteres" required>
                      <div class="invalid-feedback">Ingresa tu nombre</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">celular</label>
                      <input type="text" name="celular" pattern="[0-9]{8,12}" title="La telefono solo puede tener numeros y como minimo 8 caracteres"class="form-control" id="celular" required>
                      <div class="invalid-feedback">Ingresa tu telefono</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">correo</label>
                      <div class="input-group has-validation">
                        <input type="email" name="correo" class="form-control" id="correo" required>
                        <div class="invalid-feedback">Ingresa tu email</div>
                      </div>
                    </div>
                    <select class="cont" name="tipo_user">
                    <option value ="">Seleccione Tipo Usuario</option>
                     <br>

                    <?php
                        $control = $con -> prepare ("SELECT * from tipo_user");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_tipo_user'] . ">"
                        . $fila['tipo_user'] . "</option>";
                    } 
                    ?>
                </select>
                <br>
                <select class="cont"  name="id_estado">
                    <option  value ="">Seleccione el estado</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from estados where id_estado <= 2");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_estado'] . ">"
                        . $fila['estado'] . "</option>";
                    } 
                    ?>
                </select>

                <div class="col-12">
                      <label for="yourPassword" class="form-label">contraseña</label>
                      <input type="password" name="contrasena" class="form-control" id="contrasena" pattern="[A-Za-z0-9]{8,12}" title="La contraseña solo debe tener minimo 8 caracteres" required>
                      <div class="invalid-feedback">Ingresa tu contraseña</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Estoy de acuerdo con los <a href="#">Terminos y condiciones</a></label>
                        <div class="invalid-feedback">Debes estar de acuerdo para continuar</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <td><input class="btn btn-primary w-100"  type="submit" name="registrar" value="registrar"></td>
                    </div>
                    
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Diseñada por<a href="https://bootstrapmade.com/">Elitech JYD</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
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