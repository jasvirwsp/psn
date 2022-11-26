<?php

//Controllers Instances
$records_fetch_controller = new records_fetch_controller();
$array_resolver = new array_resolver_controller();
$wsp_auth = new wsp_auth();
$user_insert_controller = new users_insert_controller();
$user_fetch_controller = new users_fetch_controller();
$user_update_controller = new users_update_controller();
$wsp_mailer = new wsp_mailer();	
$cookie = new Cookie();
$cookie->setPrefix("wsp_");
// Faster accessibility functions

function search_array_with_where($array, $search_list) {
  
    // Create the result array
    $result = array();
  
    // Iterate over each array element
    foreach ($array as $key => $value) {
  
        // Iterate over each search condition
        foreach ($search_list as $k => $v) {
      
            // If the array element does not meet
            // the search condition then continue
            // to the next element
            if (!isset($value[$k]) || $value[$k] != $v)
            {
                  
                // Skip two loops
                continue 2;
            }
        }
      
        // Append array element's key to the
        //result array
        $result[] = $value;
    }
  
    // Return result 
    return $result;
}

function generate_mysql_timestamp(){
   $timestamp = date('Y-m-d G:i:s');
   return $timestamp;
}

function generate_color_from_string($string){
    return substr(md5($string), 0, 6);
}

function IND_money_format($number){
$amount = $number;
$formatter = new NumberFormatter('en_IN',  NumberFormatter::CURRENCY);
return $formatter->formatCurrency($amount, 'INR'). PHP_EOL;
}

function convert_to_base64($image_path){
    $path = $image_path;
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    return $base64;
}

function humanize_date($created_at){
    $only_date = date("d-m-Y",strtotime($created_at));
    return $only_date;
}

function beautify_date($timestamp,$style){
    if($timestamp == ""){
        return "-";
    }
    $beauty = date('d-m-Y', strtotime($timestamp));
    if($style=="beauty"){
    $beauty = date('j M, Y', strtotime($timestamp));
    }
    return $beauty;
}

function get_number_from_string($string){

    return preg_replace('/[^0-9]/', '', $string);
}
function get_current_month_last_date(){	
    return date("Y")."-".date("m")."-".date("t");	
}	
function get_current_month_start_date(){	
    return date("Y")."-".date("m")."-01";	
}	
function get_next_month_start_date(){	
    $d = date("Y-m-d", strtotime("first day of next month"));	
    return $d;	
}	
function get_next_month_last_date(){	
    $d = date("Y-m-d", strtotime("last day of next month"));	
    return $d;	
}	
function get_last_month_start_date(){	
    $d = date("Y-m-d", strtotime("first day of previous month"));	
    return $d;	
}	
function get_last_month_last_date(){	
    $d = date("Y-m-d", strtotime("last day of previous month"));	
    return $d;	
}

function get_original_file_name($complete_file_name){
    $original_name = explode("upload_",$complete_file_name);
    $original_name = $original_name[1];
    $original_name = explode("_",$original_name,2);
    $original_name = $original_name[1];
    return $original_name;
    }

function get_year_range_list($year_range){	
    $current_year = date("Y");	
$year_range = $year_range;	
$start_year = $current_year - $year_range;	
$end_year = $current_year + $year_range;	
$years_array = array();	
for($i=$start_year;$i<=$end_year;$i++){	
 array_push($years_array,$i);	
}	
return $years_array;	
}

function add_time_to_date($input_date,$type,$how_many,$output = "normal"){
    //type can be days, months, years. 
    //input date must be yyyy-mm-dd
    $change_date = date('Y-m-d', strtotime($input_date. ' + '.$how_many.' '. $type));
    if($output == "beauty"){
        $change_date = beautify_date($change_date,"beauty");
    }
    return $change_date;
}

function subtract_time_from_date($input_date,$type,$how_many,$output = "normal"){
    //type can be days, months, years. 
    //input date must be yyyy-mm-dd
    $change_date = date('Y-m-d', strtotime($input_date. ' - '.$how_many.' '. $type));
    if($output == "beauty"){
        $change_date = beautify_date($change_date,"beauty");
    }
    return $change_date;
}


function all_months(){
    $all_months = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
    return $all_months;
}

function all_week_days(){
    $all_days = array(1=>"Sunday",2=>"Monday",3=>"Tuesday",4=>"Wednesday",5=>"Thrusday",6=>"Friday",7=>"Saturday");
    return $all_days;
}

function get_today_date(){
    return date("Y-m-d");
}

function get_current_time(){
    return date("h:i a");
}

function get_ip_address(){
    return $_SERVER['REMOTE_ADDR'];
}

function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) {

    $dates = array();
    $current = strtotime( $first );
    $last = strtotime( $last );

    while( $current <= $last ) {

        $dates[] = date( $format, $current );
        $current = strtotime( $step, $current );
    }

    return $dates;
}

function get_timezone_welcome_message()
{
    $hour = date('H', time());
    $message = "Good Evening";

    if ($hour > 1 && $hour <= 11) {
        $message = "Good Morning";
    } else if ($hour > 11 && $hour <= 16) {
        $message =  "Good Afternoon";
    } else if ($hour > 16 && $hour <= 24) {
        $message = "Good Evening";
    }
    return $message;
}


function date_difference_in_days($first_date,$second_date,$method="second_minus_first"){
    $today = $first_date;
$today = strtotime($today);
//$now = time(); // or your date as well
$your_date = strtotime($second_date);


if($method == "first_minus_second"){
    $datediff = $today - $your_date;
}else if($method == "second_minus_first"){
    $datediff = $your_date - $today;
}else{
    $datediff = $today - $your_date;
}
return round($datediff / (60 * 60 * 24));
}

function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
  }

function beautify_array($array_to_beautify){

    echo "<pre>";
    print_r($array_to_beautify);
    echo "</pre>";
}

function filter_number_for_sms($mobile_number,$country){
    if($country == "IN"){

        if(strlen($mobile_number) == 10){
            return $mobile_number;
        }
        if(strlen($mobile_number) == 13){
            $mobile_number = substr($mobile_number,3,13);
            return $mobile_number;
        }
    }

}

function RandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function RandomNum($length) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function get_meta_value($mixed_array,$meta_name,$output_formatting){
    global $array_resolver;

    $return_meta_value = $array_resolver->get_meta_value($mixed_array,$meta_name);
    if(isset($output_formatting)){
        if($output_formatting == "title_case"){
            $return_meta_value = title_case($return_meta_value);
        }
        if($output_formatting == "upper_case"){
            $return_meta_value = upper_case($return_meta_value);
        }
        if($output_formatting == "lower_case"){
            $return_meta_value = lower_case($return_meta_value);
        }
        if($output_formatting == "kick_quotes"){
            $return_meta_value = str_replace("'","",$return_meta_value);
            $return_meta_value = str_replace('"','',$return_meta_value);            
        }
    }
    return $return_meta_value;
}

function get_single_value($mixed_array,$meta_name){
    return $mixed_array[0][$meta_name];
}


function get_value_with_id($data_string,$rec_id,$output_formatting){
    global $records_fetch_controller;
    $explode_data_string = explode(">",$data_string);
    $record_type = $explode_data_string[0];
    $meta_name = $record_type."_".$explode_data_string[1];
    $where_array = array("record_id"=>$rec_id);
    $fetch_rec_meta = $records_fetch_controller->fetch_record_single_column_with_where([$record_type,$where_array,[],$meta_name]);
    
    $return_meta_value = $fetch_rec_meta[$rec_id][$meta_name];

    if(isset($output_formatting)){
        if($output_formatting == "title_case"){
            $return_meta_value = title_case($return_meta_value);
        }
        if($output_formatting == "upper_case"){
            $return_meta_value = upper_case($return_meta_value);
        }
        if($output_formatting == "lower_case"){
            $return_meta_value = lower_case($return_meta_value);
        }
        if($output_formatting == "kick_quotes"){
            $return_meta_value = str_replace("'","",$return_meta_value);
            $return_meta_value = str_replace('"','',$return_meta_value);            
        }
    }
    return $return_meta_value;
}

function get_id_with_value($data_string,$meta_value){
    global $records_fetch_controller;
    $explode_data_string = explode(">",$data_string);
    $record_type = $explode_data_string[0];    
    $meta_name = $record_type."_".$explode_data_string[1];
    $where_array = array($meta_name=>$meta_value);
    $fetch_rec_meta = $records_fetch_controller->fetch_record_with_where([$record_type,$where_array]);
    return $fetch_rec_meta[0]["record_id"];
}

function get_first_child_meta_value($mixed_array,$meta_name){

    return $mixed_array[0][$meta_name];
}

function upper_case($string){
    $caps = strtoupper($string);
    return $caps;
}

function title_case($string){
    $titled = lower_case($string);
    $titled = ucwords($titled);
    return $titled;
}

function lower_case($string){
    $lowered = strtolower($string);
    return $lowered;
}

function create_slug($string){
    $zero = trim($string);
    $first = lower_case($zero);
    $second = str_replace(" ","_",$first);
    return $second;
}

function restrict_string($string,$limit){
    $restricted = substr($string,0,$limit);
    return $restricted;
}

function two_decimal($number){
    return number_format((float)$number, 2, '.', '');
}
function three_decimal($number){
    return number_format((float)$number, 3, '.', '');
}
function do_discount_subtract($percent,$total){
    $discount_amount = ($percent / 100) * $total;
    return $total - $discount_amount;
}

function get_discount_amount($percent,$total){
    $discount_amount = ($percent / 100) * $total;
    return $discount_amount;
}

function get_gst_inclusive_amount($total_amount,$gst_percentage){
    $return_gst_amount = $total_amount - ($total_amount * (100 / (100 + $gst_percentage)));
    return $return_gst_amount;
}

function explode_array($string_to_explode,$separator){

    
    $separate_array = explode($separator,$string_to_explode);
    $separate_array = array_filter($separate_array);
    
    return $separate_array;
    
    }
    
function explode_and_beautify_string($string_to_explode,$separator){
    
        $separate_array = explode($separator,$string_to_explode);
        $separate_array = array_filter($separate_array);
        $beautiful_string = "";
    
        foreach($separate_array as $single_value){
            $beautiful_string = $beautiful_string . ", " . $single_value;
        }
    
        return trim($beautiful_string,",");
    }


function get_today_records_by_where_array_and_created_at($where_array){
    global $records_fetch_controller;

    $options_array = array("between"=>"date(created_at),".date("Y-m-d").",".date("Y-m-d"));
    $get_records = $records_fetch_controller->fetch_record_with_where($where_array,$options_array);
    return $get_records;

}

function get_today_records_by_where_array_and_meta_key($where_array){
    global $records_fetch_controller;

    $options_array = array("between"=>"meta_value,".date("Y-m-d").",".date("Y-m-d"));
    $get_records = $records_fetch_controller->fetch_record_with_where($where_array,$options_array);
    return $get_records;

}

function get_this_month_records_by_where_array_and_created_at($where_array){
    global $records_fetch_controller;

    $options_array = array("between"=>"date(created_at),".date("Y-m-01").",".date("Y-m-d"));
    $get_records = $records_fetch_controller->fetch_record_with_where($where_array,$options_array);
    return $get_records;

}

// Faster accessibility ends

// Security Functions

function safe_get($parameter_name){
    $parameter_value = $_GET[$parameter_name];
    if(!preg_match('/[\'"^£$%&*}{~?><>|=+¬]/',$parameter_value)){
        return $parameter_value;
    }else{
        $validation_response = array("status"=>"failure","errors"=>"Invalid data passed.");
		$validation_response = json_encode($validation_response);
        print_r($validation_response);
        exit();
    }
   
}

function sanitize_input($parameter_value){    
    if(!preg_match('/[\'"^£$%&*}{~?><>|=+¬]/',$parameter_value)){
        return $parameter_value;
    }else{
        $validation_response = array("status"=>"failure","errors"=>"Invalid data passed.");
		$validation_response = json_encode($validation_response);
        print_r($validation_response);
        exit();
    }
   
}

function safe_get_strict($parameter_name){
    $parameter_value = $_GET[$parameter_name];
    if(!preg_match('/[\'"^£$%&*()}{#~?><>,|=_+¬-]/',$parameter_value)){
        return $parameter_value;
    }else{
        $validation_response = array("status"=>"failure","errors"=>"Invalid data passed.");
		$validation_response = json_encode($validation_response);
        return($validation_response);
        exit();
    }
   
}

function safe_post($parameter_name){
    $parameter_value = $_POST[$parameter_name];
    if(!preg_match('/[\'"^£$%&*}{?><>=+¬]/',$parameter_value)){
        return $parameter_value;
    }else{
        $validation_response = array("status"=>"failure","errors"=>"Invalid data passed.");
		$validation_response = json_encode($validation_response);
        print_r($validation_response);
        exit();
    }
   
}

function safe_post_strict($parameter_name){
    $parameter_value = $_POST[$parameter_name];
    if(!preg_match('/[\'"^£$%&*()}{#~?><>,|=_+¬-]/',$parameter_value)){
        return $parameter_value;
    }else{
        $validation_response = array("status"=>"failure","errors"=>"Invalid data passed.");
		$validation_response = json_encode($validation_response);
        return($validation_response);
        exit();
    }
   
}

function safe_request($parameter_name){
    $parameter_value = $_REQUEST[$parameter_name];
    if(!preg_match('/[\'"^£$%&*}{~?><>|=_+¬-]/',$parameter_value)){
        return $parameter_value;
    }else{
        $validation_response = array("status"=>"failure","errors"=>"Invalid data passed.");
		$validation_response = json_encode($validation_response);
        print_r($validation_response);
        exit();
    }
   
}

function safe_request_strict($parameter_name){
    $parameter_value = $_REQUEST[$parameter_name];
    if(!preg_match('/[\'"^£$%&*()}{#~?><>,|=_+¬-]/',$parameter_value)){
        return $parameter_value;
    }else{
        $validation_response = array("status"=>"failure","errors"=>"Invalid data passed.");
		$validation_response = json_encode($validation_response);
        return($validation_response);
        exit();
    }
   
}


// Security Functions Ends


// Errors and Logging functions
function enable_errors(){
    error_reporting(-1); // reports all errors
    ini_set("display_errors", "1"); // shows all errors
    ini_set("log_errors", 1);
    ini_set("error_log", "/tmp/php-error.log");
}

function disable_errors(){
    error_reporting(0);
}

// Errors and Logging functions Ends


function get_record_summary($record_type,$record_id,$exclude_array){
    $record_meta = get_rec_meta_by_rec_id($record_type,$record_id);
    $record_string = "";
    //Pass thru custom functions
  //function dummy_column($single_column,$dynamic_value,$record_id,$data_array){    
  //  if($dynamic_value){
    //Return Value
  //   return "test ".$dynamic_value; 
  // }
  //}

  
  //Pass thru custom functions
//Pass thru Function
function pass_thru($single_column,$dynamic_value,$record_id,$data_array){
    // Ex $allowed_columns = array("dummy_column");
    $allowed_columns = array();
  
    if(in_array($single_column,$allowed_columns)){  
  
      $return_value = $single_column($single_column,$dynamic_value,$record_id,$data_array);  
    
      return $return_value;
  }
    }
    //Pass thru Function


    foreach($record_meta[0] as $meta_key=>$meta_value){
        if($meta_value != "" && !in_array($meta_key,$exclude_array)){
        $meta_value = pass_thru($meta_key,$meta_value,$record_id,$record_meta) ?: $meta_value;
        $record_string .= beautify_meta_name_and_exclude_rec($meta_key) . " : " . $meta_value . "<br>";
        }
    }
    return $record_string;
}

// Meta functions
function get_rec_meta_by_rec_id($record_type,$rec_id){
    global $records_fetch_controller;
    
    $where_array = array("record_id"=>$rec_id);
    $fetch_rec_meta = $records_fetch_controller->fetch_record_with_where([$record_type,$where_array]);
    
    return $fetch_rec_meta;
}

// Used in records.insert.php
function check_meta_validation($column_name,$record_type){
    global ${"meta_keys_of_".$record_type};
    $meta_keys_array = ${"meta_keys_of_".$record_type};

    if(in_array($column_name,$meta_keys_array)){
return true;
    }else{
        return false;
    }
}

// Meta functions Ends
function beautify_meta_name($meta_name){
    $human_readable = ucwords(str_replace("_"," ",$meta_name));
    return $human_readable;
}

function beautify_meta_name_and_exclude_rec($meta_name){
    $exp_meta = explode("_",$meta_name);
    $record_type = $exp_meta[0]."_";
    $meta_name = str_replace($record_type,"",$meta_name);
    $human_readable = ucwords(str_replace("_"," ",$meta_name));
    return $human_readable;
}
// Records functions


function check_or_create_and_return_record_id($record_type,$check_where_array,$options_array,$create_record_array,$add_timestamp_for_insertion=true,$author_id="15"){
    global $records_fetch_controller;
   //fetch query of rec_type exist #start    
   $results_rec_type_exist = $records_fetch_controller->fetch_record_with_where([$record_type, $check_where_array, $options_array]);
   $count_results_rec_type_exist = count($results_rec_type_exist);
   if ($count_results_rec_type_exist == 1) {
      return get_single_value($results_rec_type_exist, "record_id");
   } else if ($count_results_rec_type_exist == 0) {
       //insert query of rec_type exist #start
       $record_insert_controller = new records_insert_controller();
       $record_type_rec_type_exist = $record_type;
       $record_type_array_rec_type_exist = $create_record_array;
       if($author_id){
           $create_record_array[$record_type."_insert_author"] = $author_id;
       }
       if($add_timestamp_for_insertion){
        $create_record_array["date_created"] = generate_mysql_timestamp();
        $create_record_array["date_updated"] = generate_mysql_timestamp();
       }      
       $insert_record_rec_type_exist = $record_insert_controller->insert_record([$record_type_array_rec_type_exist, $record_type_rec_type_exist]);
       $insert_id_rec_type_exist = $insert_record_rec_type_exist["record_id"];
       //insert query of rec_type  exist #ends    
      return $insert_id_rec_type_exist;
   }
   //fetch query of rec_type  exist #ends 
}

function check_and_return_record_id($record_type,$check_where_array,$options_array,$check_count=1){
    global $records_fetch_controller;
   //fetch query of rec_type exist #start    
   $results_rec_type_exist = $records_fetch_controller->fetch_record_with_where([$record_type, $check_where_array, $options_array]);
   $count_results_rec_type_exist = count($results_rec_type_exist);
   if ($count_results_rec_type_exist == $check_count) {
      return get_single_value($results_rec_type_exist, "record_id");
   } else{
       return false;
   }
   //fetch query of rec_type  exist #ends 
}

// Records functions Ends



//User functions

function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function curl_request_get($url, $parameters)
{

    $ch = curl_init();

    $url = $url;
    $dataArray = $parameters;

    $data = http_build_query($dataArray);

    $getUrl = $url . "?" . $data;

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $getUrl);
    curl_setopt($ch, CURLOPT_TIMEOUT, 80);

    $response = curl_exec($ch);

    if (curl_error($ch)) {
        echo 'Request Error:' . curl_error($ch);
    } else {
        return $response;
    }

    curl_close($ch);
}

function curl_request_post($url, $parameters)
{

    $ch = curl_init();
    $dataArray = $parameters;
    $data = http_build_query($dataArray);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        $data
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 80);

    $response = curl_exec($ch);

    if (curl_error($ch)) {
        echo 'Request Error:' . curl_error($ch);
    } else {
        return $response;
    }

    curl_close($ch);
}

function only_show_if_admin(){
    global $user_role;
    if($user_role != "admin"){
        echo "d-none";
    }
}

function only_show_if_user(){
    global $user_role;
    if($user_role != "user"){
        echo "d-none";
    }
}

function only_show_if_role($roles_array){
    global $user_role;    
    if(!in_array($user_role,$roles_array)){
        echo "d-none";
    }
}

function show_for_all_but_not($excluded_array){
    global $user_role;    
    if(in_array($user_role,$excluded_array)){
        echo "d-none";
    }
}

function get_user_meta_with_user_id($user_id){
    global $user_fetch_controller;
    $user_meta = $user_fetch_controller->fetch_user_meta_with_user_id($user_id);

    return $user_meta;
}

function get_user_meta_value_with_user_id($user_id,$meta_value){
    global $user_fetch_controller;
    $user_meta = $user_fetch_controller->fetch_user_meta_with_user_id($user_id);
    $return_value = get_single_value($user_meta,$meta_value);
    return $return_value;
}

function get_user_meta_with_where($where_array,$options_array){
    global $user_fetch_controller;
    $user_meta = $user_fetch_controller->fetch_user_with_where($where_array,$options_array);

    return $user_meta;
}

function check_web_auth_and_return_user_meta($auth_token){
    global $records_fetch_controller;
     //fetch query of users s #start
$where_array_users_s = array("auth_token"=>$auth_token,"role"=>"user");
$options_array_users_s = array();
$results_users_s = $records_fetch_controller->fetch_record_with_where(["users",$where_array_users_s,$options_array_users_s]);
$count_results_users_s = count($results_users_s);
//fetch query of users  s #ends    
if($count_results_users_s == 1){
return $results_users_s[0];
}else{
  return false;
}
}

function file_id_to_url($file_id){
    global $webapp_url;
    global $file_upload_directory;
    $rec_id_file = trim($file_id,",");
	$rec_meta_file = get_rec_meta_by_rec_id("file_upload",$rec_id_file);
    $file_name = get_single_value($rec_meta_file,"file_upload_file_name");
    if($file_name != ""){
    $file_url = $webapp_url.$file_upload_directory.$file_name; 
    return $file_url; 
}else{
    return $webapp_url.$file_upload_directory."sample.jpg";
}
}

function single_file_id_to_url($file_id){
    $file_ids = explode(",",$file_id);
    $url = "https://globalbandhan.com/auth/uploads/404.jpg";
    foreach($file_ids as $single_id){
      $file_meta = get_rec_meta_by_rec_id("file_upload",$single_id);
      $file_name = get_single_value($file_meta,"file_upload_file_name");      
      if(file_exists("uploads/".$file_name)){        
        $url = file_id_to_url($single_id);
      }else{
        continue;
      }
    }
    return $url;
}

function file_id_to_thumbnail($file_id,$width="100px",$height="100px",$rounded="rounded"){
    $image = '<img class="'.$rounded.'" src="'.file_id_to_url($file_id).'" style="width:'.$width.';height:'.$height.'">';
    return $image;
}

function file_id_to_file_path($file_id){
    global $webapp_url;
    global $file_upload_directory;
    $rec_id_file = ltrim($file_id,",");
	$rec_meta_file = get_rec_meta_by_rec_id("file_upload",$rec_id_file);
    $file_name = get_single_value($rec_meta_file,"file_upload_file_name");
    if($file_name != ""){
    $file_url = $file_upload_directory.$file_name; 
    return $file_url; 
}else{
    return $file_upload_directory."sample.jpg";
}
}


// Settings functions
function get_setting($setting_name){
    global $records_fetch_controller;

    $where_array_setting = array("setting_name"=>$setting_name);
    $results_setting = $records_fetch_controller->fetch_record_with_where(["setting",$where_array_setting]);
    $count_results_setting = count($results_setting);
    if($count_results_setting == 1){
    $setting_value = $results_setting[0]["setting_value"];
    return $setting_value;
    }else{
        return "Setting Not found";
    }
}

// Branding functions
function get_branding($branding_name){
    global $records_fetch_controller;
    global $file_upload_directory;
    $where_array_branding = array("branding_title != ?"=>"");
    $results_branding = $records_fetch_controller->fetch_record_with_where(["branding",$where_array_branding,["limit"=>1]]);
    $count_results_branding = count($results_branding);
    if($count_results_branding == 1){
    $branding_value = get_single_value($results_branding,$branding_name);
    if($branding_name == "branding_logo"){   
    $rec_id_file = $branding_value;
	$rec_meta_file = get_rec_meta_by_rec_id("file_upload",$rec_id_file);
    $file_name = get_single_value($rec_meta_file,"file_upload_file_name");
    if($file_name != ""){
      
    $file_url = $file_upload_directory.$file_name;
    
    if(file_exists($file_url)){       
        $branding_value = $file_url;
                        }
                    }
    }//end if branding logo
    return $branding_value;
    }else{
        return "Branding Not found";
    }
}


//Email functions
function getInbetweenStrings($start, $end, $str){
    $matches = array();
    $regex = "/$start([a-zA-Z0-9_]*)$end/";
    preg_match_all($regex, $str, $matches);
    return $matches[1];
}

function send_template_email($template_id,$recipent_email,$email_subject,$attachments,$replace_array){
    global $wsp_mailer;
    $template_meta = get_rec_meta_by_rec_id("template",$template_id);
    $template_message = get_single_value($template_meta,"template_mail_content");
    $get_array =$replace_array;
   
    $str_arr = getInbetweenStrings('{', '}', $template_message);

    $body_new = "";
    $content = $template_message;
    foreach ($str_arr as $key => $value) {
        $body_new =str_replace($value, $get_array[$value], $content);
        $content = $body_new;
    }
    $_final_content=str_replace("{", "", $content);
    $_final_content = str_replace("}", "", $_final_content);
    //urlencode($_final_content);
    if($email_subject == ""){
        $email_subject = get_single_value($template_meta,"template_mail_title");
    }
    if($attachments){
$wsp_mailer->send_mail($recipent_email,$email_subject,$_final_content,$attachments);
}else{
    $wsp_mailer->send_mail($recipent_email,$email_subject,$_final_content,"");
}
}


function check_record_type_ownership($user_role,$record_type){
    global $permissions;    
    if(!in_array($record_type,$permissions[$user_role."_record_types"]) && $user_role != "admin"){
        exit("Sorry,You don't have access.");
    }
}


function check_user_ownership($record_request_author,$user_role,$requested_user_id){
    global $permissions;    
    if($permissions["record_ownership"] == "personal" && $user_role != "admin"){
//Check if record author belongs to record
$user_meta = get_user_meta_with_user_id($requested_user_id);
$record_author = get_single_value($user_meta,"user_author");
if($record_author != $record_request_author){
exit("Sorry,You don't have access.");
}
    }
}

function check_record_ownership($operation,$record_request_author,$user_role,$record_type,$record_id){
    global $permissions;    
    if($permissions["record_ownership"] == "personal" && $user_role != "admin"){
//Check if operation is authorised
if(in_array($operation,$permissions[$user_role."_disabled_rights"][$record_type])){
    $response = array("status"=>"failure","errors"=>array("Sorry,You don't have access for this operation."));
	$response = json_encode($response);
	print_r($response);
    exit();
}

//Check if record author belongs to record
$record_author = get_value_with_id($record_type.">insert_author",$record_id,"");
if($record_author != $record_request_author){
    $response = array("status"=>"failure","errors"=>array("Sorry,You don't have access for this operation."));
	$response = json_encode($response);
	print_r($response);
    exit();
}
    }
}

function check_record_creation_right($operation,$user_role,$record_type){
    global $permissions;    
    if($permissions["record_ownership"] == "personal" && $user_role != "admin"){
//Check if operation is authorised
if(in_array($operation,$permissions[$user_role."_disabled_rights"][$record_type])){
    $response = array("status"=>"failure","errors"=>array("Sorry,You don't have access for this operation."));
	$response = json_encode($response);
	print_r($response);
    exit();
}
    }
}

//Permission functions
function check_permission($record_type,$user_role,$operation){
    global $permissions;
    global $excluded_record_types;
    global $wsp_auth;
    //Check user role
    if(isset($permissions[$user_role]) && $wsp_auth->do_check_auth()){
        
        if($permissions[$user_role] == "all"){ //If Admin
            
            return true;
        }else if($permissions[$user_role][$record_type] == "all"){ // if all permissions for record type
            return true;
        }else if(is_array($permissions[$user_role][$record_type])){
            
            //check operation allowance
            if(in_array($operation,$permissions[$user_role][$record_type])){
                return true;
            }else{                
                return false;
            }

        }else{ //Some misconfiguration
            return false;
        }
    }else{
return false;
    }
    //Check user role

}
//Permission functions

?>