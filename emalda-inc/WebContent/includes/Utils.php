<?php

	// sanitization of data
	function check_input($data){
		global $ret_data;
		$data = trim($data);
		$data = stripslashes($data);
		$ret_data = htmlspecialchars($data);
		return $ret_data;
	}// End form validation/sanitization

?>