<?php
include 'db.php';

// Retrieve token and new password from form
$id = mysqli_real_escape_string($connection, $_POST['id']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$ic = mysqli_real_escape_string($connection, $_POST['ic']);


// Hash password
$hashed_password = password_hash($ic, PASSWORD_BCRYPT, array('cost' => 12));

// Update user's password in the database
$id = mysqli_real_escape_string($connection, $id);
$query = "UPDATE staff 
          SET password = '$hashed_password', firstlogin = '1'
          WHERE staff.id = '$id' AND staff.email = '$email'";

// Execute the query and check if it was successful
if (mysqli_query($connection, $query)) {
    // Password updated successfully
    // Display success message
    echo "<script>alert('Kata laluan berjaya ditetapkan.');
	        window.location.href='logout.php'</script>";
} else {
    // Password update failed
    echo "<script>alert('Error3');
	        window.location.href='logout.php'</script>";

    // Debugging message
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}
