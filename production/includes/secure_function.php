<?php

    function sanitizeText($value) { 
        return htmlspecialchars(trim(strip_tags($value)), ENT_QUOTES, 'UTF-8'); 
    }

    function sanitizeEmail($email) {
        return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    }
    
?>