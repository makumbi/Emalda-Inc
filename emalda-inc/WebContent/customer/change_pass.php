<?php
  include('includes/db.php');
?>
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-info">
      <div class="panel-heading" style="height: 27px;"><b>Change Your Password</b></div>
      <div class="panel-body" Style="height: 400px;">

        <form action="" method="post">
          <table align="center">
            <tr>
              <td><b>Enter Current Password:</b></td>
              <td><input type="password" name="current_pass" required></td>
            </tr>
            <tr>
              <td><b>Enter New Password:</b></td>
              <td><input type="password" name="new_pass" required></td>
            </tr>
            <tr>
              <td><b>Re-Enter New Password:</b></td>
              <td><input type="password" name="new_pass_again" required></td>
            </tr>
            <tr>
              <td><input type="submit" name="change_pass" value="Change Password"/></td>
            </tr>
            </table>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_POST['change_pass'])){
    // Inputs needs to be validated
    $userEmailValidate = $_SESSION['customer_email'];

    $userEmail = test_input($userEmailValidate);
    // filter email to validate input
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $c_emailErr = "Invalid email format";
        echo "<script>alert('Please try again! $c_emailErr')</script>";
        exit();
    }
    
    $current_pass = test_input($_POST['current_pass']);
    // check for password length
    if (iconv_strlen($current_pass) < 8) {
        $c_passErr = "Password should be longer than 8 characters";
        echo "<script>alert('Please try again! $c_passErr')</script>";
        exit();
    }  
    $new_pass = test_input($_POST['new_pass']);
    // check for password length
    if (iconv_strlen($new_pass) < 8) {
        $c_passErr = "Password should be longer than 8 characters";
        echo "<script>alert('Please try again! $c_passErr')</script>";
        exit();
    }
    $new_again = test_input($_POST['new_pass_again']);
    // check for password length
    if (iconv_strlen($new_again) < 8) {
        $c_passErr = "Password should be longer than 8 characters";
        echo "<script>alert('Please try again! $c_passErr')</script>";
        exit();
    }  
    // Function used to sanitize and validate use input
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
    // password needs to be salted for added security
    $hash_new_pass = password_hash($new_again, PASSWORD_BCRYPT);
    
    $sel_cust = "SELECT * FROM customers WHERE customer_email=?";
           
    // Create prepared statement
    if($stmt = $con -> prepare($sel_cust)){

        // bind parameters for makers
        $stmt ->bind_param('s', $userEmail);

        // execute query
        $stmt ->execute();

        // store results
        $result = $stmt -> store_result();

        if($result == 0){
          echo "<script>alert('Your current password is wrong!')</script>";
          exit();
        }
        elseif(!(password_verify($new_pass , $hash_new_pass))){
          echo "<script>alert('New password does not match!')</script>";
          exit();
        }else{
          // SQL Statement
          $update_pass = "UPDATE customers SET customer_pass=? WHERE customer_email=?";          
          // if else statement
          if($stmt = $con -> prepare($update_pass)){
        
            // bind parameters
            $stmt ->bind_param('ss', $hash_new_pass, $userEmail);
            // execute
            if($stmt -> execute()){
                $_SESSION['customer_email'] = $userEmail;
                echo "<script>alert('Your password was updated succesfully!')</script>";
                echo "<script>window.open('my_account.php', '_self')</script>";
            }
          }
        }
    }
}

?>
