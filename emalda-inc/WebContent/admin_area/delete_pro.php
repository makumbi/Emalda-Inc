<?php

  include('includes/db.php');

  if(isset($_GET['delete_pro'])){

    $delete_id = $_GET['delete_pro'];

    // set SQL statement and execute
    $del_prod = "DELETE FROM products WHERE product_id=?";

    $stmt = $con -> prepare($del_prod);

    // bind parameters
    $stmt -> bind_param('i', $delete_id);   

    if($stmt -> execute()){
      echo "<script>alert('Product was successfully deleted!')</script>";
      echo "<script>window.open('index.php?view_products','_self')</script>";
    }
    else {
      echo "<script>alert('Product was not deleted! Try again!')</script>";
    }
  }
 ?>
