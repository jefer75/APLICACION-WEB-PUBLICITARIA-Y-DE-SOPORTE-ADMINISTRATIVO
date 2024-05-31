
<?php
    session_start();
    require_once("db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $nombre= $_POST['nombre'];
    $apellido= $_POST['apellido'];
    $nombre_comp = $nombre . " " . $apellido;
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
        
        $insertSQL = $con->prepare("INSERT INTO usuarios(cedula, nombre, celular, contrasena, correo, id_tipo_user, id_estado, nit) VALUES('$cedula', '$nombre_comp', '$celular', '$pass_cifrado', '$correo', '$tipo_user', '$id_estado', '$nit')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="index.php"</script>';
     }  
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contactanos</title>
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
                    <a href="index.php" class="nav-item nav-link">Inicio</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Recreación</a>
                        <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                            <a href="infantil.php" class="dropdown-item">Infantil</a>
                            <a href="adultos.php" class="dropdown-item">Adultos</a>
                        </div>
                    </div>

                    <a href="decoracion.php" class="nav-item nav-link">Decoración</a>
                    <a href="sobre_nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>                    
                    <a href="contact.php" class="nav-item nav-link active">Contáctanos</a>
                </div>
                <a href="model/administrador/inicio/login.php" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Iniciar Sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Page Header End -->
        <div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Contactanos</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                  
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


       
        <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
        <!-- Appointment Start -->
        <div class="container-xxl py-5" id="registrate">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4">Regístrate</h1>
                                <p>Regístrate para conocer más acerca de los paquetes y hacer tu reservación</p>
                            
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                
                                            <input class="form-control border-0" type="text" name="nombre" id="nombres" pattern="[a-zA-Z\s]{1,18}" title="Solo se permiten letras, máximo 18 caracteres" placeholder="Digite Nombre" >

                                            <label for="nombres">Nombres</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                  <input class="form-control border-0" type="text" name="apellido" id="apellidos" placeholder="Apellidos" pattern="[a-zA-Z\s]{1,18}" title="Solo se permiten letras, máximo 18 caracteres">
                                                  <label for="apellidos">Apellidos</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                 <input class="form-control border-0" type="text" name="cedula" id="documento" pattern="[0-9]{8,10}" title="Solo se permiten números, mínimo 8 dígitos" placeholder="Digite Documento">
                                                <label for="documento">N° Documento</label>
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                
                                                <input class="form-control border-0"   type="text" name="celular" id="telefono" pattern="[0-9]{7,15}" title="Solo se permiten numeros, minimo 10 digitos" placeholder="Digite Telefono" >
                                                <label for="cname">Contacto</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input  class="form-control border-0"  type="email" name="correo" id="correo" maxlength="23"  placeholder="Digite Correo" >
                                                <label for="cage">Correo</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                 <input class="form-control border-0" pattern="[a-zA-Z0-9]{8,11}" title="La contraseña debe tener entre 8 y 11 caracteres alfanuméricos" type="password" name="contrasena" placeholder="Contraseña" >
                                                <label for="fecha">Contraseña</label>
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
                                <img class="position-absolute w-100 h-100 rounded" src="imagenes/contenido/img19.jpg" style="object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </form>
        <!-- Contact End -->


  
        <!-- Footer Start -->
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
                        <h3 class="text-white mb-4">Acceso Rapido</h3>
                        <a class="btn btn-link text-white-50" href="#header">Inicio</a>
                        <a class="btn btn-link text-white-50" href="">Recreacion Infantil</a>
                        <a class="btn btn-link text-white-50" href="">Recreacion Adultos</a>
                        <a class="btn btn-link text-white-50" href="">Decoracion</a>
                        <a class="btn btn-link text-white-50" href="sobre_n.html">Sobre Nosotros</a>
                        <a class="btn btn-link text-white-50" href="contact.html">Contactanos</a>
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
                        <p>Danos tu opinion sobre nuestro servicio o nuestro sitio web.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Danos tu opnion">
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
                            &copy; <a class="border-bottom" href="#">Arlequin Eventos</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://htmlcodex.com">Elitech JYDT</a>
                            <br>Distributed By: <a class="border-bottom" href="https://themewagon.com" target="_blank">Elitech JYDT</a>
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