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
    $sql = "
        INSERT INTO `avr`
        (`penggunaan`, `staff_id`, `asset`, `asset_id`, `model`,
         `tahun`, `serial`, `kewpa`, `status`, `jen_perolehan`, `sumber`) VALUES (
        
        ?,
        ?,
        'AVR',
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?
        )";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sissis", $usetype, $staff_id, $assetid, $model, $tahun, $serial, $kewpa, $status, $perolehan, $sumber);

    if ($stmt->execute()) {
        echo "<script>alert('Pendaftaran Berjaya');
            window.location.href='asset_view.php'</script>";


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