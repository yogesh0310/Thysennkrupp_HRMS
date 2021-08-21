<?PHP
// error_reporting(0);
function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle,2024);
    }
    fclose($file_handle);
    return $line_of_text;
}

if(isset($_FILES))
{
    include 'api/db.php';
    include 'api/maildetails.php';
    $mail->setFrom('thyssenkrupp@tkep.com', 'tkei');
    $mail->addReplyTo(Email, 'Information');
    $mail->isHTML(true);

    $ctr = 0;
    // Set path to CSV file
    // $csvFile = 'test.csv';
    $csvFile = $_FILES['uploadcsv']['name'];
    $ctemp = $_FILES["uploadcsv"]['tmp_name'];
    move_uploaded_file($ctemp,"PRFDumps/".$csvFile);
    $csvFile = "PRFDumps/".$csvFile;

    // $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
    // $uid="";
    // if($cursor){
    //     foreach($cursor as $key=>$val){
    //         if($key=='uid'){
    //             $uid=$val;
    //         }
    //     }
    // }

    $csv = readCSV($csvFile);
    // echo "<script>alert(".count($csv[0]).")</script>";
    
    $ctr = 0;
    if(count($csv[0]) == 29)
    {
        for($i = 1; $i < count($csv); $i++)
        {
            if($csv[$i][28])
            {
               
                


                $val = array(              
                        "designation"       => $csv[$i][0]  ? $csv[$i][0]  :"null",
                        "region"           => $csv[$i][1]  ? $csv[$i][1]  :"null",
                        "department"   => $csv[$i][2]  ? $csv[$i][2]  :"null",
                        "mailid"         => $csv[$i][3]  ? $csv[$i][3]  :"null",
                        "username"          => $csv[$i][4]  ? $csv[$i][4]  :"null",
                        "password"    => $csv[$i][5]  ? $csv[$i][5]  :"null",
                ); 
                        // $result = $db->prfs->updateOne(
                        //     array("prf" => $csv[$i][0]),
                        //     array('$setOnInsert'=>$val),
                        //     array("upsert"=>true)
                        // );

                        
                        // $date = date_default_timezone_set('Asia/Kolkata');
            
                        // $today = date("Y-m-d H-i-s");

                        // $db->generalized->insertOne(array("prf"=>$csv[$i][0],"uid"=>$uid,"init_time"=>"NA","comp_time"=>"NA","assign_time"=>"NA","accepted_time"=>"NA","creation_time"=>$today,"status"=>"avail","totalinstance"=>0));
        
                echo json_encode([$val]);
            
            }}}
            
            
            
        // }
        // $countInstances = $db->prfs->count(array("status"=>"open"));
        // $new = $countInstances - $ctr;
        // echo $new;
}
else

{
    echo "No";
}


?>

      