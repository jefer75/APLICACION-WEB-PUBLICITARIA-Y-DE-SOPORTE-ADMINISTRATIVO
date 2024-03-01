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
    <title>Paquetes</title>
    <link rel="stylesheet" href="../../../css/tablas.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
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
}
else if (isset($_POST['registrar'])){
    header('Location: ../registrar/paquetes.php');
}

?>
    <div class="formulario">

    <h1 class="title">Paquetes</h1>
        <form method="POST" action="">
        <table>
            <tr class="gris">
           
                
                <td>Nombre Paquete</td>
                <td>edad_min</td>
                <td>edad_max</td>
                <td>valor</td>
                <td>Actualizar/Eliminar</td>
        
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
                
                <td><a href="" class="boton" onclick="window.open
                ('../actualizar y eliminar/paquetes.php?id=<?php echo $fila['id_paquetes'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Click Aqui</a></td>

            </tr>
            <?php
                  }
            ?>
         
        </table>
 
        </form>               

    </div>

</body>

</html>