<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
 include("../../wsp_rad/wsp_rad.inc.php");
 
//enable_errors();
if(isset($_POST["email"])){
//Input parameters from mobile
$user_email = $_POST["email"];
//Check with email
		$query_2 = $fpdo->from("users")->where("email",$user_email)->fetchAll();
        $query_2_count = count($query_2);       

		
        if($query_2_count != 0){  //If Email found
			$token = RandomNum(6);
            $values = array("reset_token"=>$token);
            $person_name = title_case(get_single_value($query_2,"user_name"));            
			$query = $fpdo->update("users")->set($values)->where("email",$user_email)->execute();
			$message = 'Hello , <br> You have requested a forgot password request . <br /><strong>Please copy and paste or fill the following code. <strong><br> <br> 
			<strong style="font-size:20px">'.$token.'</strong><br><br><br>Thanks';
            //$send_mail = $wsp_mailer->send_mail($user_email,"Forgot Password Request",$message,"");
            $send_mail = send_template_email(1,$user_email,"","",["person_name"=>$person_name,"reset_code"=>$token]);
			if($send_mail){
                				
                $nest1 = array("success"=>"true");
                $response_array["forgot_password"] = $nest1;
                $response = $response_array;
                $status_array = array("message"=>"success","code"=>"200");
                $status_array_response["Response"] = $status_array;
                $response["response"] = $status_array;                
                $final_json = json_encode($response);
                print_r($final_json);
			}
        }else{
                $status_array = array("message"=>"Sorry. User Email Not Found.","code"=>"401");
                $status_array_response["Response"] = $status_array;
                $response["response"] = $status_array;                
                $final_json = json_encode($response);
                print_r($final_json);
        }
    }

    if(isset($_POST["user_reset_code"])){
        $reset_code = safe_post("user_reset_code");
        $query_2 = $fpdo->from("users")->where("reset_token",$reset_code)->fetchAll();
        $query_2_count = count($query_2);  
        if($query_2_count != 0){  //If Email found
        $person_name = title_case(get_single_value($query_2,"user_name"));
        $person_email = get_single_value($query_2,"email");
        }
        $user_new_password = safe_post("password");
        $login_details = array("reset_code"=>$reset_code,"new_password"=>$user_new_password);
        if($wsp_auth->do_reset($login_details)){                       
        //    send_template_email(4,$person_email,"","",["person_name"=>$person_name]);
            $status_array = array("message"=>"success","code"=>"200","custom_message"=>"Password Reset Successful. You can login with new password now.");
            $status_array_response["Response"] = $status_array;
            $response["response"] = $status_array;                
            $final_json = json_encode($response);
            print_r($final_json);
            
            
        }else{
            $status_array = array("message"=>"failure","code"=>"401","custom_message"=>"Password Reset failed.");
            $status_array_response["Response"] = $status_array;
            $response["response"] = $status_array;                
            $final_json = json_encode($response);
            print_r($final_json);
        }
            }

    
        ?>