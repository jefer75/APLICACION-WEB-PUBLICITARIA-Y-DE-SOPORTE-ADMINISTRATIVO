<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../../css/style.css" rel="stylesheet">
    <link href="../../../css/recuperar_con.css" rel="stylesheet">

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container-xxl bg-white p-0">

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
    <img src="../../../imagenes/logos/Logo Arlequin Color.png" class="logo">
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto">
            <a href="../../../index.php" class="nav-item nav-link active">Inicio</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Recreación</a>
                <div class="dropdown-menu rounded-0 rounded-bottom border-0 shadow-sm m-0">
                    <a href="../../../infantil.php" class="dropdown-item">Infantil</a>
                    <a href="../../../adultos.php" class="dropdown-item">Adultos</a>
                </div>
            </div>

            <a href="../../../decoracion.php" class="nav-item nav-link">Decoración</a>
            <a href="../../../sobre_nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>                    
            <a href="../../../contact.php" class="nav-item nav-link">Contáctanos</a>
        </div>
        <form action="" method="POST">
            <div class="contenido">
                <input class="btn btn-primary rounded-pill px-3 d-none d-lg-block" type="submit" value="Regresar" name="regresar" id="regresar">
            </div>
        </form>
    </div>
</nav>
<!-- Navbar End -->

<div class="container-xxl py-5">
    <div class="bg-light rounded">
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
            <div class="h-100 d-flex flex-column justify-content-center p-5 contenido">
                <h1 class="mb-4">Recuperar Contraseña</h1>
                <form action="login.php" method="POST" name="form1" onsubmit="return validarContraseñas()">
                    <div class="row g-3 inputs">
                        <div class="col-sm-6 user">
                            <div class="form-floating">
                                <input class="form-control border-0 gmail" name="cedula" id="cedula" type="text" placeholder="Cédula">
                                <label for="cedula">Cédula</label>
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert" style="display: none;">
                                    La cédula debe contener entre 8 y 11 dígitos numéricos.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 user">
                            <div class="form-floating">
                                <input class="form-control border-0 gmail" name="contrasena" id="contrasena" type="password" placeholder="Nueva Contraseña">
                                <span class="toggle-password" onclick="togglePasswordVisibility(this)"></span>
                                <label for="contrasena">Nueva Contraseña</label>
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert" style="display: none;">
                                    La contraseña debe tener entre 8 y 11 caracteres.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 user">
                            <div class="form-floating">
                                <input class="form-control border-0 gmail" name="confirmar_contrasena" id="confirmar_contrasena" type="password" placeholder="Confirmar Contraseña">
                                <label for="confirmar_contrasena">Confirmar Contraseña</label>
                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert" style="display: none;">
                                    Las contraseñas no coinciden.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="actualizar" class="btn btn-primary w-100 py-3 ingresar">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

<!-- Script de validación de formulario -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validación de la formulario
        document.getElementById('form1').addEventListener('submit', function(event) {
            if (!validarContraseñas()) {
                event.preventDefault();
            }
        });

        // Validación de la cédula
        document.getElementById('cedula').addEventListener('input', function() {
            var cedula = this.value.trim();
            var alerta = this.parentElement.querySelector('.alert-danger');

            if (/^\d{8,11}$/.test(cedula)) {
                this.classList.remove('is-invalid');
                alerta.style.display = 'none';
            } else {
                this.classList.add('is-invalid');
                alerta.style.display = 'block';
            }
        });

        // Validación de la contraseña
        document.getElementById('contrasena').addEventListener('input', function() {
            var contrasena = this.value.trim();
            var alerta = this.parentElement.querySelector('.alert-danger');

            if (contrasena.length >= 8 && contrasena.length <= 11) {
                this.classList.remove('is-invalid');
                alerta.style.display = 'none';
            } else {
                this.classList.add('is-invalid');
                alerta.style.display = 'block';
            }
        });

        // Validación de confirmar contraseña
        document.getElementById('confirmar_contrasena').addEventListener('input', function() {
            var confirmarContrasena = this.value.trim();
            var contrasena = document.getElementById('contrasena').value.trim();
            var alerta = this.parentElement.querySelector('.alert-danger');

            if (confirmarContrasena === contrasena) {
                this.classList.remove('is-invalid');
                alerta.style.display = 'none';
            } else {
                this.classList.add('is-invalid');
                alerta.style.display = 'block';
            }
        });
    });

    // Función para alternar la visibilidad de la contraseña
    function togglePasswordVisibility(element) {
        var passwordInput = element.previousElementSibling;
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            element.classList.add('visible');
        } else {
            passwordInput.type = 'password';
            element.classList.remove('visible');
        }
    }

    // Validar todo el formulario antes de enviar
    function validarContraseñas() {
        var cedula = document.getElementById('cedula').value.trim();
        var contrasena = document.getElementById('contrasena').value.trim();
        var confirmarContrasena = document.getElementById('confirmar_contrasena').value.trim();
        var cedulaAlerta = document.getElementById('cedula').parentElement.querySelector('.alert-danger');
        var contrasenaAlerta = document.getElementById('contrasena').parentElement.querySelector('.alert-danger');
        var confirmarContrasenaAlerta = document.getElementById('confirmar_contrasena').parentElement.querySelector('.alert-danger');

        var cedulaValida = /^\d{8,11}$/.test(cedula);
        var contrasenaValida = contrasena.length >= 8 && contrasena.length <= 11;
        var coincidenContrasenas = confirmarContrasena === contrasena;

        if (!cedulaValida) {
            document.getElementById('cedula').classList.add('is-invalid');
            cedulaAlerta.style.display = 'block';
        } else {
            document.getElementById('cedula').classList.remove('is-invalid');
            cedulaAlerta.style.display = 'none';
        }

        if (!contrasenaValida) {
            document.getElementById('contrasena').classList.add('is-invalid');
            contrasenaAlerta.style.display = 'block';
        } else {
            document.getElementById('contrasena').classList.remove('is-invalid');
            contrasenaAlerta.style.display = 'none';
        }

        if (!coincidenContrasenas) {
            document.getElementById('confirmar_contrasena').classList.add('is-invalid');
            confirmarContrasenaAlerta.style.display = 'block';
        } else {
            document.getElementById('confirmar_contrasena').classList.remove('is-invalid');
            confirmarContrasenaAlerta.style.display = 'none';
        }

        return cedulaValida && contrasenaValida && coincidenContrasenas;
    }
</script>

</body>
</html>
