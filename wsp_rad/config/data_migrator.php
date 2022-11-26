<?php

function beautify_array($array_to_beautify){

    echo "<pre>";
    print_r($array_to_beautify);
    echo "</pre>";
}

function get_meta_value($inputs_array,$primary_input){

    foreach($inputs_array as $key=>$value){

                foreach($inputs_array[$key] as $nested_key=>$nested_value){

                            if($nested_value == $primary_input){
                                $exact_input_array = $inputs_array[$key];
                                $single_value = $exact_input_array["meta_value"];
                                return $single_value;
                            }
                    }

    }


}

//Db 1
$mysql_db_hostname = "localhost";
$mysql_db_dbname = "rich_virsa_bhangra";
$mysql_db_username = "root";
$mysql_db_password = "";
//Db 2
$mysql_db_hostname = "localhost";
$mysql_db_dbname_1 = "rich_virsa_v10";
$mysql_db_username = "root";
$mysql_db_password = "";


require_once(__DIR__."/FluentPDO/FluentPDO.php");
$pdo = new PDO("mysql:dbname=$mysql_db_dbname;host:$mysql_db_hostname;","$mysql_db_username","$mysql_db_password");
$fpdo = new FluentPDO($pdo);

$pdo1 = new PDO("mysql:dbname=$mysql_db_dbname_1;host:$mysql_db_hostname;","$mysql_db_username","$mysql_db_password");
$fpdo1 = new FluentPDO($pdo1);

// $fpdo1->debug = function($BaseQuery) {
//     echo "query: " . $BaseQuery->getQuery(false) . "<br/>";
//     echo "parameters: " . implode(', ', $BaseQuery->getParameters()) . "<br/>";
    
// };


$table_to_move = "invoice";
$meta_keys_array = array('record_id','invoice_dancer_id','invoice_subscription_id','invoice_item','invoice_qty','invoice_amount','invoice_tax','invoice_status');

array_push($meta_keys_array,"date_created","date_updated");

$fetch_records = $fpdo->from($table_to_move)->where("record_type",$table_to_move)->fetchAll();
foreach($fetch_records as $single_record){
    $record_id = $single_record["record_id"];
    $date_created = $single_record["created_at"];
    $insert_array = array();
    $fetch_meta = $fpdo->from($table_to_move."_meta")->where("record_id",$record_id)->fetchAll();
    foreach($meta_keys_array as $single_key){
        if($single_key == "record_id"){
            $insert_array["record_id"] = $record_id;
            continue;            
        }
        if($single_key == "date_created"){
            $insert_array["date_created"] = $date_created;
            continue;            
        }
        if($single_key == "date_updated"){
            $insert_array["date_updated"] = $date_created;
            continue;            
        }

        $insert_array[$single_key] = get_meta_value($fetch_meta,$single_key) ?: '';
        
    }

//Insert to other table
$fpdo1->insertInto($table_to_move)->values($insert_array)->execute();

}

echo $table_to_move . " is migrated.";