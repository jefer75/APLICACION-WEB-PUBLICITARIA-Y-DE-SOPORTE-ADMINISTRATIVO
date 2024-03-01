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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar compras</title>
    <link rel="stylesheet" href="../../../css/tablas.css">
</head>
<body>
<form action="" method="POST">

<td>
<div class="btn-container">
            <input type="submit" value="Cerrar sesión" name="cerrar_sesion" id="cerrar_sesion"/>
            <input type="submit" value="Regresar" name="regresar" id="regresar">
            <td><input type="submit" value="Registrar" name="registrar" id="registrar"></td>
    </div>
</tr>
</form>
<?php 

if(isset($_POST['cerrar_sesion']))
{
    session_destroy();

    header('location: ../../../index.html');
}
else if (isset($_POST['regresar'])){
    header('Location: ../inicio/admin.php');

}else if (isset($_POST['registrar'])){
    header('Location: ../registrar/compras.php');
}

?>
    <div class="formulario">

    <h1 class="title">Consultar compras</h1>
        <form method="POST" action="">
        <table>
            <tr class="gris">
                <td>Detalles de la compra</td>
                <td>Identificador</td>
                <td>Fecha de Compra</td>
                <td>Cedula</td>
                <td>Valor Total</td>
                <td>Actualizar/eliminar</td>
                <td></td>
            </tr>
            
            <!-- <?php
             
            //       $query = $con -> prepare("SELECT detalle_compra.id_articulo, articulos.id_articulo From detalle_compra Join articulos on detalle_compra.id_articulo =articulos.id_articulo");
            //       $query -> execute ();
            //       $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

            //       foreach ($resultados as $fila){
            // ?>
            <tr>
            //     <td><?php //echo $fila['id_articulo']?></td>

            //     <?php
            //       }
            // ?> -->
            
            
            <?php
             
                  $query = $con -> prepare("SELECT * FROM compras");
                  $query -> execute ();
                  $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                  foreach ($resultados as $fila){
            ?>
                <td><a href="read_detalle_compra.php">Detalles</a></td>
                <td><?php echo $fila['id_compras']?></td>
                <td><?php echo $fila['fecha_c']?></td>
                <td><?php echo $fila['cedula']?></td>
                <td><?php echo $fila['valor_total']?></td>
                <td>
                <a class="hiper" href="" onclick="window.open
                ('../actualizar y eliminar/compras.php?id=<?php echo $fila['id_compras'] ?>','','width=500, height=400, toolbar=NO'); void(null);">Click Aqui</a>
                </td>
               
            </tr>
            <?php
                  }
            ?>
         
        </table>
 
        </form>               

    </div>

</body>

</html>