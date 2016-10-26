<?php
// start session
session_start();

if(isset($_SESSION['token'])){

// connect to database
include("includes/db.php");
?>
<!DOCTYPE html>
<html>
  <head>
      <title>Admin Registration Form</title>
      <link rel="stylesheet" href="css/login_style.css" media="all">
  </head>
  <script>
      function loginButton(){
          window.open('login.php', '_self');
      }
  </script>      
<body>
<div class="login">
    <h1>Admin Register</h1>

    <form method="post" action="admin_registration.php">
        <input type="hidden" value="token" value="<?php echo $token; ?>" />
    	<input type="text" name="email" placeholder="Email" style="color: whitesmoke;" required="required" />
        <input type="password" name="password" placeholder="Password" style="color: whitesmoke;" required="required" />
        <button type="submit" name="register" class="btn btn-primary btn-block btn-large">Register</button>
        <button class="btn btn-primary btn-block btn-large" onclick="loginButton()">Login</button>
    </form>
</div>
</body>
</html>
<?php

    if(isset($_POST['register'])){
       global $con;
        // connect to local DB
        $con = mysqli_connect("localhost", "root", "root", "emaldaDB");

        if(mysqli_connect_errno()){
            echo "The connection was not established: " . mysqli_connect_errno();
        }          
        
        $userEmail = $_POST['email'];
        $passWord = $_POST['password'];   
        
        $email = filter_var($userEmail, FILTER_SANITIZE_STRING);
        $password = filter_var($passWord, FILTER_SANITIZE_STRING);       
        
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        // set SQL statement and execute
        $sel_user = "SELECT * FROM admins WHERE admin_email=?";
    
        if($stmt = $con -> prepare($sel_user)){

        // bind parameters
        $stmt -> bind_param('s', $email);
        
        // execute query
        $stmt -> execute();    
        
        $stmt -> get_result();
        
        $check_rows = $stmt -> affected_rows;
        
        // checks whether user is in the database
        if($check_rows == 0){
            
            // insert into customer table 
            $insert_c = "INSERT INTO admins (admin_email, admin_password) VALUES (?, ?)";
            
            $stmt = $con -> prepare($insert_c);

            // bind parameters
            $stmt -> bind_param('ss', $email, $hash);

            // execute query
            $stmt ->execute();

            // redirect user back to login page
            echo "<script>window.alert('Successfully Registered!')</script>";
            echo "<script>window.open('login.php?register_in=You have successfully registered!', '_self')</script>";
        
        } else {
            // Account has already been created    
            echo "<script>alert('Account has already been created!')</script>";
            echo "<script>window.open('admin_registration.php', '_self')</script>";
        }
        // close statement
        $stmt ->close();   
        }
    // close connection
    $con -> close();    
    }    
}
?>