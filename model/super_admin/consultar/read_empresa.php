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
    <title>Empresas</title>
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


    <h1 class="title">Empresas</h1>
        <form method="POST" action="">
        <table>
            <tr class="gris">

                <td>Nit</td>
                <td>Nombre de empresa</td>
                <td>Telefono</td>
                <td>Direccion</td>
                <td>Actualizar/Eliminar</td>
            </tr>
            
            <?php 
             
                  $query = $con -> prepare("SELECT * FROM empresa");
                  $query -> execute ();
                  $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                  foreach ($resultados as $fila){
            ?>
            <tr>
            <td><?php echo $fila['nit']?></td>
                <td><?php echo $fila['nombre_emp']?></td>
                <td><?php echo $fila['telefono']?></td>
                <td><?php echo $fila['direccion']?></td>
                </td>
                <td>
                <a class="hiper" href="" onclick="window.open
                ('../actualizar y eliminar/empresa.php?id=<?php echo $fila['nit'] ?>','','width=500, height=400, toolbar=NO'); void(null);">Click Aqui</a>
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