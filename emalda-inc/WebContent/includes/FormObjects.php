<?php

	// Class to construct Email with getters/setter
	class EmailClass
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
	
	} // End Emailclass
	

?>