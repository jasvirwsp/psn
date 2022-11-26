<?php
class array_resolver_controller{

	function input_text_structure($exact_input_array){

		echo '<input type="' . $exact_input_array["input_type"] . '"' .
			' class="' . $exact_input_array["classes"] . '"' .
			' id="' . $exact_input_array["attr_id"] . '"' .
			' name="' . $exact_input_array["input_name"] . '"' .
			' >';

	}


	function return_requested_value($exact_input_array,$requested_value_key){

		$single_value = $exact_input_array["meta_value"];
		return $single_value;
	}

	function return_input_from_nested_inputs_array($inputs_array,$primary_input,$return_type){

		foreach($inputs_array as $key=>$value){

					foreach($inputs_array[$key] as $nested_key=>$nested_value){

								if($nested_value == $primary_input){

								if($return_type == "input_text"){

								$this->input_text_structure($inputs_array[$key]);
								}

								if($return_type == "single_value"){
								//print_r($inputs_array);
								return $this->return_requested_value($inputs_array[$key],$primary_input);
								}



								}
						}

		}


	}
	function get_me_single_value_from_array($exact_array,$what_you_want){


	}

	function get_meta_value($inputs_array,$primary_input){

		foreach($inputs_array as $key=>$value){

					foreach($inputs_array[$key] as $nested_key=>$nested_value){

								if($nested_value == $primary_input){
									$exact_input_array = $inputs_array[$key];
									$single_value = $exact_input_array["meta_value"];
									return $single_value;
								}
						}

		}


	}


}//End Controller

	function return_pre_aligned_array($array_to_align){
		$aligned = "<pre>" . print_r($array_to_align) . "</pre>";
		echo $aligned;

	}
?>
