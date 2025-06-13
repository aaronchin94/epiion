<?php 
include "includes/db.php"; 
include_once 'includes/session.php';
include_once 'includes/adminonly.php';
?>



        <?php
        if(isset($_GET["id"])){
        
        // Taking all 5 values from the form data(input)
        $id = mysqli_real_escape_string($connection, $_GET['id']);
    
        // Performing insert query execution
        // here our table name is college
        $sql = "DELETE FROM staff WHERE id='$id' ";
         
        if(mysqli_query($connection, $sql)){


            echo "<script>alert('Pengguna Telah Berjaya Dipadam');
            window.location.href='./staff_view.php'</script>";

            //echo "<h3>data stored in a database successfully."
              //  . " Please browse your localhost php my admin"
                //. " to view the updated data</h3>";
                
 
        } 
        else{
            echo "<script>alert('Pengguna Tidak Berjaya Dipadam');
            window.location.href='../staff_view.php'</script>";
        }
    }
    else{
        header("Location: ./index.php");
        // Close connection
        mysqli_close($connection);
    }
        ?>