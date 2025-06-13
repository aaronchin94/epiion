<?php
// Connect to the MySQL database
include_once ('db.php');

// Set the timezone to your local timezone
date_default_timezone_set('Asia/Kuching');

// Get the visitor's IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Check if the IP address exists in the database for today's date
$today = date('Y-m-d');
$query = "SELECT id FROM visitors WHERE ip_address = '$ip_address' AND visit_date = '$today'";
$result = mysqli_query($connection, $query);
$num_rows = mysqli_num_rows($result);

// If the IP address doesn't exist, insert a new record
if ($num_rows == 0) {
  $visit_time = date('H:i:s');
  $query = "INSERT INTO visitors (ip_address, visit_date, visit_time) VALUES ('$ip_address', '$today', '$visit_time')";
  mysqli_query($connection, $query);
}

// Get the total number of visitors
$query = "SELECT COUNT(DISTINCT ip_address) AS total_visitors FROM visitors";
$result = mysqli_query($connection, $query);
$row1 = mysqli_fetch_assoc($result);
$total_visitors = $row1['total_visitors'];

// Get the number of visitors for today
$query = "SELECT COUNT(DISTINCT ip_address) AS today_visitors FROM visitors WHERE visit_date = '$today'";
$result = mysqli_query($connection, $query);
$row2 = mysqli_fetch_assoc($result);
$today_visitors = $row2['today_visitors'];
