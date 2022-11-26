<?php 
require ("../../wsp_rad/wsp_rad.inc.php");
header('Content-Type: application/json');

//Check API Key
if(!$wsp_auth->check_access_token_m(safe_get("access_token"))){
  $status_array = array("message"=>"Sorry. Validation Error","code"=>"401");
  $status_array_response["Response"] = $status_array;
  $response["response"] = $status_array;           
  $final_json = json_encode($response);
  print_r($final_json);
  exit();
}

//Configurations
$record_type = "branding";
//Columns
$columns_to_list = "all";  // You can set it to "all", array("meta_name","another_meta_name"), blank
$columns_to_exclude = array("");
//Get record meta keys
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array =  $$meta_keys_array_name;
//Initial records query 
$where_array = array(); // You can change it as per required
$options_array = array();
//End Configurations

        ?>
<?php
//set columns
$selected_columns = array($meta_keys_array[0],$meta_keys_array[1]); // if columns_to_list is blank select first two automatically
if($columns_to_list == "all"){
    $selected_columns = $meta_keys_array;
    array_push($selected_columns,"date_created","date_updated");
}
if(is_array($columns_to_list)){
    $selected_columns = $columns_to_list;    
}
?>
<?php 

$where_array = array("record_id"=>safe_get("record_id"));
$list_records = $records_fetch_controller->fetch_record_with_where([$record_type,$where_array,$options_array]);

//Pass thru custom functions

  //Pass thru custom functions
//Pass thru Function
function pass_thru($single_column,$dynamic_value,$record_id,$record_meta){
  $return_value = "";
  $dynamic_value_array = array(
      
    );
  if($dynamic_value_array[$single_column]){
    $return_value = $dynamic_value_array[$single_column];
  }
    return $return_value;
  }
  
  //Pass thru Function
// Response
$response_array = array();
// Loop list records

foreach($list_records as $single_record){
    $record_id = $single_record["record_id"];
    $record_meta = get_rec_meta_by_rec_id($record_type,$record_id);
   
    $metas_array = array();
    foreach($selected_columns as $single_column){
        if(in_array($single_column,$columns_to_exclude)){
            continue;
        }
$metas_array[$single_column] = pass_thru($single_column,$single_record[$single_column],$record_id,$record_meta) ?: $single_record[$single_column];
}

}
$response = json_encode($metas_array);
print_r($response);
?>
