<?php
session_start();
require_once ("../../../db/connection.php");
$db = new DataBase();
$con = $db -> conectar();

if (isset($_POST['recuperar'])) {
    $correo = $_POST['email'];

    if ($correo == "") {
        echo '<script>alert("Digite el correo")</script>';
    } else {
        $sql = $con -> prepare("SELECT * FROM usuarios WHERE correo='$correo'");
        $sql -> execute();
        $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

        if ($fila) {
            $digitos = "sakur02ue859y2u389rhdewirh102385y1285013289";
            $longitud = 4;
            $codigo = substr(str_shuffle($digitos), 0, $longitud);

            $insert = $con -> prepare("UPDATE usuarios SET token='$codigo' Where correo='$correo'");
            $insert -> execute();
            $fila1 = $insert -> fetchAll(PDO::FETCH_ASSOC);

            //codigo de envio de correo
            $paracorreo = "$correo";
            $titulo = "Codigo de verificacion";
            $msj = "Su codigo de verificacion es: $codigo";
            $tucorreo = "From:aeventos986@gmail.com";

            if (mail($paracorreo, $titulo, $msj, $tucorreo)) {
                echo '<script> alert ("Su codigo ha sido enviado al correo anteriormente digitado");</script>';
                echo '<script>window.location="codiS.php"</script>';
            }
        } else {
            echo '<script> alert ("El correo digitado no esta registrado");</script>';
        }
    } 
}
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
            var correoInput = document.getElementById('correo');
            var correoValue = correoInput.value.trim();
            var feedback = correoInput.parentElement.querySelector('.invalid-feedback');

            // Validación de correo electrónico
            // Se actualiza la expresión regular para validar longitud y estructura del correo
            if (!/^[\w-\.]{1,30}@[\w-]+\.[\w-]{2,}$/.test(correoValue)) {
                correoInput.classList.add('is-invalid');
                feedback.style.display = 'block';
                return false; // Evita que el formulario se envíe
            } else {
                correoInput.classList.remove('is-invalid');
                feedback.style.display = 'none';
                return true; // Permite el envío del formulario
            }
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
                <h1 style="font-family: 'Arial Rounded MT Bold', sans-serif;">Digite su Correo</h1>

                <form method="POST" name="form1" onsubmit="return validarFormulario()">
                    <div class="row g-3 inputs">
                        <div class="col-sm-6 user">
                            <div class="form-floating">
                                <input type="email" class="form-control border-0 gmail" id="correo" name="email" placeholder="Correo">
                                <div class="invalid-feedback" style="display: none;">
                                    Ingrese un correo válido (máximo 30 caracteres y debe contener '@').
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" name="recuperar" class="btn btn-primary w-100 py-3 ingresar" style="background-color: blue; color: white; border: 1px solid white;">Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
