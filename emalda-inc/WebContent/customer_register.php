<!DOCTYPE html>
<?php
// Start Session
session_start();
// Retrieves SQLFunctions php page and includes it to this page (index.php)
// Functions in SQLFunctions will be called upon
include("sql/SQLFunctions.php");
// Connect to database
include("includes/db.php");

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
// function checks whether user has inserted a query before it is excuted
function validateForm() {
    var x = document.forms["userSearch"]["user_query"].value;
    // If the document.form has empty value, alert is thrown notifying user
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
<!--****************** Added cart PHP function **************************-->
<?php cart(); ?>
<!-- ************************* NavBar ****************************** -->
<!-- The Nav Bar should always be above the "Emalda Inc." title  -->
<!-- The Nav Bar should get smaller when someone scrolls down, and get bigger when they scroll up //navbar-default navbar-fixed-top -->
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
            <h1>Create Account</h1>
            <p>We import fresh food from African farmers to your door step</p>
            <form class="form-inline" name="userSearch"
                onsubmit="return validateForm()" method="post" action="results.php" enctype="multipart/form-data">
                <input type="text" name="user_query" class="form-control" placeholder="Search a product" size="50">
                <button type="submit" class="btn btn-danger" name="search" value="Search">Search</button>
            </form>
        </div>
    </div>
</header><!--**************************End Header*****************************-->

<!--**************************Begin Customer Registration*****************************-->
  <form action="customer_register.php" method="post" enctype="multipart/form-data">
      <table align="center" width="750">
        <tr align="center">
          <td colspan="6"><h2>Create an Account</h2></td>
        </tr>
        <tr>
          <td align="right"> Customer Name:</td>
          <td><input type="text" name="c_name" required></input></td>
        </tr>

        <tr>
          <td align="right">Customer Email:</td>
          <td><input type="text" name="c_email" required></input></td>
        </tr>

        <tr>
          <td align="right">Customer Password:</td>
          <td><input type="password" name="c_pass" required></input></td>
          <br><br>
        </tr>

        <tr>
          <td align="right">Customer Address:</td>
          <td><input type="text" name="c_address" required></input></td>
        </tr>

        <tr>
          <td align="right">Customer City:</td>
          <td><input type="text" name="c_city" required></input></td>
        </tr>

        <tr>
          <td align="right">Customer Country</td>
          <td>
            <select name="c_country" required>
              <option>Select a Country</option>
              <option>United States</option>
              <option>Afghanistan</option>
              <option>India</option>
              <option>Japan</option>
              <option>Pakistan</option>
              <option>Israel</option>
              <option>Mexico</option>
              <option>Canada</option>
              <option>Brazil</option>
              <option>Uganda</option>
              <option>Kenya</option>
              <option>Tanzania</option>
              <option>England</option>
              <option>France</option>
              <option>China</option>
              <option>Belgium</option>
              <option>Argentina</option>
              <option>Peru</option>
              <option>Germany</option>
              <option>United Arab Emirates</option>
              <option>Colombia</option>
              <option>South Africa</option>
            </select>
          </td>
        </tr>

        <tr>
          <td align="right">Customer Image:</td>
          <td><input type="file" name="c_image" required></input></td>
          <br><br>
        </tr>

        <tr>
          <td align="right">Customer Contact:</td>
          <td><input type="text" name="c_contact" required></input></td>
        </tr>

        <tr align="center">
          <td colspan="6"><input type="submit" name="register" value="Create Account"></input></td>
        </tr>
      </table>
  </form>

<p></p>
<p></p>
<!--**************************End Customer Registration*****************************-->

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
  // defining variables and setting them to empty
  $c_name = $c_email = $c_pass = $c_address = $c_city = $c_country = $c_image = $c_image_tmp = $c_contact = "";
  $c_nameErr = $c_emailErr = $c_passErr = $c_addressErr = $c_cityErr = $c_imageErr = $c_image_tmpErr = $c_contactErr = "";
  
  if(isset($_POST['register'])){
    // Retrieves and stores USER IP Address
    $ip = getIp();
    // Validate and Sanitize Customer Inputs
    $c_name = test_input($_POST['c_name']);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$c_name)) {
        $c_nameErr = "Only letters and white space allowed"; 
        echo "<script>alert('Please try again! $c_nameErr')</script>";
        exit();
    }
    
    $c_email = test_input($_POST['c_email']);
    // filter email to validate input
    if (!filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
        $c_emailErr = "Invalid email format";
        echo "<script>alert('Please try again! $c_emailErr')</script>";
        exit();
    }
    
    $c_pass = test_input($_POST['c_pass']);
    // check for password length
    if (iconv_strlen($c_pass) < 8) {
        $c_passErr = "Password should be longer than 8 characters";
        echo "<script>alert('Please try again! $c_passErr')</script>";
        exit();
    }
 
    $c_address = test_input($_POST['c_address']);
    // check if email contains valid chars
    if (!preg_match("/^[a-z0-9-]+$/i",$c_address)) {
        $c_addressErr = "Invalid address"; 
        echo "<script>alert('Please try again! $c_addressErr')</script>";
        exit();
    }
    
    $c_city = test_input($_POST['c_city']);
    // check if city name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$c_city)) {
        $c_cityErr = "Only letters and white space allowed";
        echo "<script>alert('Please try again! $c_cityErr')</script>";
        exit();
    }
    
    $c_country = test_input($_POST['c_country']);
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    
    $c_contact = test_input($_POST['c_contact']);
    // check if city name only contains letters and whitespace
    if (!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/",$c_contact)) {
        $c_contactErr = "Please enter a valid phone number";
        echo "<script>alert('Please try again! $c_contactErr')</script>";
        exit();
    }
    
    // Function used to sanitize and validate use input
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    // Insert into customer table values ('$ip', '$c_name', '$c_email', '$c_pass', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image')
    $insert_c = "INSERT INTO customers (customer_ip, customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image)
      VALUES (?,?,?,?,?,?,?,?,?)";

        // Create prepared statement
        if($stmt = $con -> prepare($insert_c)){

            // moves uploaded files into folder called customer_images
            // Vulnerable to Path Traversal
            move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

            // bind parameters for makers
            $stmt ->bind_param('sssssssss', $ip, $c_name, $c_email, $c_pass, $c_country, $c_city, $c_contact, $c_address, $c_image);

            // execute query
            $stmt ->execute();

            // Insect all from cart table where IP addess is equal to user's IP
            $sel_cart = "SELECT * FROM cart WHERE ip_add=?";

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

              if($check_cart == 0){

                // Register User Session
                $_SESSION['customer_email'] = $c_email;

                echo "<script>alert('Account has been created successfully, thanks!')</script>";
                echo "<script>window.open('customer/my_account.php', '_self')</script>";
              } else {

                // Register User Session
                $_SESSION['customer_email'] = $c_email;

                echo "<script>alert('Account already exists')</script>";
                echo "<script>window.open('checkout.php', '_self')</script>";
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
