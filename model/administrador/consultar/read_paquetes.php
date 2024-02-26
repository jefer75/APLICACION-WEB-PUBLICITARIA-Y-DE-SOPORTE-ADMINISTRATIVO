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
    <title>Productos</title>
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
    header('Location: ../inicio/index_consulta.php');
}

?>>
    <div class="formulario">

    <h1 class="title">Consulta de paquetes</h1>
        <form method="POST" action="">
        <table>
            <tr class="gris">
                
                <td>nombre de paquete</td>
                <td>edad minima</td>
                <td>edad maxima</td>
                <td>valor</td>
                




            </tr>
            
            <?php
             
                  $query = $con -> prepare("SELECT * FROM paquetes");
                  $query -> execute ();
                  $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                  foreach ($resultados as $fila){
            ?>
            <tr>
                
                <td><?php echo $fila['nombre_paquete']?></td>
                <td><?php echo $fila['edad_min']?></td>
                <td><?php echo $fila['edad_max']?></td>
                <td><?php echo $fila['valor']?></td>
             
            </tr>
            <?php
                  }
            ?>
         
        </table>
 
        </form>               

    </div>

</body>
