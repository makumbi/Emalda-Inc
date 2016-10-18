<?php
include("includes/db.php");

function find_count_in_error_logins($email){
    
    // Use global keyword to connect to our database
    global $con;

    // connect to local DB
    $con = mysqli_connect("localhost", "root", "root", "emaldaDB");

    if(mysqli_connect_errno()){
        echo "The connection was not established: " . mysqli_connect_errno();
    }
    
    $isRow = find_in_error_logins($email);
    // set SQL statement and execute
    $sel_user = "SELECT * FROM failed_login WHERE email=?";

    if($stmt = $con -> prepare($sel_user)){

        // bind parameters
        $stmt -> bind_param('s', $email);

        // execute query
        $stmt -> execute();    

        // get results
        $result = $stmt -> get_result();
        
        while($row = $result -> fetch_array()){
            $email = $row['email'];
            $count = $row['count'];
            $last_time = $row['last_time'];
            return $count; 
        }
        
        if(!$isRow){
            add_record_in_error_logins($email);
            return 0;
        }
    // close statement
    $stmt ->close();  
    } 
    // close connection
    $con -> close(); 
        
 }
 
function find_in_error_logins($email){
    
    // Use global keyword to connect to our database
    global $con;

    // connect to local DB
    $con = mysqli_connect("localhost", "root", "root", "emaldaDB");

    if(mysqli_connect_errno()){
        echo "The connection was not established: " . mysqli_connect_errno();
    }
    // set SQL statement and execute
    $sel_user = "SELECT * FROM failed_login WHERE email=?";

    if($stmt = $con -> prepare($sel_user)){

        // bind parameters
        $stmt -> bind_param('s', $email);

        // execute query
        $stmt -> execute();    

        // get results
        $result = $stmt -> get_result();
        
        // gets number of rows in results
        $row_cnt = $result -> num_rows;
        
        if($row_cnt > 0){ 
           return true;
        } else {
           return false;
        }
        // close statement
        $stmt ->close();  
    }       
    // close connection
    $con -> close();     
}

function find_time_in_error_logins($email){
    // Use global keyword to connect to our database
    global $con;

    // connect to local DB
    $con = mysqli_connect("localhost", "root", "root", "emaldaDB");

    if(mysqli_connect_errno()){
        echo "The connection was not established: " . mysqli_connect_errno();
    }

    // set SQL statement and execute
    $sel_user = "SELECT * FROM failed_login WHERE email=?";

    if($stmt = $con -> prepare($sel_user)){

        // bind parameters
        $stmt -> bind_param('s', $email);

        // execute query
        $stmt -> execute();    

        // get results
        $result = $stmt -> get_result();
        
        while($row = $result -> fetch_array()){
            $email = $row['email'];
            $count = $row['count'];
            $last_time = $row['last_time'];
            return $last_time;
        }
    // close statement
    $stmt ->close();  
    } 
    // close connection
    $con -> close();      
 }


function add_record_in_error_logins($email){
    // Use global keyword to connect to our database
    global $con;

    // connect to local DB
    $con = mysqli_connect("localhost", "root", "root", "emaldaDB");

    if(mysqli_connect_errno()){
        echo "The connection was not established: " . mysqli_connect_errno();
    }
    
    $count = 1;
    $last_time = time();
    
    // set SQL statement and execute
    $sel_user = "INSERT INTO failed_login VALUES (?,?,?)";

    if($stmt = $con -> prepare($sel_user)){

        // bind parameters
        $stmt -> bind_param('sss', $email, $count, $last_time);

        // execute query
        if($stmt -> execute()){ 
            echo "<script>window.alert('Incorrect Username or Password!')</script>";
            echo "<script>window.alert('Please try again!')</script>";
            exit();
        }    
        // close statement
        $stmt ->close();  
    }       
    // close connection
    $con -> close();    
}

function update_record_in_error_logins($email){
    // Use global keyword to connect to our database
    global $con;

    // connect to local DB
    $con = mysqli_connect("localhost", "root", "root", "emaldaDB");

    if(mysqli_connect_errno()){
        echo "The connection was not established: " . mysqli_connect_errno();
    }
    // We call on our defined function to find number of times user has entered error 
    $failed_login_ctn = count_in_error_logins($email);
    $counted = $failed_login_ctn + 1;
    
    $last_time = time();
   
    // set SQL statement and execute
    // Declare int value to be used for incrementing value in count column
    // Then set it to 0
    $sel_user = "UPDATE failed_login "
            . "SET count=?, last_time=? "
            . "WHERE email=?";

    if($stmt = $con -> prepare($sel_user)){

        // bind parameters
        $stmt -> bind_param('iis', $counted, $last_time, $email);
        // execute query
        if($stmt -> execute()){
            echo "<script>window.alert('Incorrect Username or Password!')</script>";
            echo "<script>window.alert('Please try again!')</script>";
            exit();
        }    
        // close statement
        $stmt ->close();  
    }       
    // close connection
    $con -> close();  
}

function count_in_error_logins($email){
    
    // Use global keyword to connect to our database
    global $con;

    // connect to local DB
    $con = mysqli_connect("localhost", "root", "root", "emaldaDB");

    if(mysqli_connect_errno()){
        echo "The connection was not established: " . mysqli_connect_errno();
    }
    
    // set SQL statement and execute
    $sel_user = "SELECT * FROM failed_login WHERE email=?";

    if($stmt = $con -> prepare($sel_user)){

        // bind parameters
        $stmt -> bind_param('s', $email);

        // execute query
        $stmt -> execute();    

        // get results
        $result = $stmt -> get_result();
        
        while($row = $result -> fetch_array()){
            $email = $row['email'];
            $count = $row['count'];
            $last_time = $row['last_time'];
            return $count; 
        }
    // close statement
    $stmt ->close();  
    } 
    // close connection
    $con -> close(); 
        
 }

function update_record_in_error_logins_CLEAR($email){
    // Use global keyword to connect to our database
    global $con;

    // connect to local DB
    $con = mysqli_connect("localhost", "root", "root", "emaldaDB");

    if(mysqli_connect_errno()){
        echo "The connection was not established: " . mysqli_connect_errno();
    }
    
    $last_time = 0;
    
    // set SQL statement and execute
    // Declare int value to be used for incrementing value in count column
    // Then set it to 0
    $sel_user = "UPDATE failed_login SET count = 0, last_time=? WHERE email=?";

    if($stmt = $con -> prepare($sel_user)){

        // bind parameters
        $stmt -> bind_param('is', $last_time, $email);

        // execute query
        if($stmt -> execute()){
            
            return true;
        }    
        // close statement
        $stmt ->close();  
    }       
    // close connection
    $con -> close();  
}
