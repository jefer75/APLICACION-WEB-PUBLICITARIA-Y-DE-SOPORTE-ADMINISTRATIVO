<?php
// download_pdf.php
require('fpdf/fpdf.php');

function downloadPDF() {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, '¡Hola, Mundo!');

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="archivo.pdf"');
    $pdf->Output('D', 'archivo.pdf');
    exit;
}

if (isset($_POST['download_pdf'])) {
    downloadPDF();
}
?>
