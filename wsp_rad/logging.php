<?php

if((isset($_GET) && !empty($_GET)) || (isset($_POST) && !empty($_POST)) ){

$current_file_url = $_SERVER['PHP_SELF'];
$request_type = "";

if(count($_POST) != 0){    
    $request_type = "POST";
    $post_parameter_string = "";
    foreach($_POST as $form_input_name => $form_input_value){
        $post_parameter_string  = $post_parameter_string . "&".$form_input_name. "=" . urlencode($form_input_value);
    }
}

if(count($_GET) != 0){
    $request_type = "GET";
    $get_parameter_string = "";
    foreach($_GET as $form_input_name => $form_input_value){
        $get_parameter_string  = $get_parameter_string . "&".$form_input_name. "=" . urlencode($form_input_value);
    }
}


if($request_type == "POST"){    
    $final_string = $current_file_url . ",".$request_type.",".trim($post_parameter_string,"&");
}
if($request_type == "GET"){
      $final_string = $current_file_url . ",".$request_type.",".trim($get_parameter_string,"&");
}



$today = date("Y-m-d");
$log_file = __DIR__."/logs/".$today.".rad";
if(file_exists($log_file)){

}else{
    file_put_contents($log_file,"");
}
$file_existing_contents = file_get_contents($log_file);

file_put_contents($log_file,$file_existing_contents .$final_string. "|||||");

}

?>