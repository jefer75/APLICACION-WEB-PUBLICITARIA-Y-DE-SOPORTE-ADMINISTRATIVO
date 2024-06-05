<?php
    session_start();
    require_once ("../../../db/connection.php");
    //include("../../../controller/validar_licencia.php");
    $db = new DataBase();
    $con = $db -> conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    
    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../../css/style.css" rel="stylesheet">
    <link href="../../../css/login.css" rel="stylesheet">
    <style>
       body {
        background-color: #fff; /* Fondo blanco */
    }

    .container-xxl {
        background-color: lightblue; /* Fondo azul claro */
        padding: 20px; /* Añadir un poco de espacio interno */
        border-radius: 10px; /* Agregar bordes redondeados */
    }

    .bg-light {
        background-color: lightblue !important; /* Fondo azul claro */
    }

    .enlaces {
        color: blue !important; /* Color del texto azul */
    }
    .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>    
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded">
                <div class="row g-0">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="h-100 d-flex flex-column justify-content-center p-5 contenido">
                            <h1 class="mb-4">Iniciar Sesión</h1>
                            <form action="../../../controller/inicioS.php" method="POST" name="form1" id="myForm">
                                <div class="row g-3 inputs">
                                    <div class="col-sm-6 user">
                                        <div class="form-floating">
                                            <input type="text" class="form-control border-0" name="cedula" id="cedula" placeholder="Cedula">
                                            <label for="cedula">Cedula</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 user">
                                        <div class="form-floating">
                                            <input type="password" class="form-control border-0" id="password" placeholder="Contraseña" name="contrasena">
                                            <label for="password">Contraseña</label>
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

    <!-- Include JavaScript file -->
    <script src="../../../js/validacionS.js"></script>

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
