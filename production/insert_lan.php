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

    // $sql = "INSERT INTO `lan_switch` (
    //         `penggunaan`, `staff_id`, `asset`, `asset_id`, `model`, 
    //         `serial`, `kewpa`, `status`, `jen_perolehan`, `sumber`, 
    //         `bil_port`, `InsertedAt`
    //     ) VALUES (
    //         '$usetype', '$staff_id', 'LAN', '$assetid', '$model', 
    //         '$serial', '$kewpa', '$status', '$perolehan', '$sumber', 
    //         '$port', NOW()
    //     )";

    $sql = "INSERT INTO `lan_switch` (
        `penggunaan`, `staff_id`, `asset`, `asset_id`, `model`, 
        `serial`, `kewpa`, `status`, `jen_perolehan`, `sumber`, 
        `bil_port`, `InsertedAt`
    ) VALUES (?, ?, 'LAN', ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param(
    "ssssssssss",  
    $usetype, $staff_id, $assetid, $model, $serial,
        $kewpa, $status, $perolehan, $sumber, $port
    );
    
    
    if ($stmt->execute()) {
        echo "<script>alert('Pendaftaran Berjaya');
            window.location.href='asset_view.php'</script>";

    } else {
        echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($connection);
    }

    $stmt->close();

} else {
    header("Location: ../index.php");
    // Close connection
    mysqli_close($connection);
}
?>