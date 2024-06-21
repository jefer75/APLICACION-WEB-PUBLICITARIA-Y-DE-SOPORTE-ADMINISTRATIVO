<?php
session_start();
require_once("../../../db/connection.php");
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db -> conectar();

if (isset($_POST['aceptar'])){
    
    $sql= $con -> prepare ("SELECT * FROM actividades WHERE id_actividad='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
    foreach($fila as $fila){
        $direccion=$fila['imagen'];
    }

    unlink($direccion);
    
    $sql = $con -> prepare("DELETE FROM actividades WHERE id_actividad='".$_GET['id']."'");
    $sql -> execute();
    echo '<script> alert ("Actividad eliminada con exito");</script>';
    echo '<script> window.close(); </script>';
}
else if (isset($_POST['cancelar'])){

    echo '<script> window.close(); </script>';

}

?>

<!DOCTYPE html>
<html lang="en">
<script>
        function centrar() {
            iz=(screen.width-document.body.clientWidth) / 2;
            de=(screen.height-document.body.clientHeight) / 3;
            moveTo(iz,de);
        }
</script>
<style>
    body{
        text-align: center;
    }

    .aceptar{
        background-color: red;
        color: white;
        border-radius: 4vh;
        border: 0;
        padding: 3vh;
    }

    .aceptar:hover{
        background-color: lightcoral;
        padding: 5vh;
        color: black;
        font-size: larger;
    }
    .cancelar{
        background-color: #0d6efd;
        color: white;
        border-radius: 4vh;
        border: 0;
        padding: 3vh;
        margin: 5%;
    }
    .cancelar:hover{
        background-color: lightblue;
        padding: 5vh;
        color: black;
        font-size: larger;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar imagen</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/tablaedi.css" rel="stylesheet">

</head>
<body onload="centrar()">
    <h1>Se eliminara la actividad de la interfaz de recreacion infantil</h1>
    <h1>¿Deseas continuar?</h1>
    <form name="eliminar_imagen" method="POST">
        <input type="submit" name="aceptar" value="Aceptar" class="aceptar">
        <input type="submit" name="cancelar" value="Cancelar" class="cancelar">
    </form>
</body>
</html>