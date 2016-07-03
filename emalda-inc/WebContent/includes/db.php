<?php
// Utilize global build in keyword to connect to our database
global $con;
/* Connect to local DB */
$con = mysqli_connect("localhost","root", "", "ecommerce");

// Check connection
if(mysqli_connect_errno()){
  printf("Connect failed: %s/n", mysqli_connect_error());
  exit();
}
?>
