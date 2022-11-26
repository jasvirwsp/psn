<?php
//header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");

//Check if user exists and set its author
session_start();
if(isset($_SESSION["user_id"])){
$author_id = $_SESSION["user_id"];
$_POST[$record_type."_insert_author"] = $author_id;
}else{
	$response = array("status"=>"failure","errors"=>array("No author/user configured. You can't perform insert operation without a valid user."));
	$response = json_encode($response);
	print_r($response);
	exit();
}

$record_type = "sms";
$record_controller = new records_insert_controller();
$records_fetch_controller = new records_fetch_controller();

$record_type_to_sync = array("person"=>"person_mobile");

foreach($record_type_to_sync as $single_record_type=>$meta_key){
    //Where array
    $where_array_rec_type = array($meta_key." != ?"=>"");
    $results_rec_type = $records_fetch_controller->fetch_record_with_where($single_record_type,$where_array_rec_type);
    
    foreach($results_rec_type as $single_contact){
       
        $sms_number = filter_number_for_sms($single_contact[$meta_key],"IN");
        $sms_group = $single_contact["person_category"];
        //Insert to SMS table
       //timestamps
        $timestamp = date('Y-m-d G:i:s');
        $date_created = $timestamp;
        $date_updated = $timestamp;
        //timestamps
        //Main Code
        $where_array = array("sms_number"=>$sms_number);	
		$check_unique = $records_fetch_controller->fetch_record_with_where($record_type,$where_array);
        $check_count = count($check_unique);
        if($check_count == 0){
            $insert_array = array("sms_number"=>$sms_number,"sms_status"=>"active","sms_group"=>$sms_group,"sms_insert_author"=>$author_id,"date_created"=>$date_created,"date_updated"=>$date_updated);
            $insert_record = $record_controller->insert_record($insert_array,$record_type);
         }
	
       
    }
    
    
}

	$response = array("status"=>"success","message"=>"Insertion Success");
	$response = json_encode($response);
	print_r($response);



?>
