<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //empieza la consulta
    $sql = $con -> prepare("SELECT * FROM empresa WHERE nit='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();
    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $Nit = $_POST['nit'];
        $nombre_emp = $_POST['nombre_emp'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        
            $insert= $con -> prepare ("UPDATE empresa SET nombre_emp='$nombre_emp', telefono='$telefono', direccion='$direccion' WHERE nit = '".$_GET['id']."'");
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
                    <td>Nit</td>
                    <td><input type="int" name="nit" value="<?php echo $fila['nit'] ?>" readonly></td>                 
                </tr>

                
                <tr>
                    <td>Empresa</td>
                    <td><input type="varchar" name="nombre_emp" value="<?php echo $fila['nombre_emp'] ?>"></td>                 
                </tr>

                <tr>
                    <td>Telefono</td>
                    <td><input type="int" name="telefono" value="<?php echo $fila['telefono'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Direccion</td>
                    <td><input type="varchar" name="direccion" value="<?php echo $fila['direccion'] ?>" ></td>                 
                </tr>
               
                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="eliminar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>