<?php
require_once("../db/connection.php");
$db = new Database();
$con = $db -> conectar();
session_start();

if (isset($_POST["inicio"])) {

    $cedula = $_POST["cedula"];
    
    $contrasena = htmlentities(addslashes($_POST['contrasena']));

    $sql = $con->prepare("SELECT * FROM usuarios where cedula = '$cedula'");
    $sql->execute();
    $fila = $sql->fetch();

    if(gettype($fila) == "array" && password_verify($contrasena, $fila['contrasena'])){

        $_SESSION['cedula'] = $fila['cedula'];
        $_SESSION['id_tipo_user'] = $fila ['id_tipo_user'];
        echo "contraseña:",$contrasena;

        if ($_SESSION['id_tipo_user'] == 1) {
            header ("Location: ../model/administrador/pages/index.php");
            exit();
        }
        
     else if ($_SESSION['id_tipo_user'] == 2) {
         header ("Location: ../model/cliente/plantilla.php");
         exit();
         }
         else if ($_SESSION['id_tipo_user'] == 3) {
         header ("Location: ../model/empleado/plantilla.php");
         exit();
         }
   
        }else {
            header("location: ../model/administrador/inicio/error.php");
            exit();
        }
    }