<?php
include("header.php");
function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}

 
// Set path to CSV file
$csvFile = 'agritest.csv';
 $csv = readCSV($csvFile);
//Main Code
$record_insert_controller = new records_insert_controller();
$record_insert_controller = new records_insert_controller();
foreach($csv as $single_line)
{
    
    //beautify_array($single_line) . "<br>";
   
    if($single_line[0] == ""){
        continue;
    }

//insert query of dealer s #start

$record_type_dealer_s = "dealer";
$record_type_array_dealer_s = array(
    "dealer_name"=>$single_line[0],
    "dealer_type"=>"sanitary",
    "dealer_mobile_no"=>$single_line[1],
    "dealer_whatsapp_no"=>"",
    "dealer_email"=>"",
    "dealer_address"=>$single_line[2],
    "dealer_city"=>$single_line[3],
    "dealer_district"=>$single_line[7],
    "dealer_state"=>$single_line[8],
    "dealer_pin_code"=>"",
    "dealer_current_brand"=>"",
    "dealer_it_pan"=>$single_line[4],
    "dealer_photo"=>"",
    "dealer_identity_proof"=>"",
    "dealer_date_of_birth"=>"",
    "dealer_adhaar_no"=>$single_line[5],
    "dealer_date_of_marriage"=>"",
    "dealer_gst_no"=>$single_line[6],
    "dealer_firm_name"=>$single_line[0],
    "dealer_firm_type"=>"",
    "dealer_contact_person_name"=>"",
    "dealer_contact_person_no"=>"",
    "dealer_remarks"=>"",
    "dealer_lead_id"=>"",
    "date_created"=>generate_mysql_timestamp(),
    "date_updated"=>generate_mysql_timestamp(),
    "dealer_insert_author"=>"15"    
                            );
$insert_record_dealer_s = $record_insert_controller->insert_record([$record_type_array_dealer_s,$record_type_dealer_s]);
$insert_id_dealer_s = $insert_record_dealer_s["record_id"];
//insert query of dealer  s #ends    


echo $insert_id_dealer_s . "<br>";
}

echo "All Done bro";
?>