<?php
session_start();
require_once("../../db/connection.php");

// Verificar si el usuario está logueado
if(!isset($_SESSION['cedula'])) {
    header("Location: ../model/administrador/inicio/error.php");
    exit();
}

// Obtener los datos del cliente desde la base de datos
$db = new Database();
$con = $db->conectar();
$cedula = $_SESSION['cedula'];
$sql = $con->prepare("SELECT * FROM usuarios WHERE cedula = ?");
$sql->execute([$cedula]);
$cliente = $sql->fetch(PDO::FETCH_ASSOC);

if(!$cliente) {
    echo "Error: No se encontraron datos del cliente.";
    exit();
}

// Procesar el formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados del formulario
    $nombre = $_POST["nombre"];
    $celular = $_POST["celular"];
    $correo = $_POST["correo"];

    // Actualizar los datos del cliente en la base de datos
    $sql = $con->prepare("UPDATE usuarios SET nombre = ?, celular = ?, correo = ? WHERE cedula = ?");
    $result = $sql->execute([$nombre, $celular, $correo, $cedula]);

    if ($result) {
        echo "Los datos se actualizaron correctamente.";
    } else {
        echo "Error al actualizar los datos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos</title>
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body style="background-color: white;">
    <br>
    <a class="btn-regresar" href="plantilla.php" style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 15px; text-decoration: none; margin-top: 70px; margin-left: 10px;">Regresar</a>
    <h2 class="card-title" style="font-family: 'Arial Rounded MT Bold', sans-serif; text-align: center; margin-top: 20px;">Editar Datos</h2>
    <div class="col-lg-6" style="margin-top: 20px; margin-left: auto; margin-right: auto;">
        <div class="container" style="text-align: center;">
            <div class="card">
                <div class="card-body">
                    <form method="POST" name="formreg" id="formreg" class="signup-form" autocomplete="off">
                        <label class="form-label" for="nombre">Nombre:</label><br>
                        <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo $cliente['nombre']; ?>"><br>
                        <label class="form-label" for="celular">Celular:</label><br>
                        <input class="form-control" type="text" id="celular" name="celular" value="<?php echo $cliente['celular']; ?>"><br>
                        <label class="form-label" for="correo">Correo:</label><br>
                        <input class="form-control" type="email" id="correo" name="correo" value="<?php echo $cliente['correo']; ?>"><br><br>
                        <input class="btn btn-primary rounded-pill" type="submit" value="Guardar Cambios">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

