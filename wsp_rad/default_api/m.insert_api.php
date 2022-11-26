<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");


//Check API Key
if(!$wsp_auth->check_access_token_m(safe_post("access_token"))){
    $status_array = array("message"=>"Sorry. Authentication Failed","status"=>"failure");
    $status_array_response["Response"] = $status_array;
    $response["response"] = $status_array;           
    $final_json = json_encode($response);
    print_r($final_json);
    exit();
  }else{
      //Get User Details
	  //Where array
	  $where_array_user = array("access_token"=>safe_post("access_token"));
	  $results_user = $records_fetch_controller->fetch_record_with_where(["users",$where_array_user]);
	  $count_results_user = count($results_user);
	  $user_id = get_single_value($results_user,"id");
  }

$record_type = "entered_record_type";

//Validations
// array("form_input_name"=>validations separated with |)
$user_input = array(
	
);

//Select all matching post parameters
$regex_user_input = array("access_token"=>"");

$regex_input_array = array();
if($regex_user_input){
foreach($regex_user_input as $regex_input_name=>$regex_input_validations){
	$matching_inputs = preg_grep("/$regex_input_name/i",array_keys($_POST));
	foreach($matching_inputs as $meta_key_name){
		$regex_input_array[] = $meta_key_name;
		$user_input[$meta_key_name] = $regex_input_validations;
	}
}
}

$pass_validation = new validations_check();
$has_errors = $pass_validation->pass_user_input($user_input,$record_type);

$test = json_decode($has_errors,true);

if($test["status"] == "failure"){
	$has_errors = json_decode($has_errors, TRUE);
	$error_string = "";
	foreach($has_errors["errors"] as $single_error){
	  $error_string = $error_string . " " . $single_error;
	}
	$status_array = array("status"=>"failure","message"=>$has_errors["errors"][0],"code"=>"401");
	$response["response"] = $status_array;    
	$final_json = json_encode($response);
	print_r($final_json);
		exit();
}

//Pass all inputs against XSS and Sqli
$post_parameter_array = array();
// To exclude XSS and Sqli Protection on certain parameter.
$exclude_parameter_array = array(

);



//Get meta keys of record type
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array = $$meta_keys_array_name;
if($regex_input_array){
	$meta_keys_array = array_merge($meta_keys_array,$regex_input_array);
}

foreach($_POST as $parameter_key=>$parameter_value){

if(!in_array($parameter_key,$exclude_parameter_array)){
$post_parameter_array[$parameter_key] = "normal_safe_input";
}


//Check if its allowed meta_key

if(!in_array($parameter_key,$meta_keys_array)){
	$response = array("status"=>"failure","errors"=>array($parameter_key." is not a allowed meta"));
	$response["response"] = $response;
	$response = json_encode($response);
	print_r($response);
	exit();
}

}

$has_errors = $pass_validation->pass_user_input($post_parameter_array,$record_type);

$test = json_decode($has_errors,true);

if($test["status"] == "failure"){
	print_r($has_errors);
	exit();
}

//Check if user exists and set its author
$_POST[$record_type."_insert_author"] = $user_id;

//Validation Ends
//timestamps
$timestamp = date('Y-m-d G:i:s');
$_POST["date_created"] = $timestamp;
$_POST["date_updated"] = $timestamp;
//unset access token from post array

//timestamps
//Main Code
$record_controller = new records_insert_controller();
//Hook
//before_insert_entered_record_type($_POST,$record_type);
//Hook

//Get meta keys of record type and prepare insert_array for insertion
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array = $$meta_keys_array_name;
$insert_record_array = array("date_created"=>$_POST["date_created"],"date_updated"=>$_POST["date_updated"],$record_type."_insert_author"=>$_POST[$record_type."_insert_author"]);
foreach($meta_keys_array as $single_allowed_meta_key){
	if(isset($_POST[$single_allowed_meta_key])){
	$insert_record_array[$single_allowed_meta_key] = $_POST[$single_allowed_meta_key];
	}
}

$insert_record = $record_controller->insert_record([$insert_record_array,$record_type]);
$insert_id = $insert_record["record_id"];

$record_id = $insert_id;


	$response = array("status"=>"success","message"=>"Insertion Success","record_id"=>$insert_id);
	//Hook
	//after_insert_entered_record_type($_POST,$response,$record_type);
	//Hook
	$response_array["response"] = $response;
	$response_array = json_encode($response_array);
	print_r($response_array);



?>
