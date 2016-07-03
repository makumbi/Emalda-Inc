<!DOCTYPE html>
<html>
  <head>
      <title>Admin Login Form</title>
      <link rel="stylesheet" href="css/login_style.css" media="all">
  </head>
<body>
<div class="login">
	<h1>Admin Login</h1>
    <h2 style="color:white; text-align:center;"><?php echo @$_GET['not_admin']; ?></h2>
    <h2 style="color:white; text-align:center;"><?php echo @$_GET['logged_out']; ?></h2>

    <form method="post" action="login.php">
    	<input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" name="login" class="btn btn-primary btn-block btn-large">Login</button>
    </form>
</div>
</body>
</html>

<?php
  session_start();
  include('includes/db.php');

    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $pass = $_POST['password'];

        $sel_user = "SELECT * FROM admins WHERE user_email='$email' AND user_pass='$pass'";
        $run_user = mysqli_query($con, $sel_user);

        $check_user = mysqli_fetch_row($run_user);

        if($check_user == 0){
          echo "<script>alert('Password or Email is not recognized. Lets try that again!')</script>";
        } else {
          $_SESSION['user_email'] = $email;
          echo "<script>window.open('index.php?logged_in=You have successfully logged in!', '_self')</script>";
        }
    }

 ?>
