<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Page page</title>
</head>
<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<body>
    <center>
        <?php
 
            require_once "includes/db.php";
         
        // Taking all 5 values from the form data(input)
        $name       =   $_REQUEST['name'];
        $username   =   $_REQUEST['username'];
        $ic         =   $_REQUEST['ic'];
        $password   =   $_REQUEST['ic'];
        $jawatan    =   $_REQUEST['jawatan'];
        $lokasi     =   $_REQUEST['lokasi'];
        $unit       =   $_REQUEST['unit'];
        $email      =   $_REQUEST['email'];
        $tel        =   $_REQUEST['tel'];
        $role       =   $_REQUEST['role'];
         
        $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12));
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO `usersold` (
            `name`, `username`, `ic`, `password`, `jawatan`,
            `lokasi`, `unit`, `email`, `tel`, `role`
        ) VALUES (
            '$name', '$username', '$ic', '$password', '$jawatan',
            '$lokasi', '$unit', '$email', '$tel', '$role'
        )";

         
        if(mysqli_query($connection, $sql)){
            echo '<script>alert("Data has been stored successfully")</script>';
            //echo "<h3>data stored in a database successfully."
              //  . " Please browse your localhost php my admin"
                //. " to view the updated data</h3>";

                header("Location: user_view.php");
 
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($connection);
        }
         
        // Close connection
        mysqli_close($connection);
        ?>
    </center>
</body>
 
</html>