<?php

if (isset($_POST['registro'])){

$articulo = $_POST['articulo'];
$cantidad = $_POST['cantidad'];       

if ( $articulo =="" || $cantidad =="")
{
 echo '<script>alert ("Por favor llene todos los campos");</script>';
}

else {
    //se traen los datos del articulo que el usuario selecciono
    $sql = $con -> prepare("SELECT * FROM articulos WHERE id_articulo=$articulo");
    $sql -> execute();
    $fila = $sql -> fetch ();

    $cantidad_disponible=$fila['cantidad'];
    $alquiler = $fila['valor'];
    
    //se multiplica para obtener el valor neto segun la cantidad de articulos que el usuario digite
    $valor_neto = $cantidad * $alquiler;    

    //se consulta si ya existe algun 
    $sql= $con -> prepare ("SELECT * FROM detalle_factura WHERE id_articulo = $articulo AND id_evento = $id_evento");
    $sql -> execute();
    $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);    

    $art_alquilados= $con -> prepare("SELECT SUM(detalle_factura.cantidad) AS articulos_alquilados
                                    FROM detalle_factura
                                    INNER JOIN eventos ON eventos.id_eventos = detalle_factura.id_evento
                                    INNER JOIN articulos ON articulos.id_articulo = detalle_factura.id_articulo
                                    WHERE eventos.f_inicio = '$fecha_inicio' AND detalle_factura.id_articulo = $articulo");
    $art_alquilados->execute();
    $articulos_alq = $art_alquilados->fetchAll(PDO::FETCH_ASSOC);

    foreach ($articulos_alq as $articulos_alq){

        $total = $articulos_alq['articulos_alquilados']; 
    }

    $suma = $total + $cantidad;

    if ($fila){
        if($suma <= $cantidad_disponible){
            $insertSQL = $con->prepare("UPDATE detalle_factura SET cantidad=$cantidad, valor_neto=$valor_neto WHERE id_articulo = $articulo AND id_evento = $id_evento");
            $insertSQL -> execute();
            echo '<script>alert ("El articulo se ha actualizado");</script>';
        }
        else {
            echo '<script>alert ("No tenemos disponible la cantidad de articulos para esa fecha");</script>';
        }
    }
    else{
        if($suma <= $cantidad_disponible){
        $insertSQL = $con->prepare("INSERT INTO detalle_factura(id_evento, id_articulo, cantidad, valor_neto) VALUES($id_evento, $articulo, $cantidad, $valor_neto)");
        $insertSQL -> execute();
        echo '<script> alert("Articulo reservado con exito");</script>';        
        }
        else{
            echo '<script>alert ("No tenemos disponible la cantidad de articulos para esa fecha");</script>';
        }
    }
    
}  

}