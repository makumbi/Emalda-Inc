<?php
  include('includes/db.php');
  $user = $_SESSION['customer_email'];

      // Select all from customer table where customer email is equal to user variable
      $get_customer = "SELECT * FROM customers WHERE customer_email='$user'";
      // Run query
      $run_customer = mysqli_query($con, $get_customer);
      // Retrieve rows that meet our search
      $row_customer = mysqli_fetch_array($run_customer);

      $c_id = $row_customer['customer_id'];
      $name = $row_customer['customer_name'];
      $email = $row_customer['customer_email'];
      $pass = $row_customer['customer_pass'];
      $country = $row_customer['customer_country'];
      $city = $row_customer['customer_city'];
      $contact = $row_customer['customer_contact'];
      $address  = $row_customer['customer_address'];
      $image = $row_customer['customer_image'];
?>

<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-info">
      <div class="panel-heading" style="height: 27px;"><b>Update Your Account</b></div>
      <div class="panel-body" Style="height: 400px;">
      <!--**************************Begin Customer Account Edits*****************************-->
        <form action="" method="post" enctype="multipart/form-data">
            <table align="center" width="750">
              <tr>
                <td align="right"> Customer Name:</td>
                <td><input type="text" name="c_name" value="<?php echo $name; ?>" required></input></td>
              </tr>

              <tr>
                <td align="right">Customer Email:</td>
                <td><input type="text" name="c_email" value="<?php echo $email; ?>" required></input></td>
              </tr>

              <tr>
                <td align="right">Customer Password:</td>
                <td><input type="password" name="c_pass" value="<?php echo $pass; ?>" required></input></td>
                <br><br>
              </tr>

              <tr>
                <td align="right">Customer Address:</td>
                <td><input type="text" name="c_address" value="<?php echo $address; ?>" required></input></td>
              </tr>

              <tr>
                <td align="right">Customer City:</td>
                <td><input type="text" name="c_city" value="<?php echo $city; ?>" required></input></td>
              </tr>

              <tr>
                <td align="right">Customer Country</td>
                <td>
                  <select name="c_country" disabled>
                    <option><?php echo $country; ?></option>
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
                <td><input type="file" name="c_image"></input></td>
              </tr>

              <tr>
                <td align="right">Customer Contact:</td>
                <td><input type="text" name="c_contact" value="<?php echo $contact; ?>" required></input></td>
              </tr>

              <tr align="center">
                <td colspan="6"><input type="submit" name="update" value="Update Account"></input></td>
              </tr>
            </table>
        </form>
      <!--**************************End Customer Account Edits*****************************-->
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_POST['update'])){
    // Retrieves and stores USER IP Address
    $ip = getIp();

    $customer_id = $c_id;
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_address = $_POST['c_address'];
    $c_city = $_POST['c_city'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_contact = $_POST['c_contact'];

    // moves uploaded files into folder called customer_images
    move_uploaded_file($c_image_tmp, "customer_images/$c_image");
    // Insert into customer table values ('$ip', '$c_name', '$c_email', '$c_pass', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image')
    $update_c = "UPDATE customers SET customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass', customer_city='$c_city', customer_contact='$c_contact', customer_address='$c_address', customer_image='$c_image'
                WHERE customer_id='$customer_id'";
    // Run query
    $run_update = mysqli_query($con, $update_c);

    if($run_update){
      echo "<script>alert('Your account succesfully updated!')</script>";
      echo "<script>window.open('my_account.php', '_self')</script>";
    }
  }

?>
