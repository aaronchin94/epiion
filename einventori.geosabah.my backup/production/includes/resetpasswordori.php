<?php include "db.php"; ?>

<?php error_reporting (E_ALL ^ E_NOTICE); ?>
        <?php
        if(isset($_POST["resetpw"])){
        
        // Taking all 5 values from the form data(input)
        $id = mysqli_real_escape_string($connection, $_POST['id']);
        

        $password       =   mysqli_real_escape_string($connection, $_POST['ic']);

        $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12));
       
        // Performing insert query execution
        // here our table name is college
        $sql = "UPDATE users  SET password='$password' 
                WHERE id='$id'";
         
        if(mysqli_query($connection, $sql)){


            echo "<script>alert('Reset Berjaya');
            window.location.href='../user_view.php'</script>";

            //echo "<h3>data stored in a database successfully."
              //  . " Please browse your localhost php my admin"
                //. " to view the updated data</h3>";
                
 
        } 
        else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($connection);
        }
    }
    else{
        header("Location: ../index.php");
        // Close connection
        mysqli_close($connection);
    }
        ?>