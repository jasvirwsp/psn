<?php
class users_fetch_controller{

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

		return($execute);
	}

	function fetch_all_users_with_user_type($user_type,$options_array){
		global $users_table_name;
		global $fpdo;
		global $execute;

		$execute =$fpdo->from($users_table_name)->where("user_type",$user_type);

		//Check Options $this means this class
		if($options_array){
			$this->options_check($options_array);
		}

		$execute = $execute->fetchAll();
		return($execute);

	}

	

	function fetch_all_users_with_orderby_orderby_2nd_order_type_and_order_type_2nd($user_type,$order_by,$order_by_2nd,$order_type,$order_type_2nd){
		global $users_table_name;
		global $fpdo;


		$execute =$fpdo->from($users_table_name)->where("user_type",$user_type)->orderBy($order_by . " " . $order_type AND $order_by_2nd . " " . $order_type_2nd)->fetchAll();

		return($execute);

	}


	function fetch_user_with_where($where_array,$options_array){
		global $users_table_name;
		global $fpdo;
		global $execute;

		$execute =$fpdo->from($users_table_name)->where($where_array);

		//Check Options $this means this class
		if($options_array){
			$this->options_check($options_array);
		}

		$execute = $execute->fetchAll();
		
		return($execute);

	}

	function fetch_user_meta_with_user_id($user_id){
		global $users_meta_table_name;
		global $fpdo;
		global $execute;

		$where_array = array("id"=>$user_id);
		$execute =$fpdo->from($users_meta_table_name)->where($where_array);
		$execute = $execute->fetchAll();
		
		return($execute);

	}

	function fetch_user_meta_with_where($where_array){
		global $users_meta_table_name;
		global $fpdo;
		global $execute;

		$where_array = array($where_array);
		$execute =$fpdo->from($users_meta_table_name)->where($where_array);
		$execute = $execute->fetchAll();
		
		return($execute);

	}

	

	function fetch_last_user_id_by_user_type($user_type){
		global $users_table_name;
		global $fpdo;

		$execute = $fpdo->from($users_table_name)->select("user_id")->where("user_type",$user_type)->orderBy("user_id DESC")->limit(1)->fetch();
		return($execute["user_id"]);

	}
	
	function fetch_count_by_user_type($user_type){

		global $users_table_name;
		global $fpdo;

		$execute = $fpdo->from($users_table_name)->select("user_id")->where("user_type",$user_type)->count();
		return($execute);

	}

}//Controller ends
