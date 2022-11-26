<?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");

$record_type = "setting";

if(isset($_POST["record_id"])){
if(is_array($_POST["record_id"])){
    //Multi Delete
    
    foreach($_POST["record_id"] as $record_id){
        $delete_controller = new records_delete_controller();
        $delete_controller->delete_record_with_record_id([$record_id,$record_type]);
    }

    $response = array("status"=>"success","message"=>"Deletion Success");
	$response = json_encode($response);
	print_r($response);
}
else{
    //Single Delete
$delete_controller = new records_delete_controller();
$record_id = $_POST["record_id"];
$delete_controller->delete_record_with_record_id([$record_id,$record_type]);


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
