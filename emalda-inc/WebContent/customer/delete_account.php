
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

  $user = $_SESSION['customer_email'];

  if(isset($_POST['yes'])){
    // Delete from customer table where customer email is equal to user's email
    $delete_customer = "DELETE FROM customers WHERE customer_email='$user'";
    // Run the query
    $run_customer = mysqli_query($con, $delete_customer);

    echo "<script>alert('We are really sorry your account has been deleted!')</script>";
    echo "<script>window.open('../index.php', '_self')</script>";
  }
  elseif(isset($_POST['no'])){
    echo "<script>alert('Oh! That's what I was hoping to hear!')</script>";
    echo "<script>window.open('my_account.php', '_self')</script>";
  }
?>
