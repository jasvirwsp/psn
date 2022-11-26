<?php 
include("wsp_rad/wsp_rad.inc.php");

$app_id = safe_get("application_id");

include("libs/Instamojo.php");
$purpose = "Application Fee #" . $app_id;

$application_details = get_rec_meta_by_rec_id("application",$app_id);
$user_id = get_single_value($application_details,"application_user_id");
$course_id = get_single_value($application_details,"application_course_id");
$course_details = get_rec_meta_by_rec_id("course",$course_id);
$college_id = get_single_value($course_details,"course_college_id");
$college_details = get_rec_meta_by_rec_id("college",$college_id);
$amount = get_single_value($college_details,"college_application_fee");

$user_email = get_single_value($application_details,"application_email");
$phone = get_single_value($user_details,"application_mobile");
$name = get_single_value($application_details,"application_first_name") . " " .get_single_value($application_details,"application_last_name");

//Sandbox
// $api = new Instamojo\Instamojo('test_67d120dd6b63a3e19ee9c7e3629', 'test_385be2d261e8766c7375835fc72','https://test.instamojo.com/api/1.1/');

$api = new Instamojo\Instamojo('4f3a754e502cfa0fed8b008d414d62e7', 'afec456b842d03d33ecb0bb0de74ead5','https://www.instamojo.com/api/1.1/');
try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $purpose,
        "amount" => $amount,
        "buyer_name" => $name,
        "phone" => $phone,
		"email" => $user_email,
        "send_email" => false,
        "send_sms" => false,
        'allow_repeated_payments' => false,
        "redirect_url" => "https://pencilbox.live/portal/payment_success.php",
        "webhook" => "https://pencilbox.live/portal/insta_webhook.php"
        ));
        //beautify_array($response);
  $pay_ulr = $response['longurl'];
   header("Location: $pay_ulr");
    exit();
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}     
 ?>