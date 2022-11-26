<?php
include("wsp_rad/wsp_rad.inc.php");

$function_to_call = safe_get("fn");

function add_years_to_date($parameters){
$ini_date = $parameters["ini_date"];
$how_many = $parameters["how_many"];
$response = date('Y-m-d', strtotime($ini_date. ' + '.$how_many.' years'));
return $response;
}

function add_days_to_date($parameters){
    $ini_date = $parameters["ini_date"];
    $how_many = $parameters["how_many"];
    $response = date('Y-m-d', strtotime($ini_date. ' + '.$how_many.' days'));
    return $response;
    }

if(isset($_GET["fn"])){
    $function = safe_get("fn");
    $return_value = $function($_GET);
    echo $return_value;
}
?>