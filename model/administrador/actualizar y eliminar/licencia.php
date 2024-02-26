<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //empieza la consulta
    $sql = $con -> prepare("SELECT * FROM licencia WHERE id_licencia='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();
    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $id_licencia = $_POST['id_licencia'];
        $licencia = $_POST['licencia'];
        $nit = $_POST['nit'];
        $fecha_ini = $_POST['fecha_ini'];
        $fecha_fin = $_POST['fecha_fin'];
        $id_estado = $_POST['id_estado'];

            $insert= $con -> prepare ("UPDATE licencia SET Nit='$nit', fecha_fin='$fecha_fin', id_estado='$id_estado' WHERE id_licencia = '".$_GET['id']."'");
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
                    <td>id_licencia</td>
                    <td><input type="int" name="id_licencia" value="<?php echo $fila['id_licencia'] ?>" readonly></td>                 
                </tr>

                
                <tr>
                    <td>Licencia</td>
                    <td><input type="varchar" name="licencia" value="<?php echo $fila['licencia'] ?>" readonly></td>                 
                </tr>

                <tr>
                    <td>Nit</td>
                    <td><input type="varchar" name="nit" value="<?php echo $fila['nit'] ?>" ></td>                 
                </tr>

                <tr>
                    <td>Fecha de inicio</td>
                    <td><input type="int" name="fecha_ini" value="<?php echo $fila['fecha_ini'] ?>" placeholder="Cambiar contraseña" ></td>                 
                </tr>

                

                <tr>
                    <td>Fecha fin</td>
                    <td><input type="varchar" name="fecha_fin" value="<?php echo $fila['fecha_fin'] ?>" ></td>                 
                </tr>

                
                <tr>
                    <td>Estado</td>
                    <td>
                    <select name="id_estado">
                    <option value ="<?php echo $fila['id_estado'] ?>">Seleccione Estado de licencia</option>
                    <?php
                        $control = $con -> prepare ("SELECT * from estados where id_estado <= 2");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_estado'] . ">"
                        . $fila['estado'] . "</option>";
                    } 
                    ?>                    
                    </select>
                    </td>                
                </tr>

               
                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="eliminar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>