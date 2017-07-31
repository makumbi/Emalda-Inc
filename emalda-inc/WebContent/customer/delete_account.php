
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-info">
      <div class="panel-heading" style="height: 27px;"><b>Do you really want to DELETE your account?</b></div>
        <br><br>
          <form action="" method="post">

            <input type="submit" name="yes" value="Yes I want to delete my account"/>
            <input type="submit" name="no" value="No I was just joking"/>

          </form>
        <br><br>
    </div>
  </div>
</div>

<?php
include('includes/db.php');
  // Validate and Sanitize Input
  $userUntrustedInput = $_SESSION['customer_email'];
 
  $user_email = test_input($userUntrustedInput);
  // filter email to validate input
  if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
      $c_emailErr = "Invalid email format"; 
      echo "<script>alert('Please try again! $c_emailErr')</script>";
      exit();
  }

    // Function used to sanitize and validate use input
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
  if(isset($_POST['yes'])){
      
    // Delete from customer table where customer email is equal to user's email
    $delete_customer = "DELETE FROM customers WHERE customer_email=?";

    if($stmt = $con -> prepare($delete_customer)){

        // bind parameters
        $stmt -> bind_param('s', $user_email);

        // execute query
        if($stmt ->execute()){
            echo "<script>alert('Sorry to have to let you go!')</script>";
            echo "<script>window.open('../index.php', '_self')</script>";
        }  
    }
  }
  elseif(isset($_POST['no'])){
    echo "<script>alert('Oh! That's what I was hoping to hear!')</script>";
    echo "<script>window.open('my_account.php', '_self')</script>";
  }
?>
