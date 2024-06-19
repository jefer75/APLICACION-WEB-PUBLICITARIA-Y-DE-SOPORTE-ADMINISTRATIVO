<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //empieza la consulta
    $sql = $con -> prepare("SELECT * FROM paquetes WHERE id_paquetes='".$_GET['id']."'");
    $sql -> execute();
    $fila = $sql -> fetch ();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

            $nombre_paquete= $_POST['nombre_paquete'];
            $edad_minima = $_POST['edad_min'];
            $edad_maxima= $_POST['edad_max'];
            $valor = $_POST['valor'];
        
            $insert= $con -> prepare ("UPDATE paquetes SET nombre_paquete='$nombre_paquete', edad_min=$edad_minima, edad_max=$edad_maxima, valor=$valor WHERE id_paquetes = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
                
        }

        else if (isset($_POST['eliminar'])){
            
                $insert= $con -> prepare ("DELETE FROM paquetes WHERE id_paquetes = '".$_GET['id']."'");
                $insert -> execute();
                echo '<script> alert ("Registro actualizado exitosamente");</script>';
                echo '<script>
                        location.reload();
                      </script>';
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
        <title>Actualizar Paquetes</title>
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="../../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../../css/tablaedi.css" rel="stylesheet">

    </head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_actualizar" method="POST">
                <tr>
                    <td>Identificador</td>
                    <td><input class="form-input" value="<?php echo $fila['id_paquetes']?>" readonly></td>
                </tr>

                <tr>
                    <td>Nombre</td>
                    <td><input type="text" name="nombre_paquete" value="<?php echo $fila['nombre_paquete'] ?>"></td>                 
                </tr>

                <tr>
                    <td>Cantidad</td>
                    <td><input type="text" name="edad_min" value="<?php echo $fila['edad_min'] ?>"></td>                 
                </tr>
                <tr>
                    <td>Edad maxima</td>
                    <td><input type="text" name="edad_max" value="<?php echo $fila['edad_max'] ?>"></td>                 
                </tr>
                <tr>
                    <td>Valor</td>
                    <td><input type="text" name="valor" value="<?php echo $fila['valor'] ?>"></td>                 
                </tr>

                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input class="btn" style="background-color: gray; color: white;" type="submit" name="eliminar" value="Eliminar"></td>
                </tr>
            </form>
        </table>
</body>
</html>