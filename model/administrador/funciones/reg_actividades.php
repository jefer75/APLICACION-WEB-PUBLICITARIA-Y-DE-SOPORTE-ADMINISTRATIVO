<?php
require_once "../../../db/connection.php";
session_start();
$db = new DataBase();
$con = $db->conectar();

if (!empty($_POST['registrar'])){

    $nombre_act = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    
    $imagen=$_FILES['imagen']['tmp_name'];
    $nombre=$_FILES['imagen']['name'];
    $formato=strtolower(pathinfo($nombre,PATHINFO_EXTENSION));
    $peso=$_FILES['imagen']['size'];
    $carpeta="../../../imagenes/registradas/actividades/";


    if ($nombre_act!="" || $descripcion!="" || $imagen!="") {
        
    
    if ($formato=="jpg" || $formato=="jpeg" || $formato=="png") {
        
        $insertSQL = $con->prepare("INSERT INTO actividades(nombre, descripcion, imagen) VALUES('$nombre_act', '$descripcion','')");
        $insertSQL -> execute();

        $sql= $con -> prepare ("SELECT * FROM actividades WHERE imagen=''");
        $sql -> execute();
        $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
        foreach($fila as $fila){
            $id_registrado=$fila['id_actividad'];
        }

        $direccion=$carpeta.$id_registrado.".".$formato;

        $insertSQL = $con->prepare("UPDATE actividades SET imagen='$direccion' WHERE id_actividad = $id_registrado");
        $insertSQL -> execute();

        if (move_uploaded_file($imagen,$direccion)) {
            echo '<script>alert ("La imagen ha sido guardad exitosamente");</script>';
            echo '<script>window.location="../pages/actividades.php"</script>';
        } else {
            echo '<script>alert ("Error al guardar la imagen en el almacenamiento");</script>';
            echo '<script>window.location="../pages/actividades.php"</script>';
        }
    } else {
        echo '<script>alert ("El formato del archivo no corresponde");</script>';
        echo '<script>window.location="../pages/actividades.php"</script>';
    }

    } else {
        echo '<script>alert ("Por favor llene todos los campos");</script>';
        echo '<script>window.location="../pages/actividades.php"</script>';
    }

 }
