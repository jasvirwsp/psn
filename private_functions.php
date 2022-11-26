<?php
include("wsp_rad/wsp_rad.inc.php");

$function_to_call = safe_get("fn");

//#How to use : Create a function like snippet below, while making call to a function url will be like ?fn=your_function_name and GET Parameters like ?fn=do_this&param1=test . in the function you will have the access to parameters like param1 directly. 

// function function_name($parameters){
// return ""   ;
// }


if(isset($_GET["fn"])){
    $function = safe_get("fn");
    $return_value = $function($_GET);
    echo $return_value;
}
?>