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
    
?>