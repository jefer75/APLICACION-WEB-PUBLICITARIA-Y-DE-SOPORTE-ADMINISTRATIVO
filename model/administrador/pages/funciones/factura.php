<?php
require('../../../../fpdf/fpdf.php');
require_once("../../../../db/connection.php");

// Conectar a la base de datos
$db = new Database();
$con = $db->conectar();

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        // Logo
        $this->Image('../../../../imagenes/logos/Logo Arlequin Color.png', 10, 8, 33); // Ajusta la ruta del logo según sea necesario
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Título
        $this->Cell(0, 10, 'Factura de Ventas', 0, 1, 'C');
        // Salto de línea
        $this->Ln(5);
    }

    // Pie de página
    function Footer() {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Función para mostrar los datos del usuario
    function UserData($con) {
        $stmt = $con->prepare("SELECT * FROM factura WHERE id_eventos = :id_evento");
        $stmt->execute(['id_evento' => $_GET['id']]);
        $factura = $stmt->fetch();

        $numero_factura = $factura['id_factura'];

        $stmt = $con->prepare("SELECT usuarios.cedula, usuarios.nombre, usuarios.celular, usuarios.correo
                               FROM eventos
                               INNER JOIN usuarios ON usuarios.cedula = eventos.cedula
                               WHERE eventos.id_estado = 8 AND eventos.id_eventos = :id_evento");
        $stmt->execute(['id_evento' => $_GET['id']]);
        $cliente = $stmt->fetch();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(50, 10, 'Identificador de Factura: '.$numero_factura, 0, 1, 'L');
        $this->Ln(2);
        $this->Cell(0, 10, 'Informacion del Cliente:', 0, 1, 'L');
        $this->Ln(2);
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 6, 'Cedula:', 0, 0, 'L');
        $this->Cell(0, 6, $cliente['cedula'], 0, 1, 'L');
        $this->Cell(50, 6, 'Nombre:', 0, 0, 'L');
        $this->Cell(0, 6, $cliente['nombre'], 0, 1, 'L');
        $this->Cell(50, 6, 'Celular:', 0, 0, 'L');
        $this->Cell(0, 6, $cliente['celular'], 0, 1, 'L');
        $this->Cell(50, 6, 'Correo:', 0, 0, 'L');
        $this->Cell(0, 6, $cliente['correo'], 0, 1, 'L');
        $this->Ln(5); // Salto de línea
    }

    // Función para mostrar los datos de la empresa
    function CompanyData($con) {
        $stmt = $con->prepare("SELECT usuarios.nit, empresa.nombre_emp, empresa.telefono, empresa.direccion 
                               FROM eventos
                               INNER JOIN usuarios ON usuarios.cedula = eventos.cedula
                               INNER JOIN empresa ON usuarios.nit = empresa.nit
                               WHERE eventos.id_estado = 8 AND eventos.id_eventos = :id_evento");
        $stmt->execute(['id_evento' => $_GET['id']]);
        $empresa = $stmt->fetch();

        // Fecha y hora de generación del PDF
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'Informacion de la Empresa:', 0, 1, 'L');
        $this->Ln(2);
        $this->SetFont('Arial', '', 10);
        $this->Cell(95, 6, 'NIT: ' . $empresa['nit'], 0, 0, 'L');
        $this->Cell(95, 6, 'Fecha: ' . $fecha, 0, 1, 'L');
        $this->Cell(95, 6, 'Telefono: ' . $empresa['telefono'], 0, 0, 'L');
        $this->Cell(95, 6, 'Hora: ' . $hora, 0, 1, 'L');
        $this->Cell(95, 6, 'Direccion: ' . $empresa['direccion'], 0, 1, 'L');
        $this->Ln(10); // Salto de línea
    }

    function EventosData($con) {
        $stmt = $con->prepare("SELECT paquetes.nombre_paquete, paquetes.valor, tipo_e.tipo_evento, eventos.lugar, eventos.f_inicio, eventos.hora_inicio, usuarios.nombre 
                               FROM eventos
                               INNER JOIN usuarios ON usuarios.cedula = eventos.cedula
                               INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes
                               INNER JOIN tipo_e ON eventos.id_tipo_e = tipo_e.id_tipo_e
                               WHERE eventos.id_estado = 8 AND eventos.id_eventos = :id_evento");
        $stmt->execute(['id_evento' => $_GET['id']]);
        $reserva = $stmt->fetch();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'Informacion del Evento:', 0, 1, 'L');
        $this->Ln(2);
        $this->SetFont('Arial', '', 10);
        $this->Cell(50, 6, 'Paquete:', 0, 0, 'L');
        $this->Cell(0, 6, $reserva['nombre_paquete']." ($".number_format($reserva['valor']).")", 0, 1, 'L');
        $this->Cell(50, 6, 'Tipo de Evento:', 0, 0, 'L');
        $this->Cell(0, 6, $reserva['tipo_evento'], 0, 1, 'L');
        $this->Cell(50, 6, 'Lugar:', 0, 0, 'L');
        $this->Cell(0, 6, $reserva['lugar'], 0, 1, 'L');
        $this->Cell(50, 6, 'Fecha de Evento:', 0, 0, 'L');
        $this->Cell(0, 6, $reserva['f_inicio'], 0, 1, 'L');
        $this->Cell(50, 6, 'Hora de Evento:', 0, 0, 'L');
        $this->Cell(0, 6, $reserva['hora_inicio'], 0, 1, 'L');
        $this->Cell(50, 6, 'Cliente:', 0, 0, 'L');
        $this->Cell(0, 6, $reserva['nombre'], 0, 1, 'L');
        $this->Ln(5); // 
    }

    // Función para mostrar el listado de reservas
    function ReservasListado($con) {
        $stmt = $con->prepare("SELECT articulos.nombre_A, detalle_factura.cantidad , detalle_factura.valor_neto, factura.valor_total 
                               FROM detalle_factura
                               INNER JOIN articulos ON articulos.id_articulo = detalle_factura.id_articulo
                               INNER JOIN factura ON factura.id_eventos = detalle_factura.id_evento
                               WHERE detalle_factura.id_evento = :id_evento");
        $stmt->execute(['id_evento' => $_GET['id']]);
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'Detalle de Factura:', 0, 1, 'L');
        $this->Ln(2);

        // Encabezados de la tabla
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(90, 6, 'Articulo', 1, 0, 'L');
        $this->Cell(30, 6, 'Cantidad', 1, 0, 'L');
        $this->Cell(40, 6, 'Valor Neto', 1, 0, 'L');
        $this->Cell(30, 6, 'Valor Total', 1, 1, 'L');

        $this->SetFont('Arial', '', 10);
        foreach ($reservas as $reserva) {
            $this->Cell(90, 6, $reserva['nombre_A'], 1);
            $this->Cell(30, 6, $reserva['cantidad'], 1);
            $this->Cell(40, 6, number_format($reserva['valor_neto'], 2), 1);
            $this->Cell(30, 6, number_format($reserva['valor_total'], 2), 1);
            $this->Ln(6);
        }

        // Valor total fuera de la tabla
        $this->Ln(10);
        $total = $reservas[0]['valor_total']; // Asumimos que el valor total es el mismo para todas las reservas
        $this->Cell(0, 10, 'Valor Total: ' . number_format($total, 2), 0, 1, 'R');
    }
}

// Crear PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Mostrar datos de la empresa con número de factura
$pdf->CompanyData($con);

// Mostrar datos del usuario
$pdf->UserData($con);

// Mostrar datos del evento
$pdf->EventosData($con);

// Mostrar listado de reservas
$pdf->ReservasListado($con);

// Salida del PDF
$pdf->Output();
?>
