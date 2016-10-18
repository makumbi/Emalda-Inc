<?php
session_start();

// verfiy whether randomly generated token is set
if(!($_SESSION['token'] && isset($_SESSION['email']))){
    echo "<script>window.open('login.php?not_user=You have not logged in!', '_self')</script>";  
} else {

?>

<!DOCTYPE html>
    <html class="no-js" lang="en"> 
<head>
	<title>This is Admin Panel</title>												<!--Change Title-->
<meta charset="utf-8">																	<!--Edge mode for IE8+-->
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
  </body>
  </html>

  <!-- Localized -->
<?php } ?>
