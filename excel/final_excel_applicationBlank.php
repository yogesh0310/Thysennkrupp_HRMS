<?php

include 'spreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();

include("../api/db.php");

$collection = $db->tokens;
$cursor = $collection->find();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Name');
$sheet->setCellValue('B1', 'street');
$sheet->setCellValue('C1', 'Locality');
$sheet->setCellValue('D1', 'State');
$sheet->setCellValue('E1', 'Pincode');
$sheet->setCellValue('F1', 'City');
$sheet->setCellValue('G1', 'Contact Number');
$sheet->setCellValue('H1', 'Email ID');
$sheet->setCellValue('I1', 'Date Of Birth');
$sheet->setCellValue('J1', 'Position applied for');
$sheet->setCellValue('K1', 'Location');
$sheet->setCellValue('L1', 'Passport Availability');
$sheet->setCellValue('M1', 'Undergraduation');
$sheet->setCellValue('N1', 'Undergraduation Specialization');
$sheet->setCellValue('O1', 'Postgraduation');
$sheet->setCellValue('P1', 'Postgraduation Specialization');
$sheet->setCellValue('Q1', 'Internet');
$sheet->setCellValue('R1', 'Employee');
$sheet->setCellValue('S1', 'Walk In');
$sheet->setCellValue('T1', 'Web');
$sheet->setCellValue('U1', 'Other');
$sheet->setCellValue('V1', ' Date Of joining');
$sheet->setCellValue('W1', 'Notice Peroid In current organization');
$sheet->setCellValue('X1', 'Reporting Manager Name');
$sheet->setCellValue('Y1', 'Fathers Name');
$sheet->setCellValue('Z1', 'Date Of Birth');
$sheet->setCellValue('AA1', 'Mothers Name');
$sheet->setCellValue('AB1', 'Date Of Birth');
$sheet->setCellValue('AC1', 'Spouse Name');
$sheet->setCellValue('AD1', 'Date Of Birth');
$sheet->setCellValue('AE1', 'Spouse Gender');
$sheet->setCellValue('AF1', 'Child 1 Name');
$sheet->setCellValue('AG1', 'Date Of Birth');
$sheet->setCellValue('AH1', 'Gender ');
$sheet->setCellValue('AI1', 'Child 2 Name');
$sheet->setCellValue('AJ1', 'Date Of Birth');
$sheet->setCellValue('AK1', 'Gender');
$sheet->setCellValue('AL1', 'Monthly Take Home (Present)');
$sheet->setCellValue('AM1', 'Monthly Take Home (Expected)');
$sheet->setCellValue('AN1', 'Monthly Gross (Present) ');
$sheet->setCellValue('AO1', 'Monthly Gross (Expected) ');
$sheet->setCellValue('AP1', 'Yearly Gross (Present) ');
$sheet->setCellValue('AQ1', 'Yearly Gross (Expected)');

$sheet->setCellValue('AR1', 'Reference Name');
$sheet->setCellValue('AS1', 'Reference Mail');
$sheet->setCellValue('AT1', 'Reference Designation');
$sheet->setCellValue('AU1', 'Reference Contact');
$sheet->setCellValue('AV1', 'Reference Company');

$sheet->setCellValue('AW1', 'Organisation Name');
$sheet->setCellValue('AX1', 'Designation');
$sheet->setCellValue('AY1', 'From Date');
$sheet->setCellValue('AZ1', 'To Date');
$sheet->setCellValue('BA1', 'Manager Name');
$sheet->setCellValue('BB1', 'Manager Email');



$n = 1;
	foreach($cursor as $row)
	{

		$rowNum = $n + 1;
		$refname=$row['refname'];
		$refmail=$row['refmail'];
		$refdsg=$row['refdsg'];
		$refcontact=$row['refcontact'];
		$refcn=$row['refcn'];

		$managername=$row['managername'];
		$managermail=$row['managermail'];
		$fromdate=$row['fromdate'];
		$todate=$row['todate'];
		$orgname=$row['orgname'];
		$olddesg=$row['olddesignation0'];




		$sheet->setCellValue('A'.$rowNum, $row['full_name']);
		$sheet->setCellValue('B'.$rowNum, $row['street']);
		$sheet->setCellValue('C'.$rowNum, $row['Locality']);
		$sheet->setCellValue('D'.$rowNum, $row['State']);
		$sheet->setCellValue('E'.$rowNum, $row['Pincode']);
		$sheet->setCellValue('F'.$rowNum, $row['City']);
		$sheet->setCellValue('G'.$rowNum, $row['number']);
		$sheet->setCellValue('H'.$rowNum, $row['email']);
		$sheet->setCellValue('I'.$rowNum, $row['dob']);
		$sheet->setCellValue('J'.$rowNum, $row['position']);
		$sheet->setCellValue('K'.$rowNum, $row['location']);
		$sheet->setCellValue('L'.$rowNum, $row['passport']);
		$sheet->setCellValue('M'.$rowNum, $row['selectug']);
		$sheet->setCellValue('N'.$rowNum, $row['specialug']);
		$sheet->setCellValue('O'.$rowNum, $row['selectpg']);
		$sheet->setCellValue('P'.$rowNum, $row['specialpg']);
		$sheet->setCellValue('Q'.$rowNum, $row['internet']);
		$sheet->setCellValue('R'.$rowNum, $row['checkemp']);
		$sheet->setCellValue('S'.$rowNum, $row['walk']);
		$sheet->setCellValue('T'.$rowNum, $row['web']);
		$sheet->setCellValue('U'.$rowNum, $row['other']);
		$sheet->setCellValue('V'.$rowNum, $row['jdate']);
		$sheet->setCellValue('W'.$rowNum, $row['notice']);
		$sheet->setCellValue('X'.$rowNum, $row['manager']);
		$sheet->setCellValue('Y'.$rowNum, $row['fathersname']);
		$sheet->setCellValue('Z'.$rowNum, $row['fdob']);
		$sheet->setCellValue('AA'.$rowNum, $row['mother']);
		$sheet->setCellValue('AB'.$rowNum, $row['mdob']);
		$sheet->setCellValue('AC'.$rowNum, $row['spousename']);
		$sheet->setCellValue('AD'.$rowNum, $row['spdob']);
		$sheet->setCellValue('AE'.$rowNum, $row['sgender']);
		$sheet->setCellValue('AF'.$rowNum, $row['child1']);
		$sheet->setCellValue('AG'.$rowNum, $row['ch1dob']);
		$sheet->setCellValue('AH'.$rowNum, $row['ch1gender']);
		$sheet->setCellValue('AI'.$rowNum, $row['child2']);
		$sheet->setCellValue('AJ'.$rowNum, $row['ch2dob']);
		$sheet->setCellValue('AK'.$rowNum, $row['ch2gender']);
		$sheet->setCellValue('AL'.$rowNum, $row['homepresent']);
		$sheet->setCellValue('AM'.$rowNum, $row['homeexpect']);
		$sheet->setCellValue('AN'.$rowNum, $row['grosspresent']);
		$sheet->setCellValue('AO'.$rowNum, $row['grossexpect']);
		$sheet->setCellValue('AP'.$rowNum, $row['ypresent']);
		$sheet->setCellValue('AQ'.$rowNum, $row['yexpect']);
		$numm=$rowNum;
		for ($i = 0; $i < count($refname); $i++) {
			
			$sheet->setCellValue('AR'.$numm,$refname[$i]);
			$numm++;
		}
		$numm1=$rowNum;
		for ($i = 0; $i < count($refmail); $i++) {
			
			$sheet->setCellValue('AS'.$numm1,$refmail[$i]);
			$numm1++;
		}
		$numm2=$rowNum;
		for ($i = 0; $i < count($refdsg); $i++) {
			
			$sheet->setCellValue('AT'.$numm2,$refdsg[$i]);
			$numm2++;
		}
		$numm3=$rowNum;
		for ($i = 0; $i < count($refcontact); $i++) {
			
			$sheet->setCellValue('AU'.$numm3,$refcontact[$i]);
			$numm3++;
		}
		$numm4=$rowNum;
		for ($i = 0; $i < count($refcn); $i++) {
			
			$sheet->setCellValue('AV'.$numm4,$refcn[$i]);
			$numm4++;
		}

		$expnum=$rowNum;
		for ($i = 0; $i < count($orgname); $i++) {
			
			$sheet->setCellValue('AW'.$expnum,$orgname[$i]);
			$expnum++;
		}

		$expnum1=$rowNum;
		for ($i = 0; $i < count($olddesg); $i++) {
			
			$sheet->setCellValue('AX'.$expnum1,$olddesg[$i]);
			$expnum1++;
		}

		$expnum2=$rowNum;
		for ($i = 0; $i < count($fromdate); $i++) {
			
			$sheet->setCellValue('AY'.$expnum2,$fromdate[$i]);
			$expnum2++;
		}

		$expnum3=$rowNum;
		for ($i = 0; $i < count($todate); $i++) {
			
			$sheet->setCellValue('AZ'.$expnum3,$todate[$i]);
			$expnum3++;
		}

		$expnum4=$rowNum;
		for ($i = 0; $i < count($managername); $i++) {
			
			$sheet->setCellValue('BA'.$expnum4,$managername[$i]);
			$expnum4++;
		}

		$expnum5=$rowNum;
		for ($i = 0; $i < count($managermail); $i++) {
			
			$sheet->setCellValue('BB'.$expnum5,$managermail[$i]);
			$expnum5++;
		}
		if(count($orgname)>count($refname)){
			$n+=count($orgname);
		}else{
			$n+=count($refname);
		}

		
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
       $spreadsheet->getActiveSheet()->setTitle('ApplicationBlank');
       $filename = 'ApplicationBlank-'.time().'.xlsx';

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
ob_end_clean(); 
$writer->save('export.xlsx');
           header('Content-Type: application/vnd.ms-excel');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           $writer->save("php://output");
           exit;

      
?>