<?php
   // start session
   session_start();
   
    // create randomly generated token
    // mitigate XSS
    // store token in session 
    $token = md5(uniqid(rand(), TRUE));
    $_SESSION['token'] = $token;
    $_SESSION['token_time'] = time();
    
    // include db && throttle functions
    include("includes/db.php");
    include("includes/throttle_functions.php");
    
?>
<!DOCTYPE html>
<html>
  <head>
      <title>Admin Login Form</title>
      <link rel="stylesheet" href="css/login_style.css" media="all">
  </head>
  <script>
      function registerButton(){
          window.open('admin_registration.php', '_self');
      }
  </script>
      
<body>
<div class="login">
	<h1>Admin Login</h1>
    <h2 style="color:white; text-align:center;"><?php echo @$_GET['not_admin']; ?></h2>
    <h2 style="color:white; text-align:center;"><?php echo @$_GET['logged_out']; ?></h2>

    <form method="post" action="login.php">
        <input type="hidden" value="token" value="<?php echo $token; ?>" />
    	<input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" name="login" class="btn btn-primary btn-block btn-large">Login</button>
        <button class="btn btn-primary btn-block btn-large" onclick="registerButton()">Register</button>
    </form>
</div>
</body>
</html>

<?php

    if(isset($_POST['login'])){

        // Use global keyword to connect to our database
        global $con;
        global $email;
            
        // connect to local DB
        $con = mysqli_connect("localhost", "root", "root", "emaldaDB");

        if(mysqli_connect_errno()){
            echo "The connection was not established: " . mysqli_connect_errno();
        }   
        
        $userEmail = $_POST['email'];
        $passWord = $_POST['password'];  
            
        $email = filter_var($userEmail, FILTER_SANITIZE_STRING);
        $password = filter_var($passWord, FILTER_SANITIZE_STRING);
                
        $throttle_delay = throttle_failed_logins($email);
        
        if($throttle_delay > 0){
            echo "<script>window.alert('You have too many failed logins!')</script>";
            echo "<script>window.alert('Wait {$throttle_delay} mins before another attempt.')</script>";
        }else{
     
            // set SQL statement and execute
            $sel_user = "SELECT * FROM admins WHERE admin_email=?";

            if($stmt = $con -> prepare($sel_user)){

            // bind parameters
            $stmt -> bind_param('s', $email);

            // execute query
            $stmt -> execute();    

            // get results
            $result = $stmt -> get_result();

            while($row = $result -> fetch_array()){                 
                $admin_email = $row['admin_email'];
                $admin_pass = $row['admin_password'];
                
                if(password_verify($password, $admin_pass)){
                    // successful login
                    // clearing failed logins                   
                    $isSuccessful = clear_failed_logins($email);
                        
                    if($isSuccessful){
                    // register session
                    $_SESSION['email'] = $admin_email;                    
                    echo "<script>window.open('index.php?logged_in=You have successfully loggin in!', '_self')</script>";
                    }                       
                }
                // close statement
                $stmt ->close();   
                }
             // close connection
             $con -> close();   
            }
        // records failed username
        record_failed_login($email);                                        
    }
}         

 ?>
