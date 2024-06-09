<?php
require_once("../db/connection.php");
$db = new Database();
$con = $db -> conectar();
session_start();

if (isset($_POST["inicio"])) {

    $correo = $_POST["correo"];
    
    

    $sql = $con->prepare("SELECT*FROM usuarios where corrreo= '$correo'");
    $sql->execute();
    $fila = $sql->fetch();

    
        $_SESSION['correo'] = $fila['correo'];
        $_SESSION['id_tipo_user'] = $fila ['id_tipo_user'];
        echo "contraseña:",$contrasena;
        if ($_SESSION['id_tipo_user'] == 1) {
            header ("Location: ../model/administrador/pages/index.php");
            exit();
        }
        
     else if ($_SESSION['id_tipo_user'] == 2) {
         header ("Location: ../model/cliente/cliente.php");
         exit();
         }
         else if ($_SESSION['id_tipo_user'] == 3) {
         header ("Location: ../model/empleado/empleado.php");
         exit();
         }
         if ($_SESSION['id_tipo_user'] == 4) {
            header ("Location: ../model/super_admin/inicio/admin.php");
            exit();
        }
        }else {
            header("location: ../model/administrador/inicio/error.php");
            exit();
        }
    