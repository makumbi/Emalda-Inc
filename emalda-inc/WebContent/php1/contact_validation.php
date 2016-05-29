<?php

	// Needed for SQLFunctions getContact call
	require_once('sql/SQLFunctions.php');
	
	// Needed For Utils check_input call
	require_once('includes/Utils.php');
	
	// define variables and set to empty values
	$fnameErr = $lnameErr = $emailErr = $commentErr = "";
	$fname = $lname = $email = $comment = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if(empty($_POST['fname'])){
			$fnameErr = "Please enter a valid first name";
		} else {
			$fname = check_input($_POST["fname"]);			
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
				$fnameErr = "Only letters and white space allowed";
			}
		}
		
		if(empty($_POST['lname'])){
			$lnameErr = "Please enter a valid last name";
		} else {
			$lname = check_input($_POST["lname"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
				$fnameErr = "Only letters and white space allowed";
			}
		}
		
		if(empty($_POST['email'])){
		$emailErr = "Please enter a valid email";
		} else {
		$email = check_input($_POST["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format";
			}
		}
		
	/*	if(empty($_POST['comments'])){
			$commentErr = "";
		} else {
			$comment = check_input($_POST["comments"]);
		} */
	}
	
	// check whether customer contact form is inserted  
	$isSuccess = insertContact (fname, $lname, $email, $comment);

	if ($isSuccess==true)
	{
		// Show main page again.
		include('index.html');
		
		/* create function/statement that acknowledges that
		 * customer contact form was succesfully stored into DB.
		 */
	} else {
		
	   /* create function/statement that acknoledges that customer contact form
	    * was not succesfully stored into DB. This may include a simple pop-up 
	    */
	}
?>