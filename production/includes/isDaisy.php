<?php 
    include "db.php";

    $sql = "SELECT * FROM `staff` WHERE `id` = '781' ";
    $rsql = mysqli_query($connection, $sql);
    $fsql = mysqli_fetch_assoc($rsql);
    $getIParam = $fsql['ic'];

    function checkIsDaisy($checkingParam){
        global $getIParam;
        
        if($getIParam == $checkingParam){
            return true;
        }

        return false;
    }
?>