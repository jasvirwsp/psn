<?php include("../wsp_rad/wsp_rad.inc.php"); ?>
<?php

if(safe_get("do_it") == "yes"){
// Create table
                      $record_type = "booking";
                      //$record_type = $record_type."_id";
                      $meta_keys_array = array("booking_special_requirements");

//array_push($meta_keys_array,"date_created","date_updated");

                      $meta_names = "";
                      foreach($meta_keys_array as $single_key){
                        $meta_names = $meta_names . "ADD COLUMN ".$single_key . " TEXT NOT NULL,";
                      };
                      $meta_names = trim($meta_names,",");
                      
                      $sql = "ALTER table $record_type ".$meta_names;
                      echo $sql;
                        $pdo->exec($sql);
?>
<br><br><br><br><br>
<a href="../wsp_rad/backup.php" style="color:grey" target="_blank"><h1>Create DB Export</h1></a>
<?php
                    }else{
                        echo "setup record type and meta arrays first. then in GET put do_it=yes";
                    }