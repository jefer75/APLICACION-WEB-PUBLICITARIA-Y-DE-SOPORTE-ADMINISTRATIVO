<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
    <link rel="stylesheet" href="../../../css/tablas.css">
    <title>Tabla Tipo de Evento</title>
</head>
    <body onload="frm_guardar.tipu.focus()">

    <form action="" method="POST">

<td>

    <input type="submit" value="Cerrar_sesión" name="cerrar_sesion" id="cerrar_sesion"/></td>
    <td><input type="submit" value="Regresar" name="regresar" id="regresar"></td>
</tr>
</form>
<?php 

if(isset($_POST['cerrar_sesion']))
{
    session_destroy();

    header('location: ../../../index.html');
}
else if (isset($_POST['regresar'])){
    header('Location: ../inicio/index.php');
}

?>

        <section class="title">
            <header>
            <h1>TIPO DE EVENTO</h1>
            </header>
        </section>
        <table class="center">
            <form autocomplete="off" name="frm_consulta" method="GET">
                <tr class="tabla">
                    <td>&nbsp;</td>
                    <td>Identificador</td>
                    <td>Tipo de evento</td>
                    <td>Actualizar</td>
                    <td>Eliminar</td>
                    <td>&nbsp;</td>
                </tr> 
                
    <?php 

        $sql1 = $con->prepare ("SELECT * FROM tipo_e");
        $sql1->execute();
        $resultado1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultado1 as $resul) {        
                    
    ?>
        
        <tr>
            <td>&nbsp;</td>
            <td><?php echo $resul['id_tipo_e']?></td>
            <td>"<?php echo $resul['tipo_evento']?></td>
            
            <td><a href="?id=<?php echo $resul['id_tipo_e'] ?>" class="boton" onclick="window.open('update_tipo_e.php?id=<?php echo $resul['id_tipo_e'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Actualizar</a></td> 

            <td><a href="?id=<?php echo $resul['id_tipo_e'] ?>" class="boton" onclick="window.open('deleteeve.php?id=<?php echo $resul['id_tipo_e'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Eliminar</a></td>
        
        </tr>

        <?php }?>
            </form>
        </table>
        
    </body>
</html>