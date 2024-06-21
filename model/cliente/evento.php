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
                            <thead>
                                <tr>
                                    <th>Fecha Evento</th>
                                    <th>Lugar</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                    <th>Descripción</th>
                                    <th>Contacto</th>
                                    <th>Acción</th> <!-- Nueva columna para botones de reserva -->
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
                                        <!-- Agrega un botón de reserva -->
                                        <td><button onclick="reservarEvento(<?php echo isset($fila['id_evento']) ? $fila['id_evento'] : ''; ?>)">Reservar</button></td>



                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Función para manejar la reserva del evento
    function reservarEvento(id_evento) {
        // Aquí puedes agregar lógica para procesar la reserva del evento
        // Por ejemplo, redirigir a una página de reserva con el ID del evento
        window.location.href = "evento.php?id_evento=" + id_evento;
    }
</script>
