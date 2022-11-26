<?php
class wsp_auth{
	
	function do_login($login_details){
		global $users_table_name;
		global $fpdo;
		global $user_update_controller;
		global $cookie;
		
		//Check with username
		$query_1 = $fpdo->from("users")->where("user",$login_details["username"]);
		$query_1_count = $query_1->count();

		//Check with email
		$query_2 = $fpdo->from("users")->where("email",$login_details["username"]);
		$query_2_count = $query_2->count();

		
		if($query_1_count != 0){  //If username found
			session_start();
			$username = $login_details["username"];
			$password = $login_details["password"];
			$query_1_fetch = $query_1->fetch();
			$dbusername= $query_1_fetch["user"];
			$dbpassword = $query_1_fetch["password"];
			if($username==$dbusername && password_verify($password,$dbpassword)){
			$role = $query_1_fetch["role"];
			$permissions = $query_1_fetch["rights"];
			$user_id = $query_1_fetch["id"];
			$user_email = $query_1_fetch["email"];
			$username = $query_1_fetch["user"];
			$_SESSION["user_name"] = $username;
			$_SESSION["role"] = $role;
			$_SESSION["token"] = uniqid("wsp_").rand(22222,999999);
			$_SESSION["permissions"] = explode(",",$permissions);
			$_SESSION["user_id"] = $user_id;
			$_SESSION["user_email"] = $user_email;

			//Update users table
			$update_array = array("auth_token"=>$_SESSION["token"]);
			$where_array = array("id"=>$user_id);				
			$update_user = $user_update_controller->update_basic_details($update_array,$where_array);

			//Set Cookie
			$cookie->set("csrf",$_SESSION["token"]);

			return true;
			}
			
		}else if($query_2_count != 0){   //If email found
			session_start();
			$username = $login_details["username"];
			$password = $login_details["password"];
			$query_2_fetch = $query_2->fetch();
			$dbemail= $query_2_fetch["email"];
			$dbpassword = $query_2_fetch["password"];	

			if($username == $dbusername && password_verify($password,$dbpassword)){
			$role = $query_2_fetch["role"];
			$permissions = $query_2_fetch["rights"];
			$user_id = $query_2_fetch["id"];
			$user_email = $query_2_fetch["email"];
			$username = $query_2_fetch["user"];
			$_SESSION["user_name"] = $username;
			$_SESSION["role"] = $role;
			$_SESSION["token"] = uniqid("wsp_").rand(22222,999999);
			$_SESSION["permissions"] = explode(",",$permissions);
			$_SESSION["user_id"] = $user_id;
			$_SESSION["user_email"] = $user_email;

			//Update users table
			$update_array = array("auth_token"=>$_SESSION["token"]);
			$where_array = array("id"=>$user_id);
			$update_user = $user_update_controller->update_basic_details($update_array,$where_array);

			//Set Cookie
			$cookie->set("csrf",$_SESSION["token"]);

			return true;		
		
		}else{
			return false;
			}

	}
}

function do_m_login($login_details){
	global $users_table_name;
	global $fpdo;
	global $user_update_controller;
	global $cookie;
	
	//Check with username
	$query_1 = $fpdo->from("users")->where("user",$login_details["username"]);
	$query_1_count = $query_1->count();

	//Check with email
	$query_2 = $fpdo->from("users")->where("email",$login_details["username"]);
	$query_2_count = $query_2->count();
	
	
	if($query_1_count != 0){  //If username found
		
		$username = $login_details["username"];
		$password = $login_details["password"];
		$query_1_fetch = $query_1->fetch();
		$dbusername= $query_1_fetch["user"];
		$dbpassword = $query_1_fetch["password"];
		if($username==$dbusername && password_verify($password,$dbpassword)){
		$role = $query_1_fetch["role"];
		$permissions = $query_1_fetch["rights"];
		$user_id = $query_1_fetch["id"];
		$user_email = $query_1_fetch["email"];
		$username = $query_1_fetch["user"];		
		$login_auth_token = uniqid("wsp_").rand(22222,999999);
		$login_access_token = uniqid("wsp_").rand(22222,999999);

		//Update users table
		$update_array = array("auth_token"=>$login_auth_token,"access_token"=>$login_access_token);
		$where_array = array("id"=>$user_id);				
		$update_user = $user_update_controller->update_basic_details($update_array,$where_array);
		
		$response_array = array("message"=>"success","user_id"=>$user_id);

		return $response_array;
		}
		
	}else if($query_2_count != 0){   //If email found
		
		$username = $login_details["username"];		
		$password = $login_details["password"];		
		$query_2_fetch = $query_2->fetch();		
		$dbemail= $query_2_fetch["email"];		
		$dbpassword = $query_2_fetch["password"];	
		if($username == $dbemail && password_verify($password,$dbpassword)){
		
		$role = $query_2_fetch["role"];
		$permissions = $query_2_fetch["rights"];
		$user_id = $query_2_fetch["id"];
		$user_email = $query_2_fetch["email"];
		$username = $query_2_fetch["user"];
		$login_auth_token = uniqid("wsp_").rand(22222,999999);
		$login_access_token = uniqid("wsp_").rand(22222,999999);

		//Update users table
		$update_array = array("auth_token"=>$login_auth_token,"access_token"=>$login_access_token);
		$where_array = array("id"=>$user_id);				
		$update_user = $user_update_controller->update_basic_details($update_array,$where_array);

		$response_array = array("message"=>"success","user_id"=>$user_id);

		return $response_array;		
	
	}else{
		return false;
		}

}
}

function do_login_with_auth_token($auth_token){
	global $users_table_name;
	global $fpdo;
	global $user_update_controller;
	global $cookie;
	
	if($auth_token != ""){
	//Check with auth
	$query_1 = $fpdo->from($users_table_name)->where("auth_token",$auth_token);
	$query_1_count = $query_1->count();
	if($query_1_count != 0){  //If username found
		session_start();
		
		$query_1_fetch = $query_1->fetch();
		
		$role = $query_1_fetch["role"];
		$permissions = $query_1_fetch["rights"];
		$user_id = $query_1_fetch["id"];
		$user_email = $query_1_fetch["email"];
		$username = $query_1_fetch["user"];
		$_SESSION["user_name"] = $username;
		$_SESSION["role"] = $role;
		$_SESSION["token"] = uniqid("wsp_").rand(22222,999999);
		$_SESSION["permissions"] = explode(",",$permissions);
		$_SESSION["user_id"] = $user_id;
		$_SESSION["user_email"] = $user_email;

		//Update users table
		$update_array = array("auth_token"=>$_SESSION["token"]);
		$where_array = array("id"=>$user_id);
		$update_user = $user_update_controller->update_basic_details($update_array,$where_array);

		//Set Cookie
		$cookie->set("csrf",$_SESSION["token"]);

		return true;
		
		
	}else{
		return false;
		}
	}else{
		return false;
	}
}

function check_access_token_m($access_token){
	global $users_table_name;
	global $fpdo;	
	
	if($access_token != ""){		
	
		//Check with auth
		$query_1 = $fpdo->from($users_table_name)->where("access_token",$access_token);
		$query_1_count = $query_1->count();
	
		if($query_1_count != 0){  //If username found
			return true;
			
			
		}else{
			return false;
			}
		}else{	
			return false;
		}
}
	
	function do_signup(){}
	function do_logout(){
		session_start();
		session_destroy("username");
	}
	function do_forget($user_email){
		global $users_table_name;
		global $fpdo;
		global $wsp_mailer;
		

		//Check with email
		$query_2 = $fpdo->from("users")->where("email",$user_email);
		$query_2_count = $query_2->count();

		
		if($query_2_count != 0){  //If Email found
			$token = RandomNum(6);
			$values = array("reset_token"=>$token);
			$query = $fpdo->update("users")->set($values)->where("email",$user_email)->execute();
			$message = 'Hello , <br> You have requested a forgot password request . <br /><strong>Please copy and paste or fill the following code. <strong><br> <br> 
			<strong style="font-size:20px">'.$token.'</strong><br><br><br>Thanks';
			$send_mail = $wsp_mailer->send_mail($user_email,"Forgot Password Request",$message,"");
			if($send_mail){
				return true;
			}
		}
			

	}
	function do_reset($login_details){

		global $users_table_name;
		global $fpdo;
		global $wsp_mailer;
		

		//Check with email
		$query_2 = $fpdo->from("users")->where("reset_token",$login_details["reset_code"]);
		$query_2_count = $query_2->count();
		$query_2_fetch = $query_2->fetch();
		$user_email = $query_2_fetch["email"];
		
		if($query_2_count == 1){  //If Email found
			$encrypted_password = password_hash($login_details["new_password"],PASSWORD_DEFAULT);
			$values = array("password"=>$encrypted_password);
			$query = $fpdo->update("users")->set($values)->where("reset_token",$login_details["reset_code"])->execute();
			$message = 'Hello , <br> Your request for forgot password is successful.<br><br><br>Thanks';
			$send_mail = $wsp_mailer->send_mail($user_email,"Password Reset Successul",$message,"");
			if($send_mail){
				$values = array("reset_token"=>"");
				$query = $fpdo->update("users")->set($values)->where("reset_token",$login_details["reset_code"])->execute();
				return true;
			}
		}
			

	}

function do_check_auth(){
		global $wsp_auth;
		global $cookie;
	session_start();
	if(isset($_SESSION["token"])){
				return true;
	}else if(!is_array($cookie->get("csrf"))){
		if($wsp_auth->do_login_with_auth_token($cookie->get("csrf"))){   
			if(isset($_SESSION["token"])){
				return true;		
			}
			}else{		
				header("Location:login.php");
			}
	}else{
		header("Location:login.php");
	}
	}

	function do_check_auth_without_redirect($user_role){
		global $wsp_auth;
		global $cookie;
	session_start();
	if(isset($_SESSION["token"]) && $_SESSION["role"] == $user_role){
				return true;
	}else if(!is_array($cookie->get("csrf"))){
		if($wsp_auth->do_login_with_auth_token($cookie->get("csrf"))){   
			if(isset($_SESSION["token"]) && $_SESSION["role"] == $user_role){
				return true;		
			}
			}else{		
				return false;
			}
	}else{
		return false;
	}
	}

}
	
	
?>
