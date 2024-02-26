<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

//empieza la consulta
    $sql = $con -> prepare("SELECT * FROM ventas WHERE id_ventas='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['eliminar'])){

        $id_ventas= $_POST['id_ventas'];
        $fecha_v= $_POST['fecha_v'];
        $fecha_e= $_POST['fecha_e'];
        $paquete= $_POST['paquete'];
        $valor_total= $_POST['valor_total'];
        $id_tipo_e= $_POST['id_tipo_e'];
        $descripcion= $_POST['descripcion'];
        $hora= $_POST['hora'];
        $n_contacto= $_POST['n_contacto'];
        $cedula_cli= $_POST['cedula_cli'];
        $ciudad= $_POST['ciudad'];
        $tematica= $_POST['tematica'];
        $id_articulo= $_POST['id_articulo'];
        $id_recreador= $_POST['id_recreador'];
        $cedula= $_POST['cedula'];

        $insertSQL = $con -> prepare("DELETE FROM ventas WHERE id_ventas = '".$_GET['id']."'");      
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
    <title>ventas</title>
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_eliminar" method="POST">
                
                <tr>
                <td>id_ventas</td>   
                <td><input name="id_ventas" id="ventas"  value="<?php echo $fila['id_ventas']?>" readonly></td>
                        
                </tr>

                <tr>
                    <td>fecha v</td>
                    <td><input name="fecha_v" value="<?php echo $fila['fecha_v'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>fecha_e</td>
                    <td><input name="fecha_e" value="<?php echo $fila['fecha_e'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>paquete</td>
                    <td><input name="paquete" value="<?php echo $fila['paquete'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>valor total</td>
                    <td><input name="valor_total" value="<?php echo $fila['valor_total'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>tipo de evento</td>
                    <td><input name="id_tipo_e" value="<?php echo $fila['id_tipo_e'] ?>" readonly></td>                 
                </tr>

                <tr>
                <td>descripcion</td>   
                <td><input name="descripcion"  value="<?php echo $fila['descripcion']?>" readonly></td>
                        
                </tr>

                <tr>
                    <td>hora</td>
                    <td><input  name="hora" value="<?php echo $fila['hora'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>contacto</td>
                    <td><input name="n_contacto" value="<?php echo $fila['n_contacto'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>cedula cli<td>
                    <td><input name="cedula_cli" value="<?php echo $fila['cedula_cli'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>cuidad</td>
                    <td><input name="ciudad" value="<?php echo $fila['ciudad'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>Tematica</td>
                    <td><input name="tematica" value="<?php echo $fila['tematica'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>articulo</td>
                    <td><input name="id_articulo" value="<?php echo $fila['id_articulo'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>recreador</td>
                    <td><input name="id_recreador" value="<?php echo $fila['id_recreador'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>cedula</td>
                    <td><input name="cedula" value="<?php echo $fila['cedula'] ?>" readonly></td>                 
                </tr>
            
            
                <tr>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                
                </tr>
            </form>
        </table>
    


</body>
</html>