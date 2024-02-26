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

    $sql = $con -> prepare("SELECT * FROM ventas WHERE id_ventas='".$_GET['id']."'");
    $sql -> execute();
    $fila1 = $sql -> fetch ();

    $sql = $con -> prepare("SELECT * FROM ventas WHERE id_ventas='".$_GET['id']."'");
    $sql -> execute();
    $fila2 = $sql -> fetch ();

    $sql = $con -> prepare("SELECT * FROM ventas WHERE id_ventas='".$_GET['id']."'");
    $sql -> execute();
    $fila3 = $sql -> fetch ();
    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $id_ventas= $_POST['id_ventas'];
        $fecha_v = $_POST['fecha_v'];
        $fecha_e= $_POST['fecha_e'];
        $paquete= $_POST['paquete'];
        $valor_total = $_POST['valor_total'];
        $id_tipo_e = $_POST['id_tipo_e'];
        $descripcion= $_POST['descripcion'];
        $hora = $_POST['hora'];
        $n_contacto= $_POST['n_contacto'];
        $cedula_cli= $_POST['cedula_cli'];
        $ciudad = $_POST['ciudad'];
        $tematica = $_POST['tematica'];
        $id_articulo= $_POST['id_articulo'];
        $id_recreador = $_POST['id_recreador'];
        $id_vendedor= $_POST['id_vendedor'];
        
            $insert= $con -> prepare ("UPDATE ventas SET fecha_v='$fecha_v', fecha_e='$fecha_e', paquete='$paquete', valor_total='$valor_total', id_tipo_e='$id_tipo_e',  descripcion='$descripcion', hora='$hora', n_contacto='$n_contacto', cedula_cli='$cedula_cli',  ciudad='$ciudad', tematica='$tematica', id_articulo='$id_articulo', id_recreador='$id_recreador', cedula='$id_vendedor'  WHERE id_ventas = '".$_GET['id']."'");
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
                    <td>Identificador</td>
                    <td><input name="id_ventas" value="<?php echo $fila['id_ventas'] ?>" readonly></td>
                </tr>

                <tr>
                    <td>Fecha de venta</td>
                    <td><input type="date" name="fecha_v" value="<?php echo $fila['fecha_v'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Fecha de evento</td>
                    <td><input type="date" name="fecha_e" value="<?php echo $fila['fecha_e'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>paquete</td>
                    <td><input type="varchar" name="paquete" value="<?php echo $fila['paquete'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Valor total</td>
                    <td><input type="int" name="valor_total" value="<?php echo $fila['valor_total'] ?>" placeholder="Cambiar contraseña" ></td>                 
                </tr>

                

                <tr>
                    <td>Descripcion</td>
                    <td><input type="varchar" name="descripcion" value="<?php echo $fila['descripcion'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Hora</td>
                    <td><input type="varchar" name="hora" value="<?php echo $fila['hora'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Numero de contacto</td>
                    <td><input type="int" name="n_contacto" value="<?php echo $fila['n_contacto'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Cedula de cliente</td>
                    <td><input type="bigint" name="cedula_cli" value="<?php echo $fila['cedula_cli'] ?>"></td>                 
                </tr>

                <tr>
                    <td>ciudad</td>
                    <td><input type="varchar" name="ciudad" value="<?php echo $fila['ciudad'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>tematica</td>
                    <td><input type="varchar" name="tematica" value="<?php echo $fila['tematica'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Tipo de evento</td>
                    <td>
                    <select name="id_tipo_e">
                    <option value ="<?php echo $fila['id_tipo_e'] ?>"><?php echo $fila['id_tipo_e']?></option>
                    <?php
                        $control = $con -> prepare ("SELECT * from tipo_e");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_tipo_e'] . ">"
                        . $fila['tipo_evento'] . "</option>";
                    } 
                    ?>                    
                    </select>
                    </td>                
                </tr>

                <tr>
                    <td>Articulo</td>
                    <td>    <select name="id_articulo">
                    <option value ="<?php echo $fila1['id_articulo']?>"><?php echo $fila1['id_articulo']?></option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from articulos");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_articulo'] . ">"
                        . $fila['nombre_A'] . "</option>";
                    } 
                    ?>
                        </select>
                    </td>              
                </tr>

                <tr>
                    <td>Recreador</td>
                    <td><select name="id_recreador">
                    <option value="<?php echo $fila2['id_recreador']?>"><?php echo $fila2['id_recreador'] ?></option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from empleados");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_recreador'] . ">"
                        . $fila['nombre_p'] . "</option>";
                    } 
                    ?>
                </select></td>
                </tr>

                <tr>
                    <td>Cedula</td>
                    <td>
                    <select name="id_vendedor">
                    <option value ="<?php echo $fila3['cedula']?>"><?php echo $fila3['cedula']?></option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from usuarios");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['cedula'] . ">"
                        . $fila['nombre'] . "</option>";
                    } 
                    ?>
                </select>             
                </tr>

                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>