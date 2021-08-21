<?php
require('../fpdf/fpdf.php');

require('../api/db.php');

$collection = $db->tokens;
$row = $collection->findOne(array("email"=>$_GET['aid']));


$pdf = new FPDF();
$pdf->AddPage();


$pdf->Ln(5);
$pdf->SetX(70);
$pdf->SetY(30);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,"Application Blank - ".$row['full_name'],0,1,'C');

// $pdf->SetFont('Arial','B',12);
// #$image1 = $fullname['userphoto'];
// $image1 = "img.jpg";
// $pdf->Cell( 40, 40, $pdf->Image($image1, 165, 10, 35.78), 0, 0, 'R', false );

$pdf->SetFont('Arial','B',12);
$pdf->setFillColor(230,230,230);
$pdf->Ln(20);
$pdf->SetX(20); 
$pdf->Cell(150,7,'Full Name',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['full_name'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Present Address',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['address'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Contact Number',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['number'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12); 
$pdf->Cell(150,7,'Email ID',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['email'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12); 
$pdf->Cell(150,7,'Date Of Birth',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['dob'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Position applied for',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->Cell(150,7,$row['position'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Location',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['location'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Passport Availability',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['passport'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Highest Qualification',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['qualification'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12); 
$pdf->Cell(150,7,'Passing Out Year',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['passing'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Resource',0,1,'L',1);

if($row['internet']){
    $pdf->Ln(10);
    $pdf->SetX(20); 
    $pdf->SetFont('');
    $pdf->Cell(150,7,"Internet",0,1,'L');
}

if($row['checkemp']){
    $pdf->Ln(10);
    $pdf->SetX(20); 
    $pdf->SetFont('');
    $pdf->Cell(150,7,"Employee",0,1,'L');
}

if($row['walk']){
    $pdf->Ln(10);
    $pdf->SetX(20); 
    $pdf->SetFont('');
    $pdf->Cell(150,7,"WalkIn",0,1,'L');
}

if($row['web']){
    $pdf->Ln(10);
    $pdf->SetX(20);
    $pdf->SetFont(''); 
    $pdf->Cell(150,7,"Web",0,1,'L');
}

if($row['other']){
    $pdf->Ln(10);
    $pdf->SetX(20);
    $pdf->SetFont(''); 
    $pdf->Cell(150,7,$row['other'],0,1,'L');
}



$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,' Date Of joining',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['jdate'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Notice Peroid In current organization',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['notice'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Reporting Manager Name',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['manager'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Fathers Name',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['fathersname'],0,1,'L');


$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Date Of Birth',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['fdob'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Mothers Name',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['mother'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Date Of Birth',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['mdob'],0,1,'L');


if($row['spousename']){
$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Spouse Name',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['spousename'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Date Of Birth',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['spdob'],0,1,'L');

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Spouse Gender',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['sgender'],0,1,'L');
}

if($row['child1']){
$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Child 1 Name',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['child1'],0,1,'L');


$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Date Of Birth',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['ch1dob'],0,1,'L');


$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12); 
$pdf->Cell(150,7,'Gender',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['ch1gender'],0,1,'L');
}

if($row['child2']){
$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12); 
$pdf->Cell(150,7,'Child 2 Name',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont(''); 
$pdf->Cell(150,7,$row['child2'],0,1,'L');


$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Date Of Birth',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['ch2dob'],0,1,'L');


$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(150,7,'Gender',0,1,'L',1);

$pdf->Ln(10);
$pdf->SetX(20); 
$pdf->SetFont('');
$pdf->Cell(150,7,$row['ch2gender'],0,1,'L');
}




$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(75,7,'Monthly Take Home (Present)',0,0,'L',1);
$pdf->Cell(75,7,'Monthly Take Home (Expected)',0,0,'C',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('');
$pdf->Cell(100,10,$row['homepresent'],0,0,'L',0);
$pdf->Cell(100,10,$row['homeexpect'],0,0,'L',0);




$pdf->Ln(20);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(75,7,'Monthly Gross (Present) ',0,0,'L',1);
$pdf->Cell(75,7,'Monthly Gross (Expected) ',0,0,'C',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('');
$pdf->Cell(100,10,$row['grosspresent'],0,0,'L',0);
$pdf->Cell(100,10,$row['grossexpect'],0,0,'L',0);


$pdf->Ln(20);
$pdf->SetX(20);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(75,7,'Yearly Gross (Present) ',0,0,'L',1);
$pdf->Cell(75,7,'Yearly Gross  (Expected) ',0,0,'C',1);

$pdf->Ln(10);
$pdf->SetX(20);
$pdf->SetFont('');
$pdf->Cell(100,10,$row['ypresent'],0,0,'L',0);
$pdf->Cell(100,10,$row['yexpect'],0,0,'L',0);








// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,'Monthly Take Home (Present)',0,1,'L',1);

// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,$row['homepresent'],0,1,'L');


// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,'Monthly Take Home (Expected)',0,1,'L',1);

// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,$row['homeexpect'],0,1,'L');


// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,'Monthly Gross (Present) ',0,1,'L',1);

// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,$row['grosspresent'],0,1,'L');


// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,'Monthly Gross (Expected) ',0,1,'L',1);

// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,$row['grossexpect'],0,1,'L');

// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,'Yearly Gross (Present) ',0,1,'L',1);

// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,$row['ypresent'],0,1,'L');

// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,'Yearly Gross (Expected)',0,1,'L',1);

// $pdf->Ln(10);
// $pdf->SetX(20); 
// $pdf->Cell(150,7,$row['yexpect'],0,1,'L');

$pdf->Ln(10);
$refname=$row['refname'];
$refmail=$row['refmail'];
$refdsg=$row['refdsg'];
$refcontact=$row['refcontact'];
$refcn=$row['refcn'];
if($row['refname']){
for ($i = 0; $i < count($refname); $i++) {

    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetX(20);
    $pdf->Cell(75,7,'Reference Name',0,0,'L',1);
    $pdf->Cell(75,7,'Reference Mail',0,0,'C',1);
    $pdf->Ln(10);
    $pdf->SetX(20);
    $pdf->SetFont('');
    $pdf->Cell(100,10,$refname[$i],0,0,'L',0);
    $pdf->Cell(100,10,$refmail[$i],0,0,'L',0);

    $pdf->Ln(20);
    $pdf->SetX(20);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(75,7,'Reference Designation',0,0,'L',1);
    $pdf->Cell(75,7,'Reference Contact',0,0,'C',1);
    $pdf->Ln(10);
    $pdf->SetX(20);
    $pdf->SetFont('');
    $pdf->Cell(100,10,$refdsg[$i],0,0,'L',0);
    $pdf->Cell(100,10,$refcontact[$i],0,0,'L',0);

    $pdf->SetFont('Arial','B',12);
    $pdf->Ln(20);
    $pdf->SetX(20);
    $pdf->Cell(60,7,'Reference Company',0,0,'L',1);
    
    $pdf->Ln(10);
    $pdf->SetX(20);
    $pdf->SetFont('');
    $pdf->Cell(100,10,$refcn[$i],0,0,'L',0);
    $pdf->Ln(10);

    

    // $pdf->SetX(20); 
    // $pdf->Cell(150,7,'Reference Name',0,1,'L',1);

    // $pdf->Ln(10);
    // $pdf->SetX(20); 
    // $pdf->Cell(150,7,$refname[$i],0,1,'L');


    // $pdf->Ln(10);
    // $pdf->SetX(20); 
    // $pdf->Cell(150,7,'Reference Mail',0,1,'L',1);

    // $pdf->Ln(10);
    // $pdf->SetX(20); 
    // $pdf->Cell(150,7,$refmail[$i],0,1,'L');


    // $pdf->Ln(10);
    // $pdf->SetX(20); 
    // $pdf->Cell(150,7,'Reference Designation',0,1,'L',1);

    // $pdf->Ln(10);
    // $pdf->SetX(20); 
    // $pdf->Cell(150,7,$refdsg[$i],0,1,'L');


    // $pdf->Ln(10);
    // $pdf->SetX(20); 
    // $pdf->Cell(150,7,'Reference Contact',0,1,'L',1);

    // $pdf->Ln(10);
    // $pdf->SetX(20); 
    // $pdf->Cell(150,7,$refcontact[$i],0,1,'L');


    // $pdf->Ln(10);
    // $pdf->SetX(20); 
    // $pdf->Cell(150,7,'Reference Company',0,1,'L',1);

    // $pdf->Ln(10);
    // $pdf->SetX(20); 
    // $pdf->Cell(150,7,$refcn[$i],0,1,'L');


}
}




$managername=$row['managername'];
$managermail=$row['managermail'];
$fromdate=$row['fromdate'];
$todate=$row['todate'];
$orgname=$row['orgname'];
$olddesg=$row['olddesignation0'];

if($row['orgname'][0]){
    $pdf->Ln(10);
    $pdf->SetX(20); 
    $pdf->Cell(150,7,'Experience',0,1,'L',1);
for ($i = 0; $i < count($orgname); $i++) {

    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetX(20);
    $pdf->Cell(75,7,'Organisation Name',0,0,'L',1);
    $pdf->Cell(75,7,'Designation',0,0,'C',1);
    $pdf->Ln(10);

    $pdf->SetX(20);
    $pdf->SetFont('');
    $pdf->Cell(100,10,$orgname[$i],0,0,'L',0);
    $pdf->Cell(100,10,$olddesg[$i],0,0,'L',0);




    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetX(20);
    $pdf->Cell(75,7,'From Date',0,0,'L',1);
    $pdf->Cell(75,7,'To Date',0,0,'C',1);

    $pdf->Ln(10);
    $pdf->SetX(20);
    $pdf->SetFont('');
    $pdf->Cell(100,10,$fromdate[$i],0,0,'L',0);
    $pdf->Cell(100,10,$todate[$i],0,0,'L',0);




    
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetX(20);
    $pdf->Cell(75,7,'Manager Name',0,0,'L',1);
    $pdf->Cell(75,7,'Manager Email',0,0,'C',1);
    $pdf->Ln(10);

    $pdf->SetX(20);
    $pdf->SetFont('');
    $pdf->Cell(100,10,$managername[$i],0,0,'L',0);
    $pdf->Cell(100,10,$managermail[$i],0,0,'L',0);


 $pdf->Ln(10);

        // $pdf->Ln(10);
        // $pdf->SetX(20); 
        // $pdf->Cell(150,7,'Organisation Name',0,1,'L',1);

        // $pdf->Ln(10);
        // $pdf->SetX(20); 
        // $pdf->Cell(150,7,$orgname[$i],0,1,'L');

        // $pdf->Ln(10);
        // $pdf->SetX(20); 
        // $pdf->Cell(150,7,'Designation',0,1,'L',1);

        // $pdf->Ln(10);
        // $pdf->SetX(20); 
        // $pdf->Cell(150,7,$olddesg[$i],0,1,'L');

        // $pdf->Ln(10);
        // $pdf->SetX(20); 
        // $pdf->Cell(150,7,'From Date',0,1,'L',1);

        // $pdf->Ln(10);
        // $pdf->SetX(20); 
        // $pdf->Cell(150,7,$fromdate[$i],0,1,'L');

        // $pdf->Ln(10);
        // $pdf->SetX(20); 
        // $pdf->Cell(150,7,'To Date',0,1,'L',1);

        // $pdf->Ln(10);
        // $pdf->SetX(20); 
        // $pdf->Cell(150,7,$todate[$i],0,1,'L');

        $pdf->Ln(10);
        $pdf->SetX(20); 
        $pdf->Cell(150,7,'Manager Name',0,1,'L',1);

        $pdf->Ln(10);
        $pdf->SetX(20); 
        $pdf->Cell(150,7,$managername[$i],0,1,'L');


        $pdf->Ln(10);
        $pdf->SetX(20); 
        $pdf->Cell(150,7,'Manager Email',0,1,'L',1);

        $pdf->Ln(10);
        $pdf->SetX(20); 
        $pdf->Cell(150,7,$managermail[$i],0,1,'L');


}

}




$pdf->Ln(10);
$pdf->Output();
//$pdf->Output('D','Applicaton Blank-'.$row['full_name'].'.pdf');
?>