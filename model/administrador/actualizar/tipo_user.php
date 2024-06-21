<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //empieza la consulta
    $sql = $con -> prepare("SELECT * FROM tipo_user WHERE id_tipo_user='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $tipo_user= $_POST['tipo_user'];
        
            $insert= $con -> prepare ("UPDATE tipo_user SET tipo_user='$tipo_user' WHERE id_tipo_user = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
                
        }
    else if (isset($_POST['eliminar'])){
            $insert= $con -> prepare ("DELETE FROM tipo_user WHERE id_tipo_user= '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro eliminado exitosamente");</script>';
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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
    <link rel="stylesheet" href="../../../css/tablaedi.css">
    <title></title>
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_actualizar" method="POST">
                <tr>
                    <td>Identificador</td>
                    <td><input name="id_tipo_user" value="<?php echo $fila['id_tipo_user']?>" readonly></td>
                </tr>

                <tr>
                    <td>Tipo de evento</td>
                    <td><input name="tipo_user" value="<?php echo $fila['tipo_user'] ?>" ></td>                 
                </tr>

                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>