<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //empieza la consulta
    $sql = $con -> prepare("SELECT * FROM detalle_compra WHERE id_detalle_compra='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $id_detalle_compra = $_POST['id_detalle_compra'];
        $id_compras= $_POST['id_compras'];
        $id_articulo= $_POST['id_articulo'];
        $cantidad= $_POST['cantidad'];
        $valor_neto_c = $_POST['valor_neto_c'];
        
            $insert= $con -> prepare ("UPDATE detalle_compra SET id_compras='$id_compras', id_articulo='$id_articulo', cantidad='$cantidad', valor_neto_c='$valor_neto_c' WHERE id_detalle_compra = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
                
        }
        
        else if (isset($_POST['eliminar'])){
            
            $insert= $con -> prepare ("DELETE FROM detalle_compra WHERE id_detalle_compra = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro ELIMINADO exitosamente");</script>';
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
                    <td>Compra</td>
                    <td><input type="int" name="id_compra" value="<?php echo $fila['id_compras']?>" readonly></td>                 
                </tr>                

                <tr>
                    <td>Articulo</td>   
                    <td><select name="id_articulo" value="<?php echo $fila['id_articulo']?>" readonly>                   
                    <?php
                        $control1 = $con -> prepare ("SELECT * from articulos,detalle_compra where detalle_compra.id_articulo = articulos.id_articulo");
                        $control1 -> execute();
                    while ($fila1 = $control1->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila1['id_articulo'] . ">"
                        . $fila1['nombre_A'] . "</option>";
                    } 
                    ?>
                </select></td>
                </tr>
                
                <?php
                    $sql = $con -> prepare("SELECT * FROM detalle_compra WHERE id_detalle_compra='".$_GET['id']."'");
                    $sql -> execute();
                    $fila = $sql -> fetch ();
                ?>

                <tr>
                    <td>Cantidad</td>
                    <td><input type="int" name="cantidad" value="<?php echo $fila['cantidad'] ?>"></td>                 
                </tr>

                <tr>
                    <td>Valor</td>
                    <td><input type="bigint" name="valor_neto_c" value="<?php echo $fila['valor_neto_c'] ?>"></td>                 
                </tr>

                <tr>
                <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>