<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/usuario.css">
        <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
        <title>Interfaz de recreadores</title>
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
        
        
            header('location:../../index.html');
        }
        
        ?>
  
            <h1>Bienvenido</h1>
            </header> 
          
     <body>
        <div class="container">
          <h1>Tabla de Eventos</h1>
          <table>
            <thead>
              <tr>
                <th>Fecha evento</th>
                <th>Hora evento</th>
                <th>lugar</th>
                <th>cantidad de niños</th>
                <th>Contacto</th>
                <th>Paquete</th>
                <th>tipo de evento</th>
                <th>Animador</th>
              </tr>
            </thead>

            <tr> 
              <?php
              
              $query = $con -> prepare("SELECT * FROM eventos");
              $query -> execute ();
              $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

              foreach ($resultados as $fila){
              ?>

              <td><?php echo $fila['f_inicio']?></td>
              <td><?php echo $fila['hora_inicio']?></td>
              <td><?php echo $fila['lugar']?></td>
              <td><?php echo $fila['cant_ninos']?></td>
              <td><?php echo $fila['contacto']?></td>
    
              <?php
                  }
            ?>
             
            <?php   
             
             $query = $con -> prepare("SELECT paquetes.id_paquetes, eventos.id_paquetes, paquetes.nombre_paquete From eventos Join paquetes on eventos.id_paquetes = paquetes.id_paquetes");
             $query -> execute ();
             $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

             foreach ($resultados as $fila){
       ?>
       
           <td><?php echo $fila['nombre_paquete']?></td>

           <?php
                  }
            ?>
             
             <?php   
             
             $query = $con -> prepare("SELECT eventos.id_tipo_e, tipo_e.id_tipo_e, tipo_e.tipo_evento FROM eventos JOIN tipo_e ON eventos.id_tipo_e = tipo_e.id_tipo_e");
             $query -> execute ();
             $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

             foreach ($resultados as $fila){
       ?>
       
           <td><?php echo $fila['tipo_evento']?></td>

           <?php
                  }
            ?>

            <?php
             
                  $query = $con -> prepare("SELECT * FROM usuarios where id_tipo_user=3");
                  $query -> execute ();
                  $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                  foreach ($resultados as $fila){
            ?>
            
                <td><?php echo $fila['nombre']?></td>
                

            </tr>

            <?php
                  }
            ?>
         
              
          </table>
        </div>
      </body>