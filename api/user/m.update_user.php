<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include("../../wsp_rad/wsp_rad.inc.php");

$record_type = "users";
//Validations
//Check API Key
$api_key = safe_post("access_token");
if(!$wsp_auth->check_access_token_m(safe_post("access_token"))){
    $status_array = array("message"=>"Sorry. Validation Error","code"=>"401");
    $status_array_response["Response"] = $status_array;
    $response["response"] = $status_array;           
    $final_json = json_encode($response);
    print_r($final_json);
    exit();
  }

// array("form_input_name"=>validations separated with |)
$user_input = array(
	"access_token"=>"required",
	"user"=>"required|unique_db_value_username_update|min=5|max=20",	
  "email"=>"required|email|unique_db_value_email_update",
  "user_contact"=>"required|number"
);

//Get User Details 
$login_details = array("access_token"=>$api_key);
$check_user = $user_fetch_controller->fetch_user_with_where($login_details,["limit"=>1]);
$current_user = get_single_value($check_user,"user");
$current_email = get_single_value($check_user,"email");

//Check if any change in username
if($current_user == safe_post("user") && $current_email != safe_post("email")){

$user_input = array(
	"access_token"=>"required",
	"user"=>"required|min=5|max=20",	
  "email"=>"required|email|unique_db_value_email_update",
  "user_contact"=>"required|number"
);
}

//Check if any change in username
if($current_user != safe_post("user") && $current_email == safe_post("email")){

  $user_input = array(
    "access_token"=>"required",
    "user"=>"required|min=5|max=20",	
    "email"=>"required|email",
    "user_contact"=>"required|number"
  );
  }


//Check if any change in username and email
if($current_user == safe_post("user") && $current_email == safe_post("email")){
  // array("form_input_name"=>validations separated with |)
  $user_input = array(
    "access_token"=>"required",
    "user"=>"required|min=5|max=20",
    "email"=>"required|email",
    "user_contact"=>"required|number"
  );
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
$status_array = array("message"=>$error_string,"code"=>"401");
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

$update_user_controller = new users_update_controller();

//Main Code

//Update to db
unset($_POST["access_token"]);
$where_array = array("access_token"=>$api_key);

$update_user = $update_user_controller->update_basic_details($_POST,$where_array);


$status_array = array("message"=>"User Details Updated Successfully.","code"=>"200","custom_message"=>"User Details Updated Successfully.");
$status_array_response["Response"] = $status_array;
$response["response"] = $status_array;    
$final_json = json_encode($response);
print_r($final_json);
?>
