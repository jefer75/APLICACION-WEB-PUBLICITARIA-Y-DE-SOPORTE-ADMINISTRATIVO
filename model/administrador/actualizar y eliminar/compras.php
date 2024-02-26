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

    if (isset($_POST['actualizar'])){

        
        $id_articulo = $_POST['id_articulo'];
        $cantidad= $_POST['cantidad'];
        $valor = $_POST['valor'];
        $fecha_c= $_POST['fecha_c'];
        $cedula = $_POST['cedula'];
        $descripcion= $_POST['descripcion'];
        
            $insert= $con -> prepare ("UPDATE compras SET id_articulo='$id_articulo', cantidad='$cantidad', valor='$valor', fecha_c='$fecha_c', cedula='$cedula', descripcion='$descripcion' WHERE id_compras = '".$_GET['id']."'");
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

                <td>identificador</td>   
                <td><input name="id_compras" id="compras"  value="<?php echo $fila['id_compras']?>" readonly></td>
                        
                </tr>

                <tr>
                    <td>articulo</td>
                    <td><input name="id_articulo" id="articulo" value="<?php echo $fila['id_articulo']?>" ></td>                 
                </tr>

                <tr>
                    <td>cantidad</td>
                    <td><input name="cantidad" value="<?php echo $fila['cantidad'] ?>"></td>                 
                </tr>

                <tr>
                    <td>valor</td>
                    <td><input name="valor" value="<?php echo $fila['valor'] ?>"></td>                 
                </tr>

                <tr>
                    <td>fecha_c</td>
                    <td><input type="date" name="fecha_c" value="<?php echo $fila['fecha_c'] ?>"></td>                 
                </tr>

                <tr>
                    <td>Cedula</td>
                    <td><input name="cedula" value="<?php echo $fila['cedula'] ?>"></td>                 
                </tr>

                <tr>
                    <td>descripcion</td>
                    <td><input name="descripcion" value="<?php echo $fila['descripcion'] ?>"></td>                 
                </tr>

                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>