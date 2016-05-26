<?php

	// Include the required DBConnection information
	require_once('includes/Dbconnect.php');
	
	// Include the CustomerClass definition
	require_once('includes/FormObjects.php');
	
	function findEmail ($email)
	{
		// Connect to the database
		$mysqli = connectdb();
		$customer_email = $email->getEmail();
		 
		// Connect to the database
		$mysqli = connectdb();
	
		// Define the Query
		// For Windows MYSQL String is case insensitive
		$Myquery = "SELECT count(*) as count from Deals_Email
		   where email=?";
	
		$result = $mysqli -> prepare($Myquery);
		$result -> bind_param("s", $customer_email);
	
		if($result -> execute()){
	
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$count=$row["count"];
		 }
		 $result->close();
		}
		$mysqli->close();
		return $count;
	}

?>