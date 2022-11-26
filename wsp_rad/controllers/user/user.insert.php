<?php

class users_insert_controller{
	
	//Insert values into table directly
	function insert_user($insert_array){
		global $users_table_name;
		global $fpdo;
		global $insert_success;
		global $insert_failure;
		global $pdo;
		
		$execute = $fpdo->insertInto($users_table_name)->values($insert_array)->execute();
		
		if($execute){
			$user_id = $pdo->lastInsertId();
			$response_array = array("status"=>"success","user_id"=>$user_id);
			return $response_array;
		}else{
			//Check if its new column
		  
			foreach($insert_array as $column_name=>$column_value){

				$column_count = count($pdo->query("SHOW COLUMNS FROM $users_table_name WHERE Field = '$column_name'")->fetchAll());
				
				if($column_count == 0){
				  $sql = "ALTER TABLE $users_table_name ADD $column_name TEXT NOT NULL";
				  $pdo->exec($sql);
				  
				}
			  }
			  $execute = $fpdo->insertInto($users_table_name)->values($insert_array)->execute();
			  if($execute){
				  $record_id = $pdo->lastInsertId();
			  $response_array = array("status"=>"success","user_id"=>$record_id);
			  return $response_array;
						  }
		}
		
		
	}

	 
	
}//Controller Ends