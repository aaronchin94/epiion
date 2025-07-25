<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
if (isset($_POST["usetype"])) {

    require_once "includes/db.php";

    // Taking all 5 values from the form data(input)
    $usetype = $_POST['usetype'];
    $assetid = $_POST['assetid'];
    $staff_id = $_POST['staff_id'];
    $model = $_POST['model'];
    $tahun = $_POST['tahun'];
    $serial = $_POST['serial'];
    $kewpa = $_POST['kewpa'];
    $status = $_POST['status'];
    $perolehan = $_POST['perolehan'];
    $sumber = $_POST['sumber'];
    // Performing insert query execution
    // here our table name is college
    // $sql = "INSERT INTO `lcd` (`penggunaan`, `staff_id`, `asset`, `asset_id`, `model`, `tahun`,`serial`, `kewpa`, `status`, `jen_perolehan`, `sumber`, `InsertedAt`) VALUES ('$usetype', '$staff_id', 'LCD', '$assetid', '$model', '$tahun', '$serial', '$kewpa', '$status', '$perolehan', '$sumber', NOW())";
    $stmt = $conn->prepare("INSERT INTO lcd (
    penggunaan, staff_id, asset, asset_id, model, tahun,
    serial, kewpa, status, jen_perolehan, sumber, InsertedAt
    ) VALUES (?, ?, 'LCD', ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

    $stmt->bind_param("ssssssssss", 
    $usetype,      // 1. penggunaan
    $staff_id,     // 2. staff_id
    $assetid,      // 3. asset_id
    $model,        // 4. model
    $tahun,        // 5. tahun
    $serial,       // 6. serial
    $kewpa,        // 7. kewpa
    $status,       // 8. status
    $perolehan,    // 9. jen_perolehan
    $sumber        // 10. sumber
    );

    $stmt->execute();


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