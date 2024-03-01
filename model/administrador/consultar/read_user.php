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
    <title>Usuarios</title>
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
    header('Location: ../registrar/registro_admin.php');
}
?>
    <div class="formulario">

    <h1 class="title">Consulta de usuarios</h1>
        <form method="POST" action="">
        <table>
            <tr class="gris">
                
                <td>Cedula</td>
                <td>Nombre</td>
                <td>Telefono</td>
                <td>Correo</td>
                <td>Tipo de usuario</td>
                <td>Estado</td>
                <td>Nit</td>
                <td>Actualizar/Eliminar</td>
            </tr>
            
            <?php
             
                  $query = $con -> prepare("SELECT * FROM usuarios");
                  $query -> execute ();
                  $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                  foreach ($resultados as $fila){
            ?>
            <tr>
                <td><?php echo $fila['cedula']?></td>
                <td><?php echo $fila['nombre']?></td>
                <td><?php echo $fila['celular']?></td>
                <td><?php echo $fila['correo']?></td>
                <td><?php echo $fila['id_tipo_user']?></td>
                <td><?php echo $fila['id_estado']?></td>
                <td><?php echo $fila['nit']?></td>
                <td>
                <a class="hiper" href="" onclick="window.open
                ('../actualizar y eliminar/usuarios.php?id=<?php echo $fila['cedula'] ?>','','width=500, height=400, toolbar=NO'); void(null);">Click Aqui</a>
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