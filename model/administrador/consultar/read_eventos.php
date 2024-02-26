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

    <h1 class="title">Consulta de eventos</h1>
        <form method="POST" action="">
        <table>
            <tr class="gris">
                
                <td>fecha de evento</td>
                <td>lugar</td>
                <td>cantidad de niños</td>
                <td>fecha de inicio</td>
                <td>fecha final</td>
                <td>hora de inicio</td>
                <td>hora final </td>
                <td>contacto</td>
                <td>Actualizar/Eliminar</td>



            </tr>
            
            <?php
             
                  $query = $con -> prepare("SELECT * FROM eventos");
                  $query -> execute ();
                  $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                  foreach ($resultados as $fila){
            ?>
            <tr>
                
                <td><?php echo $fila['fecha_evento']?></td>
                <td><?php echo $fila['lugar']?></td>
                <td><?php echo $fila['cant_ninos']?></td>
                <td><?php echo $fila['f_inicio']?></td>
                <td><?php echo $fila['f_fin']?></td>
                <td><?php echo $fila['hora_inicio']?></td>
                <td><?php echo $fila['hora fin']?></td>
                <td><?php echo $fila['contacto']?></td>
                <td>
                <a class="hiper" href="" onclick="window.open
                ('../actualizar y eliminar/id_eventos.php?id=<?php echo $fila['id_eventos'] ?>','','width=500, height=400, toolbar=NO'); void(null);">Click Aqui</a>
                </td>
            </tr>
            <?php
                  }
            ?>
         
        </table>
 
        </form>               

    </div>

</body>
