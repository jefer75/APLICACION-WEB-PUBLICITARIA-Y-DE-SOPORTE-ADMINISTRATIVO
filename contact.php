<<<<<<< HEAD
<?php
    session_start();
    require_once("db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $nombre= $_POST['nombre'];
    $cedula= $_POST['cedula'];
    $celular= $_POST['celular'];
    $contrasena= $_POST['contrasena'];
    $correo= $_POST['correo'];
    $tipo_user= 2;
    $id_estado= 1;
    $nit= 123456789; 

     $sql= $con -> prepare ("SELECT * FROM usuarios WHERE cedula='$cedula'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("DOCUMENTO YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="index.php"</script>';
     }

     else
   
     if ($cedula=="" || $nombre=="" || $correo=="" || $celular=="" || $contrasena=="" || $tipo_user=="" || $id_estado=="" || $nit=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="index.php"</script>';
      }
      
      else{

        $pass_cifrado = password_hash($contrasena,PASSWORD_DEFAULT, array("pass"=>12));
        
        $insertSQL = $con->prepare("INSERT INTO usuarios(cedula, nombre, celular, contrasena, correo, id_tipo_user, id_estado, nit) VALUES('$cedula', '$nombre', '$celular', '$pass_cifrado', '$correo', '$tipo_user', '$id_estado', '$nit')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="index.php"</script>';
     }  
    }
    ?>
=======
>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
<<<<<<< HEAD
    <title>Contactanos</title>
=======
    <title>Recreación Adultos</title>
>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

<<<<<<< HEAD
    <!-- Favicon -->
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
     <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
=======
<<<<<<<< HEAD:adultos.html
     <!-- Favicon -->
     <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
     <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
========
    <!-- Favicon -->
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
>>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f:contact.php
>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f

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
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
            <img src="imagenes/logos/Logo Arlequin Color.png" class="logo">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
<<<<<<< HEAD
                    <a href="index.php" class="nav-item nav-link active">Inicio</a>
=======
<<<<<<<< HEAD:adultos.html
                    <a href="index.php" class="nav-item nav-link active">Inicio</a>
========
                    <a href="index.php" class="nav-item nav-link">Inicio</a>
>>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f:contact.php
>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Recreación</a>
                        <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
<<<<<<< HEAD
=======
<<<<<<<< HEAD:adultos.html
>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f
                            <a href="infantil.html" class="dropdown-item">Infantil</a>
                            <a href="adultos.html" class="dropdown-item">Adultos</a>
                        </div>
                    </div>

                    <a href="decoracion.html" class="nav-item nav-link">Decoración</a>
                    <a href="sobre_nosotros.html" class="nav-item nav-link">Sobre Nosotros</a>                    
                    <a href="contact.php" class="nav-item nav-link">Contáctanos</a>
<<<<<<< HEAD
=======
========
                            <a href="infantil.php" class="dropdown-item">Infantil</a>
                            <a href="adultos.php" class="dropdown-item">Adultos</a>
                        </div>
                    </div>

                    <a href="decoracion.php" class="nav-item nav-link">Decoración</a>
                    <a href="sobre_nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>                    
                    <a href="contact.php" class="nav-item nav-link active">Contáctanos</a>
>>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f:contact.php
>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f
                </div>
                <a href="model/administrador/inicio/login.php" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Iniciar Sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Page Header End -->
        <div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
<<<<<<< HEAD
                <h1 class="display-2 text-white animated slideInDown mb-4">Contáctanos</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                  
=======
                <h1 class="display-2 text-white animated slideInDown mb-4">Recreación para Adultos</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                       
                        <li class="breadcrumb-item text-white active" aria-current="page">Experiencias recreativas exclusivas para adultos: diversión y relajación en un solo lugar.</li>
                    </ol>
>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


<<<<<<< HEAD
        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Contáctanos</h1>
                    <p>Estamos ubicados en La ciudad de Ibagué, en el departamento del Tolima, sin embargo, realizamos eventos en todos los municipios del Tolima, además de Girardot-Cundinamarca.</p>
                </div>
                <div class="row g-4 mb-5">
                    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <i class="fa fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <h6>Urbanizacion Anda Lucia Real, Barrio las Margaritas, Ibagué-Tolima</h6>
                    </div>
                    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <i class="fa fa-envelope-open fa-2x text-primary"></i>
                        </div>
                        <h6>Arlequin_Eventos@gmail.com</h6>
                    </div>
                    <div class="col-md-6 col-lg-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 75px; height: 75px;">
                            <i class="fa fa-phone-alt fa-2x text-primary"></i>
                        </div>
                        <h6>3157418168 - 3187808830</h6>
                    </div>
                </div>

                <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
                    <!-- Appointment Start -->
                    <div class="container-xxl py-5" id="registrate">
                        <div class="container">
                            <div class="bg-light rounded">
                                <div class="row g-0">
                                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                        <div class="h-100 d-flex flex-column justify-content-center p-5">
                                            <h1 class="mb-4">Regístrate</h1>
                                            <p class="mb-4">Al llenar el siguiente formulario, estarias creando tu propio perfil en nuestro sitio web, por lo que si deseas reservar un evento, podras ingresar con tu usario y contraseña y reservarlo desde nuestro sitio web.</p>
                                        
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <div class="form-floating">
                                                            
                                                            <input  class="form-control border-0" type="text" name="nombre" id="nombres" pattern="[a-zA-Z/s]+{1,40}" title="Solo se permiten letras" placeholder="Digite Nombre">
                                                            <label for="gname">Nombre completo</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-floating">
                                                
                                                            <input class="form-control border-0"  type="number" name="cedula" id="documento" pattern="[0-9]{1,15}" title="Solo se permiten numeros" placeholder="Digite Documento">
                                                            <label for="cedula">N° Documento</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-floating">
                                                            
                                                            <input class="form-control border-0"   type="number" name="celular" id="telefono" pattern="[0-9]{1,15}" title="Solo se permiten numeros" placeholder="Digite Telefono">
                                                            <label for="cname">Telefono de Contacto</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-floating">
                                                            <input  class="form-control border-0"  type="email" name="correo" id="correo" placeholder="Digite Correo">
                                                            <label for="cage">Correo</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-floating">
                                                            <input class="form-control border-0"   type="password" name="contrasena" placeholder="Contraseña">
                                                            <label for="fecha">Contraseña</label>
                                                        </div>
                                                    </div>
            
                                                        <div class="col-sm-6">
                                                        <div class="form-floating">
                                                            <label  for="nit"></label>
            
                                                            <?php   
                         
                                                            $query = $con -> prepare("SELECT * FROM empresa where nit=123456789");
                                                            $query -> execute ();
                                                            $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);
            
                                                            foreach ($resultados as $fila1){
                                                    ?>
            
                                                <input class="form-control border-0" type="varchar" name="nombre_emp" value="<?php echo $fila1['nombre_emp']?>" readonly>
                                                        
            
                                                        <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
            
            
                                                    
                                                    <div class="col-12">
                                                        
                                                        <input class="btn btn-primary w-100 py-3"   type="submit" name="registrarse" value="Registro">
                                                        <input   type="hidden" name="MM_insert" value="formreg">
                                                    </div>
                                                </div>
                                           
                                        </div>
                                    </div>
                                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                                        <div class="position-relative h-100">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1988.9144383679056!2d-75.18760232341391!3d4.442929272459184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e38c50fb2ddff45%3A0x59199eb4e87be4fd!2sUrbanizaci%C3%B3n%20Andalucia%20Real!5e0!3m2!1ses!2sco!4v1711054122223!5m2!1ses!2sco" width="550" height="610" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
             </form>
                               
        <!-- Contact End -->


  
        <!-- Footer Start -->
=======
        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="mb-4">Bienvenidos</h1>
                        <p class="mb-4">Sumérgete en la emoción y la camaradería con Arlequin Eventos, donde te esperan una variedad de actividades diseñadas para sacar tu lado más aventurero. Desde desafiantes juegos de equipo que pondrán a prueba tu colaboración y coordinación, hasta competencias deportivas llenas de adrenalina y diversión, en nuestro espacio encontrarás la combinación perfecta entre emoción y entretenimiento para disfrutar en grupo.</p>
                        <div class="row g-4 align-items-center">
                            <div class="col-sm-6">
                                <a class="btn btn-primary rounded-pill py-3 px-5" href="about.html">Descubre más</a>
                            </div>
                            
                        </div>
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
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="imagenes/contenido/img83.jpeg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call To Action End -->


>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f
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
<<<<<<< HEAD
                    <h3 class="text-white mb-4">Acceso Rápido</h3>
=======
                        <h3 class="text-white mb-4">Acceso Rápido</h3>
>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f
                        <a class="btn btn-link text-white-50" href="index.php">Inicio</a>
                        <a class="btn btn-link text-white-50" href="infantil.html">Recreación Infantil</a>
                        <a class="btn btn-link text-white-50" href="adultos.html">Recreación Adultos</a>
                        <a class="btn btn-link text-white-50" href="decoracion.html">Decoración</a>
                        <a class="btn btn-link text-white-50" href="sobre_nosotros.html">Sobre Nosotros</a>
<<<<<<< HEAD
                        <a class="btn btn-link text-white-50" href="contact.php">Contáctanos</a>
=======
                        <a class="btn btn-link text-white-50" href="contact.html">Contáctanos</a>
>>>>>>> caa5871939e387c85e83b6bcc44d2640299dda2f
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
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Nuevo Comentario</h3>
                        <p>Danos tu opinión sobre nuestro servicio o nuestro sitio web.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Danos tu opnión">
                            <br>
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Enviar</button>
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