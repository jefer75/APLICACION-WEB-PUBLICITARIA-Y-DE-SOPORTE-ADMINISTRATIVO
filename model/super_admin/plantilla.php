<?php
session_start();
require_once "../../db/connection.php";
$db = new DataBase();
$con = $db->conectar();

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
    <style>
        .cerrar_sesion
        {
            text-decoration: none;
            border: 0;
            padding: 0;
            background-color: transparent;
            color: var(--black-light-color);
            font-size: 18px;
            font-weight: 400;
        }
    </style>
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
                    <form method="POST">
                        <span class="link-name"><input type="submit" class="cerrar_sesion" name="cerrar_sesion" value="Cerrar Sesion"></span>
                    </form>
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
    
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            
            <div>
                <h2><?php echo $nombre ?></h2>
            </div>
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        
    <script src="admin.js"></script>