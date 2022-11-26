<?php
//Get timezone list from timezone.list
//date_default_timezone_set("Asia/Calcutta");
ini_set('session.gc_maxlifetime', 2678400);


$staging = 1; // 0 for local/staging and 1 for production/live

$http_request_logging = 0; // 0 to disable and 1 to enable logging. 

$under_maintenance = 0; // 0 for working and 1 for maintenance notification.
$live = 1;  // 1 for working and 0 for down.

$display_error = 0; // 1 to enable
$log_error = 0; // 1 to enable
if($display_error == 0){
    error_reporting(0);
}
if($display_error == 1){
ini_set("display_errors", "1"); // shows all errors
error_reporting(-1); // reports all errors
}

if($log_error == 1){
error_reporting(-1); // reports all errors
ini_set("display_errors", "0"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "wsp_rad/logs/php-error.log");
error_log("Erros Below");
}


//Required for file uploads
$webapp_url = "http://localhost/rad_v13/";
$file_upload_directory = "uploads/";
if($staging == 1){
    $webapp_url = "https://wspclients.com/psn/";
    $file_upload_directory = "uploads/";
}


//Permissions
$permissions = array();
$permissions["record_ownership"] = "personal"; // Single Record Ownership only to the author
$permissions["ownership_excluded_record_types"]= array("branding","user","setting","file_upload");

//Admin Permissions
$permissions["admin_record_types"] = "all";
$permissions["admin_disabled_rights"] = array(
    // "rec_type"=>array("delete")
);

//User Permissions
$permissions["user_record_types"] = array("person"); //
$permissions["user_disabled_rights"] = array(
    // "rec_type"=>array("delete")    
);

//Permissions


//Mailer Configurations
//Host,username/email,password,method,port,sender_name,cc_email,reply_to_email,reply_to_email_name
$mailer_sandbox = array("smtp.gmail.com","wspkkptesting@gmail.com","qvugcgmveqbjdmys","tls",587,"WSP Test Account");

$mailer_live = array("smtp.gmail.com","wspkkptesting@gmail.com","qvugcgmveqbjdmys","tls",587,"WSP Test Account");

$mailer_additional = array("smtp.gmail.com","wspkkptesting@gmail.com","qvugcgmveqbjdmys","tls",587,"WSP Test Account");

?>