<?php
require '../../../../vendor/autoload.php';
require_once "../../../../db/connection.php";

$db = new Database();
$con = $db->conectar();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['paque_excel'])) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agrega los encabezados de columna
    $sheet->setCellValue('B1', 'Nombre del Paquete');
    $sheet->setCellValue('C1', 'Edad Mínima');
    $sheet->setCellValue('D1', 'Edad Máxima');
    $sheet->setCellValue('E1', 'Valor');

    $stmt = $con->prepare("SELECT nombre_paquete, edad_min, edad_max, valor FROM paquetes");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Llena la hoja de cálculo con los datos
    $row = 2;
    foreach ($result as $data) {
        $sheet->setCellValue('B' . $row, $data['nombre_paquete']);
        $sheet->setCellValue('C' . $row, $data['edad_min']);
        $sheet->setCellValue('D' . $row, $data['edad_max']);
        $sheet->setCellValue('E' . $row, $data['valor']);
        $row++;
    }

    // Establecer encabezados para la descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Paquetes.xlsx"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
?>