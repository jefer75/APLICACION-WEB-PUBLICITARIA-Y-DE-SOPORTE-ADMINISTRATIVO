<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "proyecto_arlequin";


$con = mysqli_connect($host, $user, $password, $database);
if(!$con){
echo "No se realizo la conexion a la basa de datos, el error fue:".
mysqli_connect_error() ;


}

?>