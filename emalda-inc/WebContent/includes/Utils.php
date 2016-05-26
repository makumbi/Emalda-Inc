<?php

	function check_input($data)
	{
		global $ret_data;
		$data = trim($data);
		$ret_data = htmlspecialchars($data);
		return $ret_data;
	}
	
	// sanitization of data
	function check_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}// End form validation/sanitization

?>