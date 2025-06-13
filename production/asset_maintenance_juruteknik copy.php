<?php
if (isset($_POST["technician_id"])) {
    // Establishing database connection
    include 'includes/db.php';

    // Prepare a statement
    $stmt = $connection->prepare("INSERT INTO maintenance_work 
        (maintenance_id, technician_id, assignment_date, work_status) 
        VALUES (?, ?, ?, ?)");

    // Check if the statement preparation was successful
    if (!$stmt) {
        echo "Error in preparing statement: " . $connection->error;
        exit();
    }

    // Bind parameters
    $stmt->bind_param("ssss", $maintenance_id, $technician_id, $assignment_date, $work_status);

    // Taking all values from the form data
    $maintenance_id = mysqli_real_escape_string($connection, $_POST['maintenance_id']); 
    $technician_id = mysqli_real_escape_string($connection, $_POST['technician_id']);
    $assignment_date = date('Y-m-d');
    $work_status = 0;

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Pemberian Tugas Berjaya.'); window.location.href='asset_maintenance_view.php'</script>";
    } else {
        echo "ERROR: Hush! Sorry " . $stmt->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
    mysqli_close($connection);
} else {
    header("Location: ../index.php");
}
?>