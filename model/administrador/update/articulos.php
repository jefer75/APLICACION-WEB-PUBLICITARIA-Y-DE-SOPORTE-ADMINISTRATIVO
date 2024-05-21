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

    if (isset($_POST['actualizar'])){

        $id_articulo= $_POST['id_articulo'];
        $nombre_A = $_POST['nombre_A'];
        $id_estado= $_POST['id_estado'];
        $descripcion= $_POST['descripcion'];
        $cantidad = $_POST['cantidad'];
        $valor= $_POST['valor'];
        
            $insert= $con -> prepare ("UPDATE articulos SET id_articulo='$id_articulo', nombre_A='$nombre_A', id_estado='$id_estado', descripcion='$descripcion', cantidad='$cantidad', valor='$valor' WHERE id_articulo = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
                
        }

        else if (isset($_POST['eliminar'])){
           
       
            $id_articulo= $_POST['id_articulo'];
            $nombre_A = $_POST['nombre_A'];
            $id_estado= $_POST['id_estado'];
            $descripcion= $_POST['descripcion'];
            $cantidad = $_POST['cantidad'];
            $valor= $_POST['valor'];
        
                $insert= $con -> prepare ("DELETE FROM articulos WHERE id_articulo = '".$_GET['id']."'");
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
    <title>Actualizar Articulos</title>
    <link rel="stylesheet" href="../../../css/tablaedi.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_actualizar" method="POST">
                <tr>
                    <td>Identificador</td>
                    <td><input  type="number" name="id_articulo" value="<?php echo $fila['id_articulo']?>" ></td>
                </tr>

                <tr>
                    <td>Nombre</td>
                    <td><input  name="nombre_A" value="<?php echo $fila['nombre_A'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>estado</td>
                    <td><input type="number" name="id_estado" value="<?php echo $fila['id_estado'] ?>"></td>                 
                </tr>

                <tr>
                    <td>descripcion</td>
                    <td><input type="varchar" name="descripcion" value="<?php echo $fila['descripcion']?>" ></td>
                </tr>


                <tr>
                    <td>Cantidad</td>
                    <td><input type="number" name="cantidad" value="<?php echo $fila['cantidad'] ?>"></td>                 
                </tr>

                <tr>
                    <td>valor</td>
                    <td><input type="number" name="valor" value="<?php echo $fila['valor'] ?>"></td>                 
                </tr>
              

                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                </tr>
            </form>
        </table>
</body>
</html>