<?php include "db.php"; ?>

<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
if (isset($_POST["submit"])) {

    // Taking all 5 values from the form data(input)
    $la_id = mysqli_real_escape_string($connection, $_POST['la_id']);
    $penggunaan = mysqli_real_escape_string($connection, $_POST['usetype']);
    $staff_id = mysqli_real_escape_string($connection, $_POST['staff_id']);
    $model = mysqli_real_escape_string($connection, $_POST['model']);
    $tahun = mysqli_real_escape_string($connection, $_POST['tahun']);
    $serial = mysqli_real_escape_string($connection, $_POST['serial']);
    $kewpa = mysqli_real_escape_string($connection, $_POST['kewpa']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
    $jen_perolehan = mysqli_real_escape_string($connection, $_POST['jen_perolehan']);
    $sumber = mysqli_real_escape_string($connection, $_POST['sumber']);
    $os = mysqli_real_escape_string($connection, $_POST['os']);
    $app_kerja = mysqli_real_escape_string($connection, $_POST['app_kerja']);
    $anti_v = mysqli_real_escape_string($connection, $_POST['anti_v']);
    $processor = mysqli_real_escape_string($connection, $_POST['processor']);
    $ram_gb = mysqli_real_escape_string($connection, $_POST['ram_gb']);
    $kapasiti_hd_gb = mysqli_real_escape_string($connection, $_POST['kapasiti_hd_gb']);
    $kad_grafik = mysqli_real_escape_string($connection, $_POST['kad_grafik']);
    $network_lan = mysqli_real_escape_string($connection, $_POST['network_lan']);
    $modem = mysqli_real_escape_string($connection, $_POST['modem']);
    $ip_address = mysqli_real_escape_string($connection, $_POST['ipv4']);
    $subnet_mask = mysqli_real_escape_string($connection, $_POST['subnet']);
    $def_gateway = mysqli_real_escape_string($connection, $_POST['defaultgateway']);
    $dns_server = mysqli_real_escape_string($connection, $_POST['dnsserver']);


    // Performing insert query execution
    // here our table name is college
    $sql = "
        UPDATE laptop SET 
        penggunaan='$penggunaan',
        staff_id='$staff_id',
        model='$model',
        tahun='$tahun',
        serial='$serial',
        kewpa='$kewpa',
        status='$status',
        jen_perolehan='$jen_perolehan',
        sumber='$sumber',
        os='$os',
        app_kerja='$app_kerja',
        anti_v='$anti_v',
        processor='$processor',
        ram_gb='$ram_gb',
        kapasiti_hd_gb='$kapasiti_hd_gb',
        kad_grafik='$kad_grafik',
        network_lan='$network_lan',
        modem='$modem',
        ip_address='$ip_address',
        subnet_mask='$subnet_mask',
        def_gateway='$def_gateway',
        dns_server='$dns_server'
        WHERE la_id='$la_id'
        ";

    if (mysqli_query($connection, $sql)) {


        echo "<script>alert('Kemaskini Berjaya');
            window.location.href='../asset_review_laptop.php?id=$la_id'</script>";

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