<?php

include 'spreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Instance ID');
$sheet->setCellValue('B1', 'Instance Name');
$sheet->setCellValue('C1', 'Submissiong Date');
$sheet->setCellValue('D1', 'Requester');
$sheet->setCellValue('E1', 'Position Details');
$sheet->setCellValue('F1', 'Production Line');
$sheet->setCellValue('G1', 'Hiring Type');
$sheet->setCellValue('H1', 'Classification 100');
$sheet->setCellValue('I1', 'Classification 110');
$sheet->setCellValue('J1', 'Classification 111');
$sheet->setCellValue('K1', 'Zone');
$sheet->setCellValue('L1', 'Branch');
$sheet->setCellValue('M1', 'Cost Center Name');
$sheet->setCellValue('N1', 'Cost Center Code');
$sheet->setCellValue('O1', 'Department');
$sheet->setCellValue('P1', 'Location');
$sheet->setCellValue('Q1', ' Number of Position Open');
$sheet->setCellValue('R1', 'Workforce Classification');
$sheet->setCellValue('S1', 'Request Type');
$sheet->setCellValue('T1', 'Employee Code & 8ID');
$sheet->setCellValue('U1', 'Employee Name');
$sheet->setCellValue('V1', 'New Joiner 8 ID');
$sheet->setCellValue('W1', 'New Joiner Name');
$sheet->setCellValue('X1', 'Required Date');
$sheet->setCellValue('Y1', 'Reporting To');
$sheet->setCellValue('Z1', 'Budget CTC in INR (Including Perks, Allownaces, benefits, etc)');
$sheet->setCellValue('AA1', 'Internal Posting Recommended');
$sheet->setCellValue('AB1', 'Status');
$sheet->setCellValue('Ac1', 'Next Handler');





    $cell_st =[
        'font' =>['bold' => true],
        'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
       ];
       $spreadsheet->getActiveSheet()->getStyle('A1:AC1')->applyFromArray($cell_st);
       
       //set columns widthz
       for($i = 'A'; $i <= 'Z'; $i++)
       {
       $spreadsheet->getActiveSheet()->getColumnDimension($i)->setWidth(20);
       
       }
       $spreadsheet->getActiveSheet()->setTitle('PRF format');
       $filename = 'PRF-format.xlsx';

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
ob_end_clean(); 
$writer->save('export.xlsx');
           header('Content-Type: application/vnd.ms-excel');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           $writer->save("php://output");
           exit;

      
?>