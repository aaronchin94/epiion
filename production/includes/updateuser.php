<?php 
    include_once "db.php"; 
    include_once 'secure_function.php';
    global $connection;
?>

<?php error_reporting (E_ALL ^ E_NOTICE); ?>
        <?php
        if(isset($_POST["submit"])){
        
        // Taking all 5 values from the form data(input)
        $id = mysqli_real_escape_string($connection, $_POST['id']);
        $name       =   mysqli_real_escape_string($connection, $_POST['name']);
        $ic       =   mysqli_real_escape_string($connection, $_POST['ic']);
        $jawatan       =   mysqli_real_escape_string($connection, $_POST['jawatan']);
        $lokasi       =   mysqli_real_escape_string($connection, $_POST['lokasi']);
        $unit       =   mysqli_real_escape_string($connection, $_POST['unit']);
        $email       =   mysqli_real_escape_string($connection, $_POST['email']);
        $tel       =   mysqli_real_escape_string($connection, $_POST['tel']);
        $role       =   mysqli_real_escape_string($connection, $_POST['role']);

        // Performing insert query execution
        // here our table name is college
        $sql = "UPDATE staff  SET name=?, ic=?, jawatan=?, lokasi=?, unit=?, email=?, tel=?, role=? 
                WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssssi", $name,$ic,$jawatan,$lokasi,$unit,$email,$tel,$role,$id);
        
        if(isRedundant("useric", $ic, $id)){
            echo "<script>alert('Kemaskini Gagal! IC telah didaftarkan untuk mengelak dari sebarang masalah!');
            window.location.href='../user_view.php'</script>";
        } else {
            if($stmt->execute()){
                echo "<script>alert('Kemaskini Berjaya');
                window.location.href='../user_view.php'</script>";
            } 
            else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($connection);
            }
        }
        
        
    }
    else{
        header("Location: ../index.php");
        // Close connection
        mysqli_close($connection);
    }
        ?>