<?php
require_once("../../../db/connection.php");
// include("../../../controller/validarSesion.php");

$db = new Database();
$con = $db->conectar();

include 'plantilla.php';

if (isset($_POST["registrar"])) {
  $id_tipo_art = $_POST['id_tipo_art'];
  $nombre_A = $_POST['nombre_A'];
  $id_estado = 1;
  $descripcion = $_POST['descripcion'];
  $cantidad = $_POST['cantidad'];
  $valor = $_POST['valor'];

  // Validación de campos vacíos
  if (empty($id_tipo_art) || empty($nombre_A) || empty($id_estado) || empty($descripcion) || empty($cantidad) || empty($valor)) {
      echo '<script>alert("EXISTEN DATOS VACIOS");</script>';
      echo '<script>window.location="arti.php"</script>';
  } else if ($cantidad <= 0 || $valor <= 0) {  
      echo '<script>alert("CANTIDAD Y VALOR DEBEN SER MAYORES A 0");</script>';
      echo '<script>window.location="arti.php"</script>';
  } else {
      $sql = $con->prepare("SELECT * FROM articulos WHERE nombre_A = :nombre_A");
      $sql->bindParam(':nombre_A', $nombre_A);
      $sql->execute();
      $fila = $sql->fetch(PDO::FETCH_ASSOC);

      if ($fila) {
          echo '<script>alert("ESTE ARTICULO YA EXISTE //CAMBIELO//");</script>';
          echo '<script>window.location="arti.php"</script>';
      } else {
          $insertSQL = $con->prepare("INSERT INTO articulos (nombre_A, id_tipo_art, id_estado, descripcion, cantidad, valor) VALUES (:nombre_A, :id_tipo_art, :id_estado, :descripcion, :cantidad, :valor)");
          $insertSQL->bindParam(':nombre_A', $nombre_A);
          $insertSQL->bindParam(':id_tipo_art', $id_tipo_art);
          $insertSQL->bindParam(':id_estado', $id_estado);
          $insertSQL->bindParam(':descripcion', $descripcion);
          $insertSQL->bindParam(':cantidad', $cantidad);
          $insertSQL->bindParam(':valor', $valor);
          $insertSQL->execute();

          echo '<script>alert("REGISTRO EXITOSO");</script>';
          echo '<script>window.location="arti.php"</script>';
      }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articulos</title>
</head>
<body>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Articulos</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <input type="submit" class="añadir" id="añadir" value="Añadir" onclick="opendialog();">

                        <form method="post" action="funciones/artiexcel.php">
                            <button type="submit" name="arti_excel" class="btn btn-success">
                                <i class="bi bi-download"></i>
                            </button>
                        </form>

                        <dialog class="añadir_cont" id="añadir_cont">
                        <button id="añadir_close" class="btn modal_close" onclick="closedialog();">X</button>
                        <h2 class="modal__title">Registrar artículo</h2>
                        <form method="post" name="formreg" id="formreg" class="row g-3" autocomplete="off" onsubmit="return validateForm()">
                            <div class="col-md-6">
                                <label for="inputTipoArticulo" class="form-label">Tipo Articulos</label>
                                <select class="form-control" name="id_tipo_art" required>
                                    <option value="">Seleccione el tipo de articulo</option>
                                    <?php
                                    $control = $con->prepare("SELECT * FROM tipo_articulo");
                                    $control->execute();
                                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $fila['id_tipo_art'] . "'>" . $fila['tipo_articulo'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
    <label for="inputNombreArticulo" class="form-label">Nombre artículo</label>
    <input class="form-control" type="text" id="nombreArticuloInput" name="nombre_A" placeholder="Nombre de artículo (máximo 30 caracteres)" required>
</div>

<script>
    // Obtener referencia al elemento de entrada de nombre de artículo
    var nombreArticuloInput = document.getElementById('nombreArticuloInput');

    // Agregar un event listener para el evento de cambio de valor
    nombreArticuloInput.addEventListener('input', function() {
        // Obtener el valor actual del campo de entrada
        var nombreArticuloValue = nombreArticuloInput.value.trim();

        // Validar si la entrada contiene solo letras, tildes y espacios y tiene una longitud de hasta 30 caracteres
        if (/^[A-Za-záéíóúüÁÉÍÓÚÜ\s]{1,30}$/.test(nombreArticuloValue)) {
            // La entrada es válida
            nombreArticuloInput.setCustomValidity('');
        } else {
            // La entrada no es válida, establecer un mensaje de validación personalizado
            nombreArticuloInput.setCustomValidity('Por favor, ingrese solo letras.');
        }
    });
</script>

                            <div class="col-md-6">
    <label for="inputDescripcion" class="form-label">Descripción</label>
    <input class="form-control" type="text" name="descripcion" id="descripcion" title="Solo se permiten letras, números, puntos y comas" placeholder="Descripción" maxlength="50" required>
    <span id="descripcionError" style="color: red;"></span>
</div>

<script>
    // Función para validar el campo de descripción
    function validarDescripcion() {
        var descripcionInput = document.getElementById("descripcion");
        var descripcionError = document.getElementById("descripcionError");
        var descripcionValue = descripcionInput.value;

        // Expresión regular para permitir letras, números, puntos y comas
        var regex = /^[A-Za-z0-9.,\s]+$/;

        if (!regex.test(descripcionValue)) {
            descripcionError.textContent = "Solo se permiten letras, números, puntos y comas.";
            return false;
        } else {
            descripcionError.textContent = "";
            return true;
        }
    }

    // Agregar un evento de escucha para la validación cuando el usuario escriba
    document.getElementById("descripcion").addEventListener("input", validarDescripcion);
</script>

<div class="col-12">
    <label for="inputCantidad" class="form-label">Cantidad</label>
    <input class="form-control" type="text" id="cantidadInput" name="cantidad" placeholder="Cantidad (máximo 3 dígitos)" required>
</div>

<script>
    // Obtener referencia al elemento de entrada de cantidad
    var cantidadInput = document.getElementById('cantidadInput');

    // Agregar un event listener para el evento de cambio de valor
    cantidadInput.addEventListener('input', function() {
        // Obtener el valor actual del campo de entrada
        var cantidadValue = cantidadInput.value.trim();

        // Validar si la entrada es un número con un máximo de tres dígitos
        if (/^\d{0,3}$/.test(cantidadValue)) {
            // La entrada es válida
            cantidadInput.setCustomValidity('');
        } else {
            // La entrada no es válida, establecer un mensaje de validación personalizado
            cantidadInput.setCustomValidity('Por favor ingrese números.');
        }
    });
</script>

<div class="col-12">
    <label for="inputValor" class="form-label">Valor</label>
    <input class="form-control" type="text" id="valorInput" name="valor" placeholder="Valor (máximo 8 dígitos)" required>
</div>

<script>
    // Obtener referencia al elemento de entrada de valor
    var valorInput = document.getElementById('valorInput');

    // Agregar un event listener para el evento de cambio de valor
    valorInput.addEventListener('input', function() {
        // Obtener el valor actual del campo de entrada
        var valorValue = valorInput.value.trim();

        // Validar si la entrada es un número positivo con un máximo de 8 dígitos
        if (/^\d{1,8}$/.test(valorValue) && parseInt(valorValue, 10) > 0) {
            // La entrada es válida
            valorInput.setCustomValidity('');
        } else {
            // La entrada no es válida, establecer un mensaje de validación personalizado
            valorInput.setCustomValidity('Por favor, ingrese números.');
        }
    });
</script>

                            <div class="text-center">
                                <input type="submit" name="registrar" value="Registro" class="btn btn-primary modal_close">
                            </div>
                        </form>
                    </dialog>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Tipo Articulo</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Valor</th>
                                <th>Actualizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $con_fila = $con->prepare("SELECT articulos.id_articulo, tipo_articulo.tipo_articulo, estados.estado, articulos.nombre_A, articulos.descripcion, articulos.cantidad, articulos.valor
                                FROM articulos
                                INNER JOIN tipo_articulo ON tipo_articulo.id_tipo_art = articulos.id_tipo_art
                                INNER JOIN estados ON estados.id_estado = articulos.id_estado");
                            $con_fila->execute();
                            $fila = $con_fila->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($fila as $fila) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($fila['tipo_articulo']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['nombre_A']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['estado']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['cantidad']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['valor']); ?></td>
                                    <td>
                                        <a href="#" class="boton" onclick="window.open('../actualizar/articulos.php?id=<?php echo $fila['id_articulo']; ?>','','width=800,height=750,toolbar=NO');void(null);">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../../../js/modal.js"></script>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<script>
function validateForm() {
    const id_tipo_art = document.forms["formreg"]["id_tipo_art"].value;
    const nombre_A = document.forms["formreg"]["nombre_A"].value;
    const descripcion = document.forms["formreg"]["descripcion"].value;
    const cantidad = document.forms["formreg"]["cantidad"].value;
    const valor = document.forms["formreg"]["valor"].value;

    if (!id_tipo_art || !nombre_A || !descripcion || !cantidad || !valor) {
        alert("EXISTEN DATOS VACIOS");
        return false;
    }

    if (cantidad <= 0 || valor <= 0) {
        alert("CANTIDAD Y VALOR DEBEN SER MAYORES A 0");
        return false;
    }

    return true;
}
</script>
</body>
</html>
