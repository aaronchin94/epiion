<?php include "db.php"; ?>

<?php error_reporting (E_ALL ^ E_NOTICE); ?>
        <?php
        if(isset($_POST["submit"])){
        
        // Taking all 5 values from the form data(input)
        $id = mysqli_real_escape_string($connection, $_POST['id']);
    
        // Performing insert query execution
        // here our table name is college
        $sql = "DELETE FROM users WHERE id='$id' ";
         
        if(mysqli_query($connection, $sql)){


            echo "<script>alert('Pengguna Telah Berjaya Dipadam');
            window.location.href='../user_view.php'</script>";

            //echo "<h3>data stored in a database successfully."
              //  . " Please browse your localhost php my admin"
                //. " to view the updated data</h3>";
                
 
        } 
        else{
            echo "<script>alert('Pengguna Tidak Berjaya Dipadam');
            window.location.href='../user_view.php'</script>";
        }
    }
    else{
        header("Location: ./index.php");
        // Close connection
        mysqli_close($connection);
    }
        ?>