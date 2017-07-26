
<!DOCTYPE html>
<?php

// Retrieves SQLFunctions php page and includes it to this page (index.php)
// Functions in SQLFunctions will be called upon
include("sql/SQLFunctions.php");
// Connect to database
// Utilize global build in keyword to connect to our database
global $con;
/* Connect to local DB */
$con = mysqli_connect("localhost","root", "", "ecommerce");

// Check connection
if(mysqli_connect_errno()){
  printf("Database Connection Failed ");
  exit();
}

?>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<title>Emalda Inc.</title>												<!--Change Title-->
<meta charset="utf-8">
	<!--[if lt IE 8]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->																	<!--Edge mode for IE8+-->
<meta name="description" content="describe your page">							<!--Update content-->
<meta name="keywords" content="">												<!--Update content-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">			<!--Scale a webpage to a 1:1 pixel-->
<link rel="shortcut icon" href="img/favicon.ico" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald%7CPT+Sans:400,700,400italic">	<!--Fonts styles-->
<link rel="stylesheet" href="resources/css/bootstrap.min.css">								<!--Bootstrap styles-->
<link rel="stylesheet" href="resources/css/bootstrap-responsive.min.css">						<!--Bootstrap styles-->
<link rel="stylesheet" href="resources/css/colorbox.css">
<!-- <link rel="stylesheet" type="text/css" href="resources/css/styles.css">
<link rel="stylesheet" href="resources/css/retina.css">									<!--Retina styles-->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="http://maps.googleapis.com/maps/api/js"></script>                          <!-- Add Google Maps -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
// Validate emails to receive deals
function validateForm() {
    var x = document.forms["userSearch"]["user_query"].value;
    if (x == null || x == "") {
        alert("Please search a product");
        return false;
    }
}
</script>
  <!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<style>
	@import url('resources/css/styles.css');                                           /* Custom styles */
</style>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<!-- ************************* NavBar ****************************** -->
<!-- The Nav Bar should always be above the "Emalda Inc." title  -->
<!-- The Nav Bar should get smaller when someone scrolls down, and get bigger when they scroll up  -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php#myPage">Logo</a>
     </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="index.php#myPage">HOME</a></li>
        <li><a href="index.php#about">ABOUT</a></li>
        <li><a href="index.php#products">PRODUCTS</a></li>
        <li><a href="index.php#farmers">FARMERS</a></li>
        <li><a href="index.php#contact">CONTACT</a></li>
       </ul>
       <ul class="nav navbar-nav navbar-right">
        <li><a href="customer/my_account.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart >> Items:<?php total_items();?> Price:<?php total_price();?></a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- ************************* End NavBar *************************** -->

<!--**************************Begin Header*****************************-->
<header class="header-height">
    <div class="jumbotron text-center">
        <div class="position-text">
            <h1>Account Login</h1>
            <p>We import fresh foods from African farmers to your door step</p>
            <form class="form-inline" name="userSearch"
                onsubmit="return validateForm()" method="post" action="results.php" enctype="multipart/form-data">
                <input type="text" name="user_query" class="form-control" placeholder="Search a product" size="50">
                <button type="submit" class="btn btn-danger" name="search" value="Search">Search</button>
            </form>
        </div>
    </div>
</header><!--**************************End Header*****************************-->

<!--**************************Begin Customer Account Login*****************************-->
<section class="action-products">
<div style="float:center;">
  <form method="post" action="">
    <table width="400" align="center">

      <tr align="center">
          <td colspan="4"><h2>Login or Request to Buy!</h2></td>
      </tr>

      <tr>
          <td align="center"><b>Email:</b></td>
          <td align="left"><input type="text" name="email" placeholder="enter email" required></input></td>
          <span class="error">* <?php echo $c_emailErr;?></span>
      </tr>

      <tr>
          <td align="center"><b>Password:</b></td>
          <td align="left"><input type="password" name="pass" placeholder="enter password" required></input></td>
          <span class="error">* <?php echo $c_passErr;?></span>
      </tr>

      <tr align="center">
          <td colspan="4"><input type="submit" name="login" value="Login"></input></td>
      </tr>

    </table>
  </form>
  <button align="float:center;"><a href="checkout.php?forgot_pass">Forgot Password?</a></button><br>
  <br>
  <a href="customer_register.php" align="center">New? Register Here</a>
</div>
</section>
<p></p>
<p></p>
<!--**************************End Customer Account Login*****************************-->
<!-- **************************** Footer ********************************* -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Theme Made By <a href="#" data-toggle="tooltip" title="Visit makumbi-srv">www.makumbi-srv.com</a></p>
  <div class="copyright pull-center">
	<p>&copy; Emalda Inc., 2016. All rights reserved. </p>
	<p>web by: <a href="#" target="_blank" data-toggle="tooltip">emalda.com</a></p>
	</div>
</footer>
<!-- **************************** End Footer ****************************** -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	<!--Script jQuery-->
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script> 	<!--Script jQuery-->
<script src="js/vendor/jquery-migrate.js"></script>								<!--Script jQuery for old version jQuery-->
<script src="js/vendor/bootstrap.min.js"></script>								<!--Script Bootstrap-->
<script src="js/vendor/jquery.twitter.js"></script>								<!--Script Twitter-->
<script src="js/vendor/jflickrfeed.js"></script>								<!--Script Widget Flikr-->
<script src="js/vendor/jquery.mobile.menu.js"></script>							<!--Script Mobile menu-->
<script src="js/vendor/modernizr.custom.91224.js"></script>						<!--Script Modernizr-->
<script src="js/vendor/jquery.form.js"></script>								<!--Script Send Mail-->
<script src="js/vendor/jquery.bxslider.js"></script>							<!--Script Bxslider Slider-->
<script src="js/vendor/jquery.colorbox.js"></script>
<script src="js/vendor/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="js/vendor/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="js/jquery.timelineG.js"></script>
<script src="js/custom.js"></script>											<!--Script Custom-->

<script>
$(document).ready(function(){
    // Initialize Tooltip
    $('[data-toggle="tooltip"]').tooltip();
})

$(document).ready(function() {

//3D-hover for iPhone, iPad, iPod
$('.ch-item').on("mouseenter mouseleave", function(e){
	e.preventDefault();
	$(this).toggleClass('hover');
	});

$('.ch-second-item').on("mouseenter mouseleave", function(e){
	e.preventDefault();
	$(this).toggleClass('hover');
	});


//Bxslider Slider
$('.appic-team').bxSlider({
  pager: false,
  minSlides: 1,
  maxSlides: 4,
  slideWidth: 270,
  slideMargin: 30
});

//Timeline
$( ".timeline" ).timeLineG({
	maxdis:280,
	mindis:100,
	wraperClass:'timeline-wrap'
});

});

$(document).ready(function(){
	  // Add smooth scrolling to all links in navbar + footer link
	  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

	  // Make sure this.hash has a value before overriding default behavior
	  if (this.hash !== "") {

	    // Prevent default anchor click behavior
	    event.preventDefault();

	    // Store hash
	    var hash = this.hash;

	    // Using jQuery's animate() method to add smooth page scroll
	    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
	    $('html, body').animate({
	      scrollTop: $(hash).offset().top
	    }, 900, function(){

	      // Add hash (#) to URL when done scrolling (default click behavior)
	       window.location.hash = hash;
	      });
	    } // End if
	});
})
</script>
</body>
</html>

<!-- Localized -->

<?php
// defining variables
$c_email = $c_pass = "";
$c_emailErr = $c_passErr = "";

  if(isset($_POST['login'])){
      // Validate and Sanitize Input
      $c_email = test_input($_POST['email']);
      // filter email to validate input
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $c_emailErr = "Invalid email format"; 
      }
      
      $c_pass = test_input($_POST['pass']);
      // check for password length
      if (iconv_strlen($c_pass) < 8) {
        $c_passErr = "Password should be longer than 8 characters";
        
      }
      
    // Function used to sanitize and validate use input
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
      
      // Select all from customer table where customer_pass is equal to user_pass and customer_email is equal to user_pass
      $sel_c = "SELECT * FROM customers WHERE customer_pass=? AND customer_email=?";

      if($stmt = mysqli_prepare($con, $sel_c)){

        // bind parameters for makers
        $stmt ->bind_param('ss', $c_email, $c_pass);

        // execute query
        $stmt ->execute();

        // get results
	$result = $stmt -> get_result();
        $check_customer = 0;
	while($row = $result -> fetch_array()){

            $check_customer++;
        }

        if($check_customer == 0){
          echo "<script>alert('Password or email is incorrect. Please try again!')</script>";
          // exit() tells the program that nothing else is going to be excuted once it gets to this point
          exit();
        }

      // free results
      $stmt ->free_result();

      // retrieve and store user ip address
      $ip = getIp();
      // Insect all from cart table where IP addess is equal to user's IP
      $sel_cart = "SELECT * FROM cart WHERE ip_add=?";

      // Create prepared statement
      if($stmt = $con -> prepare($sel_cart)){

        // bind parameters for makers
        $stmt ->bind_param('s', $ip);

        // execute query
        $stmt ->execute();

        // store results
        $result = $stmt -> store_result();

        // Check where the cart has rows
        // If it has rows, it means user has items in cart
        $check_cart = $result -> num_rows;

        if($check_customer > 0 AND $check_cart == 0){
          // This means user does not have any products so we should direct them to their account
          // Register User Session
          $_SESSION['customer_email'] = $c_email;

          echo "<script>alert('You logged in successfully, thanks!')</script>";
          echo "<script>window.open('customer/my_account.php', '_self')</script>";
      }else{

        // This means user has products and that they should be directed to the check out page
        // Register User Session
        $_SESSION['customer_email'] = $c_email;

        echo "<script>alert('You logged in successfully, thanks!')</script>";
        echo "<script>window.open('customer/my_account.php', '_self')</script>";

      }
      }
      // free results
      $stmt ->free_result();
      // close statement
      $stmt ->close();
      }
      // close connection
      $con -> close();
  }
?>
