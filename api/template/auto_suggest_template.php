<?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");
$meta_name = safe_get("search_input_name");
$meta_value = safe_get("search_input_value");

$record_type = $meta_name;
//This is return array. 
$return_array = array();

//Meta fields to search
$search_fields_array = array("");

//If to include record id in response. 
$return_record_id = false;

//Which fields to return in response separated by | .
$return_meta_name_array = array("");

foreach($search_fields_array as $single_field){

$where_array = array($single_field." LIKE ?"=>"%".$meta_value."%");
$options_array = array("limit"=>20);
$get_suggestions = $records_fetch_controller->fetch_record_with_where([$record_type,$where_array,$options_array]);

foreach($get_suggestions as $single_suggestion){   
    $this_return_value = "";
    if($return_record_id){
        $this_return_value = $single_suggestion["record_id"];
    }
    foreach($return_meta_name_array as $single_return){
    
    $this_return_value = $this_return_value . " | ". $single_suggestion[$single_return];
}
    $return_array[] = ltrim($this_return_value," | ");
}
}

$filter = array_unique($return_array);
$response = json_encode($filter);
print_r($response);
?>
