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
    <link rel="stylesheet" href="css/regis.css">   
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    
    <link href="../../css/style.css" rel="stylesheet">
</head>
<style>
dialog{
        width: 60%;
    height: 40vh;
    padding: 5vh 10vh;
    border: 0;
    margin: 5% 20%;
    }  
    .modal_close{
        padding: 2vh;
        background-color: red;
        float:right;
        margin: 2%;
        border-radius: 1vh;
        border: 0;
    }
    
</style>
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
    <input type="submit" class="hiper" id="añadir" value="+" onclick="opendialog();">
    
    <dialog class="añadir_cont" id="añadir_cont">
    <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>
            <form method="post" action="registrar/licencia.php" class="signup-form" autocomplete="off">
                        <br>
                        <label class="form-label" for="nit">Empresa</label>
                        <br>
                        <select class="form-control" name="nit" required>
                            <option value="">Seleccione Empresa</option>
                            <?php
                            $control = $con->prepare("SELECT * FROM empresa");
                            $control->execute();
                            while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=" . $fila['nit'] . ">" . $fila['nombre_emp'] . "</option>";
                            }
                            ?>
                        </select>
                        <br>
                        
                        <input type="submit" name="registrar" value="Registrar" style="background-color: blue; color: white; border: none; padding: 8px 16px; border-radius: 5px;">
                    </form>

            </dialog>
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
                   
                </tr>

                <?php foreach ($resultados as $fila) : ?>
                    <tr>
                        <td><?php echo $fila['licencia'] ?></td>
                        <td><?php echo $fila['nit'] ?></td>
                        <td><?php echo $fila['fecha_ini'] ?></td>
                        <td><?php echo $fila['fecha_fin'] ?></td>
                        <td><?php echo $fila['nombre_emp'] ?></td>
                        <td><?php echo $fila['estado'] ?></td>
                        <td><a class="hiper" href="" onclick="window.open('actualizar y eliminar/licencia.php?id=<?php echo $fila['id_licencia'] ?>','','width=500, height=400, toolbar=NO'); void(null);"><i class="uil uil-edit"></i>
                        </a>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>

            </table>

        </form>

    </div>
<script src="../../js/modal.js"></script>
</body>

</html>
