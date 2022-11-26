<?php 
//API Hooks Dummies 
/*

//Function Starts
function before_insert_rec_type($insert_array,$record_type){

}
//Function Ends

//Function Starts
function after_insert_rec_type($insert_array,$response,$record_type){
    
}
//Function Ends

//Function Starts
function before_update_rec_type($insert_array,$where_array,$record_type){

}
//Function Ends

//Function Starts
function after_update_rec_type($insert_array,$response,$record_type){

}
//Function Ends

//Function Starts
function after_delete_rec_type($post_array,$response,$record_type){

}
//Function Ends

*/


//Function Starts
function after_insert_user($insert_array,$response,$record_type){
//     global $wsp_mailer;
//     if($insert_array["email"] != ""){
//     send_template_email("1",$insert_array["email"],"","",["person_name"=>title_case($insert_array["user_name"]),"person_username"=>$insert_array["user"],"person_password"=>$insert_array["plain_password"]]);
//     }

// if($insert_array["user_contact_no"] != ""){
//     $message = urlencode("Portal ,Username: ".$insert_array["user"]." Password: ".$insert_array["plain_password"]);
//     $curl = curl_init();
// 	curl_setopt_array($curl, array(
// 	CURLOPT_URL => "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=E8TdS9YXy0ed7hLrTc6Z1w&senderid=WSPKKP&channel=2&DCS=8&flashsms=0&number=91".$insert_array["user_contact_no"]."&text=".$message."&route=21", 
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_TIMEOUT => 0,
// 	CURLOPT_FOLLOWLOCATION => false,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_HTTPHEADER => array('Content-Length: 0'),
// 	CURLOPT_CUSTOMREQUEST => "POST",
// 	));
// 	// $response = curl_exec($curl);
// 	// $err = curl_error($curl);
//     // curl_close($curl);
// }
    

//update query of user s #start
$record_update_controller = new records_update_controller();
$record_type_user_s = "users";
$update_array_user_s = array(
    "user_author"=>$response["record_id"]
                            );
$where_array_user_s = array("id"=>$response["record_id"]);
$update_record_user_s = $record_update_controller->update_record_with_new_values_and_where([$update_array_user_s,$where_array_user_s,$record_type_user_s]);
//update query of user  s #ends    

}
//Function Ends

//Function Starts
function before_update_template($insert_array,$where_array,$record_type){
    $new_content = str_replace("<p>","<p style='font-size:11px;font-family: Arial, Helvetica, sans-serif;'>",$insert_array["template_mail_content"]);
    $new_content = str_replace('cellpadding="15"','cellpadding="0"',$new_content);
    $new_content = str_replace("width:600px","width:100%",$new_content);
    $_POST["template_mail_content"] = $new_content;
    }
    //Function Ends

    function before_insert_booking($insert_array,$record_type){

        $records_fetch_controller = new records_fetch_controller();

        $desk_id = $insert_array['booking_desk_id'];

        //fetch query of desk fetch #start
    $where_array_desk_fetch = array("record_id"=>$desk_id);
    $options_array_desk_fetch = array();
    $results_desk_fetch = $records_fetch_controller->fetch_record_with_where(["desk",$where_array_desk_fetch,$options_array_desk_fetch]);
    $count_results_desk_fetch = count($results_desk_fetch);
    //fetch query of desk  fetch #ends   

    $desk_time_slot = get_single_value($results_desk_fetch, 'desk_time');
    $desk_count = get_single_value($results_desk_fetch, 'desk_count');
    // = get_meta_value($results_desk_fetch, 'desk_time');

    //fetch query of booking fetch #start
    $where_array_booking_fetch = array("booking_desk_id"=>$desk_id);
    $options_array_booking_fetch = array();
    $results_booking_fetch = $records_fetch_controller->fetch_record_with_where(["booking",$where_array_booking_fetch,$options_array_booking_fetch]);
    $count_results_booking_fetch = count($results_booking_fetch);
//fetch query of booking  fetch #ends  

// check booked table count
if($count_results_booking_fetch >= $desk_count) {
    $resonse = ["status"=>"failure","errors"=>array("no table available!")];
    print_r(json_encode($resonse));
    exit();
}

// first table booking

if($count_results_booking_fetch == '0') {

    $start_time = "08:00";

    $_POST['booking_visit_time'] = $start_time;

} else {

    $options_array_booking_fetch = array('orderBy'=>"record_id DESC","limit"=>1);
    $results_booking_fetch = $records_fetch_controller->fetch_record_with_where(["booking",$where_array_booking_fetch,$options_array_booking_fetch]);
    $booking_visit_time = get_single_value($results_booking_fetch, 'booking_visit_time');

    get_single_value($results_booking_fetch, 'record_id');

    $newTime = date('H:i', strtotime($booking_visit_time. ' +'.$desk_time_slot.' minutes'));
  
    $_POST['booking_visit_time'] = $newTime;

}


        $_POST['booking_user_id'] = $insert_array['booking_insert_author'];

    }