<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();
    include 'plantilla.php';
?>

    <title>Empresas</title>
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
    <h1 class="card-title" style="font-family: 'Arial Rounded MT Bold', sans-serif; text-align: center; margin-top: 20px;">Empresas</h1>
        <form method="POST" action="">
            <table class="custom-table">
                <tr class="header-row">
                    <th>Nit</th>
                    <th>Nombre de empresa</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
                
                <?php 
                
                $query = $con -> prepare("SELECT * FROM empresa");
                $query -> execute ();
                $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultados as $fila){
        ?>
        <tr>
        <td><?php echo $fila['nit']?></td>
            <td><?php echo $fila['nombre_emp']?></td>
            <td><?php echo $fila['telefono']?></td>
            <td><?php echo $fila['direccion']?></td>
            </td>
            <td>
            <a class="hiper" href="" onclick="window.open
            ('actualizar y eliminar/empresa.php?id=<?php echo $fila['nit'] ?>','','width=500, height=400, toolbar=NO'); void(null);">
            <i class="uil uil-edit"></i>
            </a>
            </td>

            <td>
            <a class="hiper" href="" onclick="window.open
            ('actualizar y eliminar/empresa.php?id=<?php echo $fila['nit'] ?>','','width=500, height=400, toolbar=NO'); void(null);">
            <i class="uil uil-trash-alt "></i>
            </a>
            </td>
            
        </tr>
        <?php
                }
        ?>
        
    </table>

    </form>               

    </div>
    </section>