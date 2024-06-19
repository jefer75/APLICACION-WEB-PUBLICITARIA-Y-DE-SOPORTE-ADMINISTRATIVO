<?php
session_start();
require_once("../../db/connection.php");
include 'plantilla.php';
$db = new Database();
$con = $db->conectar();

if (isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "formreg") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nombre_comp = $nombre . " " . $apellido;
    $cedula = $_POST['cedula'];
    $celular = $_POST['celular'];
    $contrasena = $_POST['contrasena'];
    $correo = $_POST['correo'];
    $tipo_user = $_POST['id_tipo_user'];
    $id_estado = 1;
    $nit = 123456789;

    $tipos_permitidos = [1, 4];

    if (!in_array($tipo_user, $tipos_permitidos)) {
        die("Tipo de usuario no permitido.");
    }

    $sql = $con->prepare("SELECT * FROM usuarios WHERE cedula=:cedula");
    $sql->bindParam(':cedula', $cedula);
    $sql->execute();
    $fila = $sql->fetch(PDO::FETCH_ASSOC);

    if ($fila) {
        die("Ya existe un usuario con ese documento. Por favor, utilice otro.");
    }

    $pass_cifrado = password_hash($contrasena, PASSWORD_DEFAULT);

    $insertSQL = $con->prepare("INSERT INTO usuarios(cedula, nombre, celular, contrasena, correo, id_tipo_user, id_estado, nit) 
                               VALUES(:cedula, :nombre_comp, :celular, :pass_cifrado, :correo, :tipo_user, :id_estado, :nit)");
    $insertSQL->bindParam(':cedula', $cedula);
    $insertSQL->bindParam(':nombre_comp', $nombre_comp);
    $insertSQL->bindParam(':celular', $celular);
    $insertSQL->bindParam(':pass_cifrado', $pass_cifrado);
    $insertSQL->bindParam(':correo', $correo);
    $insertSQL->bindParam(':tipo_user', $tipo_user);
    $insertSQL->bindParam(':id_estado', $id_estado);
    $insertSQL->bindParam(':nit', $nit);
    $insertSQL->execute();

    echo "Registro exitoso.";
}
?>

    <link rel="stylesheet" href="css/regis.css">
</head>
<body>
<section class="dashboard">
    <div class="container" id="registrate">
        <h1>Registrar Usuarios</h1>
        <form method="post" name="formreg" id="formreg" class="signup-form" autocomplete="off" onsubmit="return validarFormulario()">
            <div class="form-row">
                <div class="form-column">
                    <div class="form-floating">
                        <label for="nombres">Nombres</label>
                        <input class="form-control" type="text" name="nombre" id="nombres" placeholder="Digite Nombre" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-floating">
                        <label for="apellidos">Apellidos</label>
                        <input class="form-control" type="text" name="apellido" id="apellidos" placeholder="Apellidos" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-floating">
                        <label for="documento">N° Documento</label>
                        <input class="form-control" type="text" name="cedula" id="documento" placeholder="Digite Documento" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-floating">
                        <label for="telefono">Contacto</label>
                        <input class="form-control" type="text" name="celular" id="telefono" placeholder="Digite Telefono" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-floating">
                        <label for="correo">Correo</label>
                        <input class="form-control" type="email" name="correo" id="correo" placeholder="Digite Correo" required>
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-floating">
                        <label for="contrasena">Contraseña</label>
                        <input class="form-control" type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
                    </div>
                </div>

                <div class="form-column full-width">
                    <div class="form-floating">
                        <label for="id_tipo_user">Tipo de Usuario</label>
                        <select class="form-select" name="id_tipo_user" id="id_tipo_user" required>
                            <option value="1">Administrador</option>
                            <option value="4">Super Administrador</option>
                        </select>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" type="submit" name="registrarse">Registro</button>
            <input type="hidden" name="MM_insert" value="formreg">
        </form>
    </div>
</section>
