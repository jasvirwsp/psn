<?php
header("Access-Control-Allow-Origin: *");
	header('Content-Type: application/json');
	require("../../wsp_rad/wsp_rad.inc.php");

	# Autoload the required files
	require_once __DIR__ . '/vendor/autoload.php';

	# Set the default parameters
	$fb = new Facebook\Facebook([
	  'app_id' => '425157328187530',
	  'app_secret' => '6ae682141f17a5908cf559fdd152b3ac',
	  'default_graph_version' => 'v2.10',
	]);
	
	$fb_auth = $_POST['access_token'];
	
	$redirect = 'http://test.brocapture.com/include/fbapp/index.php';


	# Create the login helper object
	$helper = $fb->getRedirectLoginHelper();

	# Get the access token and catch the exceptions if any
	
	  $accessToken = $fb_auth;
	

	# If the 
	if (isset($accessToken)) {
	  	// Logged in!
	 	// Now you can redirect to another page and use the
  		// access token from $_SESSION['facebook_access_token'] 
  		// But we shall we the same page

		// Sets the default fallback access token so 
		// we don't have to pass it to each request
		$fb->setDefaultAccessToken($accessToken);
		
		  $response = $fb->get('/me?fields=email,name');		 
		  $userNode = $response->getGraphUser();
		


		$fb_name = $userNode->getProperty('name');
		$fb_id = $userNode->getProperty('id');
		$fb_email = $userNode->getProperty('email');
		$_SESSION['social_name'] = $fb_name;
		$_SESSION['social_id'] = $fb_id;
		$_SESSION['social_email'] = $fb_email;

		$login_details = array("email"=>$fb_email,"social_login"=>"1");
		$check_user = $user_fetch_controller->fetch_user_with_where($login_details,[limit=>1]);
		$count_user = count($check_user);
		if($count_user == 1){  
		$user_id = get_single_value($check_user,"id");

		$user_details = get_user_meta_with_user_id($user_id);
    $return_parameters = array("user","email","access_token");

    $nest1 = array();
    foreach($return_parameters as $single_parameter){
        $nest1[$single_parameter] = get_single_value($user_details,$single_parameter);
    }
    $response_array["login_detail"] = $nest1;
    $response = $response_array;
    $status_array = array("message"=>"success","code"=>"200");
    $status_array_response["Response"] = $status_array;
    $response["response"] = $status_array;    
    $final_json = json_encode($response);
    print_r($final_json);


		}else if($count_user == 0){
		//Set author as visitor
$author_id = 0;


//Validation Ends
//timestamps
$timestamp = date('Y-m-d G:i:s');
$_POST["date_created"] = $timestamp;
$_POST["date_updated"] = $timestamp;

//Main Code
//Encrypt the password 
$plain_password = $_POST["password"];
$encrypted_password = password_hash($plain_password,PASSWORD_DEFAULT);
$_POST["email"] = $fb_email;
$_POST["user_author"] = $author_id;
$_POST["user_name"] = $fb_name;
$_POST["social_login"] = "1";
$_POST["user"] = create_slug($fb_name);
$_POST["access_token"] = uniqid("wsp_").rand(22222,999999);
unset($_POST["authtoken"]);
//Insert to db

$insert_user = $user_insert_controller->insert_user($_POST);
$insert_id = $insert_user["user_id"];
if($insert_id){

	$user_details = get_user_meta_with_user_id($insert_id);
    $return_parameters = array("user","email","access_token");

    $nest1 = array();
    foreach($return_parameters as $single_parameter){
        $nest1[$single_parameter] = get_single_value($user_details,$single_parameter);
    }
    $response_array["login_detail"] = $nest1;
    $response = $response_array;
    $status_array = array("message"=>"success","code"=>"200");
    $status_array_response["Response"] = $status_array;
    $response["response"] = $status_array;    
    $final_json = json_encode($response);
    print_r($final_json);

}
}
	}else{
		$status_array = array("status"=>"failure","message"=>"Invalid Data Sent");
$response["response"] = $status_array;    
$final_json = json_encode($response);
print_r($final_json);
	}
	ob_flush();
	?>
