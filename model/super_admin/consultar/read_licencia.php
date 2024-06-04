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
    <link rel="stylesheet" href="../../../css/superadmin.css">
</head>
<body>
<form action="" method="POST">

<td>
    <td><input type="submit" value="Regresar" name="regresar" id="regresar" style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 15px; text-decoration: none; margin-top: 20px;"></td>
    <td><input type="submit" value="registrar" name="registrar" id="registrar" style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 15px; text-decoration: none; margin-top: 20px;"></td>
</tr>
</form>
<?php 

if (isset($_POST['regresar'])){
    header('Location: ../inicio/admin.php');

}else if (isset($_POST['registrar'])){
    header('Location: ../registrar/licencia.php');
}

?>


</style>
    <div class="formulario">
<h1 class="card-title" style="font-family: 'Arial Rounded MT Bold', sans-serif; text-align: center; margin-top: 20px;">Licencias</h1>
        <form method="POST" action="">
        <table class="custom-table">
            <tr class="header-row">
            <th>Licencia</th>
                <th>Nit</th>
                <th>Fecha de inicio</th>
                <th>Fecha de final</th>
                <th>Estado</th>
                <th>Actualizar/Eliminar</th>
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