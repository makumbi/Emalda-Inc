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
              <td><b>Enter New Password Again:</b></td>
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

    $user = $_SESSION['customer_email'];

    $current_pass= $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $new_again = $_POST['new_pass_again'];


    // Select from customers where customer_pass is equal to current pass and customer_email='$user'
    $sel_pass = "SELECT * FROM customers WHERE customer_pass='$current_pass' AND customer_email='$user'";
    // Run query
    $run_pass = mysqli_query($con, $sel_pass);

    $check_pass = mysqli_num_rows($run_pass);

    if($check_pass == 0){
      echo "<script>alert('Your current password is wrong!')</script>";
      exit();
    }
    elseif($new_pass!=$new_again){
      echo "<script>alert('New password does not match!')</script>";
      exit();
    }else{
      // SQL Statement
      $update_pass = "UPDATE customers SET customer_pass='$new_pass' WHERE customer_email='$user'";
      // Run query
      $run_update = mysqli_query($con, $update_pass);

      echo "<script>alert('Your password was updated succesfully!')</script>";
      echo "<script>window.open('my_account.php', '_self')</script>";
    }
  }

?>
