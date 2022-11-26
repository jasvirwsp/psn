<?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");

$record_type = "file_upload";
//Validations
// array("form_input_name"=>validations separated with |)
$user_input = array(
    "file_upload_identifier"=>"required",
    // "allowed_extensions"=>"jpg,jpeg,png,gif,docx,xlsx,pdf",
    // "file_size"=>"20000"
);
$pass_validation = new validations_check();
$has_errors = $pass_validation->pass_user_input($user_input,$record_type);

$test = json_decode($has_errors,true);

if($test["status"] == "failure"){
	print_r($has_errors);
	exit();
}
//Validation Ends

//Main Code
$record_controller = new records_insert_controller();

$record_type = "file_upload";

//upload file 
$file_name = $_POST["file_upload_identifier"] ."_". $_FILES["file"]["name"];

move_uploaded_file($_FILES["file"]["tmp_name"],"../../uploads/".$file_name);


$_POST["file_upload_file_name"] = $file_name;

$insert_record = $record_controller->insert_record(array("record_type"=>$record_type));
$insert_id = $insert_record["record_id"];

$record_id = $insert_id;

//Insert Query
foreach($_POST as $form_input_name => $form_input_value){
	// Insert Array
	
	if(is_array($form_input_value)){
		$form_input_value = implode(",",$form_input_value);
	}

	$insert_array = array(
	"record_id"=>$record_id,
	"meta_name"=>$form_input_name,
	"meta_value"=>$form_input_value
	);

	$insert_meta = $meta_controller->insert_meta($insert_array);

}


	$response = array("status"=>"success","message"=>"Insertion Success","record_id"=>$insert_id);
	$response = json_encode($response);
	print_r($response);



?>
