<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

//empieza la consulta
    $sql = $con -> prepare("SELECT * FROM articulos WHERE id_articulo='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['eliminar'])){

        $id_articulo= $_POST['id_articulo'];
        $nombre_A= $_POST['nombre_A'];
        $cantidad= $_POST['cantidad'];
       
        $insertSQL = $con -> prepare("DELETE FROM articulos WHERE id_articulo = '".$_GET['id']."'");      
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
    <title>Articulos</title>
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_eliminar" method="POST">
                
                <tr>
                <td>id_articulo</td>   
                <td><input name="id_articulo" id="articulo"  value="<?php echo $fila['id_articulo']?>" readonly></td>
                        
                </tr>

                <tr>
                    <td>nombre del articulo</td>
                    <td><input name="nombre_A" value="<?php echo $fila['nombre_A'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>cantidad</td>
                    <td><input name="cantidad" value="<?php echo $fila['cantidad'] ?>"readonly></td>                 
                </tr>

                <tr>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                
                </tr>
            </form>
        </table>
    


</body>
</html>