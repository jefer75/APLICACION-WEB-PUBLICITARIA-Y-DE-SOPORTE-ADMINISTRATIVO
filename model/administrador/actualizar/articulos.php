<?php
       session_start();
       require_once("../../../db/connection.php");
       // include("../../../controller/validarSesion.php");
       $db = new Database();
       $con = $db -> conectar();

   //empieza la consulta
  
   $sql = $con -> prepare("SELECT articulos.id_articulo, articulos.id_tipo_art, tipo_articulo.tipo_articulo, articulos.id_estado,  estados.estado, articulos.nombre_A, articulos.descripcion, articulos.cantidad, articulos.valor
   FROM articulos
   INNER JOIN tipo_articulo ON tipo_articulo.id_tipo_art = articulos.id_tipo_art
   INNER JOIN estados ON estados.id_estado = articulos.id_estado WHERE id_articulo='".$_GET['id']."'");
   $sql->execute();
   $fila = $sql->fetchAll(PDO::FETCH_ASSOC);
   foreach ($fila as $fila) {
   $id_tipo_art = $fila['id_tipo_art'];
   $tipo_art = $fila['tipo_articulo'];
   $id_estado = $fila['id_estado'];
   $estado = $fila['estado'];
   $cantidad = $fila['cantidad'];
   }
   //declaracion de variables de campos en la tabla

   if (isset($_POST['actualizar'])){

       $id_tipo_art= $_POST['id_tipo_art'];
       $nombre_A = $_POST['nombre_A'];
       $descripcion= $_POST['descripcion'];
       $suma = $_POST['suma'];
       $valor= $_POST['valor'];

      if (is_int($suma) AND $suma > 0) {
            $cantidad_total=$suma + $cantidad;
            $insert= $con -> prepare ("UPDATE articulos SET  nombre_A='$nombre_A', descripcion='$descripcion', id_tipo_art='$id_tipo_art', cantidad=$cantidad_total, valor='$valor' WHERE id_articulo = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
              
      }
      else if($suma!=""){
            echo '<script> alert ("La cantidad sumada debe ser un valor entero");</script>';
      }
       else {
            $insert= $con -> prepare ("UPDATE articulos SET  nombre_A='$nombre_A', descripcion='$descripcion', id_tipo_art='$id_tipo_art', valor='$valor' WHERE id_articulo = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
       } 
    }

        ?>


<!DOCTYPE html>
<html lang="en">
    <script>
        function centrar() {
            iz=(screen.width-document.body.clientWidth) / 2;
            de=(screen.height-document.body.clientHeight) / 3;
            moveTo(iz,de);
        }
    </script>
<head>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actualizar Articulos</title>
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../../../css/bootstrap.min.css" rel="stylesheet">


</head>

<body onload="centrar();">


<div class="card">

        <div class="card-body">

          <h5 class="card-title">Articulos</h5>

          <!-- Multi Columns Form -->

          <form autocomplete="off"class="row g-3" name="form_actualizar" method="POST">

          
          <div class="col-md-6">
            <label for="nombreArticulo" class="form-label">Nombre del Artículo</label>
            <input class="form-control" type="text" name="nombre_A" id="nombreArticulo" value="<?php echo htmlspecialchars($fila['nombre_A'] ?? ''); ?>" placeholder="Nombre del artículo" required>
            <div id="error_nombreArticulo" class="invalid-feedback">
                El nombre del artículo solo letras y máximo tres espacios.
            </div>
        </div>
        <div class="col-6">
            <label for="descripcion" class="form-label">Descripción</label>
            <input class="form-control" type="text" name="descripcion" id="descripcion" value="<?php echo htmlspecialchars($fila['descripcion'] ?? ''); ?>" placeholder="Descripción del artículo" required>
            <div id="error_descripcion" class="invalid-feedback">
                La descripción no puede estar vacía y debe contener máximo 80 caracteres.
            </div>
        </div>
   


<script>
document.addEventListener('DOMContentLoaded', function() {
        // Referencias a los elementos del formulario
        var nombreArticuloInput = document.getElementById('nombreArticulo');
        var errorNombreArticulo = document.getElementById('error_nombreArticulo');

        // Validación para nombre del artículo
        nombreArticuloInput.addEventListener('input', function() {
            var nombreArticulo = nombreArticuloInput.value.trim();

            // Expresión regular para validar nombre del artículo
            var regex = /^[A-Za-z]+(?:\s+[A-Za-z]+){0,2}$/;

            if (regex.test(nombreArticulo) && nombreArticulo.length >= 4 && nombreArticulo.length <= 30) {
                nombreArticuloInput.classList.remove('is-invalid');
                errorNombreArticulo.style.display = 'none';
            } else {
                nombreArticuloInput.classList.add('is-invalid');
                errorNombreArticulo.style.display = 'block';
            }
        });
  

        // Validación para descripción (máximo 80 caracteres)
        descripcionInput.addEventListener('input', function() {
            var descripcion = descripcionInput.value.trim();

            if (descripcion.length > 0 && descripcion.length <= 80) {
                descripcionInput.classList.remove('is-invalid');
                errorDescripcion.style.display = 'none';
            } else {
                descripcionInput.classList.add('is-invalid');
                errorDescripcion.style.display = 'block';
            }
        });
    });
</script>
            
<div class="col-6">
            <label for="cantidadActual" class="form-label">Cantidad Actual</label>
            <input type="number" class="form-control" id="cantidadActual" readonly value="<?php echo $cantidad; ?>">
        </div>
        <div class="col-6">
            <label for="suma" class="form-label">Añadir Compra</label>
            <input type="number" class="form-control" id="suma" name="suma" placeholder="Cantidad añadida">
            <div id="error_suma" class="invalid-feedback">
                La cantidad añadida debe ser del 1 al 500.
            </div>
        </div>
        <div class="col-6">
            <label for="valor" class="form-label">Valor de alquiler</label>
            <input type="number" class="form-control" id="valor" name="valor" value="<?php echo htmlspecialchars($fila['valor'] ?? ''); ?>" min="1" max="99999999">
            <div id="error_valor" class="invalid-feedback">
                El valor debe ser un número válido y no puede exceder los 8 dígitos.
            </div>
        </div>
   

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Referencias a los elementos del formulario
        var cantidadActualInput = document.getElementById('cantidadActual');
        var sumaInput = document.getElementById('suma');
        var valorInput = document.getElementById('valor');
        var errorSuma = document.getElementById('error_suma');
        var errorValor = document.getElementById('error_valor');

        // Validación para campo "Añadir Compra"
        sumaInput.addEventListener('input', function() {
            var suma = sumaInput.value.trim();

            if (/^\d{1,3}$/.test(suma)) {
                sumaInput.classList.remove('is-invalid');
                errorSuma.style.display = 'none';
            } else {
                sumaInput.classList.add('is-invalid');
                errorSuma.style.display = 'block';
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
        // Referencias a los elementos del formulario
        var sumaInput = document.getElementById('suma');
        var errorSuma = document.getElementById('error_suma');

        // Validación para campo suma
        sumaInput.addEventListener('input', function() {
            var suma = sumaInput.value.trim();

            // Verificar si la suma está dentro del rango y es un número válido
            if (isValidNumber(suma) && suma >= 1 && suma <= 500) {
                sumaInput.classList.remove('is-invalid');
                errorSuma.style.display = 'none';
            } else {
                sumaInput.classList.add('is-invalid');
                errorSuma.style.display = 'block';
            }
        });

        // Función para validar que sea un número válido
        function isValidNumber(value) {
            return /^\d+$/.test(value);
        }
    });
        // Validación para campo "Valor de alquiler"
        valorInput.addEventListener('input', function() {
            var valor = valorInput.value.trim();

            if (/^\d{1,8}$/.test(valor)) {
                valorInput.classList.remove('is-invalid');
                errorValor.style.display = 'none';
            } else {
                valorInput.classList.add('is-invalid');
                errorValor.style.display = 'block';
            }
        });
    });
</script>

            <div class="col-md-6">
                                <label for="inputTipoArticulo" class="form-label">Tipo Articulos</label>
                                <select class="form-control" name="id_tipo_art">
                                <option value="<?php echo $id_tipo_art ?>"><?php echo $tipo_art ?></option>
                                    <?php
                                    $control = $con-> prepare ("SELECT * FROM tipo_articulo WHERE id_tipo_art != $id_tipo_art ");
                                    $control -> execute();
                                    while ($fila = $control->fetch(PDO::FETCH_ASSOC))  
                                    {
                                        echo "<option value='" . $fila['id_tipo_art'] . "'>" . $fila['tipo_articulo'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

            <div class="text-center">

            <tr>

            <td><input type="submit" class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar"></td>

            </tr>

            </div>


            <?php

        ?>
          </form><!-- End Multi Columns Form -->



        </div>

      </div>



    </div>
    
</body>
</html>