<?php

require_once("../../db/connection.php");
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db -> conectar();

    include 'plantilla.php';

    if (isset($_POST["registrar"])){

    $nombre_paquete = $_POST['nombre_paquete'];
    $edad_min = $_POST['edad_min'];
    $edad_max = $_POST['edad_max'];
    $valor= $_POST['valor'];


     $sql= $con -> prepare ("SELECT * FROM paquetes WHERE nombre_paquete='$nombre_paquete'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("ESTE PAQUETE YA EXISTE //CAMBIELO//");</script>';
        echo '<script>window.location="paquetes.php"</script>';
     }

     else
   
     if ( $nombre_paquete =="" || $edad_min =="" || $edad_max =="" || $valor =="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="paquetes.php"</script>';
      }
      
      else{

        $insertSQL = $con->prepare("INSERT INTO paquetes(nombre_paquete , edad_min , edad_max ,  valor) VALUES('$nombre_paquete', '$edad_min', '$edad_max', '$valor')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="paquetes.php"</script>';
     }  
    }
    ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paquetes</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        .is-invalid {
            border: 1px solid red !important;
        }

        .invalid-feedback {
            color: red;
            display: none;
        }
    </style>
</head>

<body>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Paquetes</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                           
                        
                            <dialog class="añadir_cont" id="añadir_cont">
                               

                                <form method="post" name="formreg" id="formreg" class="row g-3" autocomplete="off"
                                    onsubmit="return validarFormulario();">

                                    <div class="col-md-6">
                                        <label for="nombre_paquete" class="form-label">Nombre paquete</label>
                                        <input class="form-control" type="text" id="nombre_paquete"
                                            name="nombre_paquete" placeholder="Nombre de paquete">
                                        <div id="error_nombre_paquete" class="invalid-feedback"
                                            style="display: none;">
                                            El nombre del paquete debe contener solo letras y dos espacios como
                                            máximo, con un máximo de 20 caracteres.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="edad_min" class="form-label">Edad mínima</label>
                                        <input class="form-control" type="text" id="edad_min" name="edad_min"
                                            placeholder="Edad mínima">
                                        <div id="error_edad_min" class="invalid-feedback" style="display: none;">
                                            La edad mínima debe ser un número entre 1 y 20.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="edad_max" class="form-label">Edad máxima</label>
                                        <input class="form-control" type="text" id="edad_max" name="edad_max"
                                            placeholder="Edad máxima">
                                        <div id="error_edad_max" class="invalid-feedback" style="display: none;">
                                            La edad máxima debe ser un número entre 15 y 100.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="valor" class="form-label">Valor</label>
                                        <input class="form-control" type="text" id="valor" name="valor"
                                            placeholder="Valor">
                                        <div id="error_valor" class="invalid-feedback" style="display: none;">
                                            El valor debe ser un númerico.
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <input type="submit" name="registrar" value="Registro"
                                            class="btn btn-primary modal_close">
                                    </div>

                                </form>
                            </dialog>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Nombre del paquete</th>
                                        <th>Edad mínima</th>
                                        <th>Edad máxima</th>
                                        <th>Valor</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $con_paquetes = $con->prepare("SELECT * FROM paquetes");
                                    $con_paquetes->execute();
                                    $paquetes = $con_paquetes->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($paquetes as $fila) {
                                        $nombre_paquete = $fila['nombre_paquete'];
                                        $edad_min = $fila['edad_min'];
                                        $edad_max = $fila['edad_max'];
                                        $valor = $fila['valor'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nombre_paquete ?></td>
                                        <td><?php echo $edad_min ?></td>
                                        <td><?php echo $edad_max ?></td>
                                        <td><?php echo $valor ?></td>
                                       
                                        <td>
                                            <a href=""
                                                onclick="window.open('detalles/detalle_paquetes.php?id=<?php echo $fila['id_paquetes'] ?>','','width=600,height=500,toolbar=NO');return false;">
                                                Detalles
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
        </section>

    </main>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom Script for Validation -->
    <script>
        function validarFormulario() {
            var nombrePaqueteInput = document.getElementById('nombre_paquete');
            var errorNombrePaquete = document.getElementById('error_nombre_paquete');
            var nombrePaquete = nombrePaqueteInput.value.trim();
            var regexNombre = /^[a-zA-Z]+(?: [a-zA-Z]+){0,2}$/;
            if (!regexNombre.test(nombrePaquete) || nombrePaquete.length > 20) {
                nombrePaqueteInput.classList.add('is-invalid');
                errorNombrePaquete.style.display = 'block';
                return false; // Evitar envío del formulario
            } else {
                nombrePaqueteInput.classList.remove('is-invalid');
                errorNombrePaquete.style.display = 'none';
            }

            var edadMinInput = document.getElementById('edad_min');
            var errorEdadMin = document.getElementById('error_edad_min');
            var edadMin = edadMinInput.value.trim();
            var regexEdadMin = /^(?!0\d)\d{1,2}$/;
            if (!regexEdadMin.test(edadMin) || parseInt(edadMin) < 1 || parseInt(edadMin) > 20) {
                edadMinInput.classList.add('is-invalid');
                errorEdadMin.style.display = 'block';
                return false; // Evitar envío del formulario
            } else {
                edadMinInput.classList.remove('is-invalid');
                errorEdadMin.style.display = 'none';
            }

            var edadMaxInput = document.getElementById('edad_max');
            var errorEdadMax = document.getElementById('error_edad_max');
            var edadMax = edadMaxInput.value.trim();
            if (parseInt(edadMax) < 15 || parseInt(edadMax) > 100) {
                edadMaxInput.classList.add('is-invalid');
                errorEdadMax.style.display = 'block';
                return false; // Evitar envío del formulario
            } else {
                edadMaxInput.classList.remove('is-invalid');
                errorEdadMax.style.display = 'none';
            }

            var valorInput = document.getElementById('valor');
            var errorValor = document.getElementById('error_valor');
            var valor = valorInput.value.trim();
            var regexValor = /^\d{1,11}$/;
            if (!regexValor.test(valor)) {
                valorInput.classList.add('is-invalid');
                errorValor.style.display = 'block';
                return false; // Evitar envío del formulario
            } else {
                valorInput.classList.remove('is-invalid');
                errorValor.style.display = 'none';
            }

            // Si todas las validaciones pasan, se envía el formulario
            return true;
        }
    </script>

    <!-- Custom Script for Modal -->
    <script src="../../../js/modal.js"></script>

</body>

</html>
