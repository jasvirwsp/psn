<?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");


//Check API Key
if(!$wsp_auth->check_access_token_m(safe_post("access_token"))){
    $status_array = array("message"=>"Sorry. Validation Error","code"=>"401");
    $status_array_response["Response"] = $status_array;
    $response["response"] = $status_array;           
    $final_json = json_encode($response);
    print_r($final_json);
    exit();
  }

$record_type = "branding";

if(isset($_POST["record_id"])){
if(is_array($_POST["record_id"])){
    //Multi Delete
    
    foreach($_POST["record_id"] as $record_id){
        $delete_controller = new records_delete_controller();
        $delete_controller->delete_record_with_record_id([$record_id,$record_type]);

    }


$status_array = array("status"=>"success","message"=>"Deletion Success");
$response["response"] = $status_array;    
$final_json = json_encode($response);
print_r($final_json);
}
else{
    //Single Delete
$delete_controller = new records_delete_controller();
$record_id = $_POST["record_id"];
//Hook
//before_delete_branding($_POST,$record_type);
//Hook
$delete_controller->delete_record_with_record_id([$record_id,$record_type]);


$status_array = array("status"=>"success","message"=>"Deletion Success","record_id"=>$record_id);
$response["response"] = $status_array;    
$final_json = json_encode($response);
print_r($final_json);
//Hook
//after_delete_branding($_POST,$response,$record_type);
//Hook
	
}
}else{
$response = array("status"=>"failure","message"=>"Validation Error");
$status_array = array("status"=>"failure","message"=>"Validation Error");
$response["response"] = $status_array;    
$final_json = json_encode($response);
print_r($final_json);

}
?>
