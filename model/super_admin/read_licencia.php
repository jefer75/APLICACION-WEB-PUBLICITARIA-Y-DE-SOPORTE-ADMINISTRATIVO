<?php
session_start();
require_once("../../db/connection.php");
include 'plantilla.php';

$db = new Database();
$con = $db->conectar();

$query = $con->prepare("SELECT l.*, e.estado, emp.nombre_emp
                        FROM licencia l 
                        INNER JOIN estados e ON l.id_estado = e.id_estado
                        INNER JOIN empresa emp ON l.nit = emp.nit");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);
?>

    <title>Licencia</title>
    <link rel="stylesheet" href="../../../css/superadmin.css">
</head>

<body>

<link rel="stylesheet" href="css/tabl.css">
    <section class="dashboard">
    <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <br> <br>
 
    <div class="formulario">
        <h1 class="card-title" style="font-family: 'Arial Rounded MT Bold', sans-serif; text-align: center; margin-top: 20px;">Licencias</h1>
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
