<?php include "db.php"; ?>

<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
if (isset($_POST["submit"])) {

    // Taking all 5 values from the form data(input)
    $u_id = mysqli_real_escape_string($connection, $_POST['u_id']);
    $penggunaan = mysqli_real_escape_string($connection, $_POST['usetype']);
    $staff_id = mysqli_real_escape_string($connection, $_POST['staff_id']);
    $model = mysqli_real_escape_string($connection, $_POST['model']);
    $tahun = mysqli_real_escape_string($connection, $_POST['tahun']);
    $serial = mysqli_real_escape_string($connection, $_POST['serial']);
    $kewpa = mysqli_real_escape_string($connection, $_POST['kewpa']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);
    $jen_perolehan = mysqli_real_escape_string($connection, $_POST['jen_perolehan']);
    $sumber = mysqli_real_escape_string($connection, $_POST['sumber']);

    // Performing insert query execution
    // here our table name is college
    $sql = "
        UPDATE ups SET 
        penggunaan='$penggunaan',
        staff_id='$staff_id',
        model='$model',
        tahun='$tahun',
        serial='$serial',
        kewpa='$kewpa',
        status='$status',
        jen_perolehan='$jen_perolehan',
        sumber='$sumber'
        WHERE u_id='$u_id'
        ";

    if (mysqli_query($connection, $sql)) {


        echo "<script>alert('Kemaskini Berjaya');
            window.location.href='../asset_review_ups.php?id=$u_id'</script>";

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