<?php
class records_delete_controller{
	
	function delete_record_with_record_id($rad_params){
		$records_table_name = $rad_params[1];
		global $fpdo;
		global $delete_success;
		global $delete_failure;
		
		$execute =$fpdo->deleteFrom($records_table_name)->where("record_id",$rad_params[0])->execute();
		
		if($execute){
			return true;
		}else{
			return false;
		}
		
	}
	
	function delete_record_with_where($rad_params){
		$records_table_name = $rad_params[1];
		global $fpdo;
		global $delete_success;
		global $delete_failure;
		
		$execute =$fpdo->deleteFrom($records_table_name)->where($rad_params[0])->execute();
		
		if($execute){
			return true;
		}else{
			return false;
		}
		
	}
	
}//End Conroller