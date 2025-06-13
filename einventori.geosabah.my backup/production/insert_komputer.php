<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
if (isset($_POST["usetype"])) {

    // servername => localhost, hubhasil.geosabah.my
    // username => root
    // password => empty
    // database name => staff
    $conn = mysqli_connect("localhost", "sabah_wuser", "70be8036125732e724d96024de2339d15a3194f3d2f6c462", "inventory");

    // Check connection
    if ($conn === false) {
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

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
    $sql = "
        INSERT INTO komputer VALUES (
        '0',
        '$usetype',
        '$staff_id',
        'Komputer',
        '$assetid',
        '$model',
        '$tahun',
        '$serial',
        '$kewpa',
        '$status',
        '$perolehan',
        '$sumber',
        '$os',
        '$app_kerja',
        '$anti_v',
        '$processor',
        '$ram',
        '$harddisk',
        '$grafik',
        '$networklan',
        '$modem',
        '$ipv4',
        '$subnet',
        '$defaultgateway',
        '$dnsserver'
        )";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Pendaftaran Berjaya');
            window.location.href='asset_view.php'</script>";

        //echo "<h3>data stored in a database successfully."
        //  . " Please browse your localhost php my admin"
        //. " to view the updated data</h3>";


    } else {
        echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
    }
} else {
    header("Location: ../index.php");
    // Close connection
    mysqli_close($conn);
}
?>