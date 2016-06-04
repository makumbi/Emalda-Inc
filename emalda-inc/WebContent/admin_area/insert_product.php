<!DOCTYPE html>
<html>
<head>
	<title>Insert Product</title>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
tinymce.init({ selector:'textarea' });
</script>
</head>
<body bgcolor="skyblue">

	<form action="insert_product.php" method="POST" enctype="multipart/form-data">
		<table align="center" width="750" border="2" bgcolor="orange">
		
			<tr align="center">
				<td colspan="8"><h2>Insert New POST Here</h2></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Title:</b></td>
				<td><input type="text" name="product_title" size="60" required></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Price:</b></td>
				<td><input type="text" name="product_price" required></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Image:</b></td>
				<td><input type="file" name="product_image"></td>
			</tr>
			
			
			<tr>
				<td align="right"><b>Product Discription:</b></td>
				<td><textarea name="product_desc" cols="20" rows="10"></textarea></td>
			</tr>
			
			<tr>
				<td align="right"><b>Product Keywords:</b></td>
				<td><input type="text" name="product_keywords" size="50"></td>
			</tr>
			
			<tr align="center">
				<td colspan="8"><input type="submit" name="insert_POST" value="Insert Now"></td>
			</tr>
			
		</table>
	</form>

</body>
</html>
<?php 


/* Connect to local DB */
$con = mysqli_connect("localhost","root", "", "ecommerce");

	// Form needs to be validated and sanitized!
	if(isset($_POST["insert_POST"])){

		// POSTting text data from fields
		$product_title = $_POST["product_title"];
		$product_price = $_POST["product_price"];
		$product_desc = $_POST["product_desc"];	
		$product_keywords = $_POST["product_keywords"];
		
		// POSTting image from field
		$product_image = $_FILES["product_image"]["name"];
		$product_image_tmp = $_FILES["product_image"]["tmp_name"];
		
		move_uploaded_file($product_image_tmp, "product_images/$product_image");
		
		$insert_product = "INSERT INTO products (product_title, product_price, product_desc, product_image, product_keywords)
		VALUES ('$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
		
		$insert_prod = mysqli_query($con, $insert_product);
		
		if($insert_prod) {
			echo "<script>alert('Product has been inserted')</script>";
			echo "<script>window.open('insert_product.php', '_self')</script>";
		}
	}
	
?>


