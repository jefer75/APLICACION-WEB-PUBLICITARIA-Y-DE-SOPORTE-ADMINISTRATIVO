<?php
require_once "../../../db/connection.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ELITECH</title>
    <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/unicode-15/bw/512px/1f9d1-1f4bb.png">
    <link rel="stylesheet" href="../css/conf.css">
    <script>
        function validarFormulario() {
            var cedulaInput = document.getElementById('cedula');
            var codigoInput = document.getElementById('codigo');

            // Validación de cédula
            var cedulaValue = cedulaInput.value.trim();
            if (cedulaValue.length !== 8 && cedulaValue.length !== 10) {
                alert('La cédula debe tener 8 o 10 números.');
                return false; // Evita que el formulario se envíe
            }

            // Validación de código
            var codigoValue = codigoInput.value.trim();
            if (codigoValue.length !== 4) {
                alert('El código debe tener exactamente 4 caracteres.');
                return false; // Evita que el formulario se envíe
            }

            // Si todas las validaciones pasan, permite el envío del formulario
            return true;
        }
    </script>
</head>
<body>
<header class="header">
    <nav class="navbar">
        <h2 class="logo"><a href="#">ELITECH JYDT</a></h2>
        <div class="buttons">
            <a href="../index.php" class="signup">Regresar</a>
        </div>
    </nav>
</header>

<div class="container_mayor">
    <div class="contenido">
        <div class="container">
            <div class="contenido-interior">
                <h1 style="font-family: 'Arial Rounded MT Bold', sans-serif;">Ingresa Código</h1>

                <form method="POST" action="../../../controller/inicioS.php" name="form1" onsubmit="return validarFormulario()">
                    <div class="row g-3 inputs">
                        <div class="col-sm-6 user">
                            <div class="form-floating">
                                <input class="form-control" name="cedula" id="cedula" type="number" placeholder="Cédula">
                            </div>
                        </div>
                        <div class="col-sm-6 user">
                            <div class="form-floating">
                                <input class="form-control border-0 gmail" name="codigo" id="codigo" type="text" placeholder="Código">
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="recuperar" class="btn btn-primary w-100 py-3 ingresar" style="background-color: blue; border-color: white;">Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
