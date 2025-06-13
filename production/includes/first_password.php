<?php
include "db.php";
session_start();

if(isset($_POST['Submit']) && !empty($_SESSION['username'])){
  $usernameic = $_SESSION['username'];
  $result = mysqli_query($connection,"SELECT * FROM staff WHERE ic = '$usernameic'");
  $row = mysqli_fetch_array($result); 
}
else{
  header("location: ../index.php");  
}

if (isset($_POST['np']) && isset($_POST['c_np'])) {
    
    $np = mysqli_real_escape_string($connection, $_POST['np']);
    $c_np = mysqli_real_escape_string($connection, $_POST['c_np']);
    $id = $_SESSION['id'];


    // Verify new password and confirmation password match
    if ($np !== $c_np) {
        echo "New password and confirmation password do not match";
        exit();
    }

    // Hash new password
    $hnp = password_hash($np, PASSWORD_BCRYPT, array('cost' => 12));

    // Update user's password in the database
    $sql2 = "UPDATE staff SET password='$hnp',firstlogin='0' WHERE id='$id'";
    if (mysqli_query($connection, $sql2)) {
        echo "<script>alert('Password changed successfully';window.location.href='../index.php');
        </script> ";
    } else {
        echo "Error updating password";
    }
}
