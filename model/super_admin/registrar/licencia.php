<?php

session_start();
require_once "../../../db/connection.php";
$db = new DataBase();
$con = $db->conectar();

if (isset($_POST["registrar"])) {

$digitos = "sakur02ue859y2u389rhdewirh102385y1285013289";
$longitud = 20;
$licencia = substr(str_shuffle($digitos), 0, $longitud);

date_default_timezone_set("America/Mexico_City");
$fecha_ini = date('Y-m-d');
$fecha_fin = date("Y-m-d", strtotime($fecha_ini . " + 1 year"));
$id_estado = 1;

    $nit = $_POST['nit'];

    // Verifica si hay datos vacíos
    if (empty($nit)) {
        echo '<script>alert("Por favor seleccione la empresa");</script>';
    } else {
        // Comprueba si la licencia ya existe
        $sql = $con->prepare("SELECT * FROM licencia WHERE nit = $nit");
        $sql->execute();
        $fila = $sql->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            echo '<script>alert("Esta empresa ya tiene una licencia");</script>';
            echo '<script>window.location="../read_licencia.php";</script>';
        } else {
            // Inserta la nueva licencia
            $insertSQL = $con->prepare("INSERT INTO licencia(licencia, nit, fecha_ini, fecha_fin, id_estado) VALUES ('$licencia', $nit, '$fecha_ini', '$fecha_fin', $id_estado)");
            $insertSQL->execute();
            
            echo '<script>alert("REGISTRO EXITOSO");</script>';
            echo '<script>window.location="../read_licencia.php";</script>';

        }
    }
}
?>
