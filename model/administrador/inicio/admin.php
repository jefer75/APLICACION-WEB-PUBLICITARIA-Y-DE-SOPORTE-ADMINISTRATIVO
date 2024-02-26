<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio de secion </title>
    <link rel="stylesheet" href="../../../css/admin.css">
</head>
<body>
<header>
<form action="" method="POST">

<td>

    <input type="submit" value="Cerrar_sesión" name="cerrar_sesion" id="cerrar_sesion"> 
</td>

</tr>
</form>
<?php 

if(isset($_POST['cerrar_sesion']))
{
    session_destroy();


    header('location: ../../../index.html');
}

?>

    
    <h1>Bienvenido Administrador</h1>
    </header>
    <br>
   
    <div class="a">
    
    <!-- <a href="" class="boton-animado"><h2>Graficos Estadisticos</h2></a> -->
    <section>
        <div>
            <a href="../consultar/read_user.php" class="boton-animado">Consultar Usuarios</a>
            <a href="../consultar/read_compras.php" class="boton-animado">Consultar compras</a>
            <a href="../consultar/read_articulos.php" class="boton-animado">Consultar articulos</a>
            <a href="../consultar/read_tipo_e.php" class="boton-animado">Consultar tipos de eventos</a>
            <a href="../consultar/read_tipo_user.php" class="boton-animado">Consultar tipos de usuarios</a>
            <a href="../consultar/read_eventos.php" class="boton-animado">Consultar eventos</a>
            <a href="../consultar/read_estados.php" class="boton-animado">Consultar estados</a>
            <a href="../consultar/read_factura.php" class="boton-animado">Consultar factura</a>
            <a href="../consultar/read_licencia.php" class="boton-animado">Consultar licencia</a>
            <a href="../consultar/read_paquetes.php" class="boton-animado">Consultar de paquetes</a>
            <a href="../consultar/read_tipo_articulo.php" class="boton-animado">Consultar de tipos de articulos</a>
            <a href="../consultar/read_tridders.php" class="boton-animado">Consultar de tridders</a>
            <a href="../consultar/read_detalle_compra.php" class="boton-animado">Consultar detalles de compra</a>
            <a href="../consultar/read_detalle_evento.php" class="boton-animado">Consultar detalles de eventos</a>
            <a href="../consultar/read_detalle_factura.php" class="boton-animado">Consultar detalles de facturas</a>

        </div>
    </section>
    
    </div>
    

</body>
</html>