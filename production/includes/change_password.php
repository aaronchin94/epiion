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

 

 if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {

	$op = trim($_POST['op']);
	$np = trim($_POST['np']);
	$c_np = trim($_POST['c_np']);
    
    $id = $_SESSION['id'];

    $op = mysqli_real_escape_string($connection, $op);
    $np = mysqli_real_escape_string($connection, $np);
    $c_np = mysqli_real_escape_string($connection, $c_np);
    $hop = password_hash( $op, PASSWORD_BCRYPT, array('cost' => 12));
    $hnp = password_hash( $np, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "SELECT * FROM staff WHERE id = '{$id}' ";
    $select_user_query = mysqli_query($connection, $query);
    
    if (!$select_user_query) {

        die("QUERY FAILED" . mysqli_error($connection));

    }

    while ($row = mysqli_fetch_array($select_user_query)) {

        $db_user_id        = $row['id'];
        $db_username       = $row['username'];
        $db_user_password  = $row['password'];
        $db_user_role      = $row['role'];
        
        if (password_verify($op,$db_user_password)){
            $sql2 = "UPDATE staff SET password='$hnp' WHERE id='$id'";
            mysqli_query($connection, $sql2);
            header("Location: ../user_changepassword.php?success=Tetapan semula kata laluan berjaya");
	        exit();

        }else {
        	header("Location: ../user_changepassword.php?error=Kata laluan asal tidak tepat");
	        exit();
        }

    }
            

    }
    