<?php
// Start session
session_start();

// End session
session_destroy();

echo "<script>window.open('../index.php','_self')</script>";

 ?>
