<?php
if (isset($_POST['editar'])) {
    
    
    switch ($_POST['editar']) {
        //casos de registros
        case 'editar':
            editar();
            break;
        case 'eliminar':
            eliminar();
            break;
        }
    }
    
    

    function editar()
    {
        //extract($_POST);
        require_once("../../../db/connection2.php");

        $id =  $_POST ['id_paquetes'] ;
        $nombre =  $_POST ['nombre_p'] ;
        $min =  $_POST ['edad_min'] ;
        $max =  $_POST ['edad_max'] ;
        $valor=  $_POST ['valor'] ;
        
    //casos de registros
    $consulta = "UPDATE paquetes SET nombre_paquete = '$nombre', edad_min = '$min', edad_max = '$max', valor=$valor WHERE id_paquetes =$id";
    echo $id, $nombre, $min, $max, $valor;
    $resultado = mysqli_query($con, $consulta);
    
    echo "<script>alert('Su registro ha sido actualizado con éxito')</script>";
    header("location:../pages/paquetes.php");
}

    function eliminar()
    {
        //extract($_POST);
        require_once("../../../db/connection2.php");
        
        $id =  $_POST ['id_paquetes'] ;

    //casos de registros
    $consulta = "DELETE FROM paquetes WHERE id_paquetes =$id";
    $resultado = mysqli_query($con, $consulta);

    header("location:../pages/paquetes.php");
}