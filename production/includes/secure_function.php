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

    function isRedundant($type, $value, $conn) {
        switch ($type) {
            case 'username':
                $sql = "SELECT COUNT(*) as count FROM users WHERE username = ?";
                break;

            case 'email':
                $sql = "SELECT COUNT(*) as count FROM users WHERE email = ?";
                break;

            case 'phone':
                $sql = "SELECT COUNT(*) as count FROM users WHERE phone = ?";
                break;

            default:
                // Invalid type — always return false
                return false;
        }

        // Prepare and execute query
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Return true if there’s more than 1 matching row
        return ($row['count'] > 1);
    }
    
?>