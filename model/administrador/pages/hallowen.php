
<?php
    session_start();
    require_once ("../../../db/connection.php");
    //include("../../../controller/validar_licencia.php");
    $db = new DataBase();
    $con = $db -> conectar();

    $cedula = $_SESSION['cedula'];
    $con_nombre = $con->prepare("SELECT * FROM usuarios WHERE cedula = $cedula");
    $con_nombre->execute();
    $nombres = $con_nombre->fetchAll(PDO::FETCH_ASSOC);
    foreach ($nombres as $fila) {
      $nombre = $fila['nombre'];
    }

    $con_empleados = $con->prepare("SELECT * FROM usuarios WHERE id_tipo_user = 3");
    $con_empleados->execute();
    $nombres = $con_nombre->fetchAll(PDO::FETCH_ASSOC);
    foreach ($nombres as $fila) {
      $nombre = $fila['nombre'];
    }
  
    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $nombre_A= $_POST['nombre_A'];
    $descripcion= $_POST['descripcion'];
    $id_tipo_art= $_POST['id_tipo_art'];
    $cantidad= $_POST['cantidad'];
    $valor= $_POST['valor'];

     $sql= $con -> prepare ("SELECT * FROM articulos WHERE nombre_A='$nombre_A'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("ESTE PAQUETE YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="luces.php"</script>';
     }

     else
   
     if ($nombre_A=="" || $descripcion=="" || $id_tipo_art=="" || $cantidad=="" || $valor=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="luces.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO `articulos`(`nombre_A`, `id_tipo_art`, `id_estado`, `descripcion`, `cantidad`, `valor`) VALUES('$nombre_A', '$id_tipo_art',3, '$descripcion', '$cantidad', '$valor')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="luces.php"</script>';
     }  
    }
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Articulos</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/tablas.css">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <img src="../../../imagenes/logos/Logo Arlequin Color.png" class="logo_arlequin">
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

    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <span class="badge bg-primary badge-number">4</span>
      </a><!-- End Notification Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
          You have 4 new notifications
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="notification-item">
          <i class="bi bi-exclamation-circle text-warning"></i>
          <div>
            <h4>Lorem Ipsum</h4>
            <p>Quae dolorem earum veritatis oditseno</p>
            <p>30 min. ago</p>
          </div>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="notification-item">
          <i class="bi bi-x-circle text-danger"></i>
          <div>
            <h4>Atque rerum nesciunt</h4>
            <p>Quae dolorem earum veritatis oditseno</p>
            <p>1 hr. ago</p>
          </div>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="notification-item">
          <i class="bi bi-check-circle text-success"></i>
          <div>
            <h4>Sit rerum fuga</h4>
            <p>Quae dolorem earum veritatis oditseno</p>
            <p>2 hrs. ago</p>
          </div>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="notification-item">
          <i class="bi bi-info-circle text-primary"></i>
          <div>
            <h4>Dicta reprehenderit</h4>
            <p>Quae dolorem earum veritatis oditseno</p>
            <p>4 hrs. ago</p>
          </div>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>
        <li class="dropdown-footer">
          <a href="#">Show all notifications</a>
        </li>

      </ul><!-- End Notification Dropdown Items -->

    </li><!-- End Notification Nav -->

    <li class="nav-item dropdown">

      <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-chat-left-text"></i>
        <span class="badge bg-success badge-number">3</span>
      </a><!-- End Messages Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
        <li class="dropdown-header">
          You have 3 new messages
          <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="message-item">
          <a href="#">
            <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
            <div>
              <h4>Maria Hudson</h4>
              <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
              <p>4 hrs. ago</p>
            </div>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="message-item">
          <a href="#">
            <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
            <div>
              <h4>Anna Nelson</h4>
              <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
              <p>6 hrs. ago</p>
            </div>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="message-item">
          <a href="#">
            <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
            <div>
              <h4>David Muldon</h4>
              <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
              <p>8 hrs. ago</p>
            </div>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
          <a href="#">Show all messages</a>
        </li>

      </ul><!-- End Messages Dropdown Items -->

    </li><!-- End Messages Nav -->

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $nombre ?></span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">

          <span>Administrador</span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-person"></i>
            <span>Mi Perfil</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-gear"></i>
            <span>Configuración</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
            <i class="bi bi-question-circle"></i>
            <span>Necesitas Ayuda?</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <i class="bi bi-box-arrow-right"></i>
            <span>Cerrar Sesión</span>
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
    <a class="nav-link collapsed" href="">
      <i class="bi bi-gift-fill"></i>
      <span>Paquetes</span>
    </a>
  </li><!-- End Contact Page Nav -->
  
  <li class="nav-item">
    <a class="nav-link collapsed" href="paquetes.php">
      <i class="bi bi-cart-plus"></i>
      <span>Compras</span>
    </a>
  </li><!-- End Contact Page Nav -->

  <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cash-coin"></i><span>Ventas</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="cumple.php">
              <i class="bi bi-circle"></i><span>Cumpleaños</span>
            </a>
          </li>
          <li>
            <a href="baby.php">
              <i class="bi bi-circle"></i><span>Baby Shower</span>
            </a>
          </li>
          <li>
            <a href="xv_anos.php">
              <i class="bi bi-circle"></i><span>XV Años</span>
            </a>
          </li>
          <li>
            <a href="comunion.php">
              <i class="bi bi-circle"></i><span>Primera Comunión</span>
            </a>
          </li>
          <li>
            <a href="matrimonio.php">
              <i class="bi bi-circle"></i><span>Matrimonio</span>
            </a>
          </li>
          <li>
            <a href="hallowen.php">
              <i class="bi bi-circle"></i><span>Hallowen</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-person"></i><span>Usuarios</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="forms-elements.html">
          <i class="bi bi-circle"></i><span>Administradores</span>
        </a>
      </li>
      <li>
        <a href="forms-elements.html">
          <i class="bi bi-circle"></i><span>Clientes</span>
        </a>
      </li>
      <li>
        <a href="forms-layouts.html">
          <i class="bi bi-circle"></i><span>Empleados</span>
        </a>
      </li>
    </ul>
  </li><!-- Fin seccion de usuarios -->

  <li class="nav-heading">Ayuda</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.html">
      <i class="bi bi-person-circle"></i>
      <span>Perfil</span>
    </a>
  </li><!-- End Profile Page Nav -->

  
  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-register.html">
      <i class="bi bi-people"></i>
      <span>Registrar</span>
    </a>
  </li><!-- End Register Page Nav -->
  
  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-faq.html">
      <i class="bi bi-question-circle"></i>
      <span>Ayuda</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-blank.html">
      <i class="bi bi-box-arrow-right"></i>
      <span>Cerrar Sesion</span>
    </a>
  </li><!-- End Blank Page Nav -->

</ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>ventas</h1>
      
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">halloween</h5>

              <a href="" class="añadir">Añadir</a>

<section class="modal ">
  <div class="modal__container">
      
      <a href="#" class="modal__close" id="cerrar">X</a>
      <h2 class="modal__title">Registrar paquete</h2>
      <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
        <!--Username -->
        <br>
        <label for="nombre_paquete">Nombre de paquete</label>
        <br>
        <input type="varchar" name="nombre_paquete" id="nombre_paquete" class="form_inputs" placeholder="Nombre de articulo">
        <br>
        <br>
        <select class="cont" name="id_tipo_art">
            <option value ="">Seleccione Tipo de paquete</option>
            
            <?php
                $control = $con -> prepare ("SELECT * from tipo_e");
                $control -> execute();
            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
            {
                echo "<option value=" . $fila['id_tipo_e'] . ">"
                . $fila['tipo_evento'] . "</option>";
            } 
            ?>
        </select>
     <br>           
        <br>
        <label for="lugar">lugar</label>
        <br>
        <input type="varchar" name="lugar" id="lugar" class="form_inputs" placeholder="descripcion de articulo">
        <br>
        <label for="cant_ninos">cantidad niños</label>
        <br>
        <input type="varchar" name="cant_ninos" id="cant_ninos" class="form_inputs" placeholder="descripcion de articulo">
        <br>
        <label for="hora_inicio">hora inicio</label>
        <br>
        <input type="varchar" name="hora_inicio" id="hora_inicio" class="form_inputs" placeholder="descripcion de articulo">
                        
        <br>
        <label for="contacto">contacto</label>
        <br>
        <input type="number" name="contacto" class="form_inputs" id="contacto" placeholder="Cantidad de articulo">
        <br>
        <label for="fecha">fecha de evento</label>
        <br>
        <input type="number" name="fecha" class="form_inputs" id="fecha" placeholder="Cantidad de articulo">
        <br>
        <label for="descripcion">descripcion</label>
        <br>
        <input type="number" name="descripcion" class="form_inputs" id="descripcion" placeholder="Cantidad de articulo">
        <br>
        <label for="valor_total">Valor</label>
        <br>
        <input type="number" name="valor_total" id="valor_total" class="form_inputs" placeholder="valor de articulo">

        <input type="submit" name="validar" value="Registro">
        <input type="hidden" name="MM_insert" value="formreg">
      </form>
    </div>
</section>

<!-- Table with stripped rows -->
<table class="table datatable">
  <thead>
    <tr>
    <th><b>paquetes</b></th>
      <th>lugar</th>
      <th>cantidad de niños</th>
      <th>hora inicio</th>
      <th>contacto</th>
      <th>fecha de evento</th>
      <th>descripcion</th>
      <th>valor</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
        $con_paquetes = $con->prepare("SELECT factura. id_factura,factura. fecha, eventos. id_paquetes, paquetes. nombre_paquete, eventos.lugar, eventos.cant_ninos, eventos.hora_inicio, eventos.contacto, factura.descripcion, factura.valor_total  FROM factura INNER JOIN eventos ON eventos.id_eventos = factura.id_eventos INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes WHERE id_tipo_e = 6");
        $con_paquetes->execute();
        $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($paquetes as $fila) {

            $nombre_paquete = $fila['nombre_paquete'];
          $lugar = $fila['lugar'];
          $cant_ninos = $fila['cant_ninos'];
          $hora_inicio = $fila['hora_inicio'];
          $contacto = $fila['contacto'];
          $fecha = $fila['fecha'];
          $descripcion = $fila['descripcion'];
          $valor_total = $fila['valor_total'];
          
      ?>
      
    <tr>
    <td><?php echo $nombre_paquete?></td>
      <td><?php echo $lugar?></td>
      <td><?php echo $cant_ninos?></td>
      <td><?php echo $hora_inicio?></td>
      <td><?php echo $contacto?></td>
      <td><?php echo $fecha?></td>
      <td><?php echo $descripcion?></td>
      <td><?php echo $valor_total?></td>
      <td><a href="" class="boton" onclick="window.open
       ('../actualizar y eliminar/articulos.php?id=<?php echo $id_articulo ?>','','width= 600,height=500, toolbar=NO');void(null);"><i class="bi bi-arrow-counterclockwise"></i></a></td>

    </tr>
      <?php
        }
      ?>
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../../js/modal.js"></script>
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