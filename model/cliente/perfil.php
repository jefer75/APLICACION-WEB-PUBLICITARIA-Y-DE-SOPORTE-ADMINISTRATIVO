<?php
include 'plantilla.php';


// Obtener los datos del cliente desde la base de datos
$cedula = $_SESSION['cedula'];
$sql = $con->prepare("SELECT usuarios.cedula, usuarios.nombre, usuarios.correo, usuarios.celular, empresa.nombre_emp
                    FROM usuarios 
                    INNER JOIN empresa ON usuarios.nit = empresa.nit
                    WHERE usuarios.cedula = $cedula");
$sql->execute();
$cliente = $sql->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    echo "Error: No se encontraron datos del usuario.";
    exit();
}

// Procesar el formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados del formulario
    $celular = $_POST["celular"];
    $correo = $_POST["correo"];

    // Actualizar los datos del cliente en la base de datos
    $sql = $con->prepare("UPDATE usuarios SET celular = $celular, correo = '$correo' WHERE cedula = $cedula");
    $result = $sql->execute();

    if ($result) {
        // Mostrar mensaje de éxito
        echo "Los datos se actualizaron correctamente.";

        // Actualizar los datos en el array $cliente para que refleje los cambios
        $cliente['celular'] = $celular;
        $cliente['correo'] = $correo;
    } else {
        echo "Error al actualizar los datos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <!-- Incluir tus archivos CSS aquí -->
</head>

<body>

    <aside><!-- Barra lateral -->
        <!-- Contenido de la barra lateral si es necesario -->
    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Perfil</h1>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <h2>Aqui podras actualizar algunos de tus datos de contacto</h2>
                            <br>
                            <h3>Animador (Empleado)</h3>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Perfil</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-edit">Editar Perfil</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title"></h5>

                                    <h5 class="card-title">Detalle Perfil</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nombre</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $cliente['nombre']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Cédula</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $cedula?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Compañía</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $cliente['nombre_emp']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Teléfono</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $cliente['celular']; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Correo electrónico</div>
                                        <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars($cliente['correo']); ?></div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Formulario de Edición de Perfil -->
                                    <form method="POST" action="" onsubmit="return validarFormulario()">

                                    <!-- Formulario de Edición de Perfil -->
                                    <div class="row mb-3">
        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Teléfono</label>
        <div class="col-md-8 col-lg-9">
            <input class="form-control" type="text" id="celular" name="celular"
                value="<?php echo htmlspecialchars($cliente['celular']); ?>">
            <div id="error-celular" class="invalid-feedback">Teléfono debe contener solo números y tener exactamente 10 dígitos.</div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Correo electrónico</label>
        <div class="col-md-8 col-lg-9">
            <input class="form-control" type="email" id="correo" name="correo"
                value="<?php echo htmlspecialchars($cliente['correo']); ?>">
            <div id="error-correo" class="invalid-feedback">Correo electrónico debe tener un formato válido (max 30 caracteres y debe contener '@').</div>
        </div>
    </div>

    <div class="text-center">
        <input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar"
            value="Actualizar">
    </div>
</form>

<script>
    function validarFormulario() {
        var celularInput = document.getElementById('celular');
        var correoInput = document.getElementById('correo');

        var celular = celularInput.value.trim();
        var correo = correoInput.value.trim();

        var celularValido = /^[0-9]{10}$/.test(celular); // Teléfono debe ser exactamente 10 dígitos numéricos
        var correoValido = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,30}$/.test(correo); // Correo electrónico debe tener un formato válido

        if (!celularValido) {
            celularInput.classList.add('is-invalid');
            document.getElementById('error-celular').style.display = 'block';
        } else {
            celularInput.classList.remove('is-invalid');
            document.getElementById('error-celular').style.display = 'none';
        }

        if (!correoValido) {
            correoInput.classList.add('is-invalid');
            document.getElementById('error-correo').style.display = 'block';
        } else {
            correoInput.classList.remove('is-invalid');
            document.getElementById('error-correo').style.display = 'none';
        }

        // Retorna true si ambos campos son válidos, de lo contrario, retorna false para evitar el envío del formulario
        return celularValido && correoValido;
    }
</script> 

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Derechos de autor <strong><span>NiceAdmin</span></strong>. Todos los derechos reservados
        </div>
        <div class="credits">
            Diseñado por <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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