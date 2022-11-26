<?php
header('Content-Type: application/json');
include("../../wsp_rad/wsp_rad.inc.php");


//Check API Key
if(!$wsp_auth->check_access_token_m(safe_post("access_token"))){
    $status_array = array("message"=>"Sorry. Validation Error","code"=>"401");
    $status_array_response["Response"] = $status_array;
    $response["response"] = $status_array;           
    $final_json = json_encode($response);
    print_r($final_json);
    exit();
  }else{
	//Get User Details
	//Where array
  //   $where_array_user = array("access_token"=>safe_post("access_token"));
  //   $results_user = $records_fetch_controller->fetch_record_with_where(["users",$where_array_user]);
  //   $count_results_user = count($results_user);
  //   $user_id = get_single_value($results_user,"id");
}

$record_type = "district";

//Validations
// array("form_input_name"=>validations separated with |)
$user_input = array(
	"record_id"=>"required"
);
$pass_validation = new validations_check();
$has_errors = $pass_validation->pass_user_input($user_input,$record_type);

$test = json_decode($has_errors,true);

if($test["status"] == "failure"){
	print_r($has_errors);
	exit();
}

//Pass all inputs against XSS and Sqli
$post_parameter_array = array();
// To exclude XSS and Sqli Protection on certain parameter.
$exclude_parameter_array = array(

);
foreach($_POST as $parameter_key=>$parameter_value){

if(!in_array($parameter_key,$exclude_parameter_array)){
$post_parameter_array[$parameter_key] = "normal_safe_input";
}

}

$has_errors = $pass_validation->pass_user_input($post_parameter_array,$record_type);

$test = json_decode($has_errors,true);

if($test["status"] == "failure"){
	print_r($has_errors);
	exit();
}
//Validation Ends
//timestamps
$timestamp = date('Y-m-d G:i:s');
$_POST["date_updated"] = $timestamp;
//timestamps

$record_id = $_POST["record_id"];
$update_record = new records_update_controller();
//remove record id from $_POST
unset($_POST["record_id"]);

	$where_array = array(
	"record_id"=>$record_id
	);
//Hook
//before_update_district($_POST,$where_array,$record_type);
//Hook
	//Get meta keys of record type and prepare update_array for updating
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array = $$meta_keys_array_name;
//unset record_id key
unset($meta_keys_array[0]);
$update_record_array = array("date_updated"=>$_POST["date_updated"]);
foreach($meta_keys_array as $single_allowed_meta_key){
	if(isset($_POST[$single_allowed_meta_key])){
	$update_record_array[$single_allowed_meta_key] = $_POST[$single_allowed_meta_key];
	}
}

$update_record->update_record_with_new_values_and_where([$update_record_array,$where_array,$record_type]);

	
$status_array = array("status"=>"success","message"=>"Update Success","record_id"=>$record_id);
$response["response"] = $status_array;    
$final_json = json_encode($response);
print_r($final_json);
//Hook
//after_update_district($_POST,$response,$record_type);
//Hook
	
?>
