<?php 
include 'db.php';

$dbName = 'inventory';
$tableName = 'staff';
$aasd = 50;
$qqwe = 10;

// Call the stored procedure
$stmt = $connection->prepare("CALL sp_get_tablevalue_with_limit(?, ?, ?, ?, @output)");
$stmt->bind_param("ssii", $dbName, $tableName, $aasd, $qqwe);
$stmt->execute();
$stmt->close();

// Fetch the OUT parameter
$result = $connection->query("SELECT @output AS resultStr");

if ($row = $result->fetch_assoc()) {
    echo "<pre>Output:\n" . $row['resultStr'] . "</pre>";
} else {
    echo "No result returned.";
}

// $connection->close();
?>


<!DOCTYPE html>
<html>
<body>

<h2>Migrate data (make sure targeted table has been created and emptied)</h2>

<form method="POST">
  <label for="fname">Current DB name:</label><br>
  <input type="text" id="fname" name="curdb"><br>

  <label for="lname">Target DB name:</label><br>
  <input type="text" id="lname" name="targdb"><br><br>

  <p>Data migration:</p>
  <input type="radio" id="batching" name="migr" value="batching">
  <label for="batching">Migration in batches of 100 (recommended)</label><br>

  <input type="radio" id="directall" name="migr" value="directall">
  <label for="directall">All</label><br><br>

  <button type="submit" name="submit">Submit</button>
</form> 

<div id="migrID">
    <h3>Migration log:</h3>
    <div id="migraRes">
        <?php
            if (isset($_POST['submit'])) {
                $currentDB = $_POST['curdb'];
                $targetedDB = $_POST['targdb'];
                $isBatching = $_POST['migr'];

                echo "Current DB: " . htmlspecialchars($currentDB) . "<br>";
                echo "Target DB: " . htmlspecialchars($targetedDB) . "<br>";
                echo "Migration method: " . htmlspecialchars($isBatching);

                echo "<hr>";

                // 1. get all table name from current DB first
                $query = "SELECT table_name FROM information_schema.tables WHERE table_schema = '$currentDB';";
                $result = mysqli_query($connection, $query);

                // 2. loop through each table name and get all data from current DB
                while ($row = mysqli_fetch_array($result)) {
                // 3. get all the table name from targeted DB
                    $tableName = $row['table_name']; // echo "tableNAme: " . $tableName . "<br>";
                    
                // 4. if migration method is batching, then insert data in batches of 100
                    if($isBatching == "batching") {
                        // get the row number first
                        $rowNum =countRowNum($currentDB, $tableName);
                        $offsetLooping = ceil($rowNum/100); // echo "Total row in ".$tableName.": ".$rowNum."- ".$offsetLooping."<br>";
                         // loop through each batch of 100 row
                        // for(int i=0; i<$offsetLooping; i++) {
                        //     //$createOffset = i*100;
                        //     // call SP
                        // }

                    } else{// Call the stored procedure
                        $stmt = $connection->prepare("CALL sp_get_table_as_value_list(?, ?, ?, @output)");
                        $stmt->bind_param("sss", $targetedDB, $currentDB, $tableName);
                        $stmt->execute();
                        $stmt->close();
                        
                        // Fetch the OUT parameter
                        $result = $connection->query("SELECT @output AS resultStr");

                        if ($row = $result->fetch_assoc()) {
                            echo "<pre>Output:\n" . $row['resultStr'] . "</pre>";
                        } else {
                            echo "No result returned.";
                        }
                    }

                }
                

                
            } else {
                echo "No trigger!";
            }
        ?>
    </div>
</div>

</body>
</html>

<?php   

    // ready functions
    function countRowNum($databaseName, $tableName) {
        global $connection;

        $retNum = 0;
        $query = "SELECT COUNT(*) as ccount FROM $tableName";
        $result = mysqli_query($connection, $query);
        $fres = mysqli_fetch_assoc($result);
        $retNum = $fres['ccount'];

        return $retNum;
    }

    function checkTest(){
        echo"testtting function calling";
    }
?>
