<?php
session_start();
require_once "../../db/connection.php";
//include("../../../controller/validar_licencia.php");
$db = new DataBase();
$con = $db->conectar();

$cedula = $_SESSION['cedula'];
if (!isset($cedula)){
  //include("../../../controller/validar_licencia.php");
  echo '<script>alert("No has iniciado sesion");</script>';
  header("Location: ../administrador/inicio/login.php");
  }

$con_nombre = $con->prepare("SELECT * FROM usuarios WHERE cedula = $cedula");
$con_nombre->execute();
$nombres = $con_nombre->fetchAll(PDO::FETCH_ASSOC);
foreach ($nombres as $fila) {
    $nombre = $fila['nombre'];
}

if(isset($_POST['cerrar']))
{
    session_destroy();


    header('location:../../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  
  <meta content="" name="description">
  <meta content="" name="keywords">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Favicons -->
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
  <link href="../administrador/pages/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../administrador/pages/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../administrador/pages/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../administrador/pages/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../administrador/pages/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../administrador/pages/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../administrador/pages/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../administrador/pages/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/tablas.css">

  <!-- Template Main CSS File -->
  <link href="../administrador/pages/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    aside .cerrar{
      background-color: transparent;
      border: 0;
      margin: 0;
      padding: 0;
      font-weight: bold;
      color: #012970;
    }
    header .cerrar{
      background-color: transparent;
      border: 0;
      margin: 0;
      padding: 0;
    }
    
  </style>
</head>

<body>
  

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <img src="../../imagenes/logos/Logo Arlequin Color.png" class="logo_arlequin">
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

  

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $nombre ?></span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">

          <span>Empleado</span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="perfil.php">
            <i class="bi bi-person"></i>
            <span>Mi Perfil</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>


        <li>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <i class="bi bi-box-arrow-right"></i>
            <form method="POST">
                <span><input type="submit" class="cerrar" name="cerrar" value="Cerrar Sesion"></span>
              </form>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
      <i class="bi bi-grid"></i>
      <span>Inicio</span>
    </a>
  </li><!-- End Dashboard Nav -->
  
  <li class="nav-item">
    <a class="nav-link collapsed" href="registro_venta.php">
      <i class="bi bi-bookmark-plus-fill"></i>
      <span>Reservar</span>
    </a>
  </li><!-- End Contact Page Nav -->


  <li class="nav-item">
    <a class="nav-link collapsed" href="paquetes.php">
      <i class="bi bi-gift-fill"></i>
      <span>Paquetes</span>
    </a>
  </li><!-- End Contact Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="actividades.php">
      <i class="bi bi-bookmark-star-fill"></i>
      <span>actividades</span>
    </a>
  </li><!-- End Contact Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="completadas.php">
        <i class="bi bi-bookmark-check-fill"></i>
        <span>Eventos pasados</span>
      </a>
    </li><!-- End Register Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="perfil.php">
      <i class="bi bi-person-circle"></i>
      <span>Perfil</span>
    </a>
  </li><!-- End Profile Page Nav -->


      <li class="nav-item">
          <a class="nav-link collapsed" href="#">
              <i class="bi bi-box-arrow-right"></i>
              <form method="POST">
                <span><input type="submit" class="cerrar" name="cerrar" value="Cerrar Sesion"></span>
              </form>
              
            </a>
        </li><!-- End Blank Page Nav -->

        
</ul>

</aside><!-- End Sidebar-->