<?php
require '../../../../vendor/autoload.php';
require_once "../../../../db/connection.php";

$db = new Database();
$con = $db->conectar();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['pend_excel'])) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agrega los encabezados de columna
    $sheet->setCellValue('A1', 'Fecha de Reserva');
    $sheet->setCellValue('B1', 'Paquete');
    $sheet->setCellValue('C1', 'Tipo de Evento');
    $sheet->setCellValue('D1', 'Lugar');
    $sheet->setCellValue('E1', 'Fecha de Evento');
    $sheet->setCellValue('F1', 'Hora de Evento');
    $sheet->setCellValue('G1', 'Cliente');
    $sheet->setCellValue('H1', 'Detalles');
    $sheet->setCellValue('I1', 'Animador');
    $sheet->setCellValue('J1', 'Alquiler');

    $stmt = $con->prepare("SELECT eventos.fecha_evento, paquetes.nombre_paquete, tipo_e.tipo_evento, eventos.lugar, eventos.f_inicio, eventos.hora_inicio, usuarios.nombre, eventos.id_eventos FROM eventos
                           INNER JOIN paquetes ON paquetes.id_paquetes = eventos.id_paquetes
                           INNER JOIN tipo_e ON tipo_e.id_tipo_e = eventos.id_tipo_e
                           INNER JOIN usuarios ON usuarios.cedula = eventos.cedula
                           WHERE eventos.id_estado = 6");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Llena la hoja de cálculo con los datos
    $row = 2;
    foreach ($result as $data) {
        $sheet->setCellValue('A' . $row, $data['fecha_evento']);
        $sheet->setCellValue('B' . $row, $data['nombre_paquete']);
        $sheet->setCellValue('C' . $row, $data['tipo_evento']);
        $sheet->setCellValue('D' . $row, $data['lugar']);
        $sheet->setCellValue('E' . $row, $data['f_inicio']);
        $sheet->setCellValue('F' . $row, $data['hora_inicio']);
        $sheet->setCellValue('G' . $row, $data['nombre']);
        $sheet->setCellValue('H' . $row, "Detalles del evento");
        $sheet->setCellValue('I' . $row, "Detalles del animador");
        $sheet->setCellValue('J' . $row, "Detalles del alquiler");
        $row++;
    }

    // Establecer encabezados para la descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reservas Pendientes.xlsx"');
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
