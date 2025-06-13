<?php
include 'header.php';
include_once 'includes/adminonly.php'
  ?>

<?php

// Taking all 5 values from the form data(input)

// Performing insert query execution
// here our table name is college

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "
            DELETE FROM laptop
            WHERE la_id='$id'
            ";

  if (mysqli_query($connection, $sql)) {


    echo "<script>alert('Aset Telah Berjaya Dipadam');
              window.location.href='./asset_view.php'</script>";

    //echo "<h3>data stored in a database successfully."
    //  . " Please browse your localhost php my admin"
    //. " to view the updated data</h3>";


  } else {
    echo "<script>alert('Aset Tidak Berjaya Dipadam');
              window.location.href='../asset_view.php'</script>";
  }

  mysqli_close($connection);
}


?>