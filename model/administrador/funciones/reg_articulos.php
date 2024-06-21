<?php
require_once("../../../db/connection.php");
require_once '../../../vendor/autoload.php';
use Picqer\Barcode\BarcodeGeneratorPNG;

$db = new Database();
$con = $db->conectar();

if (isset($_POST["registrar"])) {
    $id_tipo_art = $_POST['id_tipo_art'];
    $nombre_A = $_POST['nombre_A'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $valor = $_POST['valor'];
    $id_estado = 1;

    // Validación de campos vacíos
    if ($id_tipo_art=="" || $nombre_A=="" || $descripcion=="" || $cantidad=="" || $valor=="") {
        echo '<script>alert("EXISTEN DATOS VACIOS");</script>';
        echo '<script>window.location="arti.php"</script>';
    }
     else if ($cantidad <= 0 || $valor <= 0) {
        echo '<script>alert("CANTIDAD Y VALOR DEBEN SER MAYORES A 0");</script>';
        echo '<script>window.location="arti.php"</script>';
    }
     else {
        $sql = $con->prepare("SELECT * FROM articulos WHERE nombre_A = '$nombre_A'");
        $sql->execute();
        $fila = $sql->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            echo '<script>alert("ESTE ARTICULO YA EXISTE //CAMBIELO//");</script>';
            echo '<script>window.location="arti.php"</script>';
        } else {

            $codigo_barra = uniqid() . rand(1000, 9999);
            $generator = new BarcodeGeneratorPNG();
            $codigo_barras_imagen = $generator->getBarcode($codigo_barra, $generator::TYPE_CODE_128);
            $ruta_imagen = '../../../imagenes/registradas/barcode/' . $codigo_barra . '.png';
            file_put_contents($ruta_imagen, $codigo_barras_imagen);

            // Inserción en la base de datos
            $insertSQL = $con->prepare("INSERT INTO articulos (nombre_A, id_tipo_art, id_estado, descripcion, cantidad, valor, barcode) VALUES ('$nombre_A', $id_tipo_art, $id_estado, '$descripcion', $cantidad, $valor, '$ruta_imagen')");

            if ($insertSQL->execute()) {
                echo '<script>alert("REGISTRO EXITOSO");</script>';
                echo '<script>window.location="arti.php"</script>';
            } else {
                echo '<script>alert("ERROR EN EL REGISTRO");</script>';
                echo '<script>window.location="arti.php"</script>';
            }
        }
    }
}