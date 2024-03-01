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

    if (isset($_POST['actualizar'])){

        $cedula= $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $celular= $_POST['celular'];
        $correo = $_POST['correo'];
        $id_tipo_user= $_POST['id_tipo_user'];
        $id_estado=$_POST['id_estado'];
        $nit=$_POST['nit'];
        
        $encriptado = password_hash($contrasena, PASSWORD_DEFAULT,array("pass"=>12));

            $insert= $con -> prepare ("UPDATE usuarios SET nombre='$nombre', celular=$celular, correo='$correo' WHERE cedula = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';   
        }

        else if (isset($_POST['eliminar'])){
            
                $insert= $con -> prepare ("DELETE FROM usuarios WHERE cedula = '".$_GET['id']."'");
                $insert -> execute();
                echo '<script> alert ("Registro actualizado exitosamente");</script>';
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
    <title>Document</title>
    <link rel="stylesheet" href="../../../css/tablaedi.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_actualizar" method="POST">
                <tr>
                    <td>Cedula</td>
                    <td><input name="cedula" value="<?php echo $fila['cedula'] ?>" readonly></td>
                </tr>

                <tr>
                    <td>Nombre</td>
                    <td><input name="nombre" value="<?php echo $fila['nombre'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Celular</td>
                    <td><input type="celular" name="celular" value="<?php echo $fila['celular'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Correo</td>
                    <td><input type="correo" name="correo" value="<?php echo $fila['correo'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Tipo de usuario</td>
                    <td><input name="id_tipo_user" value="<?php echo $fila['id_tipo_user'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>Estado</td>
                    <td><input name="id_estado" value="<?php echo $fila['id_estado']?>" ></td>                 
                </tr>

                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>