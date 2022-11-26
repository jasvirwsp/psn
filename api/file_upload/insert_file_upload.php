<?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");

$record_type = "file_upload";
//Validations

//Check File Validations
//File extension check.
	$current_meta_name = safe_post("meta_key");

	//Allowed extensions , example : "person_docs" => array("jpg","jpeg","png","gif","docx","xlsx","pdf")
	$allowed_extensions = array(		
		"branding_logo" => array("jpg","jpeg","JPG","JPEG","png","PNG","gif"),


	);
	$file_extension =pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
	if(!in_array($file_extension,$allowed_extensions[$current_meta_name])){
		$response = array("status"=>"failure","errors"=>array("Invalid File Type or This file extension is not allowed"));
	$response = json_encode($response);
	print_r($response);
	exit();
	}
//File Size Check
$max_size = "50971500"; //20 MB
$max_size_h = "50 MB";
$file_size = filesize($_FILES["file"]["tmp_name"]);
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
session_start();
if(isset($_SESSION["user_id"])){
$author_id = $_SESSION["user_id"];
$_POST[$record_type."_insert_author"] = $author_id;
}else{
	$response = array("status"=>"failure","errors"=>array("No author/user configured. You can't perform insert operation without a valid user."));
	$response = json_encode($response);
	print_r($response);
	exit();
}
//Validation Ends

//Main Code
$record_controller = new records_insert_controller();

$record_type = "file_upload";
//upload file 
$_POST["file_upload_identifier"] = uniqid("upload_").rand(0,9999);
$initial_file_name = sanitize_input($_FILES["file"]["name"]);
$file_name = $_POST["file_upload_identifier"] ."_". create_slug($_FILES["file"]["name"]);
$_POST["file_upload_file_name"] = $file_name;



move_uploaded_file($_FILES["file"]["tmp_name"],"../../uploads/".$file_name);

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


	$response = array("status"=>"success","message"=>"Insertion Success","record_id"=>$insert_id,"file_name"=>$initial_file_name,"file_upload_identifier"=>$file_name,);
	$response = json_encode($response);
	print_r($response);



?>
