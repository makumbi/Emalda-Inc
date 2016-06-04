<!DOCTYPE html>
	<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
	<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<?php
include("sql/SQLFunctions.php");
?>

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
      <a class="navbar-brand" href="#">Logo</a>
     </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="#myPage">HOME</a></li>
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#products">PRODUCTS</a></li>
        <li><a href="#farmers">FARMERS</a></li>
        <li><a href="#contact">CONTACT</a></li>
       </ul>
       <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
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
				<h1>Cart</h1>
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
<div class="container-fluid">

  <form action="" method="post" enctype="multipart/form-data">
  	
  	<table align="center" width="730" bgcolor="yellow">	
  		
  		<tr align="center">
  			<th>Remove</th>
  			<th>Product(s)</th>
  			<th>Quantity</th>
  			<th>Total Price</th>
  		</tr>
  		
  		<?php 
  		
  		$total = 0;
  		
  		global $con;
  		
  		$ip = getIp();
  		
  		$sel_price = "SELECT * FROM cart WHERE ip_add='$ip'";
  		
  		$run_price = mysqli_query($con, $sel_price);
  		
  		while($p_price = mysqli_fetch_array($run_price)){
  				
  			$pro_id = $p_price['p_id'];
  				
  			$sel_price = "SELECT * FROM products WHERE product_id='$pro_id'";
  				
  			$run_pro_price = mysqli_query($con, $sel_price);
  				
  			while($pp_price = mysqli_fetch_array($run_pro_price)){
  		
  				$product_price = array($pp_price['product_price']);
  				$product_title = $pp_price['product_title'];
  				$product_image = $pp_price['product_image'];
  				$single_price = $pp_price['product_price'];
  				
  				$values = array_sum($product_price);
  		
  				$total += $values;

  		?>
  		
  		<tr align="center">
  			<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
  			<td><?php echo $product_title; ?><br>
  			<img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60">
  			</td>
  			<td><input type="text" size="3" name="qty"></td>
  			<td><?php echo "$" . $single_price;?></td>
  		</tr>
  		
  		<?php } } ?>
  		
  		<tr align="right">
  			<td colspan="4"><b>Sub Total</b></td>
  			<td><?php echo "$" .  $total; ?></td>
  		</tr>
  		
  		<tr align="center">
  			<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"></td>
  			<td><input type="submit" name="continue" value="Continue Shopping"></td>
  			<td><button><a href="checkout.php" style="text-decoration: none; color:black;">Checkout</a></button></td>
  		</tr>
  	</table>
  </form>	
   
   <?php 

   
	$ip = getIp();
   
   	if(isset($_POST['update_cart'])){

		foreach($_POST['remove'] as $remove_id){
			
			$delete_product = "DELETE FROM cart WHERE p_id='$remove_id' AND ip_add='$ip'";			
			$run_delete = mysqli_query($con, $delete_product);
			
			if($run_delete){
				echo "<script>window.open('cart.php', '_self')</script>";
			}

		}
   
   	}
   	
   	if(isset($_POST['continue'])){

		echo "<script>window.open('index.php#products', '_self')</script>";
	}
   
   
   ?>
   
   
   
   
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
	<p>web by: <a href="index.html" target="_blank" data-toggle="tooltip">emalda.com</a></p>
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