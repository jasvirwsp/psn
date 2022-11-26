<?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");

$record_type = "file_upload";

if(isset($_POST["record_id"])){
if(is_array($_POST["record_id"])){
    //Multi Delete
    
    foreach($_POST["record_id"] as $record_id){
$file_details = get_rec_meta_by_rec_id("file_upload",$record_id);
$file_upload_identifier = get_single_value($file_details,"file_upload_file_name");
$delete_controller = new records_delete_controller();
$delete_controller->delete_record_with_record_id([$record_id,$record_type]);

//Physically delete the file 
unlink("../../uploads/".$file_upload_identifier);

    }

    $response = array("status"=>"success","message"=>"Deletion Success");
	$response = json_encode($response);
	print_r($response);
}
else{
    //Single Delete
$delete_controller = new records_delete_controller();
$record_id = $_POST["record_id"];
$file_details = get_rec_meta_by_rec_id("file_upload",$record_id);
$file_upload_identifier = get_single_value($file_details,"file_upload_file_name");
$delete_controller->delete_record_with_record_id([$record_id,$record_type]);



//Physically delete the file 
unlink("../../uploads/".$file_upload_identifier);

$response = array("status"=>"success","message"=>"Deletion Success","record_id"=>$record_id);
	$response = json_encode($response);
	print_r($response);
}
}else{
    $response = array("status"=>"failure","message"=>"Validation Error");
	$response = json_encode($response);
    print_r($response);
}
?>