<?php
require_once("../db/connection.php");
$db = new Database();
$con = $db->conectar();
session_start();

$cedula = $_POST['cedula'];
$codigo = $_POST['codigo'];

if ($codigo == "") {
    echo '<script>alert("Por favor digite el código");</script>';
} else {
    // Consulta para verificar el código en la base de datos
    $sql = $con->prepare("SELECT * FROM usuarios WHERE token='$codigo'");
    $sql->execute();
    $fila = $sql->fetch(PDO::FETCH_ASSOC); // Usar fetch en lugar de fetchAll ya que esperamos una sola fila

    // Si se encuentra el código, almacenar la cédula en sesión y redirigir
    if ($fila) {
        $_SESSION['cedula'] = $cedula; // Almacenar la cédula en la sesión
        echo '<script>alert("Su código ha sido verificado correctamente");</script>';
        header("Location: ../model/super_admin/admin.php");
        exit;
    } else {
        // Si el código no coincide, mostrar una alerta y redirigir a la página de inicio de sesión
        echo '<script>alert("El código digitado no coincide con el código enviado");</script>';
        header("Location: ../model/super_admin/inicio/logins.php");
        exit;
    }
}
?>
