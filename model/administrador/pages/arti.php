<?php
include 'plantilla.php';
include '../funciones/reg_articulos.php';
?>
<!DOCTYPE html>
<html lang="es">
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
                                    <input class="form-control" type="text" name="nombre_A" id="nombreArticulo" pattern="[A-Za-z ]{4,30}" title="Solo se permiten letras y espacios, entre 4 y 30 caracteres, con hasta 3 espacios" placeholder="Nombre de artículo" required>
                                    <div id="error_nombreArticulo" class="invalid-feedback">
                                        El nombre del artículo debe contener entre 4 y 30 letras con 3 espacios.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputDescripcion" class="form-label">Descripción</label>
                                    <input class="form-control" type="text" name="descripcion" id="descripcion" maxlength="80" placeholder="Descripción" required>
                                    <div id="error_descripcion" class="invalid-feedback">
                                        La descripción no puede exceder los 80 caracteres.
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="inputCantidad" class="form-label">Cantidad</label>
                                    <input class="form-control" type="number" name="cantidad" id="cantidad" placeholder="Cantidad" title="Solo se permiten números, máximo 5 dígitos" min="1" max="500" required>
                                    <div id="error_cantidad" class="invalid-feedback">
                                        La cantidad debe ser un número entre 1 y 500.
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="inputValor" class="form-label">Valor de alquiler</label>
                                    <input class="form-control" type="number" name="valor" id="valor" pattern="[0-9]{1,8}" title="Solo se permiten números, máximo 8 dígitos" placeholder="Valor" min="1" required>
                                    <div id="error_valor" class="invalid-feedback">
                                        El valor solo puede contener números y máximo 8 dígitos.
                                    </div>
                                </div>
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
                                    <th>Codigo de barras</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $con_fila = $con->prepare("SELECT articulos.id_articulo, tipo_articulo.tipo_articulo, estados.estado, articulos.nombre_A, articulos.descripcion, articulos.cantidad, articulos.valor, articulos.barcode
                                    FROM articulos
                                    INNER JOIN tipo_articulo ON tipo_articulo.id_tipo_art = articulos.id_tipo_art
                                    INNER JOIN estados ON estados.id_estado = articulos.id_estado");
                                $con_fila->execute();
                                $fila = $con_fila->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($fila as $fila) {
                                    ?>
                                    <tr>
                                        <td><?php echo $fila['tipo_articulo']; ?></td>
                                        <td><?php echo $fila['nombre_A']; ?></td>
                                        <td><?php echo $fila['estado']; ?></td>
                                        <td><?php echo $fila['descripcion']; ?></td>
                                        <td><?php echo $fila['cantidad']; ?></td>
                                        <td><?php echo $fila['valor']; ?></td>
                                        <td>
                                            <img src="<?php echo $fila['barcode']?>" alt="Código de barras">
                                        </td>
                                        <td>
                                            <a href="#" class="boton" onclick="window.open('../actualizar/articulos.php?id=<?php echo $fila['id_articulo']; ?>','','width=800,height=750,toolbar=NO');void(null);">
                                                <i class="bi bi-pencil"></i>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Referencias a los elementos del formulario
        var nombreArticuloInput = document.getElementById('nombreArticulo');
        var descripcionInput = document.getElementById('descripcion');
        var cantidadInput = document.getElementById('cantidad');
        var valorInput = document.getElementById('valor');

        // Mensajes de error
        var errorNombreArticulo = document.getElementById('error_nombreArticulo');
        var errorDescripcion = document.getElementById('error_descripcion');
        var errorCantidad = document.getElementById('error_cantidad');
        var errorValor = document.getElementById('error_valor');

        // Validación para nombre del artículo
        nombreArticuloInput.addEventListener('input', function() {
            var nombreArticulo = nombreArticuloInput.value.trim();

            if (/^[A-Za-z ]{4,30}$/.test(nombreArticulo) && countSpaces(nombreArticulo) <= 3) {
                nombreArticuloInput.classList.remove('is-invalid');
                errorNombreArticulo.style.display = 'none';
            } else {
                nombreArticuloInput.classList.add('is-invalid');
                errorNombreArticulo.style.display = 'block';
            }
        });

        // Función para contar espacios en el nombre del artículo
        function countSpaces(value) {
            var spaces = value.match(/\s/g);
            return spaces ? spaces.length : 0;
        }

        // Validación para descripción (máximo 80 caracteres)
        descripcionInput.addEventListener('input', function() {
            var descripcion = descripcionInput.value.trim();

            if (descripcion.length <= 80) {
                descripcionInput.classList.remove('is-invalid');
                errorDescripcion.style.display = 'none';
            } else {
                descripcionInput.classList.add('is-invalid');
                errorDescripcion.style.display = 'block';
            }
        });

        // Validación para campo cantidad
        cantidadInput.addEventListener('input', function() {
            var cantidad = cantidadInput.value.trim();

            // Verificar si la cantidad es un número válido y está en el rango
            if (isValidNumber(cantidad) && cantidad >= 1 && cantidad <= 500) {
                cantidadInput.classList.remove('is-invalid');
                errorCantidad.style.display = 'none';
            } else {
                cantidadInput.classList.add('is-invalid');
                errorCantidad.style.display = 'block';
            }
        });

        // Función para validar que sea un número válido
        function isValidNumber(value) {
            return /^\d+$/.test(value);
        }

        // Validación para valor (solo números y máximo 8 dígitos)
        valorInput.addEventListener('input', function() {
            var valor = valorInput.value.trim();

            if (/^[0-9]{1,8}$/.test(valor)) {
                valorInput.classList.remove('is-invalid');
                errorValor.style.display = 'none';
            } else {
                valorInput.classList.add('is-invalid');
                errorValor.style.display = 'block';
            }
        });
    });

    function validateForm() {
        const id_tipo_art = document.forms["formreg"]["id_tipo_art"].value;
        const nombre_A = document.forms["formreg"]["nombre_A"].value;
        const descripcion = document.forms["formreg"]["descripcion"].value;
        const cantidad = document.forms["formreg"]["cantidad"].value;
        const valor = document.forms["formreg"]["valor"].value;

        if (!id_tipo_art || !nombre_A || !descripcion || !cantidad || !valor) {
            alert("Existen datos vacíos");
            return false;
        }

        if (cantidad <= 0 || valor <= 0) {
            alert("Cantidad y valor deben ser mayores a 0");
            return false;
        }

        return true;
    }
</script>

</body>
</html>

