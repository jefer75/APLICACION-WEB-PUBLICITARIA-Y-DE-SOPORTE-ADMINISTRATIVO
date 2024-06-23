<?php

$sql = $con -> prepare("SELECT * FROM detalle_animador WHERE id_eventos = $id_evento");
$sql -> execute();
$fila = $sql -> fetch ();

//declaracion de variables de campos en la tabla
if (isset($_POST['registro'])){

 $animador = $_POST['animador'];

  if ( $animador =="")
   {
      echo '<script>alert ("Por favor seleccione el animador");</script>';
   }
   
   else {
     $sql= $con -> prepare ("SELECT * FROM detalle_animador 
     WHERE id_eventos = $id_evento AND cedula = $animador");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){

       echo '<script>alert ("El animador ya esta asignado para este evento");</script>';

   }
   else{

    $sql= $con -> prepare ("SELECT eventos.id_eventos, detalle_animador.cedula FROM detalle_animador INNER JOIN eventos ON eventos.id_eventos = detalle_animador.id_eventos Where eventos.f_inicio = '$fecha_inicio' AND detalle_animador.cedula = $animador");
    $sql -> execute();
    $anim_asignado = $sql -> fetchAll(PDO::FETCH_ASSOC);
    
    if($anim_asignado){
        echo '<script>alert ("El animador ya esta asignado para otro evento");</script>';
    }
    else {
        $insertSQL = $con->prepare("INSERT INTO detalle_animador(id_eventos, cedula ) VALUES('$id_evento', '$animador')");
        $insertSQL -> execute();
        echo '<script> alert("Animador asignado con éxito");</script>';
    }

   }
  }  
 }