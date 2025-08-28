<?php

    function sanitizeText($value) { 
        $output = '';
        if($value == "" || $value == null){

        }else {
            $output = htmlspecialchars(trim(strip_tags($value)), ENT_QUOTES, 'UTF-8'); 
        }
        return $output;
    }

    function sanitizeEmail($email) {
        return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    }
    

    function isRedundant($type, $value, $excludeId = null) {
        global $connection;

        switch ($type) {
            case 'useric':
                $sqlas = "SELECT COUNT(*) as count FROM staff WHERE `ic` = ?";
                if ($excludeId !== null) {
                    $sqlas .= " AND id != ?";
                }
                break;

            case 'email':
                $sqlas = "SELECT COUNT(*) as count FROM users WHERE email = ?";
                if ($excludeId !== null) {
                    $sqlas .= " AND id != ?";
                }
                break;

            case 'phone':
                $sqlas = "SELECT COUNT(*) as count FROM users WHERE phone = ?";
                if ($excludeId !== null) {
                    $sqlas .= " AND id != ?";
                }
                break;

            default:
                return false;
        }

        // Prepare and execute query
        $stmtisRedundant = $connection->prepare($sqlas);

        if ($excludeId !== null) {
            $stmtisRedundant->bind_param("si", $value, $excludeId);
        } else {
            $stmtisRedundant->bind_param("s", $value);
        }

        $stmtisRedundant->execute();
        $resultisredundatn = $stmtisRedundant->get_result();
        $rowred = $resultisredundatn->fetch_assoc();

        return ($rowred['count'] > 0);
    }

    
?>