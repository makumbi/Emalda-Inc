<?php

	// Include the required DBConnection information
	require_once('includes/Dbconnect.php');
	
	// Include the CustomerClass definition
	require_once('includes/FormObjects.php');
	
	function findEmail ($email)
	{
		// Connect to the database
		$mysqli = connectdb();
		$customerEmail = $email->getEmail();
		 
		// Connect to the database
		$mysqli = connectdb();
	
		// Define the Query
		// For Windows MYSQL String is case insensitive
		$Myquery = "SELECT count(*) as count from Email_Deals
		   where email=?";
	
		$result = $mysqli -> prepare($Myquery);
		$result -> bind_param("s", $customerEmail);
	
		if($result -> execute()){
	
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$count=$row["count"];
		 }
		 $result->close();
		}
		$mysqli->close();
		return $count;
	}
	
	function insertContact ($contact)
	{
	
		// Connect to the database
		$mysqli = connectdb();
	
		$firstname = $contact->getFirstname();
		$lastname = $contact->getLastname();
		$contactEmail = $contact->getContactEmail();
		$comment = $contact->getComment();
	
		// Now we can insert
		$Query = "INSERT INTO Customer_Contact
	          (firstName,lastName,eMail,comment)
	           VALUES (?,?,?,?)";
	
		$stmt = $mysqli -> prepare($Query);
		$stmt -> bind_param("ssss", $firstname, $lastname, $contactEmail, $comment);
	
		$Success=false;
		if($stmt -> execute()){
			$Success=true;
		}
		$stmt -> close();
		$mysqli ->close();
		return $Success;
	}

?>