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
    <title>Actualizar Articulos</title>
    <link rel="stylesheet" href="../../../css/tablas.css">
</head>
<body>
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
    <div class="formulario">

    <h1 class="title">Actualizar Licencia</h1>
        <form method="POST" action="">
        <table>
            <tr class="gris">
                
                <td>id_licencia</td>
                <td>Licencia</td>
                <td>Nit</td>
                <td>Fecha_ini</td>
                <td>Fecha_fin</td>
                <td>Estado</td>
            </tr>
            
            <?php
             
                  $query = $con -> prepare("SELECT * FROM licencia");
                  $query -> execute ();
                  $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                  foreach ($resultados as $fila){
            ?>
            <tr>
                <td><?php echo $fila['id_licencia']?></td>
                <td><?php echo $fila['licencia']?></td>
                <td><?php echo $fila['nit']?></td>
                <td><?php echo $fila['fecha_ini']?></td>
                <td><?php echo $fila['fecha_fin']?></td>
                <td><?php echo $fila['id_estado']?></td>

                <td>
                <a class="hiper" href="" onclick="window.open
                ('update_licencia.php?id=<?php echo $fila['id_licencia'] ?>','','width=500, height=400, toolbar=NO'); void(null);">Actualizar/Eliminar</a>
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