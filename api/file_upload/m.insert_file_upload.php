<?php
header("Access-Control-Allow-Origin: *");
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
  }else{
	//Where array
	$where_array_user = array("access_token"=>safe_post("access_token"));
	$results_user = $records_fetch_controller->fetch_record_with_where(["users",$where_array_user]);
	$count_results_user = count($results_user);
	$user_id = get_single_value($results_user,"id");
  }

  
//Validations
  //Check File Validations
//File extension check.
	$current_meta_name = safe_post("meta_key");

	//Allowed extensions , example : "person_docs" => array("jpg","jpeg","png","gif","docx","xlsx","pdf")
	$allowed_extensions = array(				
		

	);

$record_ids = array();

foreach($_FILES as $single_file){

$record_type = "file_upload";

	$file_extension =pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
	if(!in_array($file_extension,$allowed_extensions[$current_meta_name])){
	
		$response = array("status"=>"failure","errors"=>array("Invalid File Type or This file extension is not allowed"));
	$response = json_encode($response);
	print_r($response);
	exit();
	}
//File Size Check
$max_size = "20971500"; //20 MB
$max_size_h = "20 MB";
$file_size = filesize($_FILES["file"]["tmp_name"][$file_index]);
if($file_size > $max_size){
	$response = array("status"=>"failure","errors"=>array("File Size is greater than allowed. Max size is : ".$max_size_h));
	$response = json_encode($response);
	print_r($response);
	exit();
}
//Ends

//Meta name validations
// array("form_input_name"=>validations separated with |)
$user_input = array(
    
);
$pass_validation = new validations_check();
$has_errors = $pass_validation->pass_user_input($user_input,$record_type);

$test = json_decode($has_errors,true);

if($test["status"] == "failure"){
	print_r($has_errors);
	exit();
}


//Check if user exists and set its author
// session_start();
// if(isset($_SESSION["user_id"])){
// $author_id = $_SESSION["user_id"];
// $_POST[$record_type."_insert_author"] = $author_id;
// }else{
// 	$response = array("status"=>"failure","errors"=>array("No author/user configured. You can't perform insert operation without a valid user."));
// 	$response = json_encode($response);
// 	print_r($response);
// 	exit();
// }
$author_id = $user_id;
$_POST[$record_type."_insert_author"] = $author_id;
//Validation Ends

//Main Code
$record_controller = new records_insert_controller();

$record_type = "file_upload";
//upload file 
$_POST["file_upload_identifier"] = uniqid("upload_").rand(0,9999);
$initial_file_name = sanitize_input($_FILES["file"]["name"][$file_index]);
$file_name = $_POST["file_upload_identifier"] ."_". $_FILES["file"]["name"][$file_index];
$_POST["file_upload_file_name"] = $file_name;



move_uploaded_file($_FILES["file"]["tmp_name"][$file_index],"../../uploads/".$file_name);

//Add input name field value
$_POST["file_upload_input_name"] = $current_meta_name;

//timestamps
$timestamp = date('Y-m-d G:i:s');
$_POST["date_created"] = $timestamp;
//timestamps

//unset meta key
unset($_POST["meta_key"]);
//unset meta key


$insert_record = $record_controller->insert_record([$_POST,$record_type]);
$insert_id = $insert_record["record_id"];

$record_id = $insert_id;
array_push($record_ids,$record_id);
}

	$response = array("status"=>"success","message"=>"Insertion Success","record_id"=>implode(",",$record_ids));
	$response = json_encode($response);
	print_r($response);



?>
