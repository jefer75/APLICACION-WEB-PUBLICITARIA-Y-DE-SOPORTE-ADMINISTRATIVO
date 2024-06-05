<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db->conectar();

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {
        $nit = $_POST['nit'];
        $nombre_emp = $_POST['nombre_emp'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        // Verifica si hay datos vacíos
        if (empty($nit) || empty($nombre_emp) || empty($telefono) || empty($direccion)) {
            echo '<script>alert("EXISTEN DATOS VACIOS");</script>';
            echo '<script>window.location="empresa.php";</script>';
        } else {
            // Usa parámetros en la consulta para prevenir SQL Injection
            $insertSQL = $con->prepare("INSERT INTO empresa (nit, nombre_emp, telefono, direccion) VALUES (:nit, :nombre_emp, :telefono, :direccion)");
            $insertSQL->bindParam(':nit', $nit);
            $insertSQL->bindParam(':nombre_emp', $nombre_emp);
            $insertSQL->bindParam(':telefono', $telefono);
            $insertSQL->bindParam(':direccion', $direccion);

            if ($insertSQL->execute()) {
                echo '<script>alert("REGISTRO EXITOSO");</script>';
                echo '<script>window.location="../consultar/read_empresa.php";</script>';
            } else {
                echo '<script>alert("ERROR EN EL REGISTRO");</script>';
                echo '<script>window.location="empresa.php";</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Registrar Empresa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../../css/style.css" rel="stylesheet">
</head>
<body style="background-color: white;">
    <a class="btn-regresar" href="../consultar/read_empresa.php" style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 15px; text-decoration: none; margin-top: 70px; margin-left: 10px;">Regresar</a>
    
    <h2 class="card-title" style="font-family: 'Arial Rounded MT Bold', sans-serif; text-align: center; margin-top: 20px;">Registrar Empresa</h2>
    <div class="col-lg-6" style="margin-top: 20px; margin-left: auto; margin-right: auto;">
        <div class="container" style="text-align: center;">
            <div class="card">
                <div class="card-body">
                    <br>
                    <form method="post" name="formreg" id="formreg" class="signup-form" autocomplete="off">
                        <label class="form-label" for="nit">NIT</label>
                        <br>
                        <input class="form-control" type="text" name="nit" placeholder="Digite el Nit" required>
                        <br>
                        <label class="form-label" for="nombre_emp">Nombre de la Empresa</label>
                        <br>
                        <input class="form-control" type="text" name="nombre_emp" placeholder="Nombre de empresa" required>
                        <br>
                        <label class="form-label" for="telefono">Teléfono</label>
                        <br>
                        <input class="form-control" type="text" name="telefono" placeholder="Digite el teléfono" required>
                        <br>
                        <label class="form-label" for="direccion">Dirección</label>
                        <br>
                        <input class="form-control" type="text" name="direccion" placeholder="Digite la dirección" required>
                        <br>
                        <div class="form-group">
                            <input type="submit" name="validar" value="Registro" style="background-color: blue; color: white; border: none; padding: 8px 16px; border-radius: 5px;">
                            <input type="hidden" name="MM_insert" value="formreg">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
