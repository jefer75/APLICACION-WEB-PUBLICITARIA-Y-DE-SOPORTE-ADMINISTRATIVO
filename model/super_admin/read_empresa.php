<?php
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
        <div class="dash-content">
        <div class="activity">
                <div class="title">
                    <i class="uil uil-building"></i>
                    <span class="text">Empresas</span>
                </div>
    <div class="formulario">
    <a class="hiper" href="" onclick="window.open
                ('registrar/empresa.php?id=','','width=850, height=500, toolbar=NO'); void(null);">
                <i class="uil uil-plus"></i>
            </a>

        <form method="POST" action="">
            <table class="custom-table">
                <tr class="header-row">
                    <th>Nit</th>
                    <th>Nombre de empresa</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Acción</th>
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
            ('actualizar y eliminar/empresa.php?id=<?php echo $fila['nit'] ?>','','width=500, height=460, toolbar=NO'); void(null);">
            <i class="uil uil-edit"></i>
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