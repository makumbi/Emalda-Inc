<?php

  include('includes/db.php');

  if(isset($_GET['delete_pro'])){

    $delete_id = $_GET['delete_pro'];

    $delete_pro = "DELETE FROM products WHERE product_id='$delete_id'";

    $run_delete = mysqli_query($con, $delete_pro);

    if($run_delete){
      echo "<script>alert('Product was successfully deleted!')</script>";
      echo "<script>window.open('index.php?view_products','_self')</script>";
    }
    else {
      echo "<script>alert('Product was not deleted! Try again!')</script>";
    }
  }
 ?>
