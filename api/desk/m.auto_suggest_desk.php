<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");
$meta_name = safe_get("search_input_name");
$meta_value = safe_get("search_input_value");

$record_type = $meta_name;

if(strlen($meta_value) <= 3){
$response_array[$record_type] = array();
$response = json_encode($response_array);
print_r($response);
exit();
}


//This is return array. 
$return_array = array();

//Meta fields to search
$search_fields_array = array("");

//If to include record id in response. 
$return_record_id = true;

//Which fields to return in response separated by | .
$return_meta_name_array = array("");

//Pass thru custom functions
  //function dummy_column($single_column,$dynamic_value,$record_id,$data_array){    
  //   return "test ".$dynamic_value;
  // }
  //Pass thru custom functions
  
  

  
  //Pass thru custom functions
//Pass thru Function
function pass_thru($single_column,$dynamic_value,$record_id,$data_array){
  // Ex $allowed_columns = array("dummy_column");
  $allowed_columns = array();

  if(in_array($single_column,$allowed_columns)){  

    $return_value = $single_column($single_column,$dynamic_value,$record_id,$data_array);  
  
    return $return_value;
}
  }

foreach($search_fields_array as $single_field){

$where_array = array($single_field." LIKE ?"=>"%".$meta_value."%");
$options_array = array("limit"=>50,"orderBy"=>"record_id DESC");
$get_suggestions = $records_fetch_controller->fetch_record_with_where([$record_type,$where_array,$options_array]);

foreach($get_suggestions as $single_suggestion){   
    $this_return_value = array();
    if($return_record_id){
        $this_return_value["record_id"] = $single_suggestion["record_id"];
    }
    foreach($return_meta_name_array as $single_return){
    $this_return_value[$single_return] = pass_thru($single_return,$single_suggestion[$single_return],$single_suggestion["record_id"],$single_suggestion) ?: $single_suggestion[$single_return];        
}
    $return_array[] = $this_return_value;
}
}

$filter = $return_array;
$response_array[$record_type] = $filter;
$response = json_encode($response_array);
print_r($response);
?>
