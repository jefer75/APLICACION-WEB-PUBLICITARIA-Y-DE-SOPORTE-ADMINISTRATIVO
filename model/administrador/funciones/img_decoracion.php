<?php
require_once "../../../db/connection.php";
session_start();
$db = new DataBase();
$con = $db->conectar();

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $nombre = $_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];
    $datos = file_get_contents($_FILES['imagen']['tmp_name']);
    $tamaño = $_FILES['imagen']['size'];

    // Lista de tipos de archivos permitidos
    $tiposPermitidos = ['image/png', 'image/jpeg', 'image/jpg'];
    
    // Verificar el tamaño del archivo (5 MB)
    $maxTamaño = 5 * 1024 * 1024; // 5 MB

    if ($tamaño > $maxTamaño) {
        echo '<script>alert("El archivo es demasiado grande. El tamaño máximo permitido es de 5 MB.");</script>';
        echo '<script>window.location="../pages/decoracion.php"</script>';
    } elseif (in_array($tipo, $tiposPermitidos)) {
        // Preparar la declaración SQL
        $insert = $con->prepare("INSERT INTO decoracion (nombre, tipo, datos) VALUES (:nombre, :tipo, :datos)");
        // Enlazar los parámetros
        $insert->bindParam(':nombre', $nombre);
        $insert->bindParam(':tipo', $tipo);
        $insert->bindParam(':datos', $datos, PDO::PARAM_LOB);

        // Ejecutar la declaración
        if ($insert->execute()) {
            echo '<script>alert("Imagen subida correctamente");</script>';
            echo '<script>window.location="../pages/decoracion.php"</script>';
        } else {
            echo '<script>alert("Error al subir la imagen.");</script>';
            echo '<script>window.location="../pages/decoracion.php"</script>';
        }
    } else {
        echo '<script>alert("Tipo de archivo incompatible, solo se aceptan PNG, JPG y JPEG");</script>';
        echo '<script>window.location="../pages/decoracion.php"</script>';
    }
} else {
    echo '<script>alert("Error al subir imagen, por favor intente de nuevo");</script>';
    echo '<script>window.location="../pages/decoracion.php"</script>';
}
?>
