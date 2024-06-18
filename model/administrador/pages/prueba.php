<?php
session_start();
require_once "../../../db/connection.php";
//include("../../../controller/validar_licencia.php");
$db = new DataBase();
$con = $db->conectar();

if (isset($_POST['registrar'])){
            
    $terminos = $_POST['terminos'];
    
    $fecha_actual=date('Y-m-d');
    $tipo_e = $_POST['tipo_evento'];
    $paquete = $_POST['paquete'];
    $cliente = $_POST['cliente'];
    $lugar = $_POST['lugar'];
    $cant_ninos = $_POST['cantidad'];
    $f_inicio = $_POST['f_inicio'];
    $f_fin = $_POST['f_fin'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $descripcion = $_POST['descripcion'];
    $estado = 6;
    
           
     if ($paquete="" || $tipo_e="" || $cliente="" || $lugar=="" || $cant_ninos==""|| $f_inicio=="" || $f_fin==""|| $hora_inicio=="" || $hora_fin==""|| $descripcion=="")
     {
        echo '<script>alert ("Por favor llene todos los campos");</script>';
         echo '<script>window.location="registro_venta.php"</script>';
     }
              
     else{
        
        //  $insertSQL = $con->prepare("INSERT INTO eventos(fecha_evento, id_paquetes, id_tipo_e, lugar, cant_ninos, f_inicio, f_fin, hora_inicio, hora_fin, descripcion, cedula, id_estado) VALUES ('$fecha_actual', $paquete, $tipo_e, '$lugar', $cant_ninos, '$f_inicio', '$f_fin', '$hora_inicio', '$hora_fin', '$descripcion', $cliente, $estado)");
        //  $insertSQL -> execute();
        //  echo '<script>alert ("Reserva Registrada Exitosamente");</script>';
        //  echo '<script>window.location="registro_venta.php"</script>';
        echo "tipo de evento: ", $tipo_e,
    " paquete: ", $paquete,
    " cliente: ",  $cliente,
    " lugar: ", $lugar,
    " cant: ", $cant_ninos,
    " f inicio: ",  $f_inicio,
    " f fin: ", $f_fin,
    " hora ini: ", $hora_inicio,
    " hora fin: ",  $hora_fin,
    " descrip: ", $descripcion,
    " homenda:", $estado,
    " actual:", $fecha_actual;
         }  
}

