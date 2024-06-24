<?php
require('../../../fpdf/fpdf.php');
require_once("../../../db/connection.php");

// Conectar a la base de datos
$db = new Database();
$con = $db->conectar();

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        // Logo
        $this->Image('../../../imagenes/logos/Logo Arlequin Color.png', 10, 8, 33); // Ajusta la ruta del logo según sea necesario
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Título
        $this->Cell(0, 10, 'Detalle de Reserva', 0, 1, 'C');
        // Salto de línea
        $this->Ln(10);
    }

    // Pie de página
    function Footer() {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Función para mostrar los datos del usuario
    function UserData($data) {
        $this->SetFont('Arial', '', 12);
        // Información del cliente con bordes
        $this->Cell(0, 10, 'Información del Cliente:', 0, 1, 'L');
        $this->Ln(5);
        $this->Cell(50, 10, 'Cédula:', 0, 0, 'L');
        $this->Cell(0, 10, $data['cedula'], 0, 1, 'L');
        $this->Cell(50, 10, 'Nombre:', 0, 0, 'L');
        $this->Cell(0, 10, $data['nombre'], 0, 1, 'L');
        $this->Cell(50, 10, 'Celular:', 0, 0, 'L');
        $this->Cell(0, 10, $data['celular'], 0, 1, 'L');
        $this->Cell(50, 10, 'Correo:', 0, 0, 'L');
        $this->Cell(0, 10, $data['correo'], 0, 1, 'L');
        $this->Ln(10); // Salto de línea
    }

    // Función para mostrar los detalles de la reserva
    function MostrarDetallesReserva($data) {
        $this->SetFont('Arial', '', 12);

        // Mostrar detalles
        $this->Cell(0, 10, 'Detalles de la Reserva:', 0, 1, 'L');
        $this->Ln(5);

        // Información de la reserva
        $this->Cell(50, 10, 'Fecha de Evento:', 0, 0, 'L');
        $this->Cell(0, 10, $data['fecha_evento'], 0, 1, 'L');

        $this->Cell(50, 10, 'Paquete:', 0, 0, 'L');
        $this->Cell(0, 10, $data['nombre_paquete'], 0, 1, 'L');

        $this->Cell(50, 10, 'Tipo de Evento:', 0, 0, 'L');
        $this->Cell(0, 10, $data['tipo_evento'], 0, 1, 'L');

        $this->Cell(50, 10, 'Lugar:', 0, 0, 'L');
        $this->Cell(0, 10, $data['lugar'], 0, 1, 'L');

        $this->Cell(50, 10, 'Fecha de Inicio:', 0, 0, 'L');
        $this->Cell(0, 10, $data['f_inicio'], 0, 1, 'L');

        $this->Cell(50, 10, 'Hora de Inicio:', 0, 0, 'L');
        $this->Cell(0, 10, $data['hora_inicio'], 0, 1, 'L');

        $this->Cell(50, 10, 'Cliente:', 0, 0, 'L');
        $this->Cell(0, 10, $data['nombre_cliente'], 0, 1, 'L');

        $this->Cell(50, 10, 'Cantidad de niños:', 0, 0, 'L');
        $this->Cell(0, 10, $data['cant_ninos'], 0, 1, 'L');

        $this->Cell(50, 10, 'Estado:', 0, 0, 'L');
        $this->Cell(0, 10, $data['estado'], 0, 1, 'L');

        $this->Cell(50, 10, 'Edad del Homenajeado:', 0, 0, 'L');
        $this->Cell(0, 10, $data['edad_home'], 0, 1, 'L');

        $this->Cell(50, 10, 'Descripción:', 0, 0, 'L');
        $this->MultiCell(0, 10, $data['descripcion'], 0, 'L');
    }

    // Función para mostrar el listado de reservas
    function ReservasListado($con, $cedula) {
        $this->SetFont('Arial', '', 12);

        // Consultar las reservas del usuario
        $stmt = $con->prepare("SELECT eventos.fecha_evento, paquetes.nombre_paquete, tipo_e.tipo_evento, eventos.lugar, eventos.f_inicio, eventos.hora_inicio, usuarios.nombre as nombre_cliente, eventos.cant_ninos, eventos.edad_home, eventos.descripcion, estados.estado
        FROM eventos
        INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes
        INNER JOIN tipo_e ON tipo_e.id_tipo_e = eventos.id_tipo_e
        INNER JOIN usuarios ON usuarios.cedula = eventos.cedula
        INNER JOIN estados ON estados.id_estado = eventos.id_estado
        WHERE eventos.id_estado = 6 AND eventos.cedula = :cedula");
        $stmt->execute(['cedula' => $cedula]);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cabecera de la lista
        $this->Cell(0, 10, 'Listado de Reservas:', 0, 1, 'L');
        $this->Ln(5);

        // Mostrar cada reserva como un item de lista
        foreach ($reservas as $reserva) {
            $this->Cell(0, 10, 'Fecha de Reserva: ' . $reserva['fecha_evento'], 0, 1, 'L');
            $this->Cell(0, 10, 'Paquete: ' . $reserva['nombre_paquete'], 0, 1, 'L');
            $this->Cell(0, 10, 'Tipo de Evento: ' . $reserva['tipo_evento'], 0, 1, 'L');
            $this->Cell(0, 10, 'Lugar: ' . $reserva['lugar'], 0, 1, 'L');
            $this->Cell(0, 10, 'Fecha de Evento: ' . $reserva['f_inicio'], 0, 1, 'L');
            $this->Cell(0, 10, 'Hora de Evento: ' . $reserva['hora_inicio'], 0, 1, 'L');
            $this->Cell(0, 10, 'Cliente: ' . $reserva['nombre_cliente'], 0, 1, 'L');
            $this->Ln(5); // Espacio entre reservas
        }
    }
}

// Obtener el ID del evento desde la URL
$id_evento = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id_evento) {
    die('ID del evento no especificado.');
}

// Consultar los detalles de la reserva
$stmt = $con->prepare("SELECT eventos.fecha_evento, paquetes.nombre_paquete, tipo_e.tipo_evento, eventos.lugar, eventos.f_inicio, eventos.hora_inicio, usuarios.nombre as nombre_cliente, eventos.cant_ninos, eventos.edad_home, eventos.descripcion, estados.estado
                      FROM eventos
                      INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes
                      INNER JOIN tipo_e ON tipo_e.id_tipo_e = eventos.id_tipo_e
                      INNER JOIN usuarios ON usuarios.cedula = eventos.cedula
                      INNER JOIN estados ON estados.id_estado = eventos.id_estado
                      WHERE eventos.id_eventos = :id_eventos");
$stmt->execute(['id_eventos' => $id_eventos]);
$
// Continuación del código PHP

// Fetch del resultado
$detalle_reserva = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$detalle_reserva) {
    die('Reserva no encontrada.');
}

// Datos del usuario asociado a la reserva
$cedula = $detalle_reserva['cedula'];

$stmt = $con->prepare("SELECT * FROM usuarios WHERE cedula = :cedula");
$stmt->execute(['cedula' => $cedula]);
$datos_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$datos_usuario) {
    die('Usuario no encontrado.');
}

// Crear PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Mostrar datos del usuario
$pdf->UserData($datos_usuario);

// Mostrar detalles de la reserva
$pdf->MostrarDetallesReserva($detalle_reserva);

// Mostrar listado de reservas del usuario
$pdf->ReservasListado($con, $cedula);

// Salida del PDF
$pdf->Output();
?>
