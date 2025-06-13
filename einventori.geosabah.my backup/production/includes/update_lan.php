<?php include "db.php"; ?>

<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
if (isset($_POST["submit"])) {

    // Taking all 5 values from the form data(input)
    $ls_id = mysqli_real_escape_string($connection, $_POST['ls_id']);
    $penggunaan = mysqli_real_escape_string($connection, $_POST['usetype']);
    $staff_id = mysqli_real_escape_string($connection, $_POST['staff_id']);
    $model = mysqli_real_escape_string($connection, $_POST['model']);
    $serial = mysqli_real_escape_string($connection, $_POST['serial']);
    $kewpa = mysqli_real_escape_string($connection, $_POST['kewpa']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
    $jen_perolehan = mysqli_real_escape_string($connection, $_POST['jen_perolehan']);
    $sumber = mysqli_real_escape_string($connection, $_POST['sumber']);
    $port = mysqli_real_escape_string($connection, $_POST['port']);

    // Performing insert query execution
    // here our table name is college
    $sql = "
        UPDATE lan_switch SET 
        penggunaan='$penggunaan',
        staff_id='$staff_id',
        model='$model',
        serial='$serial',
        kewpa='$kewpa',
        status='$status',
        jen_perolehan='$jen_perolehan',
        sumber='$sumber',
        bil_port='$port'
        WHERE ls_id='$ls_id'
        ";

    if (mysqli_query($connection, $sql)) {


        echo "<script>alert('Kemaskini Berjaya');
            window.location.href='../asset_review_lan.php?id=$ls_id'</script>";

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