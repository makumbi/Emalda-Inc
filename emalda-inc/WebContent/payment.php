<div>
<?php
include('includes/db.php');
include('sql/SQLFunctions.php');
// declare variable $total and set it to 0
$total = 0;

// getIp() function is used to get and store user IP address
$ip = getIp();
// Select all from cart table where IP address equals variable $ip
$sel_price = "SELECT * FROM cart WHERE ip_add=?";

if($stmt = $con -> prepare($sel_price)){

// bind parameters
$stmt -> bind_param('i', $ip);

// execute query
$stmt ->execute();

// get results
$result = $stmt -> get_result();
// place results inside fetch_array.
// loop through until all the prices have been stored to variable $p_price
while($p_price = $result -> fetch_array()){
  // Retrieve all product prices by there ids
  // store all the ids into variable $pro_id
  $pro_id = $p_price['p_id'];
  // Select all from products table where product_id equals $pro_id
  $sel_price = "SELECT * FROM products WHERE product_id=?";

  if($stmt = $con -> prepare($sel_price)){

    // bind parameters
    $stmt -> bind_param('i', $pro_id);

    // execute query
    $stmt ->execute();

    // get results
    $result = $stmt -> get_result();

  // Place results into fetch_array
  // loop through until all prices are stored into variable $pp_price
  while($pp_price = $result -> fetch_array()){
    // Store all product prices into an array and place them into variable $product_price
    $product_price = array($pp_price['product_price']);
    $product_name = $pp_price['product_title'];
    // Utilizing built in function, store $product_price into array_sum placing them into variable $values
    $values = array_sum($product_price);
    $total += $values;

?>

<h2 align="center">Pay now with PayPal:</h2>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="alexmakumbi15-business@gmail.com">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
  <input type="hidden" name="amount" value="<?php echo $total; ?>">
  <input type="hidden" name="currency_code" value="USD">
  <!--Redirects to online server -->
  <input type="hidden" name="return" value="">
  <input type="hidden" name="cancel_return" value="">
  <!-- Display the payment button. -->
  <input type="image" name="submit" border="0"
  src="images/Make-a-Payment-button.png"
  alt="PayPal - The safer, easier way to pay online">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>
</div>
<?php }}

}
// free results
$stmt ->free_result();
// close statement
$stmt ->close();
}
// close connection
$con -> close();
?>
