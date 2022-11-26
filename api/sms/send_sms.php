<?php

function partition(Array $list, $p) {
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for($px = 0; $px < $p; $px ++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}

$message = urlencode($_POST["sms_body"]);
// Create an example array - ignore this line
$mobile_numbers = implode(",",$_POST["mobile_numbers"]);
$count = count($mobile_numbers);
//echo "Total :" . $count;

$sms_gateyway_limit = 95;

if($count > $sms_gateyway_limit){
    
$sms_gateyway_limit = 95;

$offset = $count/$limit;

$partitions = partition($example, $offset);
$chunks_array = array_filter($partitions);

foreach($chunks_array as $single_chunk){
    $chunk_numbers = implode(",",$single_chunk);

    $curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=md7FsyQtO0aHEMuxELiwFQ&senderid=ORIENT&channel=2&DCS=8&flashsms=0&number=".$chunk_numbers."&text=".$message."&route=1", 
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
	//echo "cURL Error #:" . $err;
	} else {
	echo $response;
	} 

}


}else{
$chunk_numbers = $mobile_numbers;
$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=md7FsyQtO0aHEMuxELiwFQ&senderid=ORIENT&channel=2&DCS=8&flashsms=0&number=".$chunk_numbers."&text=".$message."&route=1", 
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