<?php

include("includes/sql_functions.php");

// Brute force throttling
function record_failed_login($email){
    $failed_login = find_in_error_logins($email);
    
    // If failed login returns false
    // It means user isn't registered into failed_login db
    // Therefore add new record in failed_logion db
    if(!$failed_login){
        add_record_in_error_logins($email);
    }else{
        update_record_in_error_logins($email);
    }
    return true;
}
function clear_failed_logins($email){
    $failed_login = update_record_in_error_logins_CLEAR($email);
    
    if($failed_login){  
        return true; 
    }
    return false;
}

// returns the number of mins to wait until logins
// are allowed again
function throttle_failed_logins($email){
    $throttle_at = 3;
    $delay_in_mins = 10;
    $delay = 60 * $delay_in_mins;
    
    $failed_login = find_in_error_logins($email);
    $failed_login_ctn = find_count_in_error_logins($email);
    $failed_login_time = find_time_in_error_logins($email);
    // Once failure count is over $throttle_at value
    // User must wait for the delay $delay period to pass
    if(isset($failed_login) && $failed_login_ctn >= $throttle_at){
        $remaining_delay = ($failed_login_time +  $delay) - time();
        $remaining_delay_in_mins = ceil($remaining_delay / 60);
        return $remaining_delay_in_mins;
    }else{
        return 0;
    }
}
