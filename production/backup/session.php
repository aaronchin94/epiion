<?php
session_start();
if(!empty($_SESSION['username'])){
  $usernameid = $_SESSION['username'];
  $result = mysqli_query($connection,"SELECT * FROM users WHERE username = '$usernameid'");
  $row = mysqli_fetch_array($result); 
}
else{
  header("location: login.php");  
}
?>