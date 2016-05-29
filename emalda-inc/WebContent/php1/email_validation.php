<?php

	// Needed For SQLFunctions getEmail call
	require_once('sql/SQLFunctions.php');
	
	// Needed For Utils check_input call
	require_once('includes/Utils.php');
	
	// define variables and set to empty values
	$emailErr = "";
	$email = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if(empty($_POST['email'])){
		$emailErr = "Please enter a valid email";
		} else {
		$email = check_input($_POST["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format";
			}
		}
	}
	
	// check whether email already exists 
	$count = findEmail($email);
	
	if ($count==0)
	{
		// Show main page again.

		// Ther function actually adding the email to the DB goes here!
		
		include('index.html');
		
		/* create function/statement that acknowledges that
		 email was succesfully stored into DB and also gives
		 the customer the opportunity to make an account if 
		 they would like */
	} else {
		
	   $emailErr = "Email already exists. Please try another email address";
	}
?>