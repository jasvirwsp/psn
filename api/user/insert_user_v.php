<?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");

$record_type = "user";



//Validations
// array("form_input_name"=>validations separated with |)
$user_input = array(	
    "user_name"=>"required",    
	"user"=>"required|unique_db_value_username|min=5|max=20",
	"password"=>"required|min=5|max=30",
	"email"=>"required|email|unique_db_value_email"
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
"password"
);
foreach($_POST as $parameter_key=>$parameter_value){

if(!in_array($parameter_key,$exclude_parameter_array)){
$post_parameter_array[$parameter_key] = "normal_safe_input";
}


//Check if its allowed meta_key
$meta_keys_array_name = "meta_keys_of_".$record_type;

if(!in_array($parameter_key,$$meta_keys_array_name)){
	$response = array("status"=>"failure","errors"=>array($parameter_key." is not a allowed meta"));
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
session_start();
if(isset($_SESSION["user_id"])){
$author_id = $_SESSION["user_id"];
}else{
	$author_id = 0;
}

//Validation Ends
//timestamps
$timestamp = date('Y-m-d G:i:s');
$_POST["date_created"] = $timestamp;
$_POST["date_updated"] = $timestamp;

//Main Code
//Encrypt the password 
$plain_password = $_POST["password"];
$_POST["plain_password"] = $plain_password;
$encrypted_password = password_hash($plain_password,PASSWORD_DEFAULT);
$_POST["password"] = $encrypted_password;
$_POST["user_author"] = $author_id;
$_POST["role"] = "user";
$_POST["user_status"] = "active";
unset($_POST["plain_password"]);
//Insert to db
//$insert_array = array("user"=>safe_post("user_username"),"user_author"=>$author_id,"password"=>$encrypted_password,"role"=>safe_post("user_role"),"user_name"=>safe_post("user_name"),"email"=>safe_post("user_email"),"user_status"=>safe_post("user_status"),"date_created"=>safe_post("date_created"),"date_created"=>safe_post("date_updated"));

//Hook
//before_insert_user($_POST,$record_type);
//Hook

$insert_user = $user_insert_controller->insert_user($_POST);
$insert_id = $insert_user["user_id"];
if($insert_id){

$response = array("status"=>"success","message"=>"Insertion Success","record_id"=>$insert_id);


//Hook
//after_insert_user($_POST,$response,$record_type);
//Hook
$response = json_encode($response);
print_r($response);

}
?>
