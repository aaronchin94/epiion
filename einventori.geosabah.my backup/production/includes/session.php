<?php
//Set cookies
//session_set_cookie_params(1800);
//ini_set('session.gc_maxlifetime', 1800);

// Start the session
session_start();

if(!empty($_SESSION['username'])){
  $useric = $_SESSION['username'];
  $result = mysqli_query($connection,"SELECT * FROM staff WHERE ic = '$useric'");
  $row = mysqli_fetch_array($result); 
}
else{
  header("location: login.php");  
}


// Set the timezone to your local timezone
date_default_timezone_set('Asia/Kuching');

// Get staff IC from session or cookie
$useric = $_SESSION['username'];
$login_time =  $_SESSION['login_time'];

// Update last_seen_time for staff member
$last_seen_time = date('Y-m-d H:i:s');
$update_query = "UPDATE login_session SET last_seen_time = '$last_seen_time' WHERE staff_ic = '$useric' && login_time = '$login_time'";
$result = mysqli_query($connection, $update_query);

if (!$result) {
  // Error updating login session table
  // ...
}

// Check the last activity time
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // If the last activity time is more than 30 minutes ago, destroy the session
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}

// Update the last activity time
$_SESSION['LAST_ACTIVITY'] = time();
?>
