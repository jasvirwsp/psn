<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
 include("../../wsp_rad/wsp_rad.inc.php");
 
//Input parameters from mobile
$api_key = safe_post("access_token");
if(!$wsp_auth->check_access_token_m(safe_post("access_token"))){
    $status_array = array("message"=>"Sorry. Validation Error","code"=>"401");
    $status_array_response["Response"] = $status_array;
    $response["response"] = $status_array;           
    $final_json = json_encode($response);
    print_r($final_json);
    exit();
  }

 if(isset($_POST["access_token"])){
    $login_details = array("access_token"=>$api_key);
    $check_user = $user_fetch_controller->fetch_user_with_where($login_details,["limit"=>1]);
    $user_id = get_single_value($check_user,"id");
    $count_user = count($check_user);
    if($count_user == 1){               

    $user_details = $check_user;
    $return_parameters = array("user","email","user_phone");

    $nest1 = array();
    foreach($return_parameters as $single_parameter){
        $nest1[$single_parameter] = get_single_value($user_details,$single_parameter) ?: "";
    }
    $response_array["user_detail"] = $nest1;
    $response = $response_array;
    $status_array = array("message"=>"success","code"=>"200");
    $status_array_response["Response"] = $status_array;
    $response["response"] = $status_array;    
    $final_json = json_encode($response);
    print_r($final_json);
        
    }else{
        $status_array = array("message"=>"Sorry. Login Details are Invalid.","code"=>"401");
                $status_array_response["Response"] = $status_array;
                $response["response"] = $status_array;                
                $final_json = json_encode($response);
                print_r($final_json);
    }
        }else{
            $status_array = array("message"=>"Sorry. Validation Error","code"=>"401");
            $status_array_response["Response"] = $status_array;
            $response["response"] = $status_array;           
            $final_json = json_encode($response);
            print_r($final_json);
        }
     ?>