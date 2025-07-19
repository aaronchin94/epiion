<?php

    function sanitizeText($value) { 
        return htmlspecialchars(trim(strip_tags($value)), ENT_QUOTES, 'UTF-8'); 
    }

    
?>