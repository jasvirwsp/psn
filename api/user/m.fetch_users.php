<?php 
header("Access-Control-Allow-Origin: *");
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
}else{
  //Get User Details
//Where array
  $where_array_user = array("access_token"=>safe_get("access_token"));
  $results_user = $records_fetch_controller->fetch_record_with_where(["users",$where_array_user]);
  $count_results_user = count($results_user);
  $user_id = get_single_value($results_user,"id");
}

//Configurations
$record_type = "users";
$show_date_column = true;
$enable_export_tools = false;
//Search
$search_by_columns = "all"; //you can also put "all" or array.
$enable_date_filter = true;
//Columns
$columns_to_list = array("id","user","user_contact_no","user_address","email","user_name");  // You can set it to "all", array("meta_name","another_meta_name"), blank
$columns_to_exclude = array("");
//Records
$per_page = 100;
//Offset settings
if(isset($_GET["override_limit"])){
    $per_page = safe_get("override_limit");
}
$offset= 0;
$page= 1;
if(isset($_GET["page"])){
    $page = safe_get("page");
    if($page > 0){
        $offset = ($page-1) * $per_page;
    }
}
//Get record meta keys
$meta_keys_array_name = "meta_keys_of_".$record_type;
$meta_keys_array =  $$meta_keys_array_name;
//Initial records query 
$where_array = array("user_salesman"=>$user_id); // You can change it as per required
$options_array = array("orderBy"=>"id DESC","limit"=>$per_page,"offset"=>$offset);
//End Configurations
//Search By Columns
if($search_by_columns == "all"){
    $search_by_columns = $meta_keys_array;
    
}
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
//Check if search query is reqeusted
if(isset($_GET["search"])){
  $search_array = $_GET;
  $search_array = array_filter($search_array);
  //Unset other operators from search query
  unset($search_array["search"]);
  unset($search_array["limit"]);
  unset($search_array["offset"]);
  unset($search_array["order_by"]);
  unset($search_array["access_token"]);
  
  $search_operators = array();  //Example $search_operators = array("user_name"=>"LIKE","date_created"=>"BETWEEN");
  $nested_where = array();
  foreach($search_array as $single_search_column=>$single_search_value){
    
    if(array_key_exists($single_search_column,$search_operators)){
     
      if($search_operators[$single_search_column] == "LIKE"){
        $nested_where[$single_search_column." LIKE ?"] = "%".$search_array[$single_search_column]."%";
      }
      if($search_operators[$single_search_column] == "BETWEEN"){
        $explode_between = explode(",",$search_array[$single_search_column]);
        $between_start = $explode_between[0];
        $between_end = $explode_between[1];
        $nested_where[$single_search_column." BETWEEN ". $between_start ." AND ?"] = $between_end;
      }
      else{
        $nested_where[$single_search_column] = $search_array[$single_search_column];
      }
    }
  }
  
    $where_array = $nested_where;
    $options_array = array();
    if($search_by == "record_id"){
      $where_array = array("record_id"=>$search_keyword);
      $options_array = array("limit"=>1);
    }
    if(isset($_GET["search_start_date"]) && ($_GET["search_start_date"] != "")){        
        $start_date = safe_get("search_start_date");
        $end_date = safe_get("search_end_date");
        $options_array["between"] = "date(date_created),".$start_date.",".$end_date;
    }
}
//Check if orderby is passed
if(isset($_GET["order_by"])){
$order_by = explode(",",safe_get("order_by"));
$order_by_column = $order_by[0];
$order_by_type = $order_by[1];
$options_array["orderBy"] = $order_by_column . " " . upper_case($order_by_type);
}
//check if limit is passed
if(isset($_GET["limit"])){
  $get_limit = safe_get("limit");
  $options_array["limit"] = $get_limit;
}
//check if offset is passed
if(isset($_GET["offset"])){
  $get_offset = safe_get("offset");
  $options_array["offset"] = $get_offset;
}
$list_records = $records_fetch_controller->fetch_record_with_where([$record_type,$where_array,$options_array]);

//Pass thru custom functions
  //function dummy_column($single_column,$dynamic_value,$record_id,$data_array){    
  //   return "test ".$dynamic_value;
  // }
  

  
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
  
  //Pass thru Function
// Response
$response_array = array();
// Loop list records
$nest1 = array();
//Loop list records
foreach($list_records as $single_record){
    $record_id = $single_record["record_id"];    
   
    $metas_array = array();
    foreach($selected_columns as $single_column){
        if(in_array($single_column,$columns_to_exclude)){
            continue;
        }
$metas_array[$single_column] = pass_thru($single_column,$single_record[$single_column],$record_id,$single_record) ?: $single_record[$single_column];
}
$nest1[] = $metas_array;
}
$response_array["user"] = $nest1;
$response = json_encode($response_array);
print_r($response);
?>
