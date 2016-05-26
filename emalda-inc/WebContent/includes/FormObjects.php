<?php

	// Class to construct Email_Deals with getters/setter
	class Email_Deals
	{
		// property declaration
		private $email="";
		 
		// Constructor
		public function __construct($email)
		{
			$this->email = $email;
		}
	
		// Get methods
		public function getEmail ()
		{
			return $this->email;
		}
		 
		// Set method
		public function setEmail ($value)
		{
			$this->email = $value;
		}
	} // End Email_Deals Class
	
	// Class to construct Customer_Contact with getters/setter
	class Customer_Contact
	{
		// property declaration
		private $firstname="";
		private $lastname="";
		private $cEmail="";
		private $comment="";
		 
		// Constructor
		public function __construct($firstname,$lastname,$cEmail,$comment)
		{
			$this->firstname = $firstname;
			$this->lastname = $lastname;
			$this->cEmail = $cEmail;
			$this->comment = $comment;
		}
	
		// Get methods
		public function getFirstname ()
		{
			return $this->firstname;
		}
		public function getLastname ()
		{
			return $this->lastname;
		}
		public function getContactEmail ()
		{
			return $this->cEmail;
		}
		public function getComment ()
		{
			return $this->comment;
		}
		 
	
		// Set methods
		public function setFirstname ($value)
		{
			$this->firstname = $value;
		}
		public function setLastname ($value)
		{
			$this->lastname = $value;
		}
		public function setContactEmail ($value)
		{
			$this->cEmail = $value;
		}
		public function setComment ($value)
		{
			$this->comment = $value;
		}
	
	} // End Customer_Contact class
	

?>