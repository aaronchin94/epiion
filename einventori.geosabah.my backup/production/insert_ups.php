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
    // Performing insert query execution
    // here our table name is college
    $sql = "
        INSERT INTO ups VALUES (
        '0',
        '$usetype',
        '$staff_id',
        'UPS',
        '$assetid',
        '$model',
        '$tahun',
        '$serial',
        '$kewpa',
        '$status',
        '$perolehan',
        '$sumber'
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