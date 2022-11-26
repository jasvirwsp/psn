<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include("../../wsp_rad/wsp_rad.inc.php");
 
//Input parameters from mobile
$email = $_POST["username"];
$password = $_POST["password"];

//Convert to RAD inputs 
$_POST["user_username"] = lower_case($email);
$_POST["user_password"] = $password;

 if(isset($_POST["user_username"])){
    $login_details = array("username"=>safe_post("user_username"),"password"=>safe_post("user_password"));
    $do_login = $wsp_auth->do_m_login($login_details);
    
    if($do_login["message"] == "success"){               

    $user_details = get_user_meta_with_user_id($do_login["user_id"]);
    $return_parameters = array("user_name","email","access_token");

    $nest1 = array();
    foreach($return_parameters as $single_parameter){
        $nest1[$single_parameter] = get_single_value($user_details,$single_parameter);
    }
    $response_array["login_detail"] = $nest1;
    $response = $response_array;
    $status_array = array("status"=>"success","code"=>"200");
    $status_array_response["Response"] = $status_array;
    $response["response"] = $status_array;    
    $final_json = json_encode($response);
    print_r($final_json);
        
    }else{
        $status_array = array("status"=>"failure","message"=>"Sorry. Login details are Invalid.","code"=>"401");
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