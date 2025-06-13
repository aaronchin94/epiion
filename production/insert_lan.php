<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
if (isset($_POST["usetype"])) {
 
    require_once "includes/db.php";

    // Taking all 5 values from the form data(input)
    $usetype = $_POST['usetype'];
    $assetid = $_POST['assetid'];
    $staff_id = $_POST['staff_id'];
    $model = $_POST['model'];
    $serial = $_POST['serial'];
    $kewpa = $_POST['kewpa'];
    $status = $_POST['status'];
    $perolehan = $_POST['perolehan'];
    $sumber = $_POST['sumber'];
    $port = $_POST['port'];
    // Performing insert query execution
    // here our table name is college
    $sql = "INSERT INTO `lan_switch` (
            `penggunaan`, `staff_id`, `asset`, `asset_id`, `model`, 
            `serial`, `kewpa`, `status`, `jen_perolehan`, `sumber`, 
            `bil_port`, `InsertedAt`
        ) VALUES (
            '$usetype', '$staff_id', 'LAN', '$assetid', '$model', 
            '$serial', '$kewpa', '$status', '$perolehan', '$sumber', 
            '$port', NOW()
        )";


    if (mysqli_query($connection, $sql)) {
        echo "<script>alert('Pendaftaran Berjaya');
            window.location.href='asset_view.php'</script>";

        //echo "<h3>data stored in a database successfully."
        //  . " Please browse your localhost php my admin"
        //. " to view the updated data</h3>";


    } else {
        echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($connection);
    }
} else {
    header("Location: ../index.php");
    // Close connection
    mysqli_close($connection);
}
?>