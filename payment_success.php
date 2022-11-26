<?php
ob_start();
include("wsp_rad/wsp_rad.inc.php");
include("libs/Instamojo.php");
if(safe_get("payment_request_id") == ""){
    exit();
}
//Sandbox
// $api = new Instamojo\Instamojo('test_67d120dd6b63a3e19ee9c7e3629', 'test_385be2d261e8766c7375835fc72','https://test.instamojo.com/api/1.1/');

$api = new Instamojo\Instamojo('4f3a754e502cfa0fed8b008d414d62e7', 'afec456b842d03d33ecb0bb0de74ead5','https://www.instamojo.com/api/1.1/');
try {
    $payment_request_id = safe_get("payment_request_id");
    $response = $api->paymentRequestStatus($payment_request_id);
    if($response["payments"][0]["status"] == "Credit"){

        $explode_purpose = explode("#",$response["purpose"]);
       $app_id = $explode_purpose[1];
               $application_details = get_rec_meta_by_rec_id("application",$app_id);
               $user_id = get_single_value($application_details,"application_user_id");
               $course_id = get_single_value($application_details,"application_course_id");
               $course_details = get_rec_meta_by_rec_id("course",$course_id);
               $college_id = get_single_value($course_details,"course_college_id");
               $college_details = get_rec_meta_by_rec_id("college",$college_id);
               $fee_amount = two_decimal(get_single_value($college_details,"college_application_fee"));
                $amount = $response["amount"];
                if(two_decimal($amount) == $fee_amount){
                    //update query of users application #start
$record_update_controller = new records_update_controller();
$record_type_users_application = "application";
$update_array_users_application = array(   
    "application_status"=>"Paid",   
   "date_updated"=>generate_mysql_timestamp()
                            );
$where_array_users_application = array("record_id"=>$app_id);
$update_record_users_application = $record_update_controller->update_record_with_new_values_and_where([$update_array_users_application,$where_array_users_application,$record_type_users_application]);
//update query of users  application #ends    

$message = urlencode("Thanks for submitting application. Your Application ID is #".$app_id);
    $p = file_get_contents("http://203.212.70.200/smpp/sendsms?username=penbox&password=penbox007&to=".get_single_value($application_details,"application_mobile")."&from=PENBOX&text=".$message); 

    $application_summary = get_record_summary("application",$app_id,["record_id","application_user_id"]);
    send_template_email("2",get_single_value($application_details,"application_email"),"Application Submitted","",["application_details"=>urldecode($message),"application_summary"=>$application_summary]);

    $message = urlencode("New Application Received. Application ID is #".$app_id);
    $pp = file_get_contents("http://203.212.70.200/smpp/sendsms?username=penbox&password=penbox007&to=8527038303&from=PENBOX&text=".$message);

    send_template_email("2","admin@pencilbox.live","New Application Submitted","",["application_details"=>urldecode($message),"application_summary"=>$application_summary]);

    header("Location:payment_success.php");
                }

    }
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}
ob_flush();
 ?>