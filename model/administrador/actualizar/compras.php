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

        
        $id_compras = $_POST['id_compras'];
        $fecha_c= $_POST['fecha_c'];
        $cedula = $_POST['cedula'];
        $valor_total= $_POST['valor_total'];
        
            $insert= $con -> prepare ("UPDATE compras SET id_compras='$id_compras', fecha_c='$fecha_c', cedula='$cedula', valor_total='$valor_total' WHERE id_compras = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
                
        }
        
        else if (isset($_POST['eliminar'])){
            
            $insert= $con -> prepare ("DELETE FROM compras WHERE id_compras = '".$_GET['id']."'");
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
    <title>Actualizar compras</title>
    <link rel="stylesheet" href="../../../css/tablaedi.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_actualizar" method="POST">
            <tr>

                <td>identificador</td>   
                <td><input  name="id_compras" id="compras"  value="<?php echo $fila['id_compras']?>" readonly></td>
                        
                </tr>

                

                <tr>
                    <td>Fecha de compra</td>
                    <td><input type="date" name="fecha_c" value="<?php echo $fila['fecha_c'] ?>"></td>                 
                </tr>

                <tr>
                    <td>Cedula</td>
                    <td><input name="cedula" value="<?php echo $fila['cedula'] ?>"></td>                 
                </tr>

                <tr>
                    <td>valor_total</td>
                    <td><input name="valor_total" value="<?php echo $fila['valor_total'] ?>"></td>                 
                </tr>

                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>