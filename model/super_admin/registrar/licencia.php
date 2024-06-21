<?php
session_start();
require_once("../../../db/connection.php");
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db->conectar();

// Verificar si el usuario ha iniciado sesión
$cedula = $_SESSION['cedula'];
if (!isset($_SESSION['cedula'])) {
    header("Location: ../inicio/logins.php");
    exit;
}

$digitos = "sakur02ue859y2u389rhdewirh102385y1285013289";
$longitud = 20;
$licencia = substr(str_shuffle($digitos), 0, $longitud);

date_default_timezone_set("America/Mexico_City");
$fecha_ini = date('Y-m-d');
$fecha_fin = date("Y-m-d", strtotime($fecha_ini . " + 1 year"));

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {
    $nit = $_POST['nit'];
    $id_estado = $_POST['id_estado'];

    // Verifica si hay datos vacíos
    if (empty($nit) || empty($fecha_ini) || empty($fecha_fin) || empty($id_estado)) {
        echo '<script>alert("EXISTEN DATOS VACIOS");</script>';
        echo '<script>window.location="licencia.php";</script>';
    } else {
        // Comprueba si la licencia ya existe
        $sql = $con->prepare("SELECT * FROM licencia WHERE licencia = :licencia");
        $sql->bindParam(':licencia', $licencia);
        $sql->execute();
        $fila = $sql->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            echo '<script>alert("DOCUMENTO YA EXISTE //CAMBIELO//");</script>';
            echo '<script>window.location="licencia.php";</script>';
        } else {
            // Inserta la nueva licencia
            $insertSQL = $con->prepare("INSERT INTO licencia (licencia, nit, fecha_ini, fecha_fin, id_estado) VALUES (:licencia, :nit, :fecha_ini, :fecha_fin, :id_estado)");
            $insertSQL->bindParam(':licencia', $licencia);
            $insertSQL->bindParam(':nit', $nit);
            $insertSQL->bindParam(':fecha_ini', $fecha_ini);
            $insertSQL->bindParam(':fecha_fin', $fecha_fin);
            $insertSQL->bindParam(':id_estado', $id_estado);

            if ($insertSQL->execute()) {
                echo '<script>alert("REGISTRO EXITOSO");</script>';
                echo '<script>window.location="../consultar/read_licencia.php";</script>';
            } else {
                echo '<script>alert("ERROR EN EL REGISTRO");</script>';
                echo '<script>window.location="licencia.php";</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Registrar Licencia</title>
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

    <h2 class="card-title" style="font-family: 'Arial Rounded MT Bold', sans-serif; text-align: center; margin-top: 20px;">Registrar Licencia</h2>
    <div class="col-lg-6" style="margin-top: 20px; margin-left: auto; margin-right: auto;">
        <div class="container" style="text-align: center;">
            <div class="card">
                <div class="card-body">
                    <form method="post" name="formreg" id="formreg" class="signup-form" autocomplete="off">
                        <label class="form-label" for="licencia">Licencia</label>
                        <br>
                        <input class="form-control" type="text" name="licencia" value="<?php echo $licencia; ?>" readonly>
                        <br>
                        <label class="form-label" for="nit">Empresa</label>
                        <br>
                        <select class="form-control" name="nit" required>
                            <option value="">Seleccione Empresa</option>
                            <?php
                            $control = $con->prepare("SELECT * FROM empresa");
                            $control->execute();
                            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=" . $fila['nit'] . ">" . $fila['nombre_emp'] . "</option>";
                            }
                            ?>
                        </select>
                        <br>
                        <label class="form-label" for="fecha_ini">Fecha Inicio</label>
                        <br>
                        <input class="form-control" type="date" name="fecha_ini" value="<?php echo $fecha_ini; ?>" readonly>
                        <br>
                        <label class="form-label" for="fecha_fin">Fecha Fin</label>
                        <br>
                        <input class="form-control" type="date" name="fecha_fin" value="<?php echo $fecha_fin; ?>" required>
                        <br>
                        <label class="form-label" for="id_estado">Estado</label>
                        <br>
                        <select class="form-control" name="id_estado" required>
                            <option value="">Seleccione el estado</option>
                            <?php
                            $control = $con->prepare("SELECT * FROM estados WHERE id_estado <= 2");
                            $control->execute();
                            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=" . $fila['id_estado'] . ">" . $fila['estado'] . "</option>";
                            }
                            ?>
                        </select>
                        <br>
                        <input type="submit" name="validar" value="Registro" style="background-color: blue; color: white; border: none; padding: 8px 16px; border-radius: 5px;">
                        <input type="hidden" name="MM_insert" value="formreg">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
