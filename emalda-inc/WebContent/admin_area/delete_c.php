<?php

  include('includes/db.php');

  if(isset($_GET['delete_c'])){

    $delete_id = $_GET['delete_c'];

    // set SQL statement and execute
    $del_customer = "DELETE FROM customers WHERE customer_id=?";

    $stmt = $con -> prepare($del_customer);

    // bind parameters
    $stmt -> bind_param('i', $delete_id);   

    if($stmt -> execute()){
      echo "<script>alert('Customer was successfully deleted!')</script>";
      echo "<script>window.open('index.php?view_customers','_self')</script>";
    }
    else {
      echo "<script>alert('Customer was not deleted! Try again!')</script>";
    }
  }
 ?>

