<?php
require('../fpdf/fpdf.php');

require('../api/db.php');

$collection = $db->intereval;
$cursor = $collection->findOne(array("email"=>"pragatigaikwad280@gmail.com"));
$fullname =  $db->tokens->findOne(array("email"=>$cursor['email']));

$pdf = new FPDF();
$pdf->AddPage();
 

$pdf->SetFont('Arial','B',12);
$pdf->setFillColor(230,230,230);
$pdf->Ln(20);
$pdf->SetX(20); 
$pdf->Cell(150,7,'Full Name',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20);
$pdf->SetFont('');
$pdf->Cell(150,7,$fullname['full_name'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Email',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$cursor['email'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12); 
$pdf->Cell(150,7,'Functional/Technical Knowledge',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$cursor['candidateknowledge'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Relevant Project/Functional Experience',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$cursor['candidateexperience'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Major Strengths(Technical/Functional)',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$cursor['candidatestrength'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Major Weaknesses(Technical/Functional)',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$cursor['candidateweakness'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Any special areas probes',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$cursor['candidatespecial'],0,1,'L');

if($cursor['candidatereasonhold']){
$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12); 
$pdf->Cell(150,7,'If on-hold (Reason)',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$cursor['candidatereasonhold'],0,1,'L');
}

if($cursor['candidatedesignation']){
$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'If selected (Designation)',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$cursor['candidatedesignation'],0,1,'L');
}


if($cursor['date']){
$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'If selected (Joining Date)',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$cursor['date'],0,1,'L');
}

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12); 
$pdf->Cell(150,7,'Result Of Interview',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$cursor['result'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Remarks, if any',0,1,'L',1);

$pdf->Ln(5);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$cursor['remark'],0,1,'L');


$pdf->Output();
// $pdf->Output('D','Evaluation sheet-'.$fullname['full_name'].'.pdf');
?>