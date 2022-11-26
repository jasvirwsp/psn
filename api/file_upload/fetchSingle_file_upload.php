<?php
header('Content-Type: application/json');
require("../../wsp_rad/wsp_rad.inc.php");

$record_id = $_POST["record_id"];
$record_type = ""; //Edit Me
$fetch_meta = new meta_fetch_controller();
$array_controller = new array_resolver_controller();
$all_meta = $fetch_meta->fetch_all_meta_with_record_id_and_related_meta_name($record_id,$record_type);

$return_meta = array();
foreach($all_meta as $single_meta){
	$return_meta[$single_meta["meta_name"]] = $single_meta["meta_value"];
}

$encoded = json_encode($return_meta);
print_r($encoded);
?>