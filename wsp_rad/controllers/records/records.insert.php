<?php

class records_insert_controller{
	
	//Insert values into table directly
	function insert_record($rad_params){
		global $fpdo;
		global $insert_success;
		global $insert_failure;
		global $pdo;
		
		$execute = $fpdo->insertInto($rad_params[1])->values($rad_params[0])->execute();
		
		if($execute){
			$record_id = $pdo->lastInsertId();
			$response_array = array("status"=>"success","record_id"=>$record_id);
			return $response_array;
		}else{
			//Check if its new column
		  
			foreach($rad_params[0] as $column_name=>$column_value){

			  $column_count = count($pdo->query("SHOW COLUMNS FROM $rad_params[1] WHERE Field = '$column_name'")->fetchAll());
			  
			  if($column_count == 0){
				  //Check if allowed meta
				$check_meta_validation = check_meta_validation($column_name,$rad_params[1]);
				if($check_meta_validation){
				$sql = "ALTER TABLE $rad_params[1] ADD $column_name TEXT NOT NULL";
				$pdo->exec($sql);
				}else{
					unset($rad_params[0][$column_name]);
				}
			  }
			}
			$execute = $fpdo->insertInto($rad_params[1])->values($rad_params[0])->execute();
			if($execute){
				$record_id = $pdo->lastInsertId();
			$response_array = array("status"=>"success","record_id"=>$record_id);
			return $response_array;
						}
		}
		
		
	}
	 
	
}//Controller Ends