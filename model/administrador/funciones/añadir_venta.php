<?php
if (isset($_POST['registrar'])){
            
    $paquete = $_POST['paquete'];
    $tipo_e = $_POST['tipo_e'];
    $lugar = $_POST['lugar'];
    $cant_ninos = $_POST['cantidad'];
    $f_inicio = $_POST['f_inicio'];
    $f_fin = $_POST['f_fin'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $descripcion = $_POST['descripcion'];
    $contacto = $_POST['contacto'];
           
    if ($paquete==""|| $tipo_e=="")
    {
        echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
        echo '<script>window.location="cumpleaños.php"</script>';
    }
              
    else{
        
        $insertSQL = $con->prepare("INSERT INTO `eventos`( id_paquetes, id_tipo_e, lugar, cant_ninos,   f_inicio, `f_fin, hora_inicio, hora_fin,  descripcion, contacto) VALUES($paquete, $tipo_e, '$lugar', '$cant_ninos', '$f_inicio', '$f_fin', '$hora_inicio', '$hora_fin', '$descripcion', '$contacto')");
        $insertSQL -> execute();
        
        
        $cedula = $_POST['cedula'];
                
        $con_nombre = $con->prepare("SELECT * FROM eventos WHERE id_paquetes = $paquete AND f_inicio = $f_inicio AND f_fin = $f_fin AND descripcion = $descripcion");
        $con_nombre->execute();
        $nombres = $con_nombre->fetchAll(PDO::FETCH_ASSOC);
        foreach ($nombres as $fila) {
            $id_evento = $fila['id_evento'];
        }
        
        $fecha_actual = date("Y-m-d");
        $contacto = $_POST['contacto'];
                
        
        $insertSQL = $con->prepare("INSERT INTO factura(fecha, id_evento, cedula, valor_total) VALUES($fecha_actual $id_evento, $valor_total)");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="cumpleaños.php"</script>';
    }  
}