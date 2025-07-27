<?php 
include 'header.php';
include_once 'includes/adminonly.php'
?>



        <?php
        if(isset($_GET["id"])){
        
        // Taking all 5 values from the form data(input)
        $id = mysqli_real_escape_string($connection, $_GET['id']);
        $id = intval($id);
        // Performing insert query execution
        // here our table name is college
        $sql = "UPDATE staff SET access = 0, password = '', role = '' WHERE id='$id' ";
         
        if(mysqli_query($connection, $sql)){


            echo "<script>alert('Pengguna Telah Berjaya Dipadam');
            window.location.href='./user_view.php'</script>";

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
      echo '<script> window.onload = function() {
        // similar behavior as clicking on a link
        window.location.href = "./index.php";
    }</script>';
        // Close connection
        mysqli_close($connection);
    }
        ?>