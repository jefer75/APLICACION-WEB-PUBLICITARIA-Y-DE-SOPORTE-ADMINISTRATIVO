<?php
session_start();
require_once "../../db/connection.php";
//include("../../../controller/validar_licencia.php");
$db = new DataBase();
$con = $db->conectar();

include 'plantilla.php';
?>
<head>
    <title>Arlequin Eventos</title>
    <style>
        .detalle{
    background-color: #007bff; /* color de fondo azul */
    color: #fff; /* color del texto blanco */
    border: none; /* sin borde */
    border-radius: 20px; /* bordes curvos */
    padding: 10px 20px; /* relleno */
    cursor: pointer; /* cursor de puntero al pasar por encima */
}

.detalle:hover {
    background-color: #0056b3; /* color de fondo azul más oscuro al pasar el cursor */
}

    </style>
</head>

<main id="main" class="main">

    <div class="section dashboard">
        <div class="row">
            <div class="card-body">
                <div class="col-12">
                    <div class="card recent-sales overflow-auto">
                        <h5 class="card-title">Paquetes</h5>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre Paquete</th>
                                    <th>Edad Minima</th>
                                    <th>Edad Maxima</th>
                                    <th>Valor</th>
                                    <th>Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = $con->prepare("SELECT * FROM paquetes");
                                $query->execute();
                                $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($resultados as $fila) {
                                    ?>

                                    <tr>
                                        <td><?php echo $fila['nombre_paquete'] ?></td>
                                        <td><?php echo $fila['edad_min'] ?></td>
                                        <td><?php echo $fila['edad_max'] ?></td>
                                        <td><?php echo $fila['valor'] ?></td>
                                        <!-- Aquí agregamos un botón para ver el detalle -->
                                        <td><a class="detalle" onclick="verDetalle(<?php echo $fila['id_paquetes']; ?>)">
                                       <i class="bi bi-zoom-in"></i> 
                                       </a>
                                    </td>
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

    <!-- Este es el div que contendrá el detalle -->
    <div id="detalle_paquete" style="display: none;">
        <!-- Aquí se mostrará el detalle del paquete seleccionado -->
    </div>

</main>

<script>
    // Función para mostrar el detalle del paquete
    function verDetalle(id_paquete) {
        // Realizar una petición AJAX para obtener el detalle del paquete con el ID proporcionado
        // Mostrar el detalle en el div "detalle_paquete"
    }
</script>
