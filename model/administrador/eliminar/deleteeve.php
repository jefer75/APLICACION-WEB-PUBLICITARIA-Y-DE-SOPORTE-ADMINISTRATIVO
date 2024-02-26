<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

//empieza la consulta
    $sql = $con -> prepare("SELECT * FROM tipo_e WHERE id_tipo_e='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['eliminar'])){

        $id_tipo_e= $_POST['id_tipo_e'];
        $tipo_evento= $_POST['tipo_evento'];

        $insertSQL = $con -> prepare("DELETE FROM tipo_e WHERE id_tipo_e = '".$_GET['id']."'");      
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
    <title>tipo de evento</title>
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_eliminar" method="POST">
                
                <tr>
                <td>id_tipo_e</td>   
                <td><input name="id_tipo_e" id="tipo_e"  value="<?php echo $fila['id_tipo_e']?>" readonly></td>
                        
                </tr>

                <tr>
                    <td>tipo de evento</td>
                    <td><input name="tipo_evento" value="<?php echo $fila['tipo_evento'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                
                </tr>
            </form>
        </table>
    


</body>
</html>