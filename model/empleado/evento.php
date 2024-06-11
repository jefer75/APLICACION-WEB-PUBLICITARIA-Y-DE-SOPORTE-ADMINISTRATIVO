<?php
include 'plantilla.php';
?>

<head>
    <title>Arlequin Eventos</title>
</head>

<main id="main" class="main">

    <div class="section dashboard">
        <div class="row">
            <div class="card-body">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <h5 class="card-title">Eventos</h5>

                        <table class="table table-striped">
                            <input type="submit" class="detalle" id="detalle" value="Detalle" onclick="opendialog();">
                            <dialog class="añadir_cont" id="añadir_cont">
                                <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Fecha Evento</th>
                                            <th>Lugar</th>
                                            <th>Hora Inicio</th>s
                                            <th>Hora Fin</th>
                                            <th>Descripción</th>
                                            <th>Contacto</th>
                                            
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
                                            <tr>
                                                <td scope="row"><?php echo $fila['f_inicio'] ?></td>
                                                <td scope="row"><?php echo $fila['lugar'] ?></td>
                                                <td scope="row"><?php echo $fila['hora_inicio'] ?></td>
                                                <td scope="row"><?php echo $fila['hora_fin'] ?></td>
                                                <td scope="row"><?php echo $fila['descripcion'] ?></td>
                                                <td scope="row"><?php echo $fila['contacto'] ?></td>
                                               
                                                <!-- Asegúrate de tener las columnas necesarias para la actualización -->
                                              
                                                <td></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </dialog>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
