
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
    <title>Arlequin Eventos</title>
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
                    <a href="index.php" class="nav-item nav-link active">Inicio</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Recreación</a>
                        <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                            <a href="infantil.php" class="dropdown-item">Infantil</a>
                            <a href="adultos.php" class="dropdown-item">Adultos</a>
                        </div>
                    </div>

                    <a href="decoracion.php" class="nav-item nav-link">Decoración</a>
                    <a href="sobre_nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>                    
                    <a href="contact.php" class="nav-item nav-link">Contáctanos</a>
                </div>
                <a href="model/administrador/inicio/login.php" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Iniciar Sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5" id="header">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="imagenes/slide/img2.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-2 text-white animated slideInDown mb-4">Arlequin Eventos</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">En Arlequín eventos, fusionamos la magia de la recreación, la emoción de la animación y la elegancia de la decoración para crear experiencias unicas y memorables.</p>
                                    <a href="#inicio" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Descubre</a>
                                    <a href="#registrate" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Registrate</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="imagenes/slide/img14.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(0, 0, 0, .2);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-2 text-white animated slideInDown mb-4">Arlequin Eventos</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Creemos que cada evento es una oportunidad para celebrar la vida y crear recuerdos duraderos. ¡Déjamos hacer brillar tu ocasión especial con nuestro toque mágico y creativo!</p>
                                    <a href="#inicio" class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Descubre</a>
                                    <a href="#registrate" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Registrate</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Facilities Start -->
        <div class="container-xxl py-5">
            <div class="container" id="inicio">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Bienvenidos</h1>
                    <p>Arlequin Eventos es una empresa dedicada al 100% a llevar felicidad a los hogares de nuestros clientes, valoramos el esfuerzo que hacen y por lo tanto damos nuestro mayor sacrificio por que todos los invitados pasen una buena experiencia con nosotros.</p>
                </div>
                <div class="row g-4">

                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="facility-item">
                            <div class="facility-icon bg-info">
                                <span class="bg-info"></span>
                                <i class="fa fa-futbol teacher fa-3x text-info"></i>
                                <span class="bg-info"></span>
                            </div>
                            <div class="facility-text bg-info">
                                <h3 class="text-info mb-3">Recreación infantil</h3>
                                <p class="mb-0">Son todas las dinámicas que realizamos con los niños para que ellos sean los que mas se divierten en su dia.</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="facility-item">
                            <div class="facility-icon bg-warning">
                                <span class="bg-warning"></span>
                                <i class="fa fa-home fa-3x text-warning"></i>
                                <span class="bg-warning"></span>
                            </div>
                            <div class="facility-text bg-warning">
                                <h3 class="text-warning mb-3 ">Recreación para adultos</h3>
                                <p class="mb-0">Son aquellas actividades en las que incluimos a los adultos para que haga parte de la diversión</p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="facility-item">
                            <div class="facility-icon bg-primary">
                                <span class="bg-primary"></span>
                                <i class="fa fa-bus-alt fa-3x text-primary"></i>
                                <span class="bg-primary"></span>
                            </div>
                            <div class="facility-text bg-primary">
                                <h3 class="text-primary mb-3 ">Decoración</h3>
                                <p class="mb-0">Nuestro equipo de trabajo esta especializado para decorar tu salón como tu desees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="facility-item">
                            <div class="facility-icon bg-success">
                                <span class="bg-success"></span>
                                <i class="fa fa-chalkboard fa-3x text-success"></i>
                                <span class="bg-success"></span>
                            </div>
                            <div class="facility-text bg-success">
                                
                                <h3 class="text-success mb-3">Logística</h3>
                                <p class="mb-0">El servicio de logística consiste en ayudarte a atender de una buena manera a los invitados.</p>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <!-- Facilities End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="mb-4">Aprende un poco más sobre nosotros.</h1>
                        <p class="mb-4">En Arlequin Eventos, nuestro enfoque está en diferentes servicios para que tu celebración sea muy especial, entre los cuales destaca la animación, la cual es indispensable para que se respire un aire de dirvesión y momentos felices, luego tenemos la recreación, que son todas las dinámicas que pueden hacer reir a carcajadas a tus invitados y por último pero no menos importante tenemos la  decoración, en la cual, vamos a dar nuestro mayor esfuerzo por que el ambiente no este solo en la animación y recreación sino que el lugar tambien transmita el mensaje de alegría y diversión que hara que el momento sea aún más especial.</p>
                        <div class="row g-4 align-items-center">
                            <div class="col-sm-6">
                                <a class="btn btn-primary rounded-pill py-3 px-5" href="sobre_nosotros.php">Descubre más</a>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="imagenes/logos/stephania.jpg" alt="" style="width: 45px; height: 45px;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1">Stephania Henao</h6>
                                        <small>Fundadora</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img class="img-fluid w-75 rounded-circle bg-light p-3" src="imagenes/contenido/img18.jpg" alt="">
                            </div>
                            <div class="col-6 text-start" style="margin-top: -150px;">
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="imagenes/contenido/img17.jpg" alt="">
                            </div>
                            <div class="col-6 text-end" style="margin-top: -150px;">
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="imagenes/contenido/img16.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Call To Action Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-100 h-100 rounded" src="imagenes/contenido/img52_.jpg" style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4">Únete a nuestro equipo</h1>
                                <p class="mb-4">Para ser parte de nuestro equipo es indispensable que estes dispuesto a aprender cosas nuevas, y arriesgarte a hacer cosas que probablemente nunca pensaste hacer, por lo que requerimos que seas un entusiasta de los niños
                                </p>
                                <a class="btn btn-primary py-3 px-5" href="">Únete a la familia Arlequin<i class="fa fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call To Action End -->


        <!-- Classes Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Actividades Disponibles</h1>
                    <p>Estas son solo algunas de las actividades más divertidas que podríamos realizar en tu celebración si decides confiar en Arlequin Eventos.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="imagenes/contenido/img27.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Recreación infantil</a>
                                
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Edad</h6>
                                            <small>1-10 años</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Cantidad Máxima</h6>
                                            <small>30 niños</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="imagenes/contenido/baby showe2.png" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Recreación Para Adultos</a>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Edad</h6>
                                            <small>15 años o más</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacidad</h6>
                                            <small>30 personas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="imagenes/contenido/img33.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Shows de payasitos</a>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Edad</h6>
                                            <small>3-10 años</small>
                                        </div>
                                    </div>                                    
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacidad</h6>
                                            <small>30 niños</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="imagenes/contenido/img18.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Gran Show de Magia</a>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Edad</h6>
                                            <small>3-12 años</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacidad</h6>
                                            <small>30 niños</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="imagenes/contenido/img21.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Gran Show de titeres</a>
                                
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Edad</h6>
                                            <small>3 años o más</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacidad</h6>
                                            <small>30 niños</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="imagenes/contenido/img39.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Gran Hora Loca</a>
                                
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Edad</h6>
                                            <small>No tiene restricción</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacidad</h6>
                                            <small>100 personas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Classes End -->

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
                                                
                                                <input  class="form-control border-0" type="text" name="nombre" id="nombres" pattern="[a-zA-Z/s]{3,40}" title="Solo se permiten letras, minimo 3 digitos" placeholder="Digite Nombre" required>
                                                <label for="gname">Nombres</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input class="form-control border-0" type="text" name="apellido" placeholder="Apellidos" pattern="[a-zA-Z/s]{3,40}" title="Solo se permiten letras, minimo 3 digitos" required>
                                                <label for="fecha">Apellidos</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                    
                                                <input class="form-control border-0"  type="text" name="cedula" id="documento" pattern="[0-9]{7,15}" title="Solo se permiten numeros, minimo 7 digitos" placeholder="Digite Documento" required>
                                                <label for="cedula">N° Documento</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                
                                                <input class="form-control border-0"   type="text" name="celular" id="telefono" pattern="[0-9]{7,15}" title="Solo se permiten numeros, minimo 10 digitos" placeholder="Digite Telefono" required>
                                                <label for="cname">Contacto</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input  class="form-control border-0"  type="email" name="correo" id="correo" placeholder="Digite Correo" required>
                                                <label for="cage">Correo</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input class="form-control border-0" pattern="[a-zA-Z0-9]{8,15}" title="La contraseña debe tener minimo 8 digitos" type="password" name="contrasena" placeholder="Contraseña" required>
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
        <!-- Appointment End -->


        <!-- Team Start -->
        
        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Estos son algunos de nuestros más fieles clientes</h1>
                    <p>Los siguientes comentarios los realizaron algunos de nuestros clientes mas recurrentes, los cuales nos ayudan no solo confiando en nostros como empresa, sino, también realizando críticas que nos ayudan a mejorar</p>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-item bg-light rounded p-5">
                        <p class="fs-5">Los mejores recreacionistas que hubiera podido elegir para la fiesta de mi hija, ya llevo contratano 2 años seguidos y no me han defraudado.</p>
                        <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-1.jpg" style="width: 90px; height: 90px;">
                            <div class="ps-3">
                                <h3 class="mb-1">Cliente anónimo</h3>
                            </div>
                            <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-5">
                        <p class="fs-5">Los conoci hace poco mas de dos años y he contratado varias veces con ustedes, nunca me han decepcionado</p>
                        <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-2.jpg" style="width: 90px; height: 90px;">
                            <div class="ps-3">
                                <h3 class="mb-1">Cliente anónimo</h3>
                            </div>
                            <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-5">
                        <p class="fs-5">Llevo 4 años contratando para los cumpleaños de mi hijo y siempre han hecho el mejor trabajo con mis invitados, me han dado muy buenas referencias de ellos y estoy muy agradecido.</p>
                        <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-3.jpg" style="width: 90px; height: 90px;">
                            <div class="ps-3">
                                <h3 class="mb-1">cliente anónimo</h3>
                            </div>
                            <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->


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
                        <h3 class="text-white mb-4">Acceso Rápido</h3>
                        <a class="btn btn-link text-white-50" href="#header">Inicio</a>
                        <a class="btn btn-link text-white-50" href="infantil.html">Recreación Infantil</a>
                        <a class="btn btn-link text-white-50" href="adultos.html">Recreación Adultos</a>
                        <a class="btn btn-link text-white-50" href="decoracion.html">Decoración</a>
                        <a class="btn btn-link text-white-50" href="sobre_nosotros.html">Sobre Nosotros</a>
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
                            &copy; <a class="border-bottom" href="#">Arlequin Eventos</a>, All Right Reserved. 
							
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