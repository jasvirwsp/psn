<?php 

class records_update_controller{
	
	function update_record_with_new_values_and_where($rad_params){
		
		$meta_table_name = $rad_params[2];
		global $pdo;
		global $fpdo;
		global $update_success;
		global $update_failure;
		
		
		$execute = $fpdo->update($meta_table_name)->set($rad_params[0])->where($rad_params[1])->execute();
		
		if($execute){
		  return true;
		}else{
		  //Check if its new meta
		  foreach($rad_params[0] as $column_name=>$column_value){
			$column_count = count($pdo->query("SHOW COLUMNS FROM $meta_table_name WHERE Field = '$column_name'")->fetchAll());
			
			if($column_count == 0){
				 //Check if allowed meta
				 $check_meta_validation = check_meta_validation($column_name,$rad_params[2]);
				 if($check_meta_validation){
			  $sql = "ALTER TABLE $meta_table_name ADD $column_name TEXT NOT NULL";
			  $pdo->exec($sql);
				 }else{
					unset($rad_params[0][$column_name]);
				}
			}
		  }
		  
		  $execute = $fpdo->update($meta_table_name)->set($updated_values_array)->where($rad_params[1])->execute();
	
		}
		
	}
	
	
}//End Controller