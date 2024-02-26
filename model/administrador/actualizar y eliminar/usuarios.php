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
        $apellidos= $_POST['apellidos'];
        $celular= $_POST['celular'];
        $contrasena = $_POST['contrasena'];
        $correo = $_POST['correo'];
     
      
        
        
        $encriptado = password_hash($contrasena, PASSWORD_DEFAULT,array("pass"=>12));

            $insert= $con -> prepare ("UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', celular=$celular, contrasena='$encriptado', correo='$correo'WHERE cedula = '".$_GET['id']."'");
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
                    <td>Apellidos</td>
                    <td><input name="apellidos" value="<?php echo $fila['apellidos'] ?>" "></td>                 
                </tr>

                <tr>
                    <td>Celular</td>
                    <td><input type="celular" name="celular" value="<?php echo $fila['celular'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Contrasena</td>
                    <td><input type="contrasena" name="contrasena" value="<?php echo $fila['contrasena'] ?>" placeholder="Cambiar contraseña" ></td>                 
                </tr>

                <tr>
                    <td>Correo</td>
                    <td><input type="correo" name="correo" value="<?php echo $fila['correo'] ?>" ></td>                 
                </tr>

               
                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>