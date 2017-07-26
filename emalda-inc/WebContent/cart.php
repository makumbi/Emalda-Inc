<!DOCTYPE html>
<?php
// We begin session
session_start();
// Retrieves SQLFunctions php page and includes it to this page (index.php)
// Functions in SQLFunctions will be called upon
include("sql/SQLFunctions.php");
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
  
<style>
	@import url('resources/css/styles.css');                                           /* Custom styles */
</style>
<body  id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
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
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log-out</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- ************************* End NavBar *************************** -->
<?php
	if(isset($_SESSION['customer_email'])){
            // Validate customer email
            $user = test_input($validateUser) = $_SESSION['customer_email'];
            
            // Function used to sanitize and validate use input
            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }

	}else {

            $user = "Guest";
	}

?>
<!--**************************Begin Header*****************************-->
<header class="header-height">
		<div class="jumbotron text-center">
			<div class="position-text">
				<h2>Welcome: <?php echo $user;?> </h2>
				<p>Shopping cart!</p>
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

  		<tr align="center" id="table">
                    <th>Remove</th>
                    <th>Product(s)</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
  		</tr>

            <?php
                // declare total variable and set it to 0
                // Will be used to store total price for products later on
                $total = 0;
                // declare array and set it to 0.
                // It will store total prices
  		$arrTotal [0] = 0;
                // declare array and set it to 0
                $phpArr[0] = 0;
                // Utilize global build in keyword to connect to our database
  		global $con;

		// Using SQLFunctions page, getIp() function is used to get and store user IP address
  		$ip = getIp();

                // SQL query statement
                // Select all from cart table where IP address is equal to IP address stored in $ip variable
                // $ip variable is the user's variable
  		$sel_price = "SELECT * FROM cart WHERE ip_add='$ip'";
		// Run query
  		$run_price = mysqli_query($con, $sel_price);

                $counter = 0;
                // Utilizing mysqli built in statement, results are fetched in an array format
                // Then stored inside $p_price variable
  		while($p_price = mysqli_fetch_array($run_price)){
                        // $p_price variable looks for product IDS
                        // Once it finds them they are stored inside variable $pro_id
  			$pro_id = $p_price['p_id'];
                        // SQL query statement
                        // Select all from products table where product_id is equal to product ID stored in $pro_id variable
  			$sel_price = "SELECT * FROM products WHERE product_id='$pro_id'";
			// Run query
  			$run_pro_price = mysqli_query($con, $sel_price);
			// Utilizing mysqli built in statement, results are fetched in an array format
			// Then stored inside $pp_price variable
  			while($pp_price = mysqli_fetch_array($run_pro_price)){
                                // Using $pp_price, all the product prices are stored inside an array
                                // This array is then placed stored inside variable $product_price
  				$product_price = array($pp_price['product_price']);
  				$product_title = $pp_price['product_title'];
  				$product_image = $pp_price['product_image'];
  				$single_price = $pp_price['product_price'];

				$changing_C = "t" . $counter ;

  				$values = array_sum($product_price);

				$phpArr[$counter] = $pro_id;

  		?>

<tr align="center">
    <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
    <td><?php echo $product_title; ?><br>
    <img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60">
    </td>
    <td ><input id= "<?php echo $changing_C; ?>"  onfocus="myFunction()" onfocusout="myFunction()"
    type="text" size="3" name="<?php echo $pro_id; ?>"
    value="<?php $counter = $counter + 1; echo $counter;  ?>"></td>

<script>

        var arr;
        for (var z= 0; z < parseInt("<?php echo $counter; ?>"); z++){
        nword = "item" + z;
        document.getElementById("t" + z).value = localStorage.getItem(nword);
}


function myFunction(){
        var size = "<?php echo $counter; ?>";
        var i = 0;

        while  (i< size){
                var x = document.getElementById("t" + i).value;
                word = "item" + i;
                localStorage.setItem(word, x);
                i++;

        }

};
</script>

            <?php
                if(isset($_POST['update_cart'])){

                    foreach ( $phpArr as $tableId){
                            $nqty = $_POST[$tableId];
                            $update_stmt = "UPDATE cart SET qty = '$nqty' WHERE p_id='$tableId'";
                            $run_qty = mysqli_query($con, $update_stmt);

                    }
                }
            ?>

            <td><?php $get_stmt = "SELECT p_id, qty FROM cart";
                    $get_data = mysqli_query($con, $get_stmt); $numEntered = 0;
                    while($row = $get_data->fetch_assoc()) {
                            if($row["p_id"] == $pro_id) {$numEntered = $row["qty"];}
                    }
                    $finCost = $single_price * $numEntered;
                    echo "$" . $finCost; $arrTotal[$counter - 1] = $finCost; ?></td>
  		</tr>

  		<?php $total = 0;
			foreach ($arrTotal as $rowVal){
			$total += $rowVal;
			}
		}
		} ?>

  		<tr align="right">
  			<td colspan="4"><b>Sub Total</b></td>
  			<td><?php  echo "$" .  $total; ?></td>
  		</tr>

  		<tr align="center">
  			<td colspan="2"><input     onclick="myFunction2()"
					type="submit" name="update_cart" value="Update Cart"></td>
  			<td><input type="submit" name="continue" value="Continue Shopping"></td>
  			<td><a href="checkout.php" style="text-decoration: none; color:black;">Checkout</a></td>
  		</tr>
  	</table>
  </form>

   <?php

  // function updatecart(){

                // Utilize global build in keyword to connect to our database
                global $con;

                // Using SQLFunctions page, getIp() function is used to get and store user IP address
                $ip = getIp();
                // If update cart is set, jump into the if-else statement
	   	if(isset($_POST['update_cart'])){

                    foreach($_POST['remove'] as $remove_id){
                        // Delete from cart table where product_id is equal to $remove_id variable and also where IP address is equal to $ip variable
                        $delete_product = "DELETE FROM cart WHERE p_id='$remove_id' AND ip_add='$ip'";
                        // Run query
                        $run_delete = mysqli_query($con, $delete_product);
                        // If query is succesfull
                        // refresh cart.php page
                        if($run_delete){
                                echo "<script>window.open('cart.php', '_self')</script>";
                        }
                    }
	   	}
			// If continue buttom is clicked
	   	if(isset($_POST['continue'])){
				// send user back to index page, then direct him to the products section
				echo "<script>window.open('index.php#products', '_self')</script>";
		}

		// Added an @ so that updatecart function is not invoked
		// when qty is posted
		function updatecart() { echo ""; }
		echo @$up_cart = updatecart();

	// }

   ?>

	 <script>
 	/*for (var nC = 0; nC < )
 	document.getElementById("") */
 	</script>



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
