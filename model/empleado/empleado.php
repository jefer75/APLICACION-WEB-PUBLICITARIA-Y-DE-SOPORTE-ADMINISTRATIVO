<?php
include 'plantilla.php';
?>

    <head>
        <title>Arlequin Eventos</title>

    <main id="main" class="main">

<div class="section dashboard">
    <div class="row">
    <div class="card-body">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">
         <h5 class="card-title">Evento</h5>

<table class="table table-striped">

<input type="submit" class="detalle" id="detalle" value="Detalle" onclick="opendialog();">

              <dialog class="añadir_cont" id="añadir_cont">
                <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Fecha Evento</th>
                    <th>Nombre</th>
                    <th>Edad minima</th>
                    <th>Edad maxima</th>
                    <th>Valor</th>
                    <th>Actualizar</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
            <?php
$query = $con->prepare("SELECT * FROM eventos");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultados as $fila) {
    ?>
              
              <td scope="row"><?php echo $fila['f_inicio'] ?></td>
              <td scope="row"><?php echo $fila['hora_inicio'] ?></td>
              <td scope="row"><?php echo $fila['lugar'] ?></td>
              <td scope="row"><?php echo $fila['cant_ninos'] ?></td>
              <td scope="row"><?php echo $fila['contacto'] ?></td>

              <?php
}
?>

            <?php

$query = $con->prepare("SELECT paquetes.id_paquetes, eventos.id_paquetes, paquetes.nombre_paquete From eventos Join paquetes on eventos.id_paquetes = paquetes.id_paquetes");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultados as $fila) {
    ?>

           <td><?php echo $fila['nombre_paquete'] ?></td>

           <?php
}
?>

             <?php

$query = $con->prepare("SELECT eventos.id_tipo_e, tipo_e.id_tipo_e, tipo_e.tipo_evento FROM eventos JOIN tipo_e ON eventos.id_tipo_e = tipo_e.id_tipo_e");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultados as $fila) {
    ?>

           <td><?php echo $fila['tipo_evento'] ?></td>

           <?php
}
?>

            <?php

$query = $con->prepare("SELECT * FROM usuarios where id_tipo_user=3");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultados as $fila) {
    ?>

                <td><?php echo $fila['nombre'] ?></td>


            </tr>

            <?php
}
?>

<?php include "../consultar/detalleven.php";
?>

          </table>

          </div>
              </div>
          </div>
        </div>
        
      </body>