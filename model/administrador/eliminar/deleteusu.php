<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

//empieza la consulta
    $sql = $con -> prepare("SELECT * FROM usuarios WHERE cedula='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['eliminar'])){

        $cedula= $_POST['cedula'];
        $nombre= $_POST['nombre'];
        $apellidos= $_POST['apellidos'];
        $celular= $_POST['celular'];
        $contrasena= $_POST['contrasena'];
        $id_tipo_user= $_POST['id_tipo_user'];

        $insertSQL = $con -> prepare("DELETE FROM usuarios WHERE cedula = '".$_GET['id']."'");      
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
    <title>usuarios</title>
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_eliminar" method="POST">
                
                <tr>
                <td>cedula</td>   
                <td><input name="cedula" id="cedula"  value="<?php echo $fila['cedula']?>" readonly></td>
                        
                </tr>

                <tr>
                    <td>nombre</td>
                    <td><input name="nombre" value="<?php echo $fila['nombre'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>apellidos</td>
                    <td><input name="apellidos" value="<?php echo $fila['apellidos'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>celular</td>
                    <td><input name="celular" value="<?php echo $fila['celular'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>contrasena</td>
                    <td><input name="contrasena" value="<?php echo $fila['contrasena'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>Tipo de usuario</td>
                    <td><input name="id_tipo_user" value="<?php echo $fila['id_tipo_user'] ?>" readonly></td>                 
                </tr>
            
                <tr>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                
                </tr>
            </form>
        </table>
    


</body>
</html>