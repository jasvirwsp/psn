<?php
class users_delete_controller{
	
	function delete_user_with_user_id($user_id){
		global $users_table_name;
		global $fpdo;
		global $delete_success;
		global $delete_failure;
		
		$execute =$fpdo->deleteFrom($users_table_name)->where("id",$user_id)->execute();
		
		if($execute){
			return true;
		}else{
			return false;
		}
		
	}

	function delete_user_meta_with_user_id($user_id){
		global $users_meta_table_name;
		global $fpdo;
		global $delete_success;
		global $delete_failure;
		
		$execute =$fpdo->deleteFrom($users_meta_table_name)->where("user_id",$user_id)->execute();
		
		if($execute){
			return true;
		}else{
			return false;
		}
		
	}
	
	function delete_user_with_where($where_array){
		global $users_table_name;
		global $fpdo;
		global $delete_success;
		global $delete_failure;
		
		$execute =$fpdo->deleteFrom($users_table_name)->where($where_array)->execute();
		
		if($execute){
			echo $delete_success;
		}else{
			echo $delete_failure;
		}
		
	}
	
}//End Conroller