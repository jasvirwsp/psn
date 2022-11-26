<?php 
header("Access-Control-Allow-Origin: *");
require ("../../wsp_rad/wsp_rad.inc.php");
header('Content-Type: application/json');


//Check API Key
if(!$wsp_auth->check_access_token_m(safe_get("access_token"))){  
  $status_array = array("message"=>"Sorry. Authentication Error","status"=>"failure");
  $response["response"] = $status_array;           
  $final_json = json_encode($response);
  print_r($final_json);
  exit();
}else{
  //Get User Details
//Where array
  $where_array_user = array("access_token"=>safe_get("access_token"));
  $results_user = $records_fetch_controller->fetch_record_with_where(["users",$where_array_user]);
  $count_results_user = count($results_user);
  $user_id = get_single_value($results_user,"id");
  $role = get_single_value($results_user,"role");
}

$status_array = array("status"=>"success");


//To add something once auth is successul


//To add something once auth is successul

$response["response"] = $status_array;           
$final_json = json_encode($response);
print_r($final_json);

?>