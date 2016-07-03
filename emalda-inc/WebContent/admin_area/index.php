<?php
  session_start();

  if(!isset($_SESSION['user_email'])){
      echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
  }
  else{

?>

<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<title>This is Admin Panel</title>												<!--Change Title-->
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
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- HTML5 shim for IE backwards compatibility -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<style>
	@import url('css/styles.css');                                           /* Custom styles */
</style>
<body>

  <!--  <div id="header"></div> -->
  <nav class="navbar navbar-inverse visible-xs">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Logo</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Dashboard</a></li>
          <li><a href="index.php?view_products">View All Products</a></li>
          <li><a href="index.php?insert_product">Insert New Product</a></li>
          <li><a href="index.php?view_customers">View Customer</a></li>
          <li><a href="index.php?view_orders">View Orders</a></li>
          <li><a href="index.php?view_payments">View Payments</a></li>
          <li><a href="logout.php">Admin Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav hidden-xs">
        <h2>Logo</h2>
        <ul class="nav nav-pills nav-stacked">
          <li class="active"><a href="index.php">Dashboard</a></li>
          <li><a href="index.php?view_products">View All Products</a></li>
          <li><a href="index.php?insert_product">Insert New Product</a></li>
          <li><a href="index.php?view_customers">View Customer</a></li>
          <li><a href="index.php?view_orders">View Orders</a></li>
          <li><a href="index.php?view_payments">View Payments</a></li>
          <li><a href="logout.php">Admin Logout</a></li>
        </ul><br>
      </div>
      <br>

      <div class="col-sm-9">
        <div class="well">
          <h4>Dashboard</h4>
          <p>Some text..</p>
        </div>

        <?php
          if(isset($_GET['insert_product'])){
            include('insert_product.php');
          }
          if(isset($_GET['view_products'])){
            include('view_products.php');
          }
          if(isset($_GET['edit_pro'])){
            include('edit_pro.php');
          }
          if(isset($_GET['delete_pro'])){
            include('delete_pro.php');
          }
          if(isset($_GET['view_customers'])){
            include('view_customers.php');
          }
        ?>

        <div class="row">
          <div class="col-sm-3">
            <div class="well">
              <h4>Users</h4>
              <p>1 Million</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="well">
              <h4>Pages</h4>
              <p>100 Million</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="well">
              <h4>Sessions</h4>
              <p>10 Million</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="well">
              <h4>Bounce</h4>
              <p>30%</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="well">
              <p>Text</p>
              <p>Text</p>
              <p>Text</p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="well">
              <p>Text</p>
              <p>Text</p>
              <p>Text</p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="well">
              <p>Text</p>
              <p>Text</p>
              <p>Text</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8">
            <div class="well">
              <p>Text</p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="well">
              <p>Text</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
<?php } ?>
