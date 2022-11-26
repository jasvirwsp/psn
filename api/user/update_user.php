<?php
header('Content-Type: application/json');
include("../../wsp_rad/wsp_rad.inc.php");


$record_type = "users";

//Permission Check
session_start();
check_user_ownership($_SESSION["user_id"], $_SESSION["role"], safe_post("user_id"));
//Permission Check

//Validations
//Check if logged user is making request
$record_id = $_POST["user_id"];
session_start();

if($_SESSION["user_id"] != $record_id){
	if($_SESSION["role"] != "admin"){
	$response = array("status"=>"failure","errors"=>array("You are not authorized to make this change."));
	$response = json_encode($response);
	print_r($response);
	exit();
	}
}
// array("form_input_name"=>validations separated with |)
$user_input = array(
	"user_id"=>"required",
	"user"=>"required|unique_db_value_username_update|min=5|max=20",	
	"email"=>"required|email|unique_db_value_email_update"
);


//Select all matching post parameters
$regex_user_input = array();


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

//Check if user exists and set its author
session_start();
if(isset($_SESSION["user_id"])){
	$author_id = $_SESSION["user_id"];
}else{
	$response = array("status"=>"failure","errors"=>array("No author/user configured. You can't perform insert operation without a valid user."));
	$response = json_encode($response);
	print_r($response);
	exit();
}


//Validation Ends
//timestamps
$timestamp = date('Y-m-d G:i:s');
$_POST["date_updated"] = $timestamp;


$update_user_controller = new users_update_controller();


//Array Values Processing
$array_value_parameters = array();
foreach($array_value_parameters as $single_array_value_parameter){
	if(isset($_POST[$single_array_value_parameter])){
		if(is_array($_POST[$single_array_value_parameter])){
			$implode_array = implode(",",$_POST[$single_array_value_parameter]);
			$_POST[$single_array_value_parameter] = $implode_array;
		}
	}
}
//Array Values Processing

//Update to db
unset($_POST["user_id"]);
$where_array = array("id"=>$record_id);


//Hook
//before_update_user($_POST,$where_array,$record_type);
//Hook

$update_user = $update_user_controller->update_basic_details($_POST,$where_array);


$response = array("status"=>"success","message"=>"Update Success","record_id"=>$record_id);

//Hook
// after_update_user($_POST,$response,$record_type);
//Hook



$response = json_encode($response);
print_r($response);
?>
