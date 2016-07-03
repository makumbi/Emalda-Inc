<!DOCTYPE html>
<?php
  include('includes/db.php');

  if(isset($_GET['edit_pro'])){

    $get_id = $_GET['edit_pro'];

    $get_pro = "SELECT * FROM products WHERE product_id='$get_id'";

    $run_pro = mysqli_query($con, $get_pro);

    $row_pro = mysqli_fetch_array($run_pro);

      $pro_id = $row_pro['product_id'];
      $pro_title = $row_pro['product_title'];
      $pro_price = $row_pro['product_price'];
      $pro_desc = $row_pro['product_desc'];
      $pro_image = $row_pro['product_image'];
      $pro_keywords = $row_pro['product_keywords'];
}

 ?>
<html>
<head>
	<title>Update Product</title>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
tinymce.init({ selector:'textarea' });
</script>
</head>
<body>
	<div class="row">
	  <div class="col-sm-9">
					<form action="" method="POST" enctype="multipart/form-data">
						<table align="center" width="740" border="2" bgcolor="yellow">

							<tr align="center">
								<td colspan="8"><h2>Edit Product Here</h2></td>
							</tr>

							<tr>
								<td align="center"><b>Product Title:</b></td>
								<td><input type="text" name="product_title" size="60" value="<?php echo $pro_title; ?>"/></td>
							</tr>

							<tr>
								<td align="center"><b>Product Price:</b></td>
								<td><input type="text" name="product_price" value="<?php echo $pro_price; ?>"></td>
							</tr>

							<tr>
								<td align="center"><b>Product Image:</b></td>
								<td><input type="file" name="product_image"/><img src="product_images/<?php echo $pro_image; ?>" width="80" height="80" /></td>
							</tr>


							<tr>
								<td align="center"><b>Product Description:</b></td>
								<td><textarea name="product_desc" cols="20" rows="10"><?php echo $pro_desc; ?></textarea></td>
							</tr>

							<tr>
								<td align="center"><b>Product Keywords:</b></td>
								<td><input type="text" name="product_keywords" size="50" value="<?php echo $pro_keywords; ?>"></td>
							</tr>

							<tr align="center">
								<td colspan="8"><input type="submit" name="update_product" value="Update Product"></td>
							</tr>

						</table>
					</form>
          <br>
          <br>
			</div>
		</div>
</body>
</html>
<?php

	// Form needs to be validated and sanitized!
	if(isset($_POST["update_product"])){

    $update_id = $pro_id;

		// POSTting text data from fields
		$product_title = $_POST["product_title"];
		$product_price = $_POST["product_price"];
		$product_desc = $_POST["product_desc"];
		$product_keywords = $_POST["product_keywords"];

		// POSTting image from field
		$product_image = $_FILES["product_image"]["name"];
		$product_image_tmp = $_FILES["product_image"]["tmp_name"];
		// Utilizing built in function, $product_image_tmp is store inside $product_image
		move_uploaded_file($product_image_tmp, "product_images/$product_image");
		// Insert into products table values $product_title','$product_price','$product_desc','$product_image','$product_keywords
		$update_product = "UPDATE products SET product_title='$product_title', product_price='$product_price', product_desc='$product_desc', product_image='$product_image', product_keywords='$product_keywords'
    WHERE product_id='$update_id'";

		// Run query
		$update_prod = mysqli_query($con, $update_product);
		// If $insert_prod is a success, alert user that product has been inserted into products table
		if($update_prod) {
			echo "<script>alert('Product has been updated!')</script>";
			echo "<script>window.open('index.php?view_products', '_self')</script>";
		}
	}

?>
