<?php
require '../../../../vendor/autoload.php';
require_once "../../../../db/connection.php";

$db = new DataBase();
$con = $db->conectar();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['cli_excel'])) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agrega los encabezados de columna
    // $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Cedula');
    $sheet->setCellValue('C1', 'Nombre');
    $sheet->setCellValue('D1', 'Telefono');
    $sheet->setCellValue('E1', 'Correo');
    $sheet->setCellValue('F1', 'Estado');

    $stmt = $con->prepare("SELECT usuarios.cedula, usuarios.nombre, usuarios.celular, usuarios.correo, estados.estado FROM usuarios
                      INNER JOIN estados ON estados.id_estado = usuarios.id_estado WHERE id_tipo_user = 2");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Llena la hoja de cálculo con los datos
    $row = 2;
    foreach ($result as $data) {
        // $sheet->setCellValue('A' . $row, $data['id_articulo']);
        $sheet->setCellValue('B' . $row, $data['cedula']);
        $sheet->setCellValue('C' . $row, $data['nombre']);
        $sheet->setCellValue('D' . $row, $data['celular']);
        $sheet->setCellValue('E' . $row, $data['correo']);
        $sheet->setCellValue('F' . $row, $data['estado']);

        $row++;
    }

    // Establecer encabezados para la descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Clientes.xlsx"');
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