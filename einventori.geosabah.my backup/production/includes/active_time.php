<?php 
include 'db.php';


// Set the staff ID to retrieve the total active time for
$staff_id = $_GET['id'];

// Query to calculate total active time for the specified staff member
$sql = "SELECT staff_id, SUM(TIMESTAMPDIFF(SECOND, login_time, last_seen_time)) AS total_active_time FROM login_session WHERE staff_id = $staff_id";

// Execute the query and fetch the results
$result = $connection->query($sql);
$row = $result->fetch_assoc();

// Retrieve the total active time from the query results
$total_active_time = $row['total_active_time'];


// Convert total active time to hours, minutes, and seconds format
$hours = floor($total_active_time / 3600);
$minutes = floor(($total_active_time / 60) % 60);
$seconds = $total_active_time % 60;

// Generate HTML code using echo statement
echo "<p><b>Jumlah waktu aktif adalah $hours jam, $minutes minit, dan $seconds saat </b></p>"; 
?>