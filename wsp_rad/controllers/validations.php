<?php

class validations_check{

	function pass_user_input($validations_array,$record_type){
		$errors = array();
		foreach($validations_array as $key=>$value){
			$all_rules = explode("|",$value);

			foreach($all_rules as $single_rule){
				$db_column = $key;				
				$parameter_value = $_REQUEST[$db_column];
				$human_format_db_column = ucwords(str_replace("_"," ",$db_column));

				//Empty Rule
				if($single_rule == "required"){
					if($parameter_value != ""){

					}else{
						

						$errors[] = $db_column."//".$human_format_db_column . " is required field and it must not be empty.";
					}

				}
				//Ends

				//Min Rule
				if(strpos($single_rule,"min") !== false){
					$break_limit = explode("=",$single_rule);
					if(strlen($parameter_value) >= $break_limit[1]){

					}else{

						$errors[] = $db_column."//"."Too less characters in ". $human_format_db_column . ". Minimum is :".$break_limit[1];
					}

				}
				//Ends

				//Min value Rule
				if(strpos($single_rule,"minimum_value") !== false){
					$break_limit = explode("=",$single_rule);
					if($parameter_value >= $break_limit[1]){

					}else{

						$errors[] = $db_column."//"."Invalid Value ". $human_format_db_column . ". Minimum is :".$break_limit[1];
					}

				}
				//Ends

				//Max Rule
				if(strpos($single_rule,"max") !== false){
					$break_limit = explode("=",$single_rule);
					if(strlen($parameter_value) <= $break_limit[1]){

					}else{
						$errors[] = $db_column."//".$human_format_db_column . " can't exceed max limit of " . $break_limit[1]. " characters.";
					}

				}
				//Ends

				//Max value Rule
				if(strpos($single_rule,"maximum_value") !== false){
					$break_limit = explode("=",$single_rule);
					if($parameter_value <= $break_limit[1]){

					}else{

						$errors[] = $db_column."//"."Invalid Value ". $human_format_db_column . ". Maximum is :".$break_limit[1];
					}

				}
				//Ends

				//Number Rule
				if($single_rule == "number"){
					if(is_numeric($parameter_value)){

					}else{

						$errors[] = $db_column."//".$human_format_db_column . " must be a number.";
					}

				}
				//Ends

				//Url Rule
				if($single_rule == "url"){
					if(filter_var($parameter_value,FILTER_VALIDATE_URL)){

					}else{

						$errors[] = $db_column."//".$human_format_db_column . " must be a valid URL.";
					}

				}
				//Ends

				//Email Rule
				if($single_rule == "email"){
					if(filter_var($parameter_value,FILTER_VALIDATE_EMAIL)){

					}else{

						$errors[] = $db_column."//".$human_format_db_column . " must be a valid Email.";
					}

				}
				//Ends

				//Clean Input Rule
				if($single_rule == "safe_input"){
					if(!preg_match('/[\'"^£$%&*()}{#?><>,=_¬-]/',$parameter_value)){

					}else{

						$errors[] = $db_column."//".$human_format_db_column . " has Invalid characters passed.";
					}

				}
				//Ends

				//Empty Rule
				if($single_rule == "required_with_input_value_separator"){
					$explode_parameter_value = explode("~|~",$parameter_value);
					foreach($explode_parameter_value as $single_part){
					if($single_part != ""){

					}else{
						

						$errors[] = $db_column."//".$human_format_db_column . " has a empty input.";
					}
				}

				}
				//Ends

				//Clean Input Rule
				if($single_rule == "normal_safe_input"){
					if(!preg_match('/[\'"^£$%&*}{?><>=¬]/',$parameter_value)){

					}else{

						$errors[] = $db_column."//".$human_format_db_column . " has Invalid characters passed.";
					}

				}
				//Ends

				//Unique DB Value Rule
				if($single_rule == "unique_db_value"){

					$records_fetch_controller = new records_fetch_controller();
					
					$where_array = array($db_column=>$parameter_value);	
					$check_unique = $records_fetch_controller->fetch_record_with_where([$record_type,$where_array]);
					$check_count = count($check_unique);
					if($check_count == 0){

					}else{
									
					$errors[] = $db_column."//".$human_format_db_column ." already exists with same value ". $parameter_value .". It must be unique.";
				}

				}
				//Ends

				//Unique DB Value Rule
				if($single_rule == "unique_db_value_user_table"){

					$records_fetch_controller = new records_fetch_controller();
					
					$where_array = array($db_column=>$parameter_value);	
					$check_unique = $records_fetch_controller->fetch_record_with_where(["users",$where_array]);
					$check_count = count($check_unique);
					if($check_count == 0){

					}else{
									
					$errors[] = $db_column."//".$human_format_db_column ." already exists with same value ". $parameter_value .". It must be unique.";
				}

				}
				//Ends

				//Unique DB Value Rule Username
				if($single_rule == "unique_db_value_username"){

					$users_fetch_controller = new users_fetch_controller();
					
					$where_array = array("user"=>$parameter_value);
					$options_array = array();
					$check_unique = $users_fetch_controller->fetch_user_with_where($where_array,$options_array);
					$check_count = count($check_unique);
					if($check_count == 0){

					}else{
									
					$errors[] = $db_column."//".$human_format_db_column ." already exists with same value ". $parameter_value .". It must be unique.";
				}

				}
				//Ends

				//Unique DB Value Rule Username
				if($single_rule == "unique_db_value_username_update"){

					$users_fetch_controller = new users_fetch_controller();
					
					$where_array = array("user"=>$parameter_value);	
					$options_array = array();
					$check_unique = $users_fetch_controller->fetch_user_with_where($where_array,$options_array);	
					$check_count = count($check_unique);
					if($check_count == 1){
					$get_user_meta = get_user_meta_with_user_id(safe_post("user_id"));					
					$returned_user = get_single_value($get_user_meta,"user");
					if($returned_user != $parameter_value){
						
						$errors[] = $db_column."//".$human_format_db_column ." already used. Please use another.";
					}
					}else{
									
					
				}

				}
				//Ends

				//Unique DB Value Rule Email
				if($single_rule == "unique_db_value_email"){

					$users_fetch_controller = new users_fetch_controller();
					
					$where_array = array("email"=>$parameter_value);
					$options_array = array();	
					$check_unique = $users_fetch_controller->fetch_user_with_where($where_array,$options_array);
					$check_count = count($check_unique);
					if($check_count == 0){

					}else{
									
					$errors[] = $db_column."//".$human_format_db_column ." already exists with same value ". $parameter_value .". It must be unique.";
				}

				}
				//Ends

				//Unique DB Value Rule Email
				if($single_rule == "unique_db_value_email_update"){

					$users_fetch_controller = new users_fetch_controller();
					
					$where_array = array("email"=>$parameter_value);	
					$options_array = array();
					$check_unique = $users_fetch_controller->fetch_user_with_where($where_array,$options_array);
					$check_count = count($check_unique);
					if($check_count == 1){
					$get_user_meta = get_user_meta_with_user_id(safe_post("user_id"));					
					$returned_email = get_single_value($get_user_meta,"email");
					if($returned_email != $parameter_value){
						
						$errors[] = $db_column."//".$human_format_db_column ." already used. Please use another.";
					}

					}else{
									
					
				}

				}
				//Ends

				//Unique DB Value for update Rule
				if($single_rule == "unique_db_value_update"){

					
					$records_fetch_controller = new records_fetch_controller;
					$where_array = array($db_column=>$parameter_value);	
					$check_unique =  $records_fetch_controller->fetch_record_with_where([$record_type,$where_array]);
					$check_count = count($check_unique);
					if($check_count == 0){

					}else{
									
					$errors[] = $db_column."//".$human_format_db_column ." already exists with same value ". $parameter_value .". It must be unique.";
				}

				}
				//Ends

				
				// check different record have than value
	
				//Ends


			}


		}
		if($errors){
		$error = explode("//",$errors[0]);
		$error_input = $error[0];
		$error_message = $error[1];
		$validation_response = array("status"=>"failure","errors"=>array($error_message),"error_input"=>$error_input);
		$validation_response = json_encode($validation_response);
		return($validation_response);
		}else{
			$validation_response = array("status"=>"success");
		$validation_response = json_encode($validation_response);
		return($validation_response);
		}

	}


}



?>
