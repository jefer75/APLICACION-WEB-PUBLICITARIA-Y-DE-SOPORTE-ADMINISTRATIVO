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
    <title>Licencia</title>
    <link rel="stylesheet" href="../../../css/tablas.css">
</head>
<body>
<form action="" method="POST">

<td>
    <td><input type="submit" value="Regresar" name="regresar" id="regresar"></td>
    <td><input type="submit" value="registrar" name="registrar" id="registrar"></td>
</tr>
</form>
<?php 

if (isset($_POST['regresar'])){
    header('Location: ../inicio/admin.php');

}else if (isset($_POST['registrar'])){
    header('Location: ../registrar/licencia.php');
}

?>
    <div class="formulario">


    <h1 class="title">Licencias</h1>
        <form method="POST" action="">
        <table>
            <tr class="gris">

            <td>Licencia</td>
                <td>Nit</td>
                <td>Fecha de inicio</td>
                <td>Fecha de final</td>
                <td>Estado</td>
                <td>Actualizar/Eliminar</td>
            </tr>
            
            <?php 
             
                  $query = $con -> prepare("SELECT * FROM licencia");
                  $query -> execute ();
                  $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                  foreach ($resultados as $fila){
            ?>
            <tr>
                <td><?php echo $fila['licencia']?></td>
                <td><?php echo $fila['nit']?></td>
                <td><?php echo $fila['fecha_ini']?></td>
                <td><?php echo $fila['fecha_fin']?></td>
                <td><?php echo $fila['id_estado']?></td>
                </td>
                <td>
                <a class="hiper" href="" onclick="window.open
                ('../actualizar y eliminar/licencia.php?id=<?php echo $fila['id_licencia'] ?>','','width=500, height=400, toolbar=NO'); void(null);">Click Aqui</a>
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