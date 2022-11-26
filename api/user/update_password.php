<?php
header('Content-Type: application/json');
include("../../wsp_rad/wsp_rad.inc.php");

$record_type = "users";
//Validations
// array("form_input_name"=>validations separated with |)
$user_input = array(
	"user_id"=>"required",    
    "user_new_password"=>"required|min=5|max=60",
    "user_new_password_confirm"=>"required|min=5|max=60"
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
	"user_password",
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
	if($_POST["user_role"] == ""){
		$_POST["user_role"] = $_SESSION["role"];
	}
}else{
	$response = array("status"=>"failure","errors"=>array("No author/user configured. You can't perform insert operation without a valid user."));
	$response = json_encode($response);
	print_r($response);
	exit();
}

//Check if new password is same as confirm password
$new_password = $_POST["user_new_password"];
$confirm_password = $_POST["user_new_password_confirm"];

if($new_password != $confirm_password){
    $response = array("status"=>"failure","errors"=>array("New Password and Confirm Password doesn't match. Both should be same."));
	$response = json_encode($response);
	print_r($response);
	exit();
}

//Validation Ends

$record_id = safe_post("user_id");
$update_user_controller = new users_update_controller();


//Main Code
//Encrypt the password 
$plain_password = safe_post("user_new_password");

$encrypted_password = password_hash($plain_password,PASSWORD_DEFAULT);
//Update to db
$update_array = array("password"=>$encrypted_password);
$where_array = array("id"=>$record_id);
$update_user = $update_user_controller->update_basic_details($update_array,$where_array);

$response = array("status"=>"success","message"=>"Update Success","record_id"=>$record_id);
	$response = json_encode($response);
    print_r($response);
    
?>
