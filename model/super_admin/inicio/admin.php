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


<td><input type="submit" value="Regresar" name="regresar" id="regresar"></td>


</tr>
</form>
<?php 

if (isset($_POST['regresar'])){
    header('Location: ../../../index.html');
}

?>

    
    <h1>Bienvenido Administrador</h1>
    </header>
    <br>
   
    <div class="a">
    
    <!-- <a href="" class="boton-animado"><h2>Graficos Estadisticos</h2></a> -->
    <section>
        <div>
            <a href="../consultar/read_empresa.php" class="boton-animado">Empresas</a>
            <a href="../consultar/read_licencia.php" class="boton-animado">Licencia</a>
            
        </div>
    </section>
    
    </div>
    

</body>
</html>