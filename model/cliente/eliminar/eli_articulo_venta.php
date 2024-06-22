<?php
if (isset($_POST['eliminar'])){
          
    $articulo = $_POST['articulo_select'];
    $cantidad = $_POST['cantidad'];  

    $sql= $con -> prepare ("SELECT * FROM articulos WHERE id_articulo = $articulo");
    $sql -> execute();
    $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
    foreach ($fila as $fila) {
    $nombre_arti = $fila['nombre_A'];
    $alquiler = $fila['valor'];
    $disponible = $fila['cantidad'];
    }
 
    $cantidad_actual= $disponible + $cantidad;
    
    $insertSQL = $con->prepare("UPDATE articulos SET cantidad = $cantidad_actual WHERE id_articulo = $articulo");
    $insertSQL -> execute();

    $insert= $con -> prepare ("DELETE FROM detalle_factura WHERE id_evento = $id_evento AND id_detalle_eve = $articulo");
    $insert -> execute();
    echo '<script> alert ("Se elimino el articulo")</script>';
  }