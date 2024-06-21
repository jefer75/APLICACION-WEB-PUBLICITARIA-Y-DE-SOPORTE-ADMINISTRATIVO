<?php
include 'plantilla.php';

$query = $con->prepare("SELECT l.*, e.estado, emp.nombre_emp
                        FROM licencia l 
                        INNER JOIN estados e ON l.id_estado = e.id_estado
                        INNER JOIN empresa emp ON l.nit = emp.nit");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);
?>

    <title>Licencia</title>
    <link rel="stylesheet" href="../../../css/superadmin.css">
    <link rel="stylesheet" href="css/tabl.css">
</head>

<body>

    
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <div class="dash-content">
        <div class="activity">
                <div class="title">
                    <i class="uil uil-file-bookmark-alt"></i>
                    <span class="text">Licencias</span>
                </div>
 
    <div class="formulario">
    <a class="hiper" href="" onclick="window.open
            ('registrar/licencia.php?id=<?php echo $fila['nit'] ?>','','width=750, height=650, toolbar=NO'); void(null);">
            <i class="uil uil-plus"></i>
            </a>
        <form method="POST" action="">
            <table class="custom-table">
                <tr class="header-row">
                    <th>Licencia</th>
                    <th>Nit</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha de final</th>
                    <th>Empresa</th>
                    <th>Estado</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>

                <?php foreach ($resultados as $fila) : ?>
                    <tr>
                        <td><?php echo $fila['licencia'] ?></td>
                        <td><?php echo $fila['nit'] ?></td>
                        <td><?php echo $fila['fecha_ini'] ?></td>
                        <td><?php echo $fila['fecha_fin'] ?></td>
                        <td><?php echo $fila['nombre_emp'] ?></td>
                        <td><?php echo $fila['estado'] ?></td>
                        <td><a class="hiper" href="" onclick="window.open('actualizar y eliminar/licencia.php?id=<?php echo $fila['nit'] ?>','','width=500, height=400, toolbar=NO'); void(null);"><i class="uil uil-edit"></i>
                        </a>
                        </td>
                        <td>
                        <a class="hiper" href="" onclick="window.open('actualizar y eliminar/licencia.php?id=<?php echo $fila['nit'] ?>','','width=500, height=400, toolbar=NO'); void(null);"><i class="uil uil-trash-alt "></i>
                        </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>

        </form>

    </div>

</body>

</html>
