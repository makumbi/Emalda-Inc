<!DOCTYPE html>
<?php

  if(!isset($_SESSION['user_email'])){
      echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
  }
  else{

?>
<html>
  <head>
    <title>View All Products</title>
  <link rel="stylesheet" href="css/styles.css" media="all"/>
  </head>
<body>
<div class="row">
  <div class="col-sm-9">
    <table width="745" align="center" bgcolor="pink">
        <tr>
            <td colspan="6" align="center"><h2>View All Customers Here</h2></td>
        </tr>

        <tr align="center" bgcolor="skyblue">
          <th>S.N</th>
          <th>Name</th>
          <th>Email</th>
          <th>Image</th>
          <th>Delete</th>
        </tr>
        <?php
          include("includes/db.php");

          $get_c = "SELECT * FROM customers";

          $run_c = mysqli_query($con, $get_c);

          $i = 0;
          while ($row_c = mysqli_fetch_array($run_c)) {

            $c_id = $row_c['customer_id'];
            $c_name = $row_c['customer_name'];
            $c_email = $row_c['customer_email'];
            $c_image = $row_c['customer_image'];
            $i++;

        ?>
        <tr align="center">
          <td><?php echo $i; ?></td>
          <td><?php echo $c_name; ?></td>
          <td><?php echo $c_email; ?></td>
          <td><img src="../customer/customer_images/<?php echo $c_image; ?>" width="80" height="80"</td>
          <td><a href="delete_c.php?delete_c=<?php echo $c_id; ?>">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <br>
  </div>
</div>
</body>
</html>

<?php } ?>
