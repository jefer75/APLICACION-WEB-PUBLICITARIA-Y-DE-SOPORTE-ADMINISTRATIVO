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
        $this->Cell(0, 10, 'Factura de Usuario', 0, 1, 'C');
        // Salto de línea
        $this->Ln(20);
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
    // function UserData($data) {
    //     $this->SetFont('Arial', '', 12);
    //     // Información del cliente
    //     $this->Cell(0, 10, 'Cédula: ' . $data['cedula'], 0, 1);
    //     $this->Cell(0, 10, 'Nombre: ' . $data['nombre'], 0, 1);
    //     $this->Cell(0, 10, 'Celular: ' . $data['celular'], 0, 1);
    //     $this->Cell(0, 10, 'Correo: ' . $data['correo'], 0, 1);
    //     // Más datos según sea necesario
    // }
}

// Obtener cédula del usuario
// $cedula = isset($_GET['cedula']) ? $_GET['cedula'] : null; // Ajusta según cómo obtienes la cédula del usuario
// if (!$cedula) {
//     die('Cédula del usuario no especificada.');
// }

// $stmt = $con->prepare("SELECT * FROM usuarios WHERE cedula = :cedula");
// $stmt->execute(['cedula' => $cedula]);
// $datos_usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// if (!$datos_usuario) {
//     die('Usuario no encontrado.');
// }

// Crear PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
// $pdf->UserData($datos_usuario);

// Salida del PDF
$pdf->Output();
?>
