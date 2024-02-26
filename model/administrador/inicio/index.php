<?php
    session_start();
    require_once ("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new DataBase();
    $con = $db -> conectar();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Gerente</title>
    <link rel="stylesheet" href="../../../css/admin.css">
</head>
<body>
<header>
<form action="" method="POST">

<td>

    <input type="submit" value="Cerrar_sesión" name="cerrar_sesion" id="cerrar_sesion"/></td>

    <td>
    <input type="submit" value="regresar" name="regresar" id="regresar">
</td>
</tr>
</form>
<?php 

if(isset($_POST['cerrar_sesion']))
{
    session_destroy();


    header('location: ../../../index.html');
}
if (isset($_POST['regresar'])){
    header('location: admin.php');

}
?>

<h1>Gestion de Datos</h1>
</header>

        <div class="a">
            <div>
                <a href="../registrar/registro_user.php" class="boton-animado">Registro Usuarios</a>
                <a href="../registrar/registro_articulos.php" class="boton-animado">Registro Articulos</a>
                <a href="../registrar/registro_compras.php" class="boton-animado">Registro Compras</a>
                <a href="../registrar/registro_empleados.php" class="boton-animado">Registro Empleado</a>
                <a href="../registrar/registro_ventas.php" class="boton-animado">Registro ventas</a>
                <a href="../registrar/registro_tipo_e.php" class="boton-animado">Registro Tipo de Evento</a>
            </div>
        </div>
        <div class="a">
            <div>
            <a href="../actualizar y eliminar/act_usuarios.php" class="boton-animado">Actualizar o Eliminar Usuarios</a>
            <a href="../actualizar y eliminar/act_compras.php" class="boton-animado">Actualizar o Eliminar compras</a>
            <a href="../actualizar y eliminar/act_articulos.php" class="boton-animado">Actualizar o Eliminar articulos</a>
            <a href="../actualizar y eliminar/act_empleados.php" class="boton-animado">Actualizar o Eliminar empleados</a>
            <a href="../actualizar y eliminar/act_tipo_eve.php" class="boton-animado">Actualizar o Eliminar tipos de eventos</a>
            <a href="../actualizar y eliminar/act_ventas.php" class="boton-animado">Actualizar o Eliminar ventas</a>
            </div>
        </div>

    <img src="../../../img/payasito_admin.png" alt="">
    

</body>
</html>