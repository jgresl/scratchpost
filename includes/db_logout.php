<?php
    // Remove username from session
    session_start();
    if(isset($_SESSION['username'])) {
        session_destroy();
    }
    
    // Return to main page
    header("Location: ../main.php");
?>