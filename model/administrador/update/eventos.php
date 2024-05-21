<?php
session_start();
require_once("../../../db/connection.php");

// Conectar a la base de datos
$db = new Database();
$con = $db->conectar();

$id_eventos = $_GET['id'] ?? null;

if ($id_eventos) {
    // Consulta inicial para obtener los datos del evento
    $sql = $con->prepare("SELECT * FROM eventos WHERE id_eventos = :id_eventos");
    $sql->bindParam(':id_eventos', $id_eventos, PDO::PARAM_INT);
    $sql->execute();
    $evento = $sql->fetch(PDO::FETCH_ASSOC);

    if (!$evento) {
        echo "Evento no encontrado.";
        exit;
    }

    // Manejo del formulario de actualización
    if (isset($_POST['actualizar'])) {
        $id_paquetes = $_POST['id_paquetes'];
        $id_tipo_e = $_POST['id_tipo_e'];
        $lugar = $_POST['lugar'];
        $cant_ninos = $_POST['cant_ninos'];
        $f_inicio = $_POST['f_inicio'];
        $hora_inicio = $_POST['hora_inicio'];
        $descripcion = $_POST['descripcion'];
        $contacto = $_POST['contacto'];
        $valor_total = $_POST['valor_total'];

        $update = $con->prepare("UPDATE eventos SET id_paquetes = :id_paquetes, id_tipo_e = :id_tipo_e, lugar = :lugar, cant_ninos = :cant_ninos, f_inicio = :f_inicio, hora_inicio = :hora_inicio, descripcion = :descripcion, contacto = :contacto, valor_total = :valor_total WHERE id_eventos = :id_eventos");
        $update->bindParam(':id_paquetes', $id_paquetes);
        $update->bindParam(':id_tipo_e', $id_tipo_e);
        $update->bindParam(':lugar', $lugar);
        $update->bindParam(':cant_ninos', $cant_ninos);
        $update->bindParam(':f_inicio', $f_inicio);
        $update->bindParam(':hora_inicio', $hora_inicio);
        $update->bindParam(':descripcion', $descripcion);
        $update->bindParam(':contacto', $contacto);
        $update->bindParam(':valor_total', $valor_total);
        $update->bindParam(':id_eventos', $id_eventos, PDO::PARAM_INT);
        $update->execute();

        echo '<script>alert("Registro actualizado exitosamente");</script>';
        echo '<script>window.close();</script>';
    } elseif (isset($_POST['eliminar'])) {
        $delete = $con->prepare("DELETE FROM eventos WHERE id_eventos = :id_eventos");
        $delete->bindParam(':id_eventos', $id_eventos, PDO::PARAM_INT);
        $delete->execute();

        echo '<script>alert("Registro eliminado exitosamente");</script>';
        echo '<script>window.close();</script>';
    }
} else {
    echo "ID del evento no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Evento</title>
    <link rel="stylesheet" href="../../../css/tab.css">
    <link rel="stylesheet" href="../../../css/tablaedi.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../../css/tablaedi.css" rel="stylesheet">
 <script>
        function centrar() {
            iz = (screen.width - document.body.clientWidth) / 2;
            de = (screen.height - document.body.clientHeight) / 3;
            moveTo(iz, de);
        }
    </script>
</head>
<body onload="centrar();">
<div class="card">

        <div class="card-body">

    <table class="card-body">
        <form autocomplete="off"  class="row g-3" name="form_actualizar" method="POST">
            <label  class="form-label" for="id_eventos">ID</label>
            <br>
            <input class="form-control" type="number" name="id_eventos" value="<?php echo htmlspecialchars($evento['id_eventos']); ?>" readonly>
            <br><br>

            <label  class="form-label" for="id_paquetes">Paquete</label>
            <br>
            <select class="cont" name="id_paquetes">
                <option value="<?php echo htmlspecialchars($evento['id_paquetes']); ?>">Seleccione el paquete</option>
                <?php
                $paquetes = $con->query("SELECT * FROM paquetes")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($paquetes as $paquete) {
                    echo "<option value='" . htmlspecialchars($paquete['id_paquetes']) . "'>" . htmlspecialchars($paquete['nombre_paquete']) . "</option>";
                }
                ?>
            </select>
            <br><br>

            <label  class="form-label" for="id_tipo_e">Tipo de paquete</label>
            <br>
            <select class="cont" name="id_tipo_e">
                <option value="<?php echo htmlspecialchars($evento['id_tipo_e']); ?>">Seleccione Tipo de Evento</option>
                <?php
                $tipos = $con->query("SELECT * FROM tipo_e")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tipos as $tipo) {
                    echo "<option value='" . htmlspecialchars($tipo['id_tipo_e']) . "'>" . htmlspecialchars($tipo['tipo_evento']) . "</option>";
                }
                ?>
            </select>
            <br><br>

            <label  class="form-label" for="lugar">Lugar</label>
            <br>
            <input class="form-control" type="text" name="lugar" id="lugar" value="<?php echo htmlspecialchars($evento['lugar']); ?>" required>
            <br><br>

            <label class="form-label" for="cant_ninos">Cantidad de niños</label>
            <br>
            <input class="form-control" type="number" name="cant_ninos" value="<?php echo htmlspecialchars($evento['cant_ninos']); ?>" required>
            <br><br>

            <label class="form-label" for="f_inicio">Fecha de inicio</label>
            <br>
            <input class="form-control" type="date" name="f_inicio" value="<?php echo htmlspecialchars($evento['f_inicio']); ?>" required>
            <br><br>

            <label class="form-label" for="hora_inicio">Hora de inicio</label>
            <br>
            <input class="form-control" type="time" name="hora_inicio" value="<?php echo htmlspecialchars($evento['hora_inicio']); ?>" required>
            <br><br>

            <label class="form-label" for="descripcion">Descripción</label>
            <br>
            <input class="form-control" type="text" name="descripcion" value="<?php echo htmlspecialchars($evento['descripcion']); ?>" required>
            <br><br>

            <label class="form-label"  for="contacto">Contacto</label>
            <br>
            <input class="form-control" type="text" name="contacto" value="<?php echo htmlspecialchars($evento['contacto']); ?>" required>
            <br><br>

            <label  class="form-label"for="valor_total">Valor total</label>
            <br>
            <input class="form-control" type="number" name="valor_total" value="<?php echo htmlspecialchars($evento['valor_total']); ?>" required>
            <br><br>

            <td><input type="submit"  class="btn" style="background-color: #2c8ac9; color: white;" name="actualizar" value="Actualizar"></td>
            <td><input type="submit" class="btn" style="background-color: gray; color: white;" name="eliminar" value="Eliminar"></td>
        </form>
         
    </table>
    </div>
</body>
</html>

