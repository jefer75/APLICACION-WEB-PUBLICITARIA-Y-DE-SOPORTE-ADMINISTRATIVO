<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

//empieza la consulta
    $sql = $con -> prepare("SELECT * FROM empleados WHERE id_recreador='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['eliminar'])){

        $id_recreador= $_POST['id_recreador'];
        $nombre_p= $_POST['nombre_p'];
        $nombre_artistico= $_POST['nombre_artistico'];
        $telefono= $_POST['telefono'];
        $direccion= $_POST['direccion'];

        $insertSQL = $con -> prepare("DELETE FROM empleados WHERE id_recreador = '".$_GET['id']."'");      
        $insertSQL->execute();
        echo '<script>alert ("Registro eliminado exitosamente.");</script>';
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
    <link rel="stylesheet" href="delet2.css">
    <title>empleados</title>
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_eliminar" method="POST">
                
                <tr>
                <td>id_recreador</td>   
                <td><input name="id_recreador" id="recreador"  value="<?php echo $fila['id_recreador']?>" readonly></td>
                        
                </tr>

                <tr>
                    <td>nombre </td>
                    <td><input name="nombre_p" value="<?php echo $fila['nombre_p'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>nombre artistico</td>
                    <td><input name="nombre_artistico" value="<?php echo $fila['nombre_artistico'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>telefono</td>
                    <td><input name="telefono" value="<?php echo $fila['telefono'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>direccion</td>
                    <td><input name="direccion" value="<?php echo $fila['direccion'] ?>" readonly></td>                 
                </tr>

            
                <tr>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                
                </tr>
            </form>
        </table>
    


</body>
</html>