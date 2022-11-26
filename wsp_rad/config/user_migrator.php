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


$table_to_move = "users";
$meta_keys_array = array("user_name","user_status");

array_push($meta_keys_array,"date_created","date_updated");

$fetch_records = $fpdo->from($table_to_move)->where("id != ?","")->fetchAll();


foreach($fetch_records as $single_record){
    $record_id = $single_record["id"];
    $date_created = $single_record["created_at"];
    $insert_array = array();
    $fetch_meta = $fpdo->from($table_to_move."_meta")->where("user_id",$record_id)->fetchAll();
    
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

    beautify_array($insert_array);
// //Insert to other table
$where_array = array("id"=>$record_id);
$execute = $fpdo1->update($table_to_move)->set($insert_array)->where($where_array)->execute();
if($execute){
    echo "Success ";
}
// beautify_array($insert_array);
// beautify_array($where_array);
}

echo $table_to_move . " is migrated.";