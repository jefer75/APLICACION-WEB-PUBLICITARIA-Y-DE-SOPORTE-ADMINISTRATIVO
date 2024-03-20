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
    header('Location: ../registrar/tipo_e.php');
}

?>
    <div class="formulario">

    <h1 class="title">Consulta de Tipos de Evento</h1>
        <form method="POST" action="">
        <table>
            <tr class="gris">
                
                <td>Identificador</td>
                <td>Tipo de evento</td>
                <td>Actualizar/Eliminar</td>

            </tr>
            
            <?php
             
                  $query = $con -> prepare("SELECT * FROM tipo_e");
                  $query -> execute ();
                  $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                  foreach ($resultados as $fila){
            ?>
            <tr>
                <td><?php echo $fila['id_tipo_e']?></td>
                <td><?php echo $fila['tipo_evento']?></td>
                <td>
                <a class="hiper" href="" onclick="window.open
                ('../actualizar y eliminar/tipo_e.php?id=<?php echo $fila['id_tipo_e'] ?>','','width=500, height=400, toolbar=NO'); void(null);">Click Aqui</a>
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