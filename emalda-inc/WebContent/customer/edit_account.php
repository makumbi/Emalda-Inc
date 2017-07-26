<?php
  include('includes/db.php');
  
  // Input should be validated
  $userEmail = test_input($userEmailValidation) = $_SESSION['customer_email'];
  global $email;
    
    // Function used to sanitize and validate use input
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
      // set SQL statement and execute
    $sel_user = "SELECT * FROM customers WHERE customer_email=?";
    
    if($stmt = $con -> prepare($sel_user)){

        // bind parameters
        $stmt -> bind_param('s', $userEmail);
        
        // execute query
        $stmt -> execute();    
  
        // get results
        $result = $stmt -> get_result();
        
        while($row_customer = $result -> fetch_array()){  
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
                <td align="right"> Name:</td>
                <td><input type="text" name="c_name" value="<?php echo $name; ?>" ></input></td>
              </tr>

              <tr>
                <td align="right">Email:</td>
                <td><input type="text" name="c_email" value="<?php echo $email; ?>" ></input></td>
              </tr>

              <tr>
                <td align="right">Password:</td>
                <td><input type="password" name="c_pass" value="<?php echo $pass; ?>" ></input></td>
                <br><br>
              </tr>

              <tr>
                <td align="right">Address:</td>
                <td><input type="text" name="c_address" value="<?php echo $address; ?>" ></input></td>
              </tr>

              <tr>
                <td align="right">City:</td>
                <td><input type="text" name="c_city" value="<?php echo $city; ?>" ></input></td>
              </tr>

              <tr>
                <td align="right">Country</td>
                <td>
                  <select name="c_country">
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
                <td align="right">Image:</td>
                <td><input type="file" name="c_image" required></input></td>
              </tr>

              <tr>
                <td align="right">Contact:</td>
                <td><input type="text" name="c_contact" value="<?php echo $contact; ?>" ></input></td>
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
        }
    }
?>
<?php
// defining variables and setting them to empty
$c_name = $c_email = $c_pass = $c_address = $c_city = $c_country = $c_image = $c_image_tmp = $c_contact = "";
$c_nameErr = $c_emailErr = $c_passErr = $c_addressErr = $c_cityErr = $c_imageErr = $c_image_tmpErr = $c_contactErr = "";
  

if(isset($_POST['update'])){
    // Retrieves and stores USER IP Address
    $ip = getIp();
    // user inputs should be sanitized/validated
    $c_name = test_input($_POST['c_name']);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$c_name)) {
        $c_nameErr = "Only letters and white space allowed"; 
        echo "<script>alert('Please try again! $c_nameErr')</script>";
        exit();
    }
    
    $c_email = test_input($_POST['c_email']);
    // filter email to validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $c_emailErr = "Invalid email format";
        echo "<script>alert('Please try again! $c_emailErr')</script>";
        exit();
    }
    
    $c_pass = test_input($_POST['c_pass']);
    // check for password length
    if (iconv_strlen($c_pass) < 8) {
        $c_passErr = "Password should be longer than 8 characters";
        echo "<script>alert('Please try again! $c_passErr')</script>";
        exit();
    }
 
    $c_address = test_input($_POST['c_address']);
    // check if email contains valid chars
    if (!preg_match("/^[a-z0-9-]+$/i",$c_address)) {
        $c_addressErr = "Invalid address"; 
        echo "<script>alert('Please try again! $c_addressErr')</script>";
        exit();
    }
    
    $c_city = test_input($_POST['c_city']);
    // check if city name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$c_name)) {
        $c_cityErr = "Only letters and white space allowed";
        echo "<script>alert('Please try again! $c_cityErr')</script>";
        exit();
    }
    
    $c_country = test_input($_POST['c_country']);
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    
    $c_contact = test_input($_POST['c_contact']);
    // check if city name only contains letters and whitespace
    if (!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/",$c_contact)) {
        $c_contactErr = "Please enter a valid phone number";
        echo "<script>alert('Please try again! $c_contactErr')</script>";
        exit();
    }

    // Function used to sanitize and validate use input
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    
    $hash = password_hash($c_pass, PASSWORD_BCRYPT);
    
    // moves uploaded files into folder called customer_images
    move_uploaded_file($c_image_tmp, "customer_images/$c_image");
    
    // Update customer table SET ('$c_name', '$c_email', '$c_pass', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image', '$ip')
    $update_c = "UPDATE customers SET customer_name=?, customer_email=?, customer_pass=?, customer_country=?, customer_city=?, customer_contact=?, customer_address=?, customer_image=?
                WHERE customer_ip=? AND customer_email=?";
    
    if($stmt = $con -> prepare($update_c)){
        
        // bind parameters
        $stmt ->bind_param('ssssssssss', $c_name, $c_email, $hash, $c_country, $c_city, $c_contact, $c_address, $c_image, $ip, $email);
   
        if($stmt -> execute()){
          $_SESSION['customer_email'] = $c_email;
          echo "<script>alert('Your account succesfully updated!')</script>";
          echo "<script>window.open('my_account.php', '_self')</script>";
        }
    }
 }

?>
