<?php
class records_fetch_controller{

	//Check Options
	function options_check($options_array){

		global $execute;


			if(@$options_array["between"]){
			$three_attributes = explode(",",$options_array["between"]);
			$column_name = $three_attributes[0];
			$start_date  = $three_attributes[1];
			$end_date = $three_attributes[2];
			$execute = $execute->where($column_name." BETWEEN ? AND ?",$start_date,$end_date);
			}

			if(@$options_array["orderBy"]){
			$execute = $execute->orderBy($options_array["orderBy"]);
			}

			if(@$options_array["limit"]){
			$execute = $execute->limit($options_array["limit"]);
			}

			if(@$options_array["offset"]){
				$execute = $execute->offset($options_array["offset"]);
				}

		return($execute);
	}


	//rad_params = record_type,where_array,options_array
	function fetch_record_with_where($rad_params){
		// //Permission Check
		// global $user_role;
		// if(!check_permission($rad_params[0],$user_role,"read")){
		// 	exit("You don't have permission to perform this action.");
		// };
		// //Permission Check
		$records_table_name = $rad_params[0];
		global $fpdo;
		global $execute;

		$execute =$fpdo->from($records_table_name)->where($rad_params[1]);

		//Check Options $this means this class
		if($rad_params[2]){
			$this->options_check($rad_params[2]);
		}

		$execute = $execute->fetchAll();
		
		return($execute);

	}

	//rad_params = record_type,where_array,options_array,single_column
	function fetch_record_single_column_with_where($rad_params){
		$records_table_name = $rad_params[0];
		global $fpdo;
		global $execute;

		$execute =$fpdo->from($records_table_name)->select($rad_params[3])->where($rad_params[1]);

		//Check Options $this means this class
		if($rad_params[2]){
			$this->options_check($rad_params[2]);
		}

		$execute = $execute->fetchAll('record_id',$rad_params[3]);
		
		return($execute);

	}
	

	//rad_params = record_type,where_array
	function fetch_count_by_record_type_and_where_array($rad_params){
		global $records_table_name;
		global $fpdo;
		
		$execute = $fpdo->from($rad_params[0])->select(null)->select("count(*)")->where($rad_params[1])->execute();
		$count = $execute->fetch();
		return($count['count(*)']);

	}

}//Controller ends
