<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio de secion</title>
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
            <a href="../consultar/read_user.php" class="boton-animado">Usuarios</a>
            <a href="../consultar/read_tipo_user.php" class="boton-animado">tipos de usuarios</a>
            <a href="../consultar/read_triggers.php" class="boton-animado">Registros de modificacion</a>

            <a href="../consultar/read_compras.php" class="boton-animado">Compras</a>
                        
            <a href="../consultar/read_articulos.php" class="boton-animado">Articulos</a>
            <a href="../consultar/read_tipo_articulo.php" class="boton-animado">Tipos de Articulos</a>

            <a href="../consultar/read_eventos.php" class="boton-animado">Eventos</a>
            <a href="../consultar/read_tipo_e.php" class="boton-animado">Tipos de Eventos</a>
            
            <a href="../consultar/read_paquetes.php" class="boton-animado">Paquetes</a>
            <a href="../consultar/read_estados.php" class="boton-animado">Estados</a>

            <a href="" class="boton-animado">Factura</a> 

        </div>
    </section>
    
    </div>
    

</body>
</html>