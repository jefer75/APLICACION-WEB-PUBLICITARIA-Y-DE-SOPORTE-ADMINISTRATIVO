<?php

require_once("db/connection.php");
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db -> conectar();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Recreación Infantil</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

     <!-- Favicon -->
     <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
     <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/infantil.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">

        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
            <img src="imagenes/logos/Logo Arlequin Color.png" class="logo">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                <a href="index.php" class="nav-item nav-link">Inicio</a>
                    <a href="infantil.php" class="nav-item nav-link active">Recreacion</a>
                    <a href="decoracion.php" class="nav-item nav-link">Decoración</a>
                    <a href="sobre_nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>                    
                    <a href="contact.php" class="nav-item nav-link">Contáctanos</a>
                </div>
                <a href="model/administrador/inicio/login.php" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Iniciar Sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Page Header End -->
        <div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Recreación Infantil</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                       
                        <li class="breadcrumb-item text-white active" aria-current="page">Aquí, cada risa cuenta una historia y cada juego es una nueva aventura esperando a ser descubierta.</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Bienvenidos</h1>
                    <p>Arlequín Eventos se destaca por poner la diversión y la alegría en el centro de cada evento infantil que organiza. A través de una variedad de actividades emocionantes y seguras, como juegos al aire libre y desafíos creativos en grupo, se asegura de crear experiencias inolvidables para los niños. Su equipo de animadores capacitados no solo estimula la imaginación de los pequeños, sino que también promueve la cooperación y garantiza momentos de risas y entretenimiento en un ambiente seguro y supervisado. Cada evento se convierte en una aventura mágica que deja recuerdos duraderos en los niños y sus familias.</p>
                </div>
            </div>
        </div>

        <div class="cuadro">
            
        <div class="info">
            <?php
                       $actividades = $con->prepare("SELECT * FROM actividades");
                       $actividades->execute();
                       $actividades = $actividades->fetchAll(PDO::FETCH_ASSOC);
                       foreach ($actividades as $fila) {
                       
                        $nombre = $fila['nombre'];
                        $descripcion = $fila['descripcion'];
                        $imagen = $fila['imagen'];
                       
                    ?>

            <div class="con">
               <div class="img">
               <img src="model/administrador/inicio/<?php echo $imagen?>">
               </div>
               <div class="top-text">
                    <h3><?php echo $nombre?></h3>
                
               </div>
               <div class="bottom-text">
                  <div class="text">
                  <p><?php echo $descripcion?></p>
                  </div>
                  <div class="btn">
                     <a href="model/administrador/inicio/login.php">Conoce más</a>
                  </div>
               </div>
            </div>
            <?php
              }
            ?>
         </div>
    
        </div>

        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        
                        <p class="mb-4">Sumérgete en la emoción y la camaradería con Arlequin Eventos, donde te esperan una variedad de actividades diseñadas para sacar tu lado más aventurero. Desde desafiantes juegos de equipo que pondrán a prueba tu colaboración y coordinación, hasta competencias deportivas llenas de adrenalina y diversión, en nuestro espacio encontrarás la combinación perfecta entre emoción y entretenimiento para disfrutar en grupo.</p>
                        
                    </div>
                    <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img class="img-fluid w-75 rounded-circle bg-light p-3" src="imagenes/contenido/img115.jpg" alt="">
                            </div>
                            <div class="col-6 text-start" style="margin-top: -150px;">
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="imagenes/contenido/img77.jpeg" alt="">
                            </div>
                            <div class="col-6 text-end" style="margin-top: -150px;">
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="imagenes/contenido/img144.jpeg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        <!-- fin recre -->

        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Donde estamos?</h3>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Urbanizacion Anda Lucia Real</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>3157418168-3187808830</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>Arlequin_Eventos@gmail.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/arlequin.ibague?mibextid=ZbWKwL "><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.tiktok.com/@arlequineventos?_t=8hBmHctGkvG&_r=1>"><i class="fab fa-tik-tok"></i>TK</a>
                            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/arlequin.ibague?mibextid=ZbWKwL"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Acceso Rápido</h3>
                        <a class="btn btn-link text-white-50" href="index.php">Inicio</a>
                        <a class="btn btn-link text-white-50" href="infantil.php">Recreación Infantil</a>
                        <a class="btn btn-link text-white-50" href="adultos.php">Recreación Adultos</a>
                        <a class="btn btn-link text-white-50" href="decoracion.php">Decoración</a>
                        <a class="btn btn-link text-white-50" href="sobre_nosotros.php">Sobre Nosotros</a>
                        <a class="btn btn-link text-white-50" href="contact.php">Contáctanos</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Galeria de Fotos</h3>
                        <div class="row g-2 pt-2">
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="imagenes/contenido/img20.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="imagenes/contenido/img10.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="imagenes/contenido/img26.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="imagenes/contenido/img30.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="imagenes/contenido/img34.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="imagenes/contenido/img14.jpg" alt="">
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="index.php">Arlequin Eventos</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="">Elitech JYDT</a>
                            <br>Distributed By: <a class="border-bottom" href="" target="_blank">Elitech JYDT</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>