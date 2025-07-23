<?php 
    function noRecordFound($noColspan, bool $ismuted) {
        $muted = $ismuted ? 'text-muted' : '';
        echo "<tr><td colspan=$noColspan class='text-center'><span class='$muted' style='font-style:italic'>Tiada rekod!</span></td></tr>";
    }

?>