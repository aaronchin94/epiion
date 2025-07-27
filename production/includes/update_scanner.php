<?php include "db.php"; ?>

<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
if (isset($_POST["submit"])) {

    // Taking all 5 values from the form data(input)
    $s_id = mysqli_real_escape_string($connection, $_POST['s_id']);
    $penggunaan = mysqli_real_escape_string($connection, $_POST['usetype']);
    $staff_id = mysqli_real_escape_string($connection, $_POST['staff_id']);
    $model = mysqli_real_escape_string($connection, $_POST['model']);
    $tahun = mysqli_real_escape_string($connection, $_POST['tahun']);
    $serial = mysqli_real_escape_string($connection, $_POST['serial']);
    $kewpa = mysqli_real_escape_string($connection, $_POST['kewpa']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
    $jen_perolehan = mysqli_real_escape_string($connection, $_POST['jen_perolehan']);
    $sumber = mysqli_real_escape_string($connection, $_POST['sumber']);
    $resolution = mysqli_real_escape_string($connection, $_POST['resolution']);
    $network = mysqli_real_escape_string($connection, $_POST['network']);
    $ip_address = mysqli_real_escape_string($connection, $_POST['ipv4']);
    $subnet_mask = mysqli_real_escape_string($connection, $_POST['subnet']);
    $def_gateway = mysqli_real_escape_string($connection, $_POST['defaultgateway']);
    $dns_server = mysqli_real_escape_string($connection, $_POST['dnsserver']);


    // Performing insert query execution
    // here our table name is college
    $sql = "
        UPDATE scanner SET 
        penggunaan=?, 
        staff_id=?,
        model=?,
        tahun=?,
        serial=?,
        kewpa=?,
        status=?,
        jen_perolehan=?,
        sumber=?,
        resolution=?,
        network=?,
        ip_address=?,
        subnet_mask=?,
        def_gateway=?,
        dns_server=?
        WHERE s_id=?
        ";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sissssssssssssssi",  $penggunaan, $staff_id, $model, $tahun, $serial, $kewpa, $status, $jen_perolehan, $sumber, $resolution, $network, $ip_address, $subnet_mask, $def_gateway, $dns_server, $s_id);
    

    if ($stmt->execute()) {


        echo "<script>alert('Kemaskini Berjaya');
            window.location.href='../asset_review_scanner.php?id=$s_id'</script>";

        //echo "<h3>data stored in a database successfully."
        //  . " Please browse your localhost php my admin"
        //. " to view the updated data</h3>";


    } else {
        echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($connection);
        // echo $nama_pengguna;
    }
} else {
    header("Location: ../index.php");
    // Close connection
    mysqli_close($connection);
}
?>