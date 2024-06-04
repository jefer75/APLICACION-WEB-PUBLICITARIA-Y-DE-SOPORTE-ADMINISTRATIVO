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
    <link rel="stylesheet" href="../../../css/superadmin.css">
</head>
<body>
<form action="" method="POST">

<td>
    <td><input type="submit" value="Regresar" name="regresar" id="regresar"  style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 15px; text-decoration: none; margin-top: 20px;"></td>
    <td><input type="submit" value="registrar" name="registrar" id="registrar" style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 15px; text-decoration: none; margin-top: 20px;"></td>
</tr>
</form>
<?php 

if (isset($_POST['regresar'])){
    header('Location: ../inicio/admin.php');

}else if (isset($_POST['registrar'])){
    header('Location: ../registrar/empresa.php');
}

?>

   
<div class="formulario">
<h1 class="card-title" style="font-family: 'Arial Rounded MT Bold', sans-serif; text-align: center; margin-top: 20px;">Empresas</h1>
    <form method="POST" action="">
        <table class="custom-table">
            <tr class="header-row">
                <th>Nit</th>
                <th>Nombre de empresa</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Actualizar/Eliminar</th>
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