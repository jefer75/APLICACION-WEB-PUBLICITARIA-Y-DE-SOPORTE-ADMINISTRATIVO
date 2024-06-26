<?php
    include 'plantilla.php';
?>

<head>

    <link rel="stylesheet" href="css/tabl.css">
    <title>Empresas</title>
<style>
    dialog{
        width: 60%;
        height: 70vh;
        padding: 5vh 10vh;
        border: 0;
        margin: 5% 20%;
        }  
        .modal_close{
            padding: 2vh;
            background-color: red;
            float:right;
            margin-bottom: 2%;
            border-radius: 1vh;
            border: 0;
            }
    
    </style>
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
<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="uil uil-building"></i>
        <span class="text">Empresas</span>
                </div>
                <input type="submit" class="hiper" id="añadir" value="+" onclick="opendialog();">
    
                <dialog class="añadir_cont" id="añadir_cont">
                    <form method="post" action="registrar/empresa.php" class="signup-form" autocomplete="off">
                    <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>
                    <br>
                    <label class="form-label" for="nit">NIT</label>
                    <br>
                    <input class="form-control" type="text" name="nit" placeholder="Digite el Nit" required>
                    <br>
                    <label class="form-label" for="nombre_emp">Nombre de la Empresa</label>
                    <br>
                    <input class="form-control" type="text" name="nombre_emp" placeholder="Nombre de empresa" required>
                    <br>
                    <label class="form-label" for="telefono">Teléfono</label>
                    <br>
                    <input class="form-control" type="text" name="telefono" placeholder="Digite el teléfono" required>
                    <br>
                    <label class="form-label" for="direccion">Dirección</label>
                    <br>
                    <input class="form-control" type="text" name="direccion" placeholder="Digite la dirección" required>
                    <br>
                    <div class="form-group">
                    <input type="submit" name="registrar" value="Registro" style="background-color: blue; color: white; border: none; padding: 8px 16px; border-radius: 5px;">
                    <input type="hidden" name="MM_insert" value="formreg">
                    </div>
                </form>
            </dialog>

    <div class="formulario">
        <form method="POST" action="">
            <table class="custom-table">
                <tr class="header-row">
                    <th>Nit</th>
                    <th>Nombre de empresa</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Actualizar</th>
                
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

            
        </tr>
        <?php
                }
        ?>
        
    </table>

    </form>               

    </div>
    
    </section>
    <script src="../../js/modal.js"></script>