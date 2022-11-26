<?php 

class html_elements_controller{
	
	function input_text_structure($exact_input_array){		
		
		echo '<input type="' . $exact_input_array["input_type"] . '"' .
			' class="' . $exact_input_array["classes"] . '"' .
			' id="' . $exact_input_array["attr_id"] . '"' .
			' name=' . $exact_input_array["input_name"] . '"' .
			' >';
		
	}
	
	
}

?>