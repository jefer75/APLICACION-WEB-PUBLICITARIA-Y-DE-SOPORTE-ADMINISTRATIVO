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
<div class="btn-container">
            <input type="submit" value="Cerrar sesión" name="cerrar_sesion" id="cerrar_sesion"/>
            <input type="submit" value="Regresar" name="regresar" id="regresar">
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

}
?>
    <div class="formulario">

    <h1 class="title">Consulta de tridders</h1>
        <form method="POST" action="">
        <table>
            <tr class="gris">
                
                <td>Tipo</td>
                <td>Fecha de modificacion</td>
            </tr>
            
            <?php
             
                  $query = $con -> prepare("SELECT * FROM trig");
                  $query -> execute ();
                  $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                  foreach ($resultados as $fila){
            ?>
            <tr>
                <td>Cambio de contraseña</td>
                <td><?php echo $fila['fecha_creacion']?></td>
             
            </tr>
            <?php
                  }
            ?>
         
        </table>
 
        </form>               

    </div>

</body>
</html>