<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
if (isset($_POST["usetype"])) {

    require_once "includes/db.php";

    // Taking all 5 values from the form data(input)
    $usetype = $_POST['usetype'];
    $staff_id = $_POST['staff_id'];
    $assetid = $_POST['assetid'];
    $model = $_POST['model'];
    $tahun = $_POST['tahun'];
    $serial = $_POST['serial'];
    $kewpa = $_POST['kewpa'];
    $status = $_POST['status'];
    $perolehan = $_POST['perolehan'];
    $sumber = $_POST['sumber'];
    $jeniscetakan = $_POST['jeniscetakan'];
    $network = $_POST['network'];
    $ipv4 = $_POST['ipv4'];
    $subnet = $_POST['subnet'];
    $defaultgateway = $_POST['defaultgateway'];
    $dnsserver = $_POST['dnsserver'];

    // Performing insert query execution
    // here our table name is college
    $sql = "INSERT INTO `printer` (
            `penggunaan`, `staff_id`, `asset`, `asset_id`, `model`, `tahun`,
            `serial`, `kewpa`, `status`, `jen_perolehan`, `sumber`,
            `jen_cetakan`, `network`, `ip_address`, `subnet_mask`,
            `def_gateway`, `dns_server`, `InsertedAt`
        ) VALUES (
            '$usetype', '$staff_id', 'Printer', '$assetid', '$model', '$tahun',
            '$serial', '$kewpa', '$status', '$perolehan', '$sumber',
            '$jeniscetakan', '$network', '$ipv4', '$subnet',
            '$defaultgateway', '$dnsserver', NOW()
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