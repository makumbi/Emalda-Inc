
<?php
include('includes/db.php');

if(mysqli_connect_errno()){
	echo "The connection was not established: " . mysqli_connect_error();
}
/*
	function insertContact ($firstname, $lastname, $contactEmail, $comment)
	{

		// Connect to the database
		$mysqli = connectdb();

		// Now we can insert
		$Query = "INSERT INTO CustomerContact
	          (firstName,lastName,eMail,comment)
	           VALUES (?,?,?,?)";

		$stmt = $mysqli -> prepare($Query);
		$stmt -> bind_param("ssss", $firstname, $lastname, $contactEmail, $comment);

		$Success=false;
		if($stmt -> execute()){
			$Success=true;
		}
		$stmt -> close();
		$mysqli ->close();
		return $Success;
	}
*/
	// getting the user IP address
	function mygetIp() {

			// check for shared internet/ISP IP
			if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
				return $_SERVER['HTTP_CLIENT_IP'];
			}

			// check for IPs passing through proxies
			if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				// check if multiple ips exist in var
				if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
					$iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
					foreach ($iplist as $ip) {
						if (myValidate_ip($ip))
							return $ip;
					}
				} else {
					if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
						return $_SERVER['HTTP_X_FORWARDED_FOR'];
				}
			}
			if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
				return $_SERVER['HTTP_X_FORWARDED'];
			if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
				return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
			if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
				return $_SERVER['HTTP_FORWARDED_FOR'];
			if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
				return $_SERVER['HTTP_FORWARDED'];

			// return unreliable ip since all else failed
			return $_SERVER['REMOTE_ADDR'];
		}

		/**
		 * Ensures an ip address is both a valid IP and does not fall within
		 * a private network range.
		 */
		function myValidate_ip($ip) {
			if (strtolower($ip) === 'unknown')
				return false;

			// generate ipv4 network address
			$ip = ip2long($ip);

			// if the ip is set and not equivalent to 255.255.255.255
			if ($ip !== false && $ip !== -1) {
				// make sure to get unsigned long representation of ip
				// due to discrepancies between 32 and 64 bit OSes and
				// signed numbers (ints default to signed in PHP)
				$ip = sprintf('%u', $ip);
				// do private network range checking
				if ($ip >= 0 && $ip <= 50331647) return false;
				if ($ip >= 167772160 && $ip <= 184549375) return false;
				if ($ip >= 2130706432 && $ip <= 2147483647) return false;
				if ($ip >= 2851995648 && $ip <= 2852061183) return false;
				if ($ip >= 2886729728 && $ip <= 2887778303) return false;
				if ($ip >= 3221225984 && $ip <= 3221226239) return false;
				if ($ip >= 3232235520 && $ip <= 3232301055) return false;
				if ($ip >= 4294967040) return false;
			}
			return true;
	}

	// creating the shopping cart
	function mycart() {
		// Utilize global build in keyword to connect to our database
		global $con;
		// if add_cart is set, GET the information
		// GET is used to retrive data instead of position
		// this is because later we will need to get product id from the URL
		if(isset($_GET['add_cart'])){
			//getIp() function is used to get and store user IP address
			$ip = mygetIp();
			// retrieve information using get and store it inside variable $pro_id
			$pro_id = $_GET['add_cart'];
			// Select all from cart table where IP address is equal to variable $ip and also where product_id is equal to variable $pro_id
			$check_pro = "SELECT * FROM cart WHERE ip_add='$ip' AND p_id='$pro_id'";
			// Run query
			$run_check = mysqli_query($con, $check_pro);
			// Utilizing if-else statement, check the number of rows
			// if num of rows is greater than 0, echo alert script letting the user know product already exists in shopping cart
			// if num of rows is not greater than 0, query values into cart table in the database
			if(mysqli_num_rows($run_check)>0){
				echo "<script>alert('Product is already inserted in shopping cart!');</script>";
				echo "<script>window.open('index.php#products', '_self')</script>";
			}else {
				// Insert into cart table values stored inside variables $pro_id and $ip
				$insert_pro = "INSERT INTO cart (p_id, ip_add) VALUES ('$pro_id','$ip')";
				// Run query
				$run_pro = mysqli_query($con, $insert_pro);

				echo "<script>window.open('index.php#products', '_self')</script>";
			}
		}
	}

	// getting total items stored in cart
	function mytotal_items() {

		if(isset($_GET['add_cart'])){

			// Utilize global build in keyword to connect to our database
			global $con;

			// getIp() function is used to get and store user IP address
			$ip = mygetIp();
			// Select all from cart table where IP address is equal to variable $ip
			$get_items = "SELECT * FROM cart WHERE ip_add='$ip'";
			// Run query
			$run_items = mysqli_query($con, $get_items);
			// Get results and store them in mysqli_num_rows built in Functions
			// the function besically counts the number of rows, which are then stored in variable $count_items
			$count_items = mysqli_num_rows($run_items);
		} else {

			// Utilize global build in keyword to connect to our database
			global $con;

			// getIp() function is used to get and store user IP address
			$ip = mygetIp();
			// Select all from cart table where IP address is equal to variable $ip
			$get_items = "SELECT * FROM cart WHERE ip_add='$ip'";
			// Run query
			$run_items = mysqli_query($con, $get_items);
			// Get results and store them in mysqli_num_rows built in Functions
			// the function besically counts the number of rows, which are then stored in variable $count_items
			$count_items = mysqli_num_rows($run_items);
		}

		echo $count_items;
	}

	// getting total price from items in shopping cart
	function mytotal_price() {
		// declare variable $total and set it to 0
		$total = 0;

		// Utilize global build in keyword to connect to our database
		global $con;
		// getIp() function is used to get and store user IP address
		$ip = mygetIp();
		// Select all from cart table where IP address equals variable $ip
		$sel_price = "SELECT * FROM cart WHERE ip_add='$ip'";
		// Run query
		$run_price = mysqli_query($con, $sel_price);
		// place results inside mysqli_fetch_array.
		// loop through until all the prices have been stored to variable $p_price
		while($p_price = mysqli_fetch_array($run_price)){
			// Retrieve all product prices by there ids
			// store all the ids into variable $pro_id
			$pro_id = $p_price['p_id'];
			// Select all from products table where product_id equals $pro_id
			$sel_price = "SELECT * FROM products WHERE product_id='$pro_id'";
			// Run query
			$run_pro_price = mysqli_query($con, $sel_price);
			// Place results into mysqli_fetch_array
			// loop through until all prices are stored into variable $pp_price
			while($pp_price = mysqli_fetch_array($run_pro_price)){
				// Store all product prices into an array and place them into variable $product_price
				$product_price = array($pp_price['product_price']);
				// Utilizing built in function, store $product_price into array_sum placing them into variable $values
				$values = array_sum($product_price);
				$total += $values;
			}

		}

		echo "$" . $total;
	}

	// getting products and displaying them
	function mygetProduct(){

		global $con;
		// Select all from products table ordering by random. Limit the results from 0 to 6
		$get_pro = "SELECT * FROM products ORDER BY RAND() LIMIT 0,6";
		// Run query
		$run_pro = mysqli_query($con, $get_pro);
		// Place results into mysqli_fetch_array
		// loop through until all products are stored into variable $row
		while($row = mysqli_fetch_array($run_pro)){

			$pro_id = $row['product_id'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];


		echo "

			<div id='single_product'>
				<h3>$pro_title</h3>

				<img src='admin_area/product_images/$pro_image' width='200' height='180'>

				<p><b> Price: $ $pro_price</b></p>
				<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
			</div>

		";

		}

	}





?>
