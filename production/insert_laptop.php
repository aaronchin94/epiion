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
    $os = $_POST['os'];
    $app_kerja = $_POST['app_kerja'];
    $anti_v = $_POST['anti_v'];
    $processor = $_POST['processor'];
    $ram = $_POST['ram'];
    $harddisk = $_POST['harddisk'];
    $grafik = $_POST['grafik'];
    $networklan = $_POST['networklan'];
    $modem = $_POST['modem'];
    $ipv4 = $_POST['ipv4'];
    $subnet = $_POST['subnet'];
    $defaultgateway = $_POST['defaultgateway'];
    $dnsserver = $_POST['dnsserver'];

    // Performing insert query execution
    // here our table name is college
    $sql = "INSERT INTO `laptop` (
            `penggunaan`, `staff_id`, `asset`, `asset_id`, `model`, `tahun`,
            `serial`, `kewpa`, `status`, `jen_perolehan`, `sumber`,
            `os`, `app_kerja`, `anti_v`, `processor`, `ram_gb`, `kapasiti_hd_gb`,
            `kad_grafik`, `network_lan`, `modem`, `ip_address`, `subnet_mask`,
            `def_gateway`, `dns_server`, `InsertedAt`
        ) VALUES (
            ?, ?, 'Laptop', ?, ?, ?,
            ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?,
            ?, ?, NOW()
        )";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siisissssssssssssssssss", $usetype, $staff_id, $assetid, $model, $tahun,
                                $serial, $kewpa, $status, $perolehan, $sumber,
                                $os, $app_kerja, $anti_v, $processor, $ram, $harddisk,
                                $grafik, $networklan, $modem, $ipv4, $subnet,
                                $defaultgateway, $dnsserver);

    if ($stmt->execute()) {
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