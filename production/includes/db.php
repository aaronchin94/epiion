


<?php
$serverName = "localhost";
$dBUsername = "sabah_wuser";
$dBPassword = "70be8036125732e724d96024de2339d15a3194f3d2f6c462";
$dBName = "inventorytest";// update

$connection = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$connection){
    die("Connection failed: " . mysqli_connect_error());
} 

// else {
//     echo "$dBName Database";
// }
