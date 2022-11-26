<?php 

class users_update_controller{
	
	function update_user_with_new_values_and_where($updated_values_array,$where_array){
		global $users_meta_table_name;
		global $fpdo;
		global $update_success;
		global $update_failure;
		
		$execute = $fpdo->update($users_meta_table_name)->set($updated_values_array)->where($where_array)->execute();
		if($execute){
			return true;
		}else{
			return false;
		}
		
	}

	function update_basic_details($updated_values_array,$where_array){
		global $users_table_name;
		global $fpdo;
		global $update_success;
		global $update_failure;
		
		$execute = $fpdo->update($users_table_name)->set($updated_values_array)->where($where_array)->execute();
		if($execute){
			return true;
		}else{
			return false;
		}
		
	}
	
	
}//End Controller