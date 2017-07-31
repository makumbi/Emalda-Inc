<!DOCTYPE html>
<?php
// Start session
session_start();

if(!isset($_SESSION['customer_email'])){
		echo "<script>window.open('../customer_login.php', '_self')</script>";
}
else{
// Retrieves SQLFunctions php page and includes it to this page (index.php)
// Functions in SQLFunctions will be called upon
include("../sql/SQLFunctions.php");
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
	@import url('css/styles.css');                                           /* Custom styles */
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
      <a class="navbar-brand" href="../#myPage">Logo</a>
     </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="../#myPage">HOME</a></li>
        <li><a href="../#about">ABOUT</a></li>
        <li><a href="../#products">PRODUCTS</a></li>
        <li><a href="../#farmers">FARMERS</a></li>
        <li><a href="../#contact">CONTACT</a></li>
       </ul>
       <ul class="nav navbar-nav navbar-right">
        <li><a href="my_account.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
        <li><a href="../cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart >> Items:<?php total_items();?> Price:<?php total_price();?></a></li>
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log-out</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- ************************* End NavBar *************************** -->
<?php

	if(isset($_SESSION['customer_email'])){
            // customer email input to be sanitized and validated
            $user_emailTest = $_SESSION['customer_email'];
            
          // Validate and Sanitize Input
          $user_email = test_input($user_emailTest);
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
            
            // Select all from customer table where customer email is equal to user variable
            $get_img = "SELECT * FROM customers WHERE customer_email=?";

            if($stmt = $con -> prepare($get_img)){

            // bind parameters
            $stmt -> bind_param('s', $user_email);

            // execute query
            $stmt ->execute();

            // get results
            $result = $stmt -> get_result();
            // place results inside fetch_array.
            // loop through until all the prices have been stored to variable $p_price
            while($row_img = $result -> fetch_array()){
                // Retrieve customer image
                $c_image = $row_img['customer_image'];
                // Retrieve customer name
                $user_name = $row_img['customer_name'];
            }
        }
?>

<!--**************************Begin Header*****************************-->
<header class="header-height">
    <div class="jumbotron text-center">
        <div class="position-text">
            <h2>Welcome: <?php echo $user_name;?></h2>
            <p>We import fresh foods from African farmers to your door step</p>
            <form class="form-inline" name="userSearch"
                    onsubmit="return validateForm()" method="post" action="results.php" enctype="multipart/form-data">
                    <input type="text" name="user_query" class="form-control" placeholder="Search a product" size="50">
                    <button type="submit" class="btn btn-danger" name="search" value="Search">Search</button>
            </form>
        </div>
    </div>
</header><!--**************************End Header*****************************-->

<!--**************************Begin Company Products*****************************-->
<section class="action-products">
  <div id="products" class="container">
    <div class="container-fluid text-center">
      <div class="container text-center">
        <div class="row">
          <div class="col-sm-3 well">
            <div class="well">
              <p><a href="#">My Profile</a></p>

              <?php
              echo "<img src='customer_images/$c_image' class='img-square' height='160' width='200' alt='Hiking Crew'>";
              ?>
            </div>
            <div class="well">
              <p><a href="my_account.php?my_orders">My Orders</a></p>
              <p><a href="my_account.php?edit_account">Edit Account</a></p>
              <p><a href="my_account.php?change_pass">Change Password</a></p>
              <p><a href="my_account.php?delete_account">Delete Account</a></p>
              <br>
              <h5>My Interests</h5>
              <p>
                <span class="label label-default">News</span>
                <span class="label label-primary">W3Schools</span>
                <span class="label label-success">Labels</span>
                <span class="label label-info">Football</span>
                <span class="label label-warning">Gaming</span>
                <span class="label label-danger">Friends</span>
              </p>
            </div>
            <div class="alert alert-success fade in">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
              <p><strong>Ey!</strong></p>
              People are looking at your profile. Find out who.
            </div>
          </div>
          <div class="col-sm-7">

            <div class="row">
              <div class="col-sm-12">
                <div class="panel panel-default text-left" style="height: 115px;">
                  <div class="panel-body">
                    <p contenteditable="true"><b>Status:</b> Feeling Blue</p>
                    <button type="button" class="btn btn-default btn-sm" style="float: right">
                      <span class="glyphicon glyphicon-thumbs-up"></span> Like
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <?php
              if(isset($_GET['edit_account'])){
                include('edit_account.php');
              }
              if(isset($_GET['change_pass'])){
                include('change_pass.php');
              }
              if(isset($_GET['delete_account'])){
                include('delete_account.php');
              }
            ?>

            <div class="row">
              <div class="col-sm-3">
                <div class="well">
                 <p>John</p>
                 <img src="images/Sagiitta_Avator.jpg" class="img-circle" height="55" width="55" alt="Avatar">
                </div>
              </div>
              <div class="col-sm-9">
                <div class="well">
                  <p>Just Forgot that I had to mention something about someone to someone about how I forgot something,
                    but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <div class="well">
                 <p>Bo</p>
                 <img src="images/models.jpg.png" class="img-circle" height="55" width="55" alt="Avatar">
                </div>
              </div>
              <div class="col-sm-9">
                <div class="well">
                  <p>Just Forgot that I had to mention something about someone to someone about how I forgot something,
                    but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <div class="well">
                 <p>Jane</p>
                 <img src="images/horse-with-hat.png" class="img-circle" height="55" width="55" alt="Avatar">
                </div>
              </div>
              <div class="col-sm-9">
                <div class="well">
                  <p>Just Forgot that I had to mention something about someone to someone about how I forgot something,
                    but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <div class="well">
                 <p>Anja</p>
                 <img src="images/Sagiitta_Avator.jpg" class="img-circle" height="55" width="55" alt="Avatar">
                </div>
              </div>
              <div class="col-sm-9">
                <div class="well">
                  <p>Just Forgot that I had to mention something about someone to someone about how I forgot something,
                    but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-2 well">
            <div class="thumbnail">
              <p>Upcoming Events:</p>
              <img src="images/washington-dc.jpg" alt="Washington D.C" width="395" height="300">
              <p><strong>Washington D.C</strong></p>
              <p>Fri. 27 November 2016</p>
              <button class="btn btn-primary">Info</button>
            </div>
            <div class="thumbnail">
              <p>Past Events:</p>
              <img src="images/uganda_traore[1].jpg" alt="Ugandan Martyrs" width="395" height="300">
              <p><strong>Martyrs Day</strong></p>
              <p>Sat. 6 June 2016</p>
              <button class="btn btn-primary">Info</button>
            </div>
            <div class="well">
              <p>ADS</p>
            </div>
            <div class="well">
              <p>ADS</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--**************************End Company Products*****************************-->

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

<?php }} ?>