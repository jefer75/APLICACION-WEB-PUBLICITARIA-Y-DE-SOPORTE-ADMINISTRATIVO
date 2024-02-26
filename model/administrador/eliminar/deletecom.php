<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

//empieza la consulta
    $sql = $con -> prepare("SELECT * FROM compras WHERE id_compras='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['eliminar'])){

        $id_compras= $_POST['id_compras'];
        $id_articulo= $_POST['id_articulo'];
        $cantidad= $_POST['cantidad'];
        $valor= $_POST['valor'];
        $fecha_c= $_POST['fecha_c'];
        $cedula= $_POST['cedula'];
        $descripcion= $_POST['descripcion'];

        $insertSQL = $con -> prepare("DELETE FROM compras WHERE id_compras = '".$_GET['id']."'");      
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
    <title>compras</title>
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_eliminar" method="POST">
                
                <tr>
                <td>id_compra</td>   
                <td><input name="id_compras" id="compras"  value="<?php echo $fila['id_compras']?>" readonly></td>
                        
                </tr>

                <tr>
                    <td>articulo</td>
                    <td><input name="id_articulo" id="articulo" value="<?php echo $fila['id_articulo']?>" readonly></td>                 
                </tr>

                <tr>
                    <td>cantidad</td>
                    <td><input name="cantidad" value="<?php echo $fila['cantidad'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>valor</td>
                    <td><input name="valor" value="<?php echo $fila['valor'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>fecha_c</td>
                    <td><input name="fecha_c" value="<?php echo $fila['fecha_c'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>Cedula</td>
                    <td><input name="cedula" value="<?php echo $fila['cedula'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>descripcion</td>
                    <td><input name="descripcion" value="<?php echo $fila['descripcion'] ?>" readonly></td>                 
                </tr>
            
                <tr>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                
                </tr>
            </form>
        </table>
    


</body>
</html>