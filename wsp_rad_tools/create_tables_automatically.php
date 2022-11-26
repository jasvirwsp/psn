<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<head>
	<meta charset="utf-8" />
	<title>Create Table</title>
  </head>
<?php

if(safe_get("do_it") == "yes"){
// Create table
                      $record_type = safe_get("record_type");
                      //$record_type = $record_type."_id";                      
                      $meta_keys_array = explode(",",safe_get("meta_keys"));;











//unset Record it
$key = array_search("record_id", $meta_keys_array);
unset($meta_keys_array[$key]);
array_push($meta_keys_array,"date_created","date_updated",$record_type."_insert_author");

                      $meta_names = "";
                      foreach($meta_keys_array as $single_key){
                        $meta_names = $meta_names . $single_key . " TEXT NOT NULL,";
                      };
                      $meta_names = trim($meta_names,",");
                      $sql = "CREATE table $record_type(record_id INT(255) AUTO_INCREMENT PRIMARY KEY,".$meta_names.")";
                      echo $sql;
                        $pdo->exec($sql);
?><br><br><br><br><br>
<a href="../wsp_rad/backup.php" style="color:grey" target="_blank"><h1>Create DB Export</h1></a>
<?php
                    }else{
                        echo "setup record type and meta arrays first. then in GET put do_it=yes";
                    }