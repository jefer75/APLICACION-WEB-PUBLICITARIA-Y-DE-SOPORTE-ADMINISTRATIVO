<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //empieza la consulta
    $sql = $con -> prepare("SELECT * FROM eventos WHERE id_eventos='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $id_eventos= $_POST['id_eventos'];
        $id_paquetes= $_POST['id_paquetes'];
        $id_tipo_e= $_POST['id_tipo_e'];
        $lugar= $_POST['lugar'];
        $cant_ninos= $_POST['cant_ninos'];
        $f_inicio= $_POST['f_inicio'];
        $f_fin= $_POST['f_fin'];
        $hora_inicio= $_POST['hora_inicio']; 
        $hora_fin= $_POST['hora_fin'];
        $contacto= $_POST['contacto'];
        
            $insert= $con -> prepare ("UPDATE eventos SET id_paquetes='$id_paquetes', id_tipo_e=$id_tipo_e, lugar='$lugar', cant_ninos='$cant_ninos', f_inicio='$f_inicio', f_fin='$f_fin', hora_inicio='$hora_inicio', hora_fin='$hora_fin', contacto=$contacto WHERE id_eventos = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';   
        }

        else if (isset($_POST['eliminar'])){
            
                $insert= $con -> prepare ("DELETE FROM eventos WHERE id_eventos = '".$_GET['id']."'");
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
    <link rel="stylesheet" href="../../../css/tablaedi.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_actualizar" method="POST">
            
                <br>
                <label  for="id_eventos"></label>
                <br>
                <input class="cont"     type="int" name="id_eventos" id="lugar" pattern="[a-zA-Z]{1,40}" title="Solo se permiten letras" placeholder="Digite Lugar del evento" value="<?php echo $fila['id_eventos'] ?>" readonly>
                <br>
                <br>
                <select class="cont" name="id_paquetes">
                    <option value ="<?php echo $fila['id_paquetes'] ?>">Seleccione el paquete</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from paquetes");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_paquetes'] . ">"
                        . $fila['nombre_paquete'] . "</option>";
                    } 
                    ?>
                </select>
                <br>
                <?php
                $sql = $con -> prepare("SELECT * FROM eventos WHERE id_eventos='".$_GET['id']."'");
                $sql -> execute();
                $fila = $sql -> fetch ();
                ?>
                <select class="cont" name="id_tipo_e">
                    <option value ="<?php echo $fila['id_tipo_e'] ?>">Seleccione Tipo de Evento</option>
                    
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

                <?php
                $sql = $con -> prepare("SELECT * FROM eventos WHERE id_eventos='".$_GET['id']."'");
                $sql -> execute();
                $fila = $sql -> fetch ();
                ?>

                <br>
                <label  for="lugar"></label>
                <br>
                <input class="cont"     type="varchar" name="lugar" id="lugar" pattern="[a-zA-Z]{1,40}" title="Solo se permiten letras" placeholder="Digite Lugar del evento" value="<?php echo $fila['lugar'] ?>">
                <br>
                <label for="cant_ninos"></label>
                <br>
                <input class="cont"     type="int" name="cant_ninos" value="<?php echo $fila['cant_ninos'] ?>" >
                <br>
                <p>Fecha de inicio</p>
                <label for="f_inicio"></label>
                <br>
                <input class="cont"     type="date" name="f_inicio" <?php echo $fila['f_inicio'] ?> >
                <br>
                <p>Fecha de fin</p>
                <label for="f_fin"></label>
                <br>
                <input class="cont"    type="date" name="f_fin" value="<?php echo $fila['f_fin'] ?>">
                <br>
                <p>Hora de fin</p>
                <label for="hora_inicio"></label>
                <br>
                <input class="cont"     type="time" name="hora_inicio" value="<?php echo $fila['hora_inicio'] ?>" >
                <br>
                <!--Password -->
                <p>Hora de inicio</p>
                <label for="hora_fin"></label>
                <br>
                <input class="cont"    type="time" name="hora_fin" value="<?php echo $fila['hora_fin'] ?>">
                <br>
                <label for="contacto"></label>
                <br>
                <input class="cont" type="int" name="contacto" value="<?php echo $fila['contacto'] ?>">
                <br>

                <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
            </form>
        </table>
</body>
</html>