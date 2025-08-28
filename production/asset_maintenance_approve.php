<?php
header('Content-Type: application/json'); // Tell the browser we're sending JSON
require_once 'includes/db.php';
global $connection;

$action = isset($_POST['action']) && $_POST['action'] !="" ? $_POST['action'] : "";  

if (isset ($_POST['token'])) {
    $token = $_POST['token'];
    $estimated_completion_date = $_POST['estimated_completion_date'];
    $estimated_deliver_date = $_POST['estimated_deliver_date'];

    $getmid = "SELECT a.maintenance_id FROM maintenance a LEFT JOIN maintenance_token b ON a.maintenance_id = b.maintenance_id WHERE b.token = ?";
    $stmtgetmid = $connection->prepare($getmid);
    $stmtgetmid->bind_param("s", $token);
    $stmtgetmid->execute();
    $resgetmid = $stmtgetmid->get_result();
    $fetchgmid = $resgetmid->fetch_assoc();
    $maintID = intval($fetchgmid['maintenance_id']);

    $sql = "UPDATE maintenance SET maintenance_status = '2', estimated_completion_date = ?, estimated_deliver_date = ? WHERE maintenance_id = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $estimated_completion_date, $estimated_deliver_date, $maintID);

    if ($stmt->execute()) {
        $success = true;
        $success_redirect = true;
        $response = $response['message'] = 'Update successful';
        echo json_encode($response);
    } else {
        $success = false;
    }

    $stmtgetmid->close();
    $stmt->close();

    session_unset();
    //session_destroy();
    session_start();
    $_SESSION['username'] = '771104125752';
    $_SESSION['role'] = 'Admin';
    $_SESSION['id'] = '781';
    $login_time = date('Y-m-d H:i:s');
    $_SESSION['login_time'] = $login_time;



} elseif (isset ($_POST['id'])) {
    $ress = '';
    $maintenance_id = $_POST['id'];
    $estimated_completion_date = $_POST['estimated_completion_date'];
    $estimated_deliver_date = $_POST['estimated_deliver_date'];

    $sql = "UPDATE maintenance SET maintenance_status = 2, estimated_completion_date = ?, estimated_deliver_date = ? WHERE maintenance_id = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $estimated_completion_date, $estimated_deliver_date, $maintenance_id);

    if ($stmt->execute()) {
        $success = true;
        $success_redirect = true;
        $ress = array("status"=>1,"result"=>"Insert successfully!");
    } else {
        $success = false;
        $ress = array("status"=>0,"result"=>"Insert Failed!");
    }

    $stmt->close();

    echo json_encode($ress);
    
} elseif($action != "") {
    switch ($action){
        case 'approveMaint' :
            if(isset($_POST["data"])) {
                    $ress = "";
					$getData = $_POST["data"];
                    
                    $params = array();
                    parse_str($getData, $params); //unserialize jquery string data                            
                    $maintenance_id = isset($params['getTheId']) ? $params['getTheId'] : "";
                    $estimated_completion_date = isset($params['estimated_completion_date']) ? $params['estimated_completion_date'] : "";
                    $estimated_deliver_date = isset($params['estimated_deliver_date']) ? $params['estimated_deliver_date'] : "";
                    
                    $sql = "UPDATE maintenance SET maintenance_status = 2, estimated_completion_date = ?, estimated_deliver_date = ? WHERE maintenance_id = ?";

                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("ssi", $estimated_completion_date, $estimated_deliver_date, $maintenance_id);

                    if ($stmt->execute()) {
                        $ress = array("status"=>"1 Done", "result"=>"Insert successfully!", "maintenance_id"=>$maintenance_id);
                    } else {
                        $ress = array("status"=>"0 Failed", "result"=>"Insert Failed!");
                    }

					echo json_encode($ress);
				}
        break;

        default:
            break;
    }
}
