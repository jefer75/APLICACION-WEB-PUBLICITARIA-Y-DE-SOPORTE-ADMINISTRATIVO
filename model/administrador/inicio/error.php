<?php
session_start();
require_once ("../../../db/connection.php");
//include("../../../controller/validar_licencia.php");
$db = new DataBase();
$con = $db->conectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error al Iniciar Sesión</title>
    <!-- Favicon -->
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../../css/style.css" rel="stylesheet">
    <link href="../../../css/login.css" rel="stylesheet">
</head>
<body>
<?php
$nit = 123456789;
$sql = $con->prepare("SELECT * FROM licencia WHERE licencia != '' AND id_estado = 1 AND nit = ?");
$sql->execute([$nit]);
$fila = $sql->fetchAll(PDO::FETCH_ASSOC);

if ($fila) {
?>
<div class="container-xxl bg-white p-0">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
        <img src="../../../imagenes/logos/Logo Arlequin Color.png" class="logo">
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto">
                <a href="../../../index.php" class="nav-item nav-link ">Inicio</a>
                <a href="../../../infantil.php" class="nav-item nav-link">Recreacion</a>
                <a href="../../../decoracion.php" class="nav-item nav-link">Decoración</a>
                <a href="../../../sobre_nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>
                <a href="../../../contact.php" class="nav-item nav-link">Contáctanos</a>
            </div>
            <form action="" method="POST">
                <div class="contenido">
                    <input class="btn btn-primary rounded-pill px-3 d-none d-lg-block" type="submit" value="regresar" name="regresar" id="regresar">
                </div>
            </form>
        </div>
    </nav>
    <!-- Navbar End -->

    <?php 
    if (isset($_POST['regresar'])) {
        header('Location: login.php');
        exit();
    }
    ?>

    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded">
                <div class="row g-0">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="h-100 d-flex flex-column justify-content-center p-5 contenido">
                            <h1 class="mb-4">Error al Iniciar Sesión</h1>
                            <p>Documento o contraseña incorrectos</p>
                            <form action="../../../controller/inicio.php" method="POST" name="form1" onsubmit="return validarFormulario()">
                                <div class="row g-3 inputs">
                                    <div class="col-sm-6 user">
                                        <div class="form-floating">
                                            <input type="text" class="form-control border-0" name="cedula" id="cedula" placeholder="Cédula">
                                            <label for="cedula">Cédula</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 user">
                                        <div class="form-floating">
                                            <input type="password" class="form-control border-0" id="contrasena" placeholder="Contraseña" name="contrasena">
                                            <label for="contrasena">Contraseña</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" name="inicio" class="btn btn-primary w-100 py-3 ingresar">Ingresar</button>
                                        <a href="recuperar_con.php" class="enlaces" id="contra">Olvide la contraseña</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100 rounded" src="../../../imagenes/contenido/img23.jpg" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
</div>

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

<!-- Custom JS File -->
<script src="../../../js/validaciones.js"></script>

</body>
</html>

<?php
} else {
    header("Location: ../../../index.php");
    exit();
}
?>