<?php

//Send SMS
if($_POST["mobile_numbers"] != ""){
	
	$mobile_no = implode(",",$_POST["mobile_numbers"]);
		
	$message = urlencode($_POST["sms_body"]);
	
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=5vP55oSwxki6bZzoDvdL2A&senderid=SMSTST&channel=2&DCS=0&flashsms=0&number=".$mobile_no."&text=".$message."&route=1",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => false,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_HTTPHEADER => array('Content-Length: 0'),
	CURLOPT_CUSTOMREQUEST => "POST",
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	echo "cURL Error #:" . $err;
	} else {
	echo $response;
	} 
	
	}

?>