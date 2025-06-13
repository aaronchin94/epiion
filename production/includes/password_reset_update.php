<?php 
include 'db.php';

// Retrieve token and new password from form
$id = mysqli_real_escape_string($connection, $_POST['id']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$token = mysqli_real_escape_string($connection, $_POST['token']);
$password = mysqli_real_escape_string($connection, $_POST['np']);
$confirm_password = mysqli_real_escape_string($connection, $_POST['c_np']);

// Validate password
if ($password != $confirm_password) {
	// Passwords do not match
	echo "<script>alert('Error1');
        window.location.href='logout.php'</script>";

} else if (strlen($password) < 8) {
	// Password is too short
	echo "<script>alert('Error2');
        window.location.href='logout.php'</script>";
} else {
	// Hash password
	$hashed_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    
	// Update user's password in the database
	$id = mysqli_real_escape_string($connection, $id);
	$token = mysqli_real_escape_string($connection, $token);
	$query = "UPDATE staff 
	JOIN password_reset_tokens ON staff.id = password_reset_tokens.staff_id
	SET password = '$hashed_password'
	WHERE staff.id = '$id' AND staff.email = '$email'
	AND password_reset_tokens.token = '$token';
	";
	
	// Execute the query and check if it was successful
	if(mysqli_query($connection, $query)){
	    // Password updated successfully
	    
	    // Delete token from password_reset_tokens table
	    $token = mysqli_real_escape_string($connection, $token);
	    $query = "DELETE FROM password_reset_tokens WHERE token='$token'";
	    mysqli_query($connection, $query);
	    
	    // Display success message
	    echo "<script>alert('Kata laluan berjaya ditetapkan.');
	        window.location.href='logout.php'</script>";
	}else{
	    // Password update failed
	    echo "<script>alert('Error3');
	        window.location.href='logout.php'</script>";
	        
	    // Debugging message
	    echo "Error: " . $query . "<br>" . mysqli_error($connection);
	}
}
