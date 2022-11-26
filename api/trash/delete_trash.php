<?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");

$record_type = "trash";

//Permission Check
session_start();
check_record_ownership("delete",$_SESSION["user_id"], $_SESSION["role"], $record_type, safe_post("record_id"));
//Permission Check

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
//Hook
//before_delete_trash($_POST,$record_type);
//Hook
$delete_controller->delete_record_with_record_id([$record_id,$record_type]);


$response = array("status"=>"success","message"=>"Deletion Success","record_id"=>$record_id);
//Hook
//after_delete_trash($_POST,$response,$record_type);
//Hook
	$response = json_encode($response);
	print_r($response);
}
}else{
    $response = array("status"=>"failure","message"=>"Validation Error");
	$response = json_encode($response);
    print_r($response);
}
?>
