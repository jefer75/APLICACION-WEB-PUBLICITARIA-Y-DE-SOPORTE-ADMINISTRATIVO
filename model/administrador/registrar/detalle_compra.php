<?php
        session_start();
        require_once("../../../db/connection.php");
        // include("../../../controller/validarSesion.php");
        $db = new Database();
        $con = $db -> conectar();

    //empieza la consulta
    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
    {

    //declaracion de variables de campos en la tabla
        $id_detalle_compra = $_POST['id_detalle_compra'];
        $id_compras= $_POST['id_compras'];
        $id_articulo= $_POST['id_articulo'];
        $cantidad= $_POST['cantidad'];
        $valor_neto_c = $_POST['valor_neto_c'];

        $sql= $con -> prepare ("SELECT * FROM detalle_compra");
        $sql -> execute();
        $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

         if ($id_compras=="" || $id_articulo=="" || $cantidad=="" || $valor_neto_c=="")
          {
             echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
             echo '<script>window.location="detalle_compra.php"</script>';
          }
          
          else{
            $insertSQL = $con->prepare("INSERT INTO detalle_compra(id_compras, id_articulo, cantidad, valor_neto_c) VALUES('$id_compras', '$id_articulos', '$cantidad', '$valor_neto_c')");
            $insertSQL -> execute();

            echo '<script> alert("REGISTRO EXITOSO");</script>';
            echo '<script>window.location="../consultar/read_detalle_compra.php"</script>';
         }  
    }
        
?>

<!DOCTYPE html>
<html lang="en">
    <script>
        function centrar() {
            iz=(screen.width-document.body.clientWidth) / 2;
            de=(screen.height-document.body.clientHeight) / 3;
            moveTo(iz,de);
        }
    </script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle compra</title>
    <link rel="stylesheet" href="../../../css/formularios.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
</head>
<body onload="centrar();">
<?php echo $id_articulo ?>
<form action="" method="POST">

<td>

    <input  class="c"    type="submit" value="Cerrar_sesión" name="cerrar_sesion" id="cerrar_sesion"/></td>
    <td><input   class="r"     type="submit" value="Regresar" name="regresar" id="regresar"></td>
</tr>
</form>
<?php 

if(isset($_POST['cerrar_sesion']))
{
    session_destroy();

    header('location: ../../../index.html');
}
else if (isset($_POST['regresar'])){
    header('Location: ../consultar/read_detalle_compra.php');
}

?>

<div class="formulario">
        <div class="signup-box">
            
            <h1 class="signup-title">REGISTRO DETALLE DE COMPRA</h1>
            <br>
            <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off">  
                <tr>
                     
                    <td><select name="id_compras" class="cont">
                    <option value ="">Seleccione la compra</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from compras");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_compras'] . ">"
                        . $fila['id_compras'] . "</option>";
                    } 
                    ?>
                </select></td>
                </tr>

                <tr>
                       
                    <td><select name="id_articulo" class="cont">
                    <option value ="">Seleccione el articulo</option>
                    
                    <?php
                        $control = $con -> prepare ("SELECT * from articulos");
                        $control -> execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                    {
                        echo "<option value=" . $fila['id_articulo'] . ">"
                        . $fila['nombre_A'] . "</option>";
                    } 
                    ?>
                </select></td>
                </tr>

                <tr>     
                    <td><input type="int" name="cantidad" placeholder="Digite la cantidad" class="cont"></td>                 
                </tr>

                <tr>
                    <td><input type="bigint" name="valor_neto_c" placeholder="Digite el valor" class="cont"></td>                 
                </tr>

                <tr>           
                <br>

                <input class="b"     type="submit" name="validar" value="Registro">
                <input   type="hidden" name="MM_insert" value="formreg">
                </form>

        </div> 
    </div>

</body>
</html>