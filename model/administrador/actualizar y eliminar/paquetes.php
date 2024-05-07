<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //empieza la consulta
    $sql = $con -> prepare("SELECT * FROM paquetes WHERE id_paquetes='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $nombre_paquete= $_POST['nombre_paquete'];
        $edad_min = $_POST['edad_min'];
        $edad_max= $_POST['edad_max'];
        $valor= $_POST['valor'];  

            $insert= $con -> prepare ("UPDATE paquetes SET nombre_paquete='$nombre_paquete', edad_min='$edad_min', edad_max='$edad_max', valor='$valor' WHERE id_paquetes = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
                
        }
    else if (isset($_POST['eliminar'])){
            $insert= $con -> prepare ("DELETE FROM paquetes WHERE id_paquetes= '".$_GET['id']."'");
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
    <title>Paquetes</title>
    <link rel="stylesheet" href="../../../css/tablaedi.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_actualizar" method="POST">

              <tr>
                    <td>Identificador</td>
                    <td><input name="id_paquetes" value="<?php echo $fila['id_paquetes']?>" readonly></td>
                </tr>

                <tr>
                    <td>Paquetes</td>
                    <td><input name="nombre_paquete" value="<?php echo $fila['nombre_paquete'] ?>" ></td>
                </tr>

                <tr>
                    <td>Edad minima</td>
                    <td><input name="edad_min" value="<?php echo $fila['edad_min'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Edad maxima</td>
                    <td><input name="edad_max" value="<?php echo $fila['edad_max'] ?>"></td>                 
                </tr>

                <tr>
                    <td>Valor</td>
                    <td><input type="valor" name="valor" value="<?php echo $fila['valor'] ?>" ></td>                 
                </tr>
               
                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                </tr>
            </form>
        </table>
        <style>
    
</body>
</html>