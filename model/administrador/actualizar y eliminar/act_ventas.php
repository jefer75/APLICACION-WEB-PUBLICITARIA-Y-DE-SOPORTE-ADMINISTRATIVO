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
    <link rel="stylesheet" href="../../../css/tabla_ventas.css">
    <title>Tabla Ventas</title>
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
            <h1 class="title">VENTAS</h1>
            </header>
        </section>
        <table class="center">
            <form autocomplete="off" name="frm_consulta" method="GET">
                <tr class="tabla">
                    
                    <td>Identificador</td>
                    <td>Fecha de venta</td>
                    <td>Fecha de evento</td>
                    <td>Paquete</td>
                    <td>Valor total</td>
                    <td>Tipo de evento</td>
                    <td>Descripcion</td>
                    <td>Hora</td>
                    <td>Contacto</td>
                    <td>C.C Cliente</td>
                    <td>Ciudad</td>
                    <td>Tematica</td>
                    <td>Articualo</td>
                    <td>Recreador</td>
                    <td>Vendedor</td>
                    <td>Actualizar</td>
                    <td>Eliminar</td>
                    
                </tr> 
                
    <?php 

        $sql1 = $con->prepare ("SELECT * FROM ventas");
        $sql1->execute();
        $resultado1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultado1 as $resul) {        
                    
    ?>
        
        <tr>
            
            <td><?php echo $resul['id_ventas']?></td>
            <td><?php echo $resul['fecha_v']?></td>
            <td><?php echo $resul['fecha_e']?></td>
            <td><?php echo $resul['paquete']?></td>
            <td><?php echo $resul['valor_total']?></td>
            <td><?php echo $resul['id_tipo_e']?></td>
            <td><?php echo $resul['descripcion']?></td>
            <td><?php echo $resul['hora']?></td>
            <td><?php echo $resul['n_contacto']?></td>
            <td><?php echo $resul['cedula_cli']?></td>
            <td><?php echo $resul['ciudad']?></td>
            <td><?php echo $resul['tematica']?></td>
            <td><?php echo $resul['id_articulo']?></td>
            <td><?php echo $resul['id_recreador']?></td>
            <td><?php echo $resul['cedula']?> </td>
            
            
            <td><a href="?id=<?php echo $resul['id_ventas'] ?>" class="boton" onclick="window.open('update_ventas.php?id=<?php echo $resul['id_ventas'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Actualizar</a></td> 
            
            <td><a href="?id=<?php echo $resul['id_ventas'] ?>" class="boton" onclick="window.open('deleteven.php?id=<?php echo $resul['id_ventas'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Elimiar</a></td>
        </tr>

        <?php }?>
            </form>
        </table>
        
    </body>
</html>