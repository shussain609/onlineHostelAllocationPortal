<?php
    
        session_start();
        session_destroy();
        $_SESSION=array();
        echo '<script>window.location="index.html"</script>';
?>
