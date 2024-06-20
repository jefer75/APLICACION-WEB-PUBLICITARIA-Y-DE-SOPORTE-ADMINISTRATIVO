<?php
session_start();
require_once "../../db/connection.php";
//include("../../../controller/validar_licencia.php");
$db = new DataBase();
$con = $db->conectar();

$cedula = $_SESSION['cedula'];
if (!isset($cedula)){
  //include("../../../controller/validar_licencia.php");
  echo '<script>No has iniciado sesion</script>';
  header("Location: inicio/logins.php");
  }

$con_nombre = $con->prepare("SELECT * FROM usuarios WHERE cedula = $cedula");
$con_nombre->execute();
$nombres = $con_nombre->fetchAll(PDO::FETCH_ASSOC);
foreach ($nombres as $fila) {
    $nombre = $fila['nombre'];
}

$con_empleados = $con->prepare("SELECT * FROM usuarios WHERE id_tipo_user = 4");
$con_empleados->execute();
$nombres = $con_nombre->fetchAll(PDO::FETCH_ASSOC);
foreach ($nombres as $fila) {
    $nombre = $fila['nombre'];
}

?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/unicode-15/bw/512px/1f9d1-1f4bb.png">
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Unicons - Free Icons Library -->
    <title>ELITECH</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
               <img src="https://images.emojiterra.com/google/noto-emoji/unicode-15/bw/512px/1f9d1-1f4bb.png" alt="">
            </div>

            <span class="logo_name">ELITECH JYDT</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Inicio</span>
                </a></li>
                <li><a href="read_empresa.php">
                    <i class="uil uil-building"></i>
                    <span class="link-name">Empresa</span>
                </a></li>
                <li><a href="read_licencia.php">
                    <i class="uil uil-file-bookmark-alt"></i>
                    <span class="link-name">Licencia</span>
                </a></li>
                <li><a href="supera.php">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Super Administradores</span>
                </a></li>
                <li><a href="registrarAS.php">
                    <i class="uil uil-user-plus "></i>
                    <span class="link-name">Registro Admin</span>
                </a></li>
                
            </ul>
            
            <ul class="logout-mode">
                <li><a href="index.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Cerrar Sesión</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Modo Oscuro</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
        
    </nav>
    
    <script src="admin.js"></script>
    
</body>
</html>