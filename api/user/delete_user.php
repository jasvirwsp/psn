<?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");

$record_type = "users";

//Permission Check
session_start();
check_record_ownership("delete",$_SESSION["user_id"], $_SESSION["role"], $record_type, safe_post("record_id"));
//Permission Check

if(isset($_POST["record_id"])){
if(is_array($_POST["record_id"])){
    //Multi Delete
    $record_insert_controller = new records_insert_controller(); 
    foreach($_POST["record_id"] as $record_id){
        
 //Create trash entry 
 $record_data = get_user_meta_with_user_id(safe_post("record_id"));
 $record_data = serialize($record_data[0]);
 $record_type_trash_del = "trash";
 $record_type_array_trash_del = array(
     "trash_record_type"=>$record_type,
     "trash_record_id"=>$record_id,
     "trash_record_data"=>$record_data,
     "date_created"=>generate_mysql_timestamp(),
     "date_updated"=>generate_mysql_timestamp(),
     "trash_insert_author"=>$_SESSION["user_id"]    
                             );
 $insert_record_trash_del = $record_insert_controller->insert_record([$record_type_array_trash_del,$record_type_trash_del]);
 $insert_id_trash_del = $insert_record_trash_del["record_id"];
 //Create trash entry  

        $delete_controller = new users_delete_controller();
$delete_controller->delete_user_with_user_id($record_id);


$delete_controller->delete_user_meta_with_user_id($record_id);
    }

    $response = array("status"=>"success","message"=>"Deletion Success");
	$response = json_encode($response);
	print_r($response);
}
else{
    //Single Delete
$delete_controller = new users_delete_controller();
$record_id = $_POST["record_id"];


//Create trash entry 
$record_data = get_user_meta_with_user_id(safe_post("record_id"));
$record_data = serialize($record_data[0]);
$record_insert_controller = new records_insert_controller();
$record_type_trash_del = "trash";
$record_type_array_trash_del = array(
    "trash_record_type"=>"users",
    "trash_record_id"=>safe_post("record_id"),
    "trash_record_data"=>$record_data,
    "date_created"=>generate_mysql_timestamp(),
    "date_updated"=>generate_mysql_timestamp(),
    "trash_insert_author"=>$_SESSION["user_id"]    
                            );
$insert_record_trash_del = $record_insert_controller->insert_record([$record_type_array_trash_del,$record_type_trash_del]);
$insert_id_trash_del = $insert_record_trash_del["record_id"];
//Create trash entry     

//Delete user
$delete_controller->delete_user_with_user_id($record_id);

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
