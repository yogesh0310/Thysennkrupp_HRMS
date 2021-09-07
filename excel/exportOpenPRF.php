<?php

require 'spreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

require 'db.php';

$collection = $db->prfs;
$cursor = $collection->find();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'INSTANCE ID');
$sheet->setCellValue('B1', 'POSITION DETAILS');
$sheet->setCellValue('C1', 'ZONE');
$sheet->setCellValue('D1', 'DEPARTMENT');
$sheet->setCellValue('E1', 'NO. OF POSITIONS');
$sheet->setCellValue('F1', 'STATUS');
$sheet->setCellValue('G1', 'PROGRESS');
// $sheet->setCellValue('H1', 'Any special areas probes');
// $sheet->setCellValue('I1', 'Result Of Interview ');
// $sheet->setCellValue('J1', 'If on-hold (Reason)');
// $sheet->setCellValue('K1', 'If selected (Designation)');
// $sheet->setCellValue('L1', 'If selected (Joining Date)');
// $sheet->setCellValue('M1', 'Remarks, if any');


$n = 1;
	foreach($cursor as $row)
	{
		$rowNum = $n + 1;
        // $id=array($row['prf'],$row['pos'],$row['iid'],$row['rid']);
        // $id=implode("-",$id);
        // $fullname =  $db->tokens->findOne(array("email"=>$row['email']));

        // $sheet->setCellValue('A'.$rowNum, $id);
        // $sheet->setCellValue('B'.$rowNum, $fullname['full_name']);
        $sheet->setCellValue('A'.$rowNum, $row['prf']);
        $sheet->setCellValue('B'.$rowNum, $row['position']);
        $sheet->setCellValue('C'.$rowNum, $row['zone']);
        $sheet->setCellValue('D'.$rowNum, $row['department']);
		$sheet->setCellValue('E'.$rowNum, $row['pos']);
		$sheet->setCellValue('F'.$rowNum, $row['status']);
        $sheet->setCellValue('G'.$rowNum, $row['progress']);    
		// $sheet->setCellValue('J'.$rowNum, $row['candidatereasonhold']);
		// $sheet->setCellValue('K'.$rowNum, $row['candidatedesignation']);
        // $sheet->setCellValue('L'.$rowNum, $row['date']);
        // $sheet->setCellValue('M'.$rowNum, $row['remark']);
        
	
		$n++;
	}

    $cell_st =[
        'font' =>['bold' => true],
        'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
       ];
       $spreadsheet->getActiveSheet()->getStyle('A1:BZ1')->applyFromArray($cell_st);
       
       //set columns widthz
       for($i = 'A'; $i <= 'Z'; $i++)
       {
       $spreadsheet->getActiveSheet()->getColumnDimension($i)->setWidth(20);
       
       }
       $spreadsheet->getActiveSheet()->setTitle('OpenPRF');
       $filename = 'OpenPRF-'.time().'.xlsx';

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
           $writer->save('export.xlsx');
           header('Content-Type: application/vnd.ms-excel');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           $writer->save("php://output");
           exit;

      
?>